@extends('layouts.app')

@section('title', isset($transaction) ? 'Edit Transaction' : 'Create Transaction')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center" style="color: var(--secondary-color);">{{ isset($transaction) ? 'Edit Transaction' : 'Create Transaction' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <form action="{{ isset($transaction) ? route('transactions.update', $transaction->kodepengiriman) : route('transactions.store') }}" method="POST">
    @csrf
    @if(isset($transaction))
        @method('PUT')
    @endif

    <div class="card mb-3">
        <div class="card-header">
            Informasi Pengiriman
        </div>
        <div class="card-body">
            <!-- Shipping Information Fields -->
            <div class="mb-3">
                <label for="kodepengiriman" class="form-label">Shipping Code</label>
                <input type="text" name="kodepengiriman" class="form-control" id="kodepengiriman" value="{{ $transaction->kodepengiriman ?? old('kodepengiriman') }}" required>
            </div>
            <div class="mb-3">
                <label for="tglpengiriman" class="form-label">Delivery Date</label>
                <input type="date" name="tglpengiriman" class="form-control" id="tglpengiriman" value="{{ $transaction->tglpengiriman ?? old('tglpengiriman') }}" required>
            </div>
            <div class="mb-3">
                <label for="nopol" class="form-label">Vehicle</label>
                <select name="nopol" class="form-control" required>
                    <option value="">Select Vehicle</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->nopol }}" {{ (isset($transaction) && $transaction->nopol == $vehicle->nopol) || old('nopol') == $vehicle->nopol ? 'selected' : '' }}>
                            {{ $vehicle->nopol }} | {{ $vehicle->nama_kendaraan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="driver" class="form-label">Driver</label>
                <input type="text" name="driver" class="form-control" id="driver" value="{{ $transaction->driver ?? old('driver') }}" required>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Detail Item Pengiriman
        </div>
        <div class="card-body">
            <div id="items-container">
                @if(isset($transaction) && $transaction->products)
                    @foreach($transaction->products as $index => $product)
                        <div class="row mb-3 item-row" id="item-row-{{ $index }}">
                            <div class="col-md-4">
                                <label for="kodeproduk" class="form-label">Product</label>
                                <select name="products[{{ $index }}][kodeproduk]" class="form-control product-select" data-index="{{ $index }}" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $prod)
                                        <option value="{{ $prod->kodeproduk }}" {{ $prod->kodeproduk == $product->kodeproduk ? 'selected' : '' }}>
                                            {{ $prod->kodeproduk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="nama" class="form-label">Product Name</label>
                                <input type="text" name="products[{{ $index }}][nama]" class="form-control" readonly value="{{ $product->nama }}">
                            </div>
                            <div class="col-md-2">
                                <label for="satuan" class="form-label">Unit</label>
                                <input type="text" name="products[{{ $index }}][satuan]" class="form-control" readonly value="{{ $product->satuan }}">
                            </div>
                            <div class="col-md-2">
                                <label for="qty" class="form-label">Quantity</label>
                                <input type="number" name="products[{{ $index }}][qty]" class="form-control qty-input" value="{{ $product->pivot->qty }}" required oninput="calculateTotalQuantity()">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeItem('item-row-{{ $index }}')">Remove</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="button" class="btn btn-info" id="add-item-btn">Add Item</button>

            <hr>

            <div class="row mb-3 justify-content-end">
                <div class="col-md-3">
                    <label for="totalqty" class="form-label fw-bold">Total Quantity</label>
                    <input type="number" id="totalqty" class="form-control" name="totalqty" value="{{ $transaction->totalqty ?? old('totalqty', 0) }}" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Save Transaction</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

    </div>

    <script>
        // Siapkan data produk dalam format JSON
        const allProducts = @json($products->keyBy('kodeproduk'));
        
        // Tentukan itemIndex. Mulai dari jumlah item yang ada (di edit mode) atau 0 (di create mode)
        let itemIndex = {{ isset($transaction) ? $transaction->products->count() : 0 }};

        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. Fungsi untuk tombol TAMBAH ITEM
            document.getElementById('add-item-btn').addEventListener('click', function() {
                const index = itemIndex++; // Gunakan index saat ini, lalu increment
                const itemsContainer = document.getElementById('items-container');
                const newItemRow = document.createElement('div');
                newItemRow.classList.add('row', 'mb-3', 'item-row');
                newItemRow.id = 'item-row-' + index;

                // Buat HTML untuk <option> produk
                let productOptions = '<option value="">Select Product</option>';
                for (const kodeproduk in allProducts) {
                    productOptions += `<option value="${allProducts[kodeproduk].kodeproduk}">${allProducts[kodeproduk].kodeproduk}</option>`;
                }

                newItemRow.innerHTML = `
                    <div class="col-md-4">
                        <label for="kodeproduk" class="form-label">Product</label>
                        <select name="products[${index}][kodeproduk]" class="form-control product-select" data-index="${index}" required>
                            ${productOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="nama" class="form-label">Product Name</label>
                        <input type="text" name="products[${index}][nama]" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="satuan" class="form-label">Unit</label>
                        <input type="text" name="products[${index}][satuan]" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="qty" class="form-label">Quantity</label>
                        <input type="number" name="products[${index}][qty]" class="form-control qty-input" required oninput="calculateTotalQuantity()">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeItem('item-row-${index}')">Remove</button>
                    </div>
                `;
                itemsContainer.appendChild(newItemRow);
            });

            // 2. Event delegation untuk Pilihan PRODUK (product-select)
            // Ini akan berfungsi untuk item lama (edit) dan item baru (add)
document.getElementById('items-container').addEventListener('change', function(e) {
    if (e.target && e.target.classList.contains('product-select')) {
        updateProductDetails(e.target);
    }
});

            // 3. Kalkulasi total saat halaman dimuat (untuk edit mode)
            calculateTotalQuantity();
        });

        // Fungsi untuk UPDATE NAMA & SATUAN PRODUK
       function updateProductDetails(selectElement) {
    const selectedKode = selectElement.value;
    const index = selectElement.getAttribute('data-index');
    const row = document.getElementById('item-row-' + index);

    if (selectedKode && allProducts[selectedKode]) {
        const product = allProducts[selectedKode];
        row.querySelector(`input[name="products[${index}][nama]"]`).value = product.nama;
        row.querySelector(`input[name="products[${index}][satuan]"]`).value = product.satuan;
    } else {
        // Reset if "Select Product" is chosen
        row.querySelector(`input[name="products[${index}][nama]"]`).value = '';
        row.querySelector(`input[name="products[${index}][satuan]"]`).value = '';
    }
}

        // Fungsi untuk HAPUS ITEM (berlaku untuk semua)
        function removeItem(rowId) {
            document.getElementById(rowId).remove();
            calculateTotalQuantity(); // Hitung ulang total
        }

        // Fungsi untuk KALKULASI TOTAL QTY (dipanggil saat ubah qty, add, remove)
        function calculateTotalQuantity() {
            let total = 0;
            document.querySelectorAll('.qty-input').forEach(function(input) {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('totalqty').value = total;
        }
    </script>
@endsection