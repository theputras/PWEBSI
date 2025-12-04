<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageProxyController extends Controller
{
    public function show(Request $request, string $path)
    {
        // normalize and block traversal / protocol tricks
        $path = ltrim($path, '/');
        abort_if(Str::contains($path, ['..', '://', '\\']), 404);

        $disk = Storage::disk('public');  // storage/app/public
        abort_unless($disk->exists($path), 404);

        $absolute = $disk->path($path);  // local filesystem path
        $mime = $disk->mimeType($path) ?: 'application/octet-stream';
        $mtime = @filemtime($absolute) ?: time();
        $etag = '"' . md5($absolute . $mtime) . '"';
        $lastMod = gmdate('D, d M Y H:i:s', $mtime) . ' GMT';

        // Conditional GET support (304)
        if ($request->header('If-None-Match') === $etag ||
                $request->header('If-Modified-Since') === $lastMod) {
            return response('', 304)->withHeaders([
                'ETag' => $etag,
                'Last-Modified' => $lastMod,
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        // Stream file from storage/app/public
        $stream = $disk->readStream($path);

        return new StreamedResponse(function () use ($stream) {
            fpassthru($stream);
            if (is_resource($stream))
                fclose($stream);
        }, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000',
            'ETag' => $etag,
            'Last-Modified' => $lastMod,
            'Accept-Ranges' => 'bytes',
        ]);
    }
}
