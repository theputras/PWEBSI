<!-- resources/views/produk/edit.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Edit Produk</h4>
<form method="POST" action="{{ route('produk.update',$item->kodeproduk) }}" class="row g-3" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="col-md-4">
    <label class="form-label">Kode Produk</label>
    <input name="kodeproduk" class="form-control" required maxlength="20" value="{{ old('kodeproduk',$item->kodeproduk) }}">
  </div>
  <div class="col-md-8">
    <label class="form-label">Nama</label>
    <input name="nama" class="form-control" required maxlength="200" value="{{ old('nama',$item->nama) }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Satuan</label>
    <input name="satuan" class="form-control" required maxlength="15" value="{{ old('satuan',$item->satuan) }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Harga</label>
    <input type="number" step="0.01" min="0" name="harga" class="form-control" required value="{{ old('harga',$item->harga) }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">Gambar Baru (opsional)</label>
    <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    @if($item->gambar_url)
      <div class="form-text mt-2">Saat ini:</div>
      <img src="{{ $item->gambar_url }}" alt="gambar" style="height:48px;">
    @endif
  </div>
  <div class="col-md-6">
    <label class="form-label">Gudang</label>
    <select name="kodegudang" class="form-select" required>
      @foreach($gudang as $g)
        <option value="{{ $g->kodegudang }}" @selected($g->kodegudang==$item->kodegudang)>{{ $g->namagudang }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12">
    <button class="btn btn-success">Update</button>
    <a class="btn btn-secondary" href="{{ route('produk.index') }}">Batal</a>
  </div>
</form>
@endsection
