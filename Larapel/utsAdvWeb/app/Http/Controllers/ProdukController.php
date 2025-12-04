<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukController extends Controller
{
    public function index()
    {
        $items = Produk::query()
            ->with('gudang')  // define belongsTo in model
            ->orderBy('kodeproduk')
            ->paginate(10);

        return view('produk.index', compact('items'));
    }

    public function create()
    {
        $gudang = Gudang::orderBy('namagudang')->get(['kodegudang', 'namagudang']);
        return view('produk.create', compact('gudang'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kodeproduk' => ['required', 'string', 'max:20', 'unique:produk,kodeproduk'],
            'nama' => ['required', 'string', 'max:200'],
            'satuan' => ['required', 'string', 'max:15'],
            'harga' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],  // 2 MB
            'kodegudang' => ['required', 'string', 'max:20', 'exists:gudang,kodegudang'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');  // e.g. produk/abc.jpg
        } else {
            $data['gambar'] = null;
        }

        Produk::create($data);
        return redirect()->route('produk.index')->with('success', 'Produk created');
    }

    public function show(string $kodeproduk)
    {
        $item = Produk::with('gudang')->where('kodeproduk', $kodeproduk)->firstOrFail();
        return view('produk.show', compact('item'));
    }

    public function edit(string $kodeproduk)
    {
        $item = Produk::where('kodeproduk', $kodeproduk)->firstOrFail();
        $gudang = Gudang::orderBy('namagudang')->get(['kodegudang', 'namagudang']);
        return view('produk.edit', compact('item', 'gudang'));
    }

    public function update(Request $request, string $kodeproduk)
    {
        $item = Produk::where('kodeproduk', $kodeproduk)->firstOrFail();

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:200'],
            'satuan' => ['required', 'string', 'max:15'],
            'harga' => ['required', 'numeric', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'kodegudang' => ['required', 'string', 'max:20', 'exists:gudang,kodegudang'],
            'kodeproduk' => ['required', 'string', 'max:20', \Illuminate\Validation\Rule::unique('produk', 'kodeproduk')->ignore($item->kodeproduk, 'kodeproduk')],
        ]);

        if ($request->hasFile('gambar')) {
            if ($item->gambar)
                Storage::disk('public')->delete($item->gambar);
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        } else {
            unset($data['gambar']);  // keep old path
        }

        if ($item->kodeproduk !== $data['kodeproduk']) {
            $item->update(['kodeproduk' => $data['kodeproduk']]);
        }
        $item->update(collect($data)->except('kodeproduk')->all());

        return redirect()->route('produk.index')->with('success', 'Produk updated');
    }

    public function destroy(string $kodeproduk)
    {
        $item = Produk::where('kodeproduk', $kodeproduk)->firstOrFail();
        if ($item->gambar)
            Storage::disk('public')->delete($item->gambar);
        $item->delete();
        return redirect()->route('produk.index')->with('success', 'Produk deleted');
    }
}
