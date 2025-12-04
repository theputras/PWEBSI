<!-- resources/views/kendaraan/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Daftar Kendaraan</h4>
  <a class="btn btn-success" href="{{ route('kendaraan.create') }}">Tambah Kendaraan Baru</a>
</div>

<table class="table table-striped align-middle">
  <thead class="table-success">
    <tr>
      <th>Nopol</th><th>Nama Kendaraan</th><th>Jenis</th><th>Tahun</th><th>Kapasitas</th><th>Driver</th><th>Kontak Driver</th><th class="text-end">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $k)
    <tr>
      <td>{{ $k->nopol }}</td>
      <td>{{ $k->namakendaraan }}</td>
      <td>{{ $k->jeniskendaraan }}</td>
      <td>{{ optional($k->tahun)->format('Y-m-d') }}</td>
      <td>{{ $k->kapasitas }}</td>
      <td>{{ $k->namadriver }}</td>
      <td>{{ $k->kontakdriver }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-primary" href="{{ route('kendaraan.edit',$k->nopol) }}">Edit</a>
        <form action="{{ route('kendaraan.destroy',$k->nopol) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus kendaraan?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $items->links() }}
@endsection
