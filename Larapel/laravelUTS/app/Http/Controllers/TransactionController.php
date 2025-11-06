<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Warehouse; // Tidak terpakai di 'create' tapi ada di 'index'
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Kita butuh ini untuk Transaction

class TransactionController extends Controller
{
    // index() Anda sepertinya sudah OK untuk filter
    public function index(Request $request)
    {
        $query = Transaction::with(['products', 'vehicle']); // Ganti ke relasi 'products'
        
        // if ($request->has('jenis') && $request->jenis != 'ALL') {
        //     $query->where('jenis', $request->jenis);
        // }
        
                if ($request->input('jenis') == 'DETAIL') {
            // Jika 'DETAIL', kita pastikan query-nya HANYA mengambil
            // transaksi yang punya data di tabel detail (products).
            // Ini akan mengecek ke tabel 'detailkirim' (via relasi 'products')
            $query->whereHas('products');
        }
        if ($request->has('nopol') && $request->nopol != 'ALL') {
            $query->where('nopol', $request->nopol);
        }
        if ($request->has('kodegudang') && $request->kodegudang != 'ALL') {
            // Ini filter berdasarkan gudang di produk
            $query->whereHas('products.warehouse', function ($q) use ($request) {
                $q->where('kodegudang', $request->kodegudang);
            });
        }
        if ($request->has('tgl_awal') && $request->has('tgl_akhir')) {
            $query->whereBetween('tglpengiriman', [$request->tgl_awal, $request->tgl_akhir]);
        }

        $transactions = $query->get();
        $warehouses = Warehouse::all();
        $vehicles = Vehicle::all();
        $products = Product::all();
        
        return view('transactions.index', compact('transactions', 'warehouses', 'vehicles', 'products'));
    }

    // Menampilkan form untuk membuat transaksi baru
    public function create()
    {
        $products = Product::all();
        $vehicles = Vehicle::all();
        // $warehouses tidak perlu, karena gudang nempel di produk
        return view('transactions.form', compact('products', 'vehicles'));
    }

    // ---- INI FUNGSI YANG DIPERBAIKI ----
public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            // GANTI BAGIAN INI:
            'kodepengiriman' => 'required|string|max:20|unique:'. (new Transaction)->getTable() .',kodepengiriman',
            
            // ... sisa validasi ...
            'tglpengiriman' => 'required|date',
            'nopol' => 'required|string|exists:vehicles,nopol',
            'driver' => 'required|string|max:50',
            'totalqty' => 'required|numeric|min:1',
            'products' => 'required|array|min:1',
            'products.*.kodeproduk' => 'required|string|exists:products,kodeproduk',
            'products.*.qty' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'kodepengiriman' => $request->kodepengiriman,
                'tglpengiriman' => $request->tglpengiriman,
                'nopol' => $request->nopol,
                'driver' => $request->driver,
                'totalqty' => $request->totalqty,
            ]);

            $productsData = [];
            foreach ($request->products as $product) {
                $productsData[$product['kodeproduk']] = ['qty' => $product['qty']];
            }

            $transaction->products()->attach($productsData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
        
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit(Transaction $transaction)
    {
        // Eager load relasi 'products'
        $transaction->load('products'); 

        $products = Product::all();
        $vehicles = Vehicle::all();

        return view('transactions.form', compact('transaction', 'products', 'vehicles'));
    }

    // ---- INI FUNGSI YANG DIPERBAIKI ----
public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            // GANTI BAGIAN INI:
            'kodepengiriman' => 'required|string|max:20|unique:'. $transaction->getTable() .',kodepengiriman,' . $transaction->kodepengiriman . ',kodepengiriman',
            
            // ... sisa validasi ...
            'tglpengiriman' => 'required|date',
            'nopol' => 'required|string|exists:vehicles,nopol',
            'driver' => 'required|string|max:50',
            'totalqty' => 'required|numeric|min:1',
            'products' => 'required|array|min:1',
            'products.*.kodeproduk' => 'required|string|exists:products,kodeproduk',
            'products.*.qty' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaction->update([
                'kodepengiriman' => $request->kodepengiriman,
                'tglpengiriman' => $request->tglpengiriman,
                'nopol' => $request->nopol,
                'driver' => $request->driver,
                'totalqty' => $request->totalqty,
            ]);

            $productsData = [];
            foreach ($request->products as $product) {
                $productsData[$product['kodeproduk']] = ['qty' => $product['qty']];
            }

            $transaction->products()->sync($productsData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal mengupdate transaksi: ' . $e->getMessage()]);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        // Hapus relasi di pivot tabel dulu
        $transaction->products()->detach();
        
        // Hapus data master
        $transaction->delete();
        
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}