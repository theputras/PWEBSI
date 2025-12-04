<!-- resources/views/kendaraan/create.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Tambah Kendaraan</h4>
<form method="POST" action="{{ route('kendaraan.store') }}" class="row g-3" enctype="multipart/form-data">
  @csrf
  <div class="col-md-3"><label class="form-label">Nopol</label><input name="nopol" class="form-control" required maxlength="10"></div>
  <div class="col-md-5"><label class="form-label">Nama Kendaraan</label><input name="namakendaraan" class="form-control" required maxlength="100"></div>
  <div class="col-md-4"><label class="form-label">Jenis Kendaraan</label><input name="jeniskendaraan" class="form-control" required maxlength="100"></div>
  <div class="col-md-3"><label class="form-label">Tahun</label><input type="date" name="tahun" class="form-control"></div>
  <div class="col-md-3"><label class="form-label">Kapasitas</label><input name="kapasitas" class="form-control" maxlength="10"></div>
  <div class="col-md-3"><label class="form-label">Driver</label><input name="namadriver" class="form-control" required maxlength="40"></div>
  <div class="col-md-3"><label class="form-label">Kontak Driver</label><input name="kontakdriver" class="form-control" maxlength="15"></div>
  <div class="col-md-12">
    <label class="form-label">Foto (JPG, PNG, WEBP, ≤2MB)</label>
    <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
  </div>
  <div class="col-12"><button class="btn btn-success">Simpan</button> <a class="btn btn-secondary" href="{{ route('kendaraan.index') }}">Batal</a></div>
</form>
@endsection
