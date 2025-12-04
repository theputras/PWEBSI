<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanController extends Controller
{
    public function index()
    {
        $items = Kendaraan::orderBy('nopol')->paginate(10);
        return view('kendaraan.index', compact('items'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nopol' => ['required', 'string', 'max:10', 'unique:kendaraan,nopol'],
            'namakendaraan' => ['required', 'string', 'max:100'],
            'jeniskendaraan' => ['required', 'string', 'max:100'],
            'namadriver' => ['required', 'string', 'max:40'],
            'kontakdriver' => ['nullable', 'string', 'max:15'],
            'tahun' => ['nullable', 'date'],
            'kapasitas' => ['nullable', 'string', 'max:10'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        } else {
            $data['foto'] = null;
        }

        Kendaraan::create($data);
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan created');
    }

    public function show(string $nopol)
    {
        $item = Kendaraan::where('nopol', $nopol)->firstOrFail();
        return view('kendaraan.show', compact('item'));
    }

    public function edit(string $nopol)
    {
        $item = Kendaraan::where('nopol', $nopol)->firstOrFail();
        return view('kendaraan.edit', compact('item'));
    }

    public function update(Request $request, string $nopol)
    {
        $item = Kendaraan::where('nopol', $nopol)->firstOrFail();

        $data = $request->validate([
            'namakendaraan' => ['required', 'string', 'max:100'],
            'jeniskendaraan' => ['required', 'string', 'max:100'],
            'namadriver' => ['required', 'string', 'max:40'],
            'kontakdriver' => ['nullable', 'string', 'max:15'],
            'tahun' => ['nullable', 'date'],
            'kapasitas' => ['nullable', 'string', 'max:10'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'nopol' => ['required', 'string', 'max:10', \Illuminate\Validation\Rule::unique('kendaraan', 'nopol')->ignore($item->nopol, 'nopol')],
        ]);

        if ($request->hasFile('foto')) {
            if ($item->foto)
                Storage::disk('public')->delete($item->foto);
            $data['foto'] = $request->file('foto')->store('kendaraan', 'public');
        } else {
            unset($data['foto']);
        }

        if ($item->nopol !== $data['nopol']) {
            $item->update(['nopol' => $data['nopol']]);
        }
        $item->update(collect($data)->except('nopol')->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan updated');
    }

    public function destroy(string $nopol)
    {
        $item = Kendaraan::where('nopol', $nopol)->firstOrFail();
        if ($item->foto)
            Storage::disk('public')->delete($item->foto);
        $item->delete();
        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan deleted');
    }
}
