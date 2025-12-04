<!-- resources/views/masterkirim/create.blade.php -->
@extends('layouts.app')
@section('content')
<h4>Buat Pengiriman Produk Baru</h4>

<form method="POST" action="{{ route('masterkirim.store') }}" id="formKirim" class="mb-4">
  @csrf
  <div class="row g-3">
    <div class="col-md-4">
      <label class="form-label">Kode Pengiriman</label>
      <input name="kodekirim" class="form-control" maxlength="20" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Tanggal Kirim</label>
      <input type="date" name="tglkirim" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Kendaraan (Nopol)</label>
      <select name="nopol" class="form-select" required>
        <option value="" hidden>Pilih Kendaraan</option>
        @foreach($kendaraan as $k)
          <option value="{{ $k->nopol }}">{{ $k->nopol }} — {{ $k->namakendaraan }} ({{ $k->namadriver }})</option>
        @endforeach
      </select>
    </div>
  </div>

  <hr class="my-4">

  <h6>Detail Item Pengiriman</h6>
  <div class="row g-2 align-items-end mb-2" id="rowInput">
    <div class="col-md-6">
      <label class="form-label">Pilih Produk</label>
      <select id="pilihProduk" class="form-select">
        <option value="" hidden>Pilih Produk...</option>
        @foreach(\App\Models\Produk::orderBy('nama')->get() as $p)
          <option value="{{ $p->kodeproduk }}" data-nama="{{ $p->nama }}" data-satuan="{{ $p->satuan }}">{{ $p->kodeproduk }} — {{ $p->nama }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Qty</label>
      <input id="qtyProduk" type="number" step="0.01" min="0" class="form-control">
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-outline-success w-100" id="btnTambah">Tambah Baris</button>
    </div>
  </div>

  <div class="table-responsive">
  <table class="table table-bordered" id="tblDetail">
    <thead class="table-light">
      <tr><th>Kode Produk</th><th>Nama Produk</th><th>Satuan</th><th class="text-end">Qty</th><th class="text-end">Aksi</th></tr>
    </thead>
    <tbody></tbody>
    <tfoot>
      <tr><th colspan="3" class="text-end">Total Kuantitas Kirim</th><th class="text-end" id="totalQty">0</th><th></th></tr>
    </tfoot>
  </table>
  </div>

  <button class="btn btn-success">Simpan Pengiriman</button>
  <a class="btn btn-secondary" href="{{ route('masterkirim.index') }}">Batal</a>
</form>

<script>
(function(){
  const tbody = document.querySelector('#tblDetail tbody');
  const totalEl = document.getElementById('totalQty');
  const pilih = document.getElementById('pilihProduk');
  const qty = document.getElementById('qtyProduk');
  const btn = document.getElementById('btnTambah');

  function recalc(){
    let t = 0;
    tbody.querySelectorAll('input[name*="[qty]"]').forEach(i => t += parseFloat(i.value||0));
    totalEl.textContent = t.toFixed(2);
  }

  btn.addEventListener('click', () => {
    const opt = pilih.options[pilih.selectedIndex];
    if(!opt || !opt.value) return alert('Pilih produk dahulu');
    const kode = opt.value, nama = opt.dataset.nama, satuan = opt.dataset.satuan;
    const q = parseFloat(qty.value||0);
    if(!(q>0)) return alert('Isi qty > 0');

    // prevent duplicate: if exists, just bump quantity
    const exists = tbody.querySelector(`tr[data-kode="${kode}"]`);
    if(exists){
      const inp = exists.querySelector('input[name*="[qty]"]');
      inp.value = (parseFloat(inp.value||0)+q).toFixed(2);
      recalc();
      return;
    }

    const i = tbody.children.length;
    const tr = document.createElement('tr');
    tr.dataset.kode = kode;
    tr.innerHTML = `
      <td>
        ${kode}
        <input type="hidden" name="details[${i}][kodeproduk]" value="${kode}">
      </td>
      <td>${nama}</td>
      <td>${satuan}</td>
      <td class="text-end"><input type="number" step="0.01" min="0" class="form-control form-control-sm text-end" name="details[${i}][qty]" value="${q.toFixed(2)}"></td>
      <td class="text-end"><button type="button" class="btn btn-sm btn-danger btn-hapus">Hapus</button></td>
    `;
    tbody.appendChild(tr);
    qty.value = '';
    recalc();
  });

  tbody.addEventListener('click', (e) => {
    if(e.target.classList.contains('btn-hapus')){
      e.target.closest('tr').remove();
      recalc();
    }
  });

  tbody.addEventListener('input', recalc);
})();
</script>
@endsection
