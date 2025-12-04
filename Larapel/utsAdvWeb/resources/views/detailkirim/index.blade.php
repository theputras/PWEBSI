<!-- resources/views/detailkirim/index.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Detail Pengiriman {{ $kodekirim }}</h4>

<form class="row g-2 mb-3" method="POST" action="{{ route('detailkirim.store',$kodekirim) }}">
  @csrf
  <div class="col-md-6">
    <label class="form-label">Produk</label>
    <select name="kodeproduk" class="form-select" required>
      @foreach(\App\Models\Produk::orderBy('nama')->get() as $p)
        <option value="{{ $p->kodeproduk }}">{{ $p->kodeproduk }} — {{ $p->nama }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <label class="form-label">Qty</label>
    <input type="number" step="0.01" min="0" name="qty" class="form-control" required>
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <button class="btn btn-success w-100">Simpan Baris</button>
  </div>
</form>

<table class="table table-striped">
  <thead class="table-success">
    <tr><th>Kode</th><th>Nama</th><th>Satuan</th><th class="text-end">Qty</th><th class="text-end">Aksi</th></tr>
  </thead>
  <tbody>
    @foreach($items as $d)
    <tr>
      <td>{{ $d->kodeproduk }}</td>
      <td>{{ $d->nama }}</td>
      <td>{{ $d->satuan }}</td>
      <td class="text-end">{{ number_format($d->qty,2) }}</td>
      <td class="text-end">
        <form action="{{ route('detailkirim.destroy',[$kodekirim,$d->kodeproduk]) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus baris?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<a class="btn btn-secondary" href="{{ route('masterkirim.show',$kodekirim) }}">Kembali</a>
@endsection
