<!-- resources/views/gudang/edit.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Edit Gudang</h4>
<form method="POST" action="{{ route('gudang.update',$item->kodegudang) }}" class="row g-3">
  @csrf @method('PUT')
  <div class="col-md-3"><label class="form-label">Kode Gudang</label><input name="kodegudang" class="form-control" required maxlength="20" value="{{ old('kodegudang',$item->kodegudang) }}"></div>
  <div class="col-md-5"><label class="form-label">Nama Gudang</label><input name="namagudang" class="form-control" required maxlength="100" value="{{ old('namagudang',$item->namagudang) }}"></div>
  <div class="col-md-4"><label class="form-label">Kontak</label><input name="kontak" class="form-control" maxlength="50" value="{{ old('kontak',$item->kontak) }}"></div>
  <div class="col-md-8"><label class="form-label">Alamat</label><input name="alamat" class="form-control" required maxlength="200" value="{{ old('alamat',$item->alamat) }}"></div>
  <div class="col-md-4"><label class="form-label">Kapasitas</label><input type="number" step="0.01" min="0" name="kapasitas" class="form-control" value="{{ old('kapasitas',$item->kapasitas) }}"></div>
  <div class="col-12"><button class="btn btn-success">Update</button> <a class="btn btn-secondary" href="{{ route('gudang.index') }}">Batal</a></div>
</form>
@endsection
