<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GudangController extends Controller
{
    public function index()
    {
        $items = Gudang::orderBy('kodegudang')->paginate(10);
        return view('gudang.index', compact('items'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kodegudang' => ['required', 'string', 'max:20', 'unique:gudang,kodegudang'],
            'namagudang' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:200'],
            'kontak' => ['nullable', 'string', 'max:50'],
            'kapasitas' => ['nullable', 'numeric', 'min:0'],
        ]);

        Gudang::create($data);
        return redirect()->route('gudang.index')->with('success', 'Gudang created');
    }

    public function show(string $kodegudang)
    {
        $item = Gudang::where('kodegudang', $kodegudang)->firstOrFail();
        return view('gudang.show', compact('item'));
    }

    public function edit(string $kodegudang)
    {
        $item = Gudang::where('kodegudang', $kodegudang)->firstOrFail();
        return view('gudang.edit', compact('item'));
    }

    public function update(Request $request, string $kodegudang)
    {
        $item = Gudang::where('kodegudang', $kodegudang)->firstOrFail();

        $data = $request->validate([
            'namagudang' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:200'],
            'kontak' => ['nullable', 'string', 'max:50'],
            'kapasitas' => ['nullable', 'numeric', 'min:0'],
            'kodegudang' => ['required', 'string', 'max:20', Rule::unique('gudang', 'kodegudang')->ignore($item->kodegudang, 'kodegudang')],
        ]);

        // allow renaming primary key
        if ($item->kodegudang !== $data['kodegudang']) {
            $item->update(['kodegudang' => $data['kodegudang']]);
        }
        $item->update(collect($data)->except('kodegudang')->all());

        return redirect()->route('gudang.index')->with('success', 'Gudang updated');
    }

    public function destroy(string $kodegudang)
    {
        $item = Gudang::where('kodegudang', $kodegudang)->firstOrFail();
        $item->delete();
        return redirect()->route('gudang.index')->with('success', 'Gudang deleted');
    }
}
