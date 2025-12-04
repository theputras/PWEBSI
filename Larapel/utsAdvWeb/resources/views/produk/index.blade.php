<!-- resources/views/produk/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Daftar Produk</h4>
  <a class="btn btn-success" href="{{ route('produk.create') }}">Tambah Produk Baru</a>
</div>

<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead class="table-success">
    <tr>
      <th>Kode</th>
      <th>Nama Produk</th>
      <th>Satuan</th>
      <th>Harga</th>
      <th>Gudang</th>
      <th>Gambar</th>
      <th class="text-end">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $p)
    <tr>
      <td>{{ $p->kodeproduk }}</td>
      <td>{{ $p->nama }}</td>
      <td>{{ $p->satuan }}</td>
      <td>Rp {{ number_format($p->harga,0,',','.') }}</td>
      <td>{{ optional($p->gudang)->namagudang }}</td>
      <td>
        @if($p->gambar_url)
          <img src="{{ $p->gambar_url }}" alt="img" style="height:28px;">
        @endif
      </td>
      <td class="text-end">
        <a class="btn btn-sm btn-primary" href="{{ route('produk.edit',$p->kodeproduk) }}">Edit</a>
        <form action="{{ route('produk.destroy',$p->kodeproduk) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

{{ $items->links() }}
@endsection
