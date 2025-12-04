<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class pert9Controller extends Controller
{
    public function tugasSelect()
{
    // Get the product and delivery details
    $products = DB::table('masterkiriman as mk')
        ->join('vehicles as k', 'mk.nopol', '=', 'k.nopol')
        ->join('detailkirim as dk', 'mk.kodepengiriman', '=', 'dk.kodepengiriman')
        ->join('products as p', 'dk.kodeproduk', '=', 'p.kodeproduk')
        ->select(
            'p.kodeproduk as kode_produk',
            'p.nama as nama_produk',
            'p.satuan as satuan_produk',
            'dk.qty as qty',
            'mk.kodepengiriman',
            'mk.tglpengiriman as tanggal',
            'k.nama_kendaraan as kendaraan',
            'mk.nopol',
            'k.kontakdriver as driver',
            'mk.totalqty'
        )
        ->get()
        ->groupBy('kode_produk')  // Group by product code
        ->map(function ($items) {
            $product = $items->first();

            // Group by delivery date (tanggal)
            $deliveries = $items->groupBy('tanggal')->map(function ($deliveriesOnDate) {
                return [
                    'tanggal' => $deliveriesOnDate->first()->tanggal,
                    'detail_pengiriman' => $deliveriesOnDate->map(function ($delivery) {
                        return [
                            'kodepengiriman' => $delivery->kodepengiriman,
                            'kendaraan' => $delivery->kendaraan,
                            'nopol' => $delivery->nopol,
                            'driver' => $delivery->driver,
                            'totalqty' => $delivery->totalqty,
                        ];
                    })->toArray()
                ];
            });

            return [
                'kode_produk' => $product->kode_produk,
                'nama_produk' => $product->nama_produk,
                'satuan_produk' => $product->satuan_produk,
                'deliveries' => $deliveries->values()->toArray(),
            ];
        });

    // Return the JSON response
    return response()->json([
        'products' => $products
    ]);
}

}
