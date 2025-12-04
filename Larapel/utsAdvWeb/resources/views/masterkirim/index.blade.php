<!-- resources/views/masterkirim/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Daftar Pengiriman Barang</h4>
  <a class="btn btn-success" href="{{ route('masterkirim.create') }}">Buat Pengiriman Baru</a>
</div>

<form class="row g-2 mb-3">
  <div class="col-md-2">
    <label class="form-label">Awal</label>
    <input type="date" name="awal" class="form-control" value="{{ request('awal') }}">
  </div>
  <div class="col-md-2">
    <label class="form-label">Akhir</label>
    <input type="date" name="akhir" class="form-control" value="{{ request('akhir') }}">
  </div>
  <div class="col-md-2">
    <label class="form-label">Jenis</label>
    <select name="jenis" class="form-select">
      <option value="REKAP" @selected(request('jenis')==='REKAP')>REKAP</option>
      <option value="DETAIL" @selected(request('jenis')==='DETAIL')>DETAIL</option>
    </select>
  </div>
  <div class="col-md-2">
    <label class="form-label">NOPOL</label>
    <input name="nopol" class="form-control" value="{{ request('nopol') }}" placeholder="ALL">
  </div>
  <div class="col-md-2 d-flex align-items-end">
    <button class="btn btn-outline-success w-100">Filter</button>
  </div>
</form>

<table class="table table-striped align-middle">
  <thead class="table-success">
    <tr>
      <th>Kode Kirim</th><th>Tanggal</th><th>Kendaraan</th><th>Driver</th><th class="text-end">Total Qty</th><th class="text-end">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $h)
    <tr>
      <td>{{ $h->kodekirim }}</td>
      <td>{{ \Illuminate\Support\Carbon::parse($h->tglkirim)->format('Y-m-d') }}</td>
      <td>{{ $h->nopol }} — {{ $h->namakendaraan }}</td>
      <td>{{ $h->namadriver }}</td>
      <td class="text-end">{{ number_format($h->totalqty,2) }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-primary" href="{{ route('masterkirim.show',$h->kodekirim) }}">Detail</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $items->links() }}
@endsection
