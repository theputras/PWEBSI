<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Vehicle;
use App\Models\Transaction;

class DatabaseUTS extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
        // Menambahkan data produk
        Product::create([
            'kodeproduk' => 'P001',
            'nama' => 'Tomato',
            'satuan' => 'Kg',
            'harga' => 2000,
            'gambar' => 'https://preview.redd.it/joko-widodo-is-my-spirit-v0-9x89ydyu34gf1.jpeg?width=1080&auto=webp&s=3d3af72907af2bd9a1682748ec24a5ec8286d684'
        ]);
        Product::create([
            'kodeproduk' => 'P002',
            'nama' => 'Cucumber',
            'satuan' => 'Kg',
            'harga' => 1500,
            'gambar' => 'https://preview.redd.it/joko-widodo-is-my-spirit-v0-9x89ydyu34gf1.jpeg?width=1080&auto=webp&s=3d3af72907af2bd9a1682748ec24a5ec8286d684'
        ]);
        Product::create([
            'kodeproduk' => 'P003',
            'nama' => 'Carrot',
            'satuan' => 'Kg',
            'harga' => 2500,
            'gambar' => 'https://preview.redd.it/joko-widodo-is-my-spirit-v0-9x89ydyu34gf1.jpeg?width=1080&auto=webp&s=3d3af72907af2bd9a1682748ec24a5ec8286d684'
        ]);
        Product::create([
            'kodeproduk' => 'P004',
            'nama' => 'Lettuce',
            'satuan' => 'Kg',
            'harga' => 1200,
            'gambar' => 'https://preview.redd.it/joko-widodo-is-my-spirit-v0-9x89ydyu34gf1.jpeg?width=1080&auto=webp&s=3d3af72907af2bd9a1682748ec24a5ec8286d684'
        ]);
        Product::create([
            'kodeproduk' => 'P005',
            'nama' => 'Spinach',
            'satuan' => 'Kg',
            'harga' => 1800,
            'gambar' => 'https://preview.redd.it/joko-widodo-is-my-spirit-v0-9x89ydyu34gf1.jpeg?width=1080&auto=webp&s=3d3af72907af2bd9a1682748ec24a5ec8286d684'
        ]);

        // Menambahkan data gudang
        Warehouse::create(['kodegudang' => 'G001', 'namagudang' => 'Warehouse A', 'alamat' => 'Jakarta', 'kapasitas' => 1000, 'kontak' => '081234567890']);
        Warehouse::create(['kodegudang' => 'G002', 'namagudang' => 'Warehouse B', 'alamat' => 'Bandung', 'kapasitas' => 1500, 'kontak' => '089876543210']);
        Warehouse::create(['kodegudang' => 'G003', 'namagudang' => 'Warehouse C', 'alamat' => 'Surabaya', 'kapasitas' => 2000, 'kontak' => '082112345678']);
        Warehouse::create(['kodegudang' => 'G004', 'namagudang' => 'Warehouse D', 'alamat' => 'Yogyakarta', 'kapasitas' => 1200, 'kontak' => '083398765432']);
        Warehouse::create(['kodegudang' => 'G005', 'namagudang' => 'Warehouse E', 'alamat' => 'Semarang', 'kapasitas' => 1800, 'kontak' => '084467890123']);

        // Menambahkan data kendaraan
        Vehicle::create(['nopol' => 'B1234XYZ', 'nama_kendaraan' => 'Pickup 1', 'jenis_kendaraan' => 'Pickup', 'kontakdriver' => '081234567890', 'kapasitas' => 1000, 'tahun' => 2018]);
        Vehicle::create(['nopol' => 'B5678ABC', 'nama_kendaraan' => 'Pickup 2', 'jenis_kendaraan' => 'Pickup', 'kontakdriver' => '089876543210', 'kapasitas' => 1200, 'tahun' => 2018]);
        Vehicle::create(['nopol' => 'B91011DEF', 'nama_kendaraan' => 'Truck 1', 'jenis_kendaraan' => 'Truck', 'kontakdriver' => '082112345678', 'kapasitas' => 3000, 'tahun' => 2018]);
        Vehicle::create(['nopol' => 'B11213GHI', 'nama_kendaraan' => 'Truck 2', 'jenis_kendaraan' => 'Truck', 'kontakdriver' => '083398765432', 'kapasitas' => 4000, 'tahun' => 2018]);
        Vehicle::create(['nopol' => 'B14151JKL', 'nama_kendaraan' => 'Van 1', 'jenis_kendaraan' => 'Van', 'kontakdriver' => '084467890123', 'kapasitas' => 1500, 'tahun' => 2018]);

        // // Menambahkan data transaksi
        // Transaction::create([
        //     'kodeproduk' => 'P001', 'kodegudang' => 'G001', 'nopol' => 'B1234XYZ', 'quantity' => 20, 'delivery_date' => '2025-11-06'
        // ]);
        // Transaction::create([
        //     'kodeproduk' => 'P002', 'kodegudang' => 'G002', 'nopol' => 'B5678ABC', 'quantity' => 30, 'delivery_date' => '2025-11-06'
        // ]);
        // Transaction::create([
        //     'kodeproduk' => 'P003', 'kodegudang' => 'G003', 'nopol' => 'B91011DEF', 'quantity' => 15, 'delivery_date' => '2025-11-06'
        // ]);
        // Transaction::create([
        //     'kodeproduk' => 'P004', 'kodegudang' => 'G004', 'nopol' => 'B11213GHI', 'quantity' => 10, 'delivery_date' => '2025-11-07'
        // ]);
        // Transaction::create([
        //     'kodeproduk' => 'P005', 'kodegudang' => 'G005', 'nopol' => 'B14151JKL', 'quantity' => 25, 'delivery_date' => '2025-11-07'
        // ]);
    }
}
