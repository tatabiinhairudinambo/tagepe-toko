@extends('backend.layout.app')
@section('title', 'Buat Pesanan')
@section('content')

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body">
                <h5 class="mb-3">Pilih Produk</h5>
                <div class="row g-3" id="produk-list">
                    @foreach($produks as $produk)
                    @php
                        $stok = $cabang_id && $produk->stokCabangs->first()
                            ? $produk->stokCabangs->first()->stok
                            : $produk->stok;
                    @endphp
                    <div class="col-md-4">
                        <div class="card h-100 produk-item" style="cursor:pointer;border-radius:10px"
                             data-id="{{ $produk->id }}"
                             data-nama="{{ $produk->nama }}"
                             data-harga="{{ $produk->harga }}"
                             data-stok="{{ $stok }}">
                            <div class="card-body text-center p-3">
                                @if($produk->foto)
                                    <img src="{{ str_starts_with($produk->foto,'http') ? $produk->foto : asset('storage/'.$produk->foto) }}"
                                         class="img-fluid mb-2" style="height:70px;object-fit:cover;border-radius:8px">
                                @endif
                                <h6 class="mb-1 small">{{ $produk->nama }}</h6>
                                <p class="text-muted small mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <span class="badge bg-info">Stok: {{ $stok }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius:14px;position:sticky;top:20px">
            <div class="card-body">
                <h5 class="mb-3">Detail Pesanan</h5>
                <form action="{{ route('pemesanan.store') }}" method="POST" id="form-pesan">
                    @csrf
                    <input type="hidden" name="cabang_id" value="{{ $cabang_id }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Kasir</label>
                        <input type="text" name="kasir" class="form-control"
                               placeholder="Nama kasir / shift"
                               value="{{ session('kasir_nama', '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan <span class="text-muted small">(opsional)</span></label>
                        <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama pelanggan">
                    </div>

                    <div id="cart-items" class="mb-3">
                        <p class="text-muted text-center small">Belum ada produk dipilih</p>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total:</strong>
                        <strong id="total-harga">Rp 0</strong>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="btn-pesan" disabled>
                        <i class="bi bi-receipt me-1"></i> Buat Pesanan & Cetak Nota
                    </button>
                    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];
let total = 0;

document.querySelectorAll('.produk-item').forEach(item => {
    item.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const harga = parseFloat(this.dataset.harga);
        const stok = parseInt(this.dataset.stok);
        const existing = cart.find(i => i.id == id);
        if (existing) {
            if (existing.jumlah < stok) existing.jumlah++;
            else { alert('Stok tidak cukup!'); return; }
        } else {
            cart.push({ id, nama, harga, jumlah: 1, stok });
        }
        updateCart();
    });
});

function updateCart() {
    const cartDiv = document.getElementById('cart-items');
    if (cart.length === 0) {
        cartDiv.innerHTML = '<p class="text-muted text-center small">Belum ada produk dipilih</p>';
        document.getElementById('btn-pesan').disabled = true;
        total = 0;
    } else {
        let html = '';
        total = 0;
        cart.forEach((item, index) => {
            const subtotal = item.harga * item.jumlah;
            total += subtotal;
            html += `
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                    <div class="flex-grow-1">
                        <small><strong>${item.nama}</strong></small><br>
                        <small class="text-muted">Rp ${item.harga.toLocaleString('id-ID')} x ${item.jumlah}</small>
                        <input type="hidden" name="items[${index}][produk_id]" value="${item.id}">
                        <input type="hidden" name="items[${index}][jumlah]" value="${item.jumlah}">
                    </div>
                    <div class="btn-group btn-group-sm ms-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="updateJumlah(${index},-1)">-</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="updateJumlah(${index},1)">+</button>
                        <button type="button" class="btn btn-outline-danger" onclick="removeItem(${index})">×</button>
                    </div>
                </div>`;
        });
        cartDiv.innerHTML = html;
        document.getElementById('btn-pesan').disabled = false;
    }
    document.getElementById('total-harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function updateJumlah(index, delta) {
    const item = cart[index];
    const newJumlah = item.jumlah + delta;
    if (newJumlah <= 0) removeItem(index);
    else if (newJumlah <= item.stok) { item.jumlah = newJumlah; updateCart(); }
    else alert('Stok tidak cukup!');
}

function removeItem(index) {
    cart.splice(index, 1);
    updateCart();
}
</script>
@endsection
