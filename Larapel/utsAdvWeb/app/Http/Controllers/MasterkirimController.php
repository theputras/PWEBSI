<?php

namespace App\Http\Controllers;

use App\Models\Detailkirim;
use App\Models\Kendaraan;
use App\Models\Masterkirim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MasterkirimController extends Controller
{
    public function index()
    {
        $items = Masterkirim::query()
            ->join('kendaraan', 'kendaraan.nopol', '=', 'masterkirim.nopol')
            ->select('masterkirim.*', 'kendaraan.namakendaraan', 'kendaraan.namadriver')
            ->orderByDesc('tglkirim')
            ->paginate(10);

        return view('masterkirim.index', compact('items'));
    }

    public function create()
    {
        $kendaraan = Kendaraan::orderBy('nopol')->get(['nopol', 'namakendaraan', 'namadriver']);
        return view('masterkirim.create', compact('kendaraan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kodekirim' => ['required', 'string', 'max:20', 'unique:masterkirim,kodekirim'],
            'tglkirim' => ['required', 'date'],
            'nopol' => ['required', 'string', 'max:10', 'exists:kendaraan,nopol'],
            // optional inline details
            'details' => ['sometimes', 'array'],
            'details.*.kodeproduk' => ['required_with:details', 'string', 'max:20', 'exists:produk,kodeproduk'],
            'details.*.qty' => ['required_with:details', 'numeric', 'min:0'],
        ]);

        DB::transaction(function () use ($data, $request) {
            Masterkirim::create([
                'kodekirim' => $data['kodekirim'],
                'tglkirim' => $data['tglkirim'],
                'nopol' => $data['nopol'],
                'totalqty' => 0,
            ]);

            if (!empty($data['details'])) {
                foreach ($data['details'] as $row) {
                    Detailkirim::updateOrCreate(
                        ['kodekirim' => $data['kodekirim'], 'kodeproduk' => $row['kodeproduk']],
                        ['qty' => $row['qty']]
                    );
                }
            }

            $this->recalcTotal($data['kodekirim']);
        });

        return redirect()->route('masterkirim.index')->with('success', 'Pengiriman created');
    }

    public function show(string $kodekirim)
    {
        $header = Masterkirim::where('kodekirim', $kodekirim)->firstOrFail();
        $kendaraan = Kendaraan::where('nopol', $header->nopol)->first();
        $details = Detailkirim::query()
            ->join('produk', 'produk.kodeproduk', '=', 'detailkirim.kodeproduk')
            ->where('detailkirim.kodekirim', $kodekirim)
            ->select('detailkirim.*', 'produk.nama', 'produk.satuan')
            ->orderBy('produk.nama')
            ->get();

        return view('masterkirim.show', compact('header', 'kendaraan', 'details'));
    }

    public function edit(string $kodekirim)
    {
        $header = Masterkirim::where('kodekirim', $kodekirim)->firstOrFail();
        $kendaraan = Kendaraan::orderBy('nopol')->get(['nopol', 'namakendaraan', 'namadriver']);
        return view('masterkirim.edit', compact('header', 'kendaraan'));
    }

    public function update(Request $request, string $kodekirim)
    {
        $header = Masterkirim::where('kodekirim', $kodekirim)->firstOrFail();

        $data = $request->validate([
            'tglkirim' => ['required', 'date'],
            'nopol' => ['required', 'string', 'max:10', 'exists:kendaraan,nopol'],
            'kodekirim' => ['required', 'string', 'max:20', Rule::unique('masterkirim', 'kodekirim')->ignore($header->kodekirim, 'kodekirim')],
        ]);

        DB::transaction(function () use ($header, $data) {
            if ($header->kodekirim !== $data['kodekirim']) {
                // move PK
                $old = $header->kodekirim;
                $header->update(['kodekirim' => $data['kodekirim']]);
                Detailkirim::where('kodekirim', $old)->update(['kodekirim' => $data['kodekirim']]);
            }
            $header->update([
                'tglkirim' => $data['tglkirim'],
                'nopol' => $data['nopol'],
            ]);
            $this->recalcTotal($header->kodekirim);
        });

        return redirect()->route('masterkirim.show', $data['kodekirim'])->with('success', 'Pengiriman updated');
    }

    public function destroy(string $kodekirim)
    {
        DB::transaction(function () use ($kodekirim) {
            Detailkirim::where('kodekirim', $kodekirim)->delete();
            Masterkirim::where('kodekirim', $kodekirim)->delete();
        });

        return redirect()->route('masterkirim.index')->with('success', 'Pengiriman deleted');
    }

    // helper
    private function recalcTotal(string $kodekirim): void
    {
        $total = Detailkirim::where('kodekirim', $kodekirim)->sum('qty');
        Masterkirim::where('kodekirim', $kodekirim)->update(['totalqty' => $total]);
    }
}
