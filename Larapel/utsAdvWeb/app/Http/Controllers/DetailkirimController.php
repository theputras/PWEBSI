<?php

namespace App\Http\Controllers;

use App\Models\Detailkirim;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailkirimController extends Controller
{
    // List detail lines for a shipment
    public function index(string $kodekirim)
    {
        $items = Detailkirim::query()
            ->join('produk', 'produk.kodeproduk', '=', 'detailkirim.kodeproduk')
            ->where('detailkirim.kodekirim', $kodekirim)
            ->select('detailkirim.*', 'produk.nama', 'produk.satuan')
            ->orderBy('produk.nama')
            ->get();

        return view('detailkirim.index', compact('items', 'kodekirim'));
    }

    // Add or upsert a line
    public function store(Request $request, string $kodekirim)
    {
        $data = $request->validate([
            'kodeproduk' => ['required', 'string', 'max:20', 'exists:produk,kodeproduk'],
            'qty' => ['required', 'numeric', 'min:0'],
        ]);

        Detailkirim::updateOrCreate(
            ['kodekirim' => $kodekirim, 'kodeproduk' => $data['kodeproduk']],
            ['qty' => $data['qty']]
        );

        // refresh total on header
        app(MasterkirimController::class)->recalcTotal($kodekirim);

        return back()->with('success', 'Detail saved');
    }

    public function update(Request $request, string $kodekirim, string $kodeproduk)
    {
        $data = $request->validate([
            'qty' => ['required', 'numeric', 'min:0'],
        ]);

        $line = Detailkirim::where(['kodekirim' => $kodekirim, 'kodeproduk' => $kodeproduk])->firstOrFail();
        $line->update(['qty' => $data['qty']]);

        app(MasterkirimController::class)->recalcTotal($kodekirim);

        return back()->with('success', 'Detail updated');
    }

    public function destroy(string $kodekirim, string $kodeproduk)
    {
        Detailkirim::where(['kodekirim' => $kodekirim, 'kodeproduk' => $kodeproduk])->delete();
        app(MasterkirimController::class)->recalcTotal($kodekirim);
        return back()->with('success', 'Detail deleted');
    }
}
