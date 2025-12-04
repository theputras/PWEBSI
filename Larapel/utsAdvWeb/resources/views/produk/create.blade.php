<!-- resources/views/produk/create.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Tambah Produk</h4>
<form method="POST" action="{{ route('produk.store') }}" class="row g-3" enctype="multipart/form-data">
  @csrf
  <div class="col-md-4">
    <label class="form-label">Kode Produk</label>
    <input name="kodeproduk" class="form-control" required maxlength="20">
  </div>
  <div class="col-md-8">
    <label class="form-label">Nama</label>
    <input name="nama" class="form-control" required maxlength="200">
  </div>
  <div class="col-md-3">
    <label class="form-label">Satuan</label>
    <input name="satuan" class="form-control" required maxlength="15">
  </div>
  <div class="col-md-3">
    <label class="form-label">Harga</label>
    <input type="number" step="0.01" min="0" name="harga" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Gambar (JPG, PNG, WEBP, ≤2MB)</label>
    <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
  </div>
  <div class="col-md-6">
    <label class="form-label">Gudang</label>
    <select name="kodegudang" class="form-select" required>
      <option value="" hidden>Pilih Gudang</option>
      @foreach($gudang as $g)
        <option value="{{ $g->kodegudang }}">{{ $g->namagudang }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12">
    <button class="btn btn-success">Simpan</button>
    <a class="btn btn-secondary" href="{{ route('produk.index') }}">Batal</a>
  </div>
</form>
@endsection
