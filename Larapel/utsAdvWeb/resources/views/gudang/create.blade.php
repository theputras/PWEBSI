<!-- resources/views/gudang/create.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Tambah Gudang</h4>
<form method="POST" action="{{ route('gudang.store') }}" class="row g-3">
  @csrf
  <div class="col-md-3"><label class="form-label">Kode Gudang</label><input name="kodegudang" class="form-control" required maxlength="20"></div>
  <div class="col-md-5"><label class="form-label">Nama Gudang</label><input name="namagudang" class="form-control" required maxlength="100"></div>
  <div class="col-md-4"><label class="form-label">Kontak</label><input name="kontak" class="form-control" maxlength="50"></div>
  <div class="col-md-8"><label class="form-label">Alamat</label><input name="alamat" class="form-control" required maxlength="200"></div>
  <div class="col-md-4"><label class="form-label">Kapasitas</label><input type="number" step="0.01" min="0" name="kapasitas" class="form-control"></div>
  <div class="col-12"><button class="btn btn-success">Simpan</button> <a class="btn btn-secondary" href="{{ route('gudang.index') }}">Batal</a></div>
</form>
@endsection
