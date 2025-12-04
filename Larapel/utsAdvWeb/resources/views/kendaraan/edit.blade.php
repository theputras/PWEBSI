<!-- resources/views/kendaraan/edit.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Edit Kendaraan</h4>
<form method="POST" action="{{ route('kendaraan.update',$item->nopol) }}" class="row g-3" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="col-md-3"><label class="form-label">Nopol</label><input name="nopol" class="form-control" required maxlength="10" value="{{ old('nopol',$item->nopol) }}"></div>
  <div class="col-md-5"><label class="form-label">Nama Kendaraan</label><input name="namakendaraan" class="form-control" required maxlength="100" value="{{ old('namakendaraan',$item->namakendaraan) }}"></div>
  <div class="col-md-4"><label class="form-label">Jenis Kendaraan</label><input name="jeniskendaraan" class="form-control" required maxlength="100" value="{{ old('jeniskendaraan',$item->jeniskendaraan) }}"></div>
  <div class="col-md-3"><label class="form-label">Tahun</label><input type="date" name="tahun" class="form-control" value="{{ optional($item->tahun)->format('Y-m-d') }}"></div>
  <div class="col-md-3"><label class="form-label">Kapasitas</label><input name="kapasitas" class="form-control" maxlength="10" value="{{ old('kapasitas',$item->kapasitas) }}"></div>
  <div class="col-md-3"><label class="form-label">Driver</label><input name="namadriver" class="form-control" required maxlength="40" value="{{ old('namadriver',$item->namadriver) }}"></div>
  <div class="col-md-3"><label class="form-label">Kontak Driver</label><input name="kontakdriver" class="form-control" maxlength="15" value="{{ old('kontakdriver',$item->kontakdriver) }}"></div>
  <div class="col-md-12">
    <label class="form-label">Foto Baru (opsional)</label>
    <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    @php
      use Illuminate\Support\Facades\Storage;
    @endphp
    @if(!empty($item->foto_url) || !empty($item->foto))
      <div class="form-text mt-2">Saat ini:</div>
      @php
        // prefer foto_url if it's a full URL, otherwise build a storage URL
        $fotoUrl = $item->foto_url ?? (isset($item->foto) ? Storage::url($item->foto) : null);
      @endphp
      @if($fotoUrl)
        <img src="{{ $fotoUrl }}" alt="foto" style="height:48px;">
      @endif
    @endif
  </div>
  <div class="col-12"><button class="btn btn-success">Update</button> <a class="btn btn-secondary" href="{{ route('kendaraan.index') }}">Batal</a></div>
</form>
@endsection
