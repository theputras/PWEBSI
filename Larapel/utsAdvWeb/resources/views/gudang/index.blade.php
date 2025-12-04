<!-- resources/views/gudang/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Daftar Gudang</h4>
  <a class="btn btn-success" href="{{ route('gudang.create') }}">Tambah Gudang Baru</a>
</div>

<table class="table table-striped align-middle">
  <thead class="table-success">
    <tr>
      <th>Kode Gudang</th><th>Nama Gudang</th><th>Alamat</th><th>Kapasitas</th><th>Kontak</th><th class="text-end">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $g)
    <tr>
      <td>{{ $g->kodegudang }}</td>
      <td>{{ $g->namagudang }}</td>
      <td>{{ $g->alamat }}</td>
      <td>{{ $g->kapasitas }}</td>
      <td>{{ $g->kontak }}</td>
      <td class="text-end">
        <a class="btn btn-sm btn-primary" href="{{ route('gudang.edit',$g->kodegudang) }}">Edit</a>
        <form action="{{ route('gudang.destroy',$g->kodegudang) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus gudang?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $items->links() }}
@endsection
