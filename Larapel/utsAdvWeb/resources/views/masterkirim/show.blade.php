<!-- resources/views/masterkirim/show.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Detail Pengiriman: {{ $header->kodekirim }}</h4>

<div class="row g-3 mb-3">
  <div class="col-md-3"><div class="form-control">Tanggal: {{ $header->tglkirim->format('Y-m-d') }}</div></div>
  <div class="col-md-3"><div class="form-control">Nopol: {{ $kendaraan->nopol }}</div></div>
  <div class="col-md-3"><div class="form-control">Kendaraan: {{ $kendaraan->namakendaraan }}</div></div>
  <div class="col-md-3"><div class="form-control">Driver: {{ $kendaraan->namadriver }}</div></div>
</div>

<table class="table table-striped">
  <thead class="table-success">
    <tr><th>Kode</th><th>Nama Produk</th><th>Satuan</th><th class="text-end">Qty</th></tr>
  </thead>
  <tbody>
    @foreach($details as $d)
    <tr>
      <td>{{ $d->kodeproduk }}</td>
      <td>{{ $d->nama }}</td>
      <td>{{ $d->satuan }}</td>
      <td class="text-end">{{ number_format($d->qty,2) }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr><th colspan="3" class="text-end">Total</th><th class="text-end">{{ number_format($header->totalqty,2) }}</th></tr>
  </tfoot>
</table>

<a class="btn btn-secondary" href="{{ route('masterkirim.index') }}">Kembali</a>
@endsection
