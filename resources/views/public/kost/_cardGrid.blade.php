@php $rating = number_format(rand(44,50)/10,1); @endphp

<a href="{{ route('kost.show', $kost) }}" class="text-decoration-none text-dark">
    <div class="card kost-card h-100 position-relative">

        <div class="kost-badge">
            {{ ucfirst($kost->tipe) }}
        </div>

        <div class="kost-rating">
            <i class="bi bi-star-fill text-warning"></i>
            <span>{{ $rating }}</span>
        </div>

        @if($kost->photos->first())
            <img class="kost-img"
                 src="{{ asset('storage/'.$kost->photos->first()->path) }}" alt="">
        @else
            <div class="kost-img d-flex align-items-center justify-content-center">
                <span class="text-muted">No Photo</span>
            </div>
        @endif

        <div class="card-body">
            <div class="kost-title">{{ $kost->nama }}</div>
            <div class="kost-location">{{ $kost->kota }}</div>

<div class="kost-features mt-1">
    @foreach($kost->facilities->take(3) as $fac)
        {{ $fac->name }}@if(!$loop->last) • @endif
    @endforeach

    @if($kost->facilities->count() > 3)
        • +{{ $kost->facilities->count() - 3 }} lainnya
    @endif
</div>


            <div class="d-flex justify-content-between align-items-end mt-2">
                <div>
                    <div class="price">Rp {{ number_format($kost->harga_bulanan) }}</div>
                    <div class="text-muted small">/bulan</div>
                </div>
                @if($kost->sisa_kamar <= 3)
                    <div class="remaining">Sisa {{ $kost->sisa_kamar }}</div>
                @endif
            </div>
        </div>
    </div>
</a>
