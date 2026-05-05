@extends('layout.app')
@section('title', 'Kasir')
@section('content')

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Pilih Cabang --}}
@if($cabangs->count() > 0)
<div class="card border-0 shadow-sm mb-3" style="border-radius:14px">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <label class="form-label mb-0"><i class="bi bi-building me-1"></i> Pilih Cabang</label>
            </div>
            <div class="col-md-6">
                <form action="{{ route('transaksi.setCabang') }}" method="POST">
                    @csrf
                    <select name="cabang_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Pilih Cabang --</option>
                        @foreach($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ $cabang_id == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama_cabang }} ({{ $cabang->kode_cabang }})
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px">
            <div class="card-body">
                <h5 class="mb-3">Pilih Produk</h5>
                <div class="mb-3">
                    <input type="text" id="searchKasir" class="form-control" placeholder="🔍 Cari nama produk...">
                </div>
                
                @if($produks->count() == 0)
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        @if($cabang_id)
                            Tidak ada produk dengan stok di cabang ini. Silakan kelola stok cabang terlebih dahulu.
                        @else
                            Tidak ada produk dengan stok. Silakan tambah produk atau pilih cabang.
                        @endif
                    </div>
                @endif
                
                <div class="row g-3" id="produk-list">
                    @foreach($produks as $produk)
                    @php
                        $stok = $cabang_id && $produk->stokCabangs->first()
                            ? $produk->stokCabangs->first()->stok
                            : $produk->stok;
                        $foto = $produk->foto
                            ? (str_starts_with($produk->foto, 'http') ? $produk->foto : asset('storage/'.$produk->foto))
                            : null;
                    @endphp
                    <div class="col-6 col-md-3">
                        <div class="card h-100 produk-item border-0 shadow-sm"
                             style="cursor:pointer;border-radius:12px;transition:transform .15s,box-shadow .15s"
                             data-id="{{ $produk->id }}"
                             data-nama="{{ $produk->nama }}"
                             data-harga="{{ $produk->harga }}"
                             data-stok="{{ $stok }}"
                             onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.12)'"
                             onmouseout="this.style.transform='';this.style.boxShadow=''">
                            {{-- Foto --}}
                            <div style="height:130px;overflow:hidden;border-radius:12px 12px 0 0;background:#f0f4f8">
                                @if($foto)
                                    <img src="{{ $foto }}" alt="{{ $produk->nama }}"
                                         style="width:100%;height:100%;object-fit:cover">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="bi bi-image text-muted" style="font-size:2.5rem"></i>
                                    </div>
                                @endif
                            </div>
                            {{-- Info --}}
                            <div class="card-body p-2 text-center">
                                <div class="fw-semibold small mb-1" style="font-size:.82rem;line-height:1.3">{{ $produk->nama }}</div>
                                <div class="text-primary fw-bold small">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                <div class="mt-1">
                                    @if($stok > 0)
                                        <span class="badge bg-success" style="font-size:.7rem">Stok: {{ $stok }}</span>
                                    @else
                                        <span class="badge bg-danger" style="font-size:.7rem">Habis</span>
                                    @endif
                                </div>
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
                <h5 class="mb-3">Keranjang</h5>
                <form action="{{ route('transaksi.store') }}" method="POST" id="form-transaksi">
                    @csrf
                    <input type="hidden" name="cabang_id" value="{{ $cabang_id }}">
                    <div id="cart-items" class="mb-3">
                        <p class="text-muted text-center">Belum ada produk</p>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Total:</strong>
                        <strong id="total-harga">Rp 0</strong>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-person me-1"></i>Nama Kasir / Shift</label>
                        <input type="text" name="kasir" class="form-control" 
                               placeholder="Contoh: Budi - Shift Pagi"
                               value="{{ session('kasir_nama', '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bayar</label>
                        <input type="number" name="bayar" id="bayar" class="form-control" required min="0" step="1000">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control" readonly>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" id="btn-bayar" disabled>
                        <i class="bi bi-check-lg me-1"></i> Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let cart = [];
let total = 0;

// Pencarian produk di kasir
document.getElementById('searchKasir').addEventListener('input', function() {
    const keyword = this.value.toLowerCase();
    document.querySelectorAll('.produk-item').forEach(card => {
        const nama = card.dataset.nama?.toLowerCase() || '';
        card.closest('.col-6').style.display = nama.includes(keyword) ? '' : 'none';
    });
});

// Tambah produk ke cart
document.querySelectorAll('.produk-item').forEach(item => {
    item.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const harga = parseFloat(this.dataset.harga);
        const stok = parseInt(this.dataset.stok);
        
        // Cek apakah sudah ada di cart
        const existing = cart.find(i => i.id == id);
        if (existing) {
            if (existing.jumlah < stok) {
                existing.jumlah++;
            } else {
                alert('Stok tidak cukup!');
                return;
            }
        } else {
            cart.push({ id, nama, harga, jumlah: 1, stok });
        }
        
        updateCart();
    });
});

// Update tampilan cart
function updateCart() {
    const cartDiv = document.getElementById('cart-items');
    
    if (cart.length === 0) {
        cartDiv.innerHTML = '<p class="text-muted text-center">Belum ada produk</p>';
        document.getElementById('btn-bayar').disabled = true;
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
                    <div class="text-end">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-secondary" onclick="updateJumlah(${index}, -1)">-</button>
                            <button type="button" class="btn btn-outline-secondary" onclick="updateJumlah(${index}, 1)">+</button>
                            <button type="button" class="btn btn-outline-danger" onclick="removeItem(${index})">×</button>
                        </div>
                        <div><small><strong>Rp ${subtotal.toLocaleString('id-ID')}</strong></small></div>
                    </div>
                </div>
            `;
        });
        
        cartDiv.innerHTML = html;
        document.getElementById('btn-bayar').disabled = false;
    }
    
    document.getElementById('total-harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
    hitungKembalian();
}

// Update jumlah
function updateJumlah(index, delta) {
    const item = cart[index];
    const newJumlah = item.jumlah + delta;
    
    if (newJumlah <= 0) {
        removeItem(index);
    } else if (newJumlah <= item.stok) {
        item.jumlah = newJumlah;
        updateCart();
    } else {
        alert('Stok tidak cukup!');
    }
}

// Hapus item
function removeItem(index) {
    cart.splice(index, 1);
    updateCart();
}

// Hitung kembalian
document.getElementById('bayar').addEventListener('input', hitungKembalian);

function hitungKembalian() {
    const bayar = parseFloat(document.getElementById('bayar').value) || 0;
    const kembalian = bayar - total;
    document.getElementById('kembalian').value = kembalian >= 0 ? 'Rp ' + kembalian.toLocaleString('id-ID') : 'Kurang bayar';
}
</script>

@endsection
