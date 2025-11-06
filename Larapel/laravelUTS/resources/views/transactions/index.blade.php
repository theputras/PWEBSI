@extends('layouts.app')

@section('title', 'Transaction List')

@section('content')
    @php
        // Ambil filter 'jenis' dari URL, default-nya 'REKAP'
        $jenis = request('jenis', 'REKAP');
    @endphp

    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">Transaction List</h1>

        <div class="mb-3">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
        </div>

        <!-- FORM FILTER (Sudah dibenahi agar 'sticky') -->
        <form method="GET" action="{{ route('transactions.index') }}">
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="tgl_awal" class="form-label">Start Date</label>
                    <!-- Tampilkan value filter yang lama -->
                    <input type="date" name="tgl_awal" class="form-control" value="{{ request('tgl_awal') }}">
                </div>
                <div class="col-md-2">
                    <label for="tgl_akhir" class="form-label">End Date</label>
                    <input type="date" name="tgl_akhir" class="form-control" value="{{ request('tgl_akhir') }}">
                </div>
                <div class="col-md-2">
                    <label for="jenis" class="form-label">Type</label>
                    <select name="jenis" class="form-control">
                        <!-- Cek $jenis untuk 'selected' -->
                        <option value="REKAP" {{ $jenis == 'REKAP' ? 'selected' : '' }}>REKAP</option>
                        <option value="DETAIL" {{ $jenis == 'DETAIL' ? 'selected' : '' }}>DETAIL</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="nopol" class="form-label">Nopol</label>
                    <select name="nopol" class="form-control">
                        <option value="ALL">ALL</option>
                        @foreach($vehicles as $vehicle)
                            <!-- 'selected' jika nopol di URL = nopol di loop -->
                            <option value="{{ $vehicle->nopol }}" {{ request('nopol') == $vehicle->nopol ? 'selected' : '' }}>
                                {{ $vehicle->nopol }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="kodegudang" class="form-label">Warehouse</label>
                    <select name="kodegudang" class="form-control">
                        <option value="ALL">ALL</option>
                        @foreach($warehouses as $warehouse)
                             <option value="{{ $warehouse->kodegudang }}" {{ request('kodegudang') == $warehouse->kodegudang ? 'selected' : '' }}>
                                {{ $warehouse->namagudang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Filter</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                Daftar Pengiriman (Mode: {{ $jenis }})
            </div>
            <div class="card-body">
                
                <!-- TAMPILAN JIKA MODE REKAP (SUMMARY) -->
                @if($jenis == 'REKAP')
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Shipping Code</th>
                                <th>Delivery Date</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Total Qty</th>
                                <th>Actions</th> <!-- Actions HANYA ada di mode REKAP -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->kodepengiriman }}</td>
                                <td>{{ $transaction->tglpengiriman }}</td>
                                <!-- Panggil relasi 'vehicle' -->
                                <td>{{ $transaction->vehicle->nama_kendaraan ?? $transaction->nopol }}</td>
                                <td>{{ $transaction->driver }}</td>
                                <td>{{ $transaction->totalqty }}</td>
                                <td>
                                    <a href="{{ route('transactions.edit', $transaction->kodepengiriman) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction->kodepengiriman) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No transactions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                <!-- TAMPILAN JIKA MODE DETAIL -->
                @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Shipping Code</th>
                                <th>Delivery Date</th>
                                <th>Vehicle</th>
                                <th>Product</th>
                                <th>Warehouse</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <!-- Loop di dalam loop (Master-Detail) -->
                                <!-- 'products' adalah nama relasi di Model Transaction Anda -->
                                @foreach($transaction->products as $product)
                                <tr>
                                    <td>{{ $transaction->kodepengiriman }}</td>
                                    <td>{{ $transaction->tglpengiriman }}</td>
                                    <td>{{ $transaction->vehicle->nama_kendaraan ?? $transaction->nopol }}</td>
                                    
                                    <!-- INI PERBAIKAN UTAMANYA -->
                                    <td>{{ $product->nama }}</td>
                                    <!-- 'warehouse' adalah nama relasi di Model Product Anda -->
                                    <td>{{ $product->warehouse->namagudang ?? 'N/A' }}</td>
                                    <!-- 'pivot->qty' adalah 'qty' dari tabel detailkirim -->
                                    <td>{{ $product->pivot->qty }}</td> 
                                </tr>
                                @endforeach
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No transactions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
                
            </div>
        </div>
    </div>
@endsection