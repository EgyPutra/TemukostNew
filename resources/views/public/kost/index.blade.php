@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- ===== HERO SEARCH ===== --}}
    <div class="p-4 p-md-5 bg-white rounded-4 shadow-sm mb-4"
         style="background: radial-gradient(1200px circle at top left, #f2f6ff 0%, #ffffff 50%);">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <h2 class="fw-bold mb-2">TemuKost Bali</h2>
                <p class="section-subtitle mb-3">
                    Temukan kost terbaik di Bali. Putra, putri, atau campur — semua ada.
                </p>

                <form class="row g-2" method="GET" action="{{ route('home') }}">
                    <div class="col-md-4">
                        <input name="kota" class="form-control form-control-lg rounded-3"
                               placeholder="Kota (Denpasar, Badung...)"
                               value="{{ request('kota') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="tipe" class="form-select form-select-lg rounded-3">
                            <option value="">Semua tipe</option>
                            <option value="putra" @selected(request('tipe')=='putra')>Putra</option>
                            <option value="putri" @selected(request('tipe')=='putri')>Putri</option>
                            <option value="campur" @selected(request('tipe')=='campur')>Campur</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <input name="min" type="number" class="form-control form-control-lg rounded-3"
                               placeholder="Min harga" value="{{ request('min') }}">
                    </div>

                    <div class="col-md-2">
                        <input name="max" type="number" class="form-control form-control-lg rounded-3"
                               placeholder="Max harga" value="{{ request('max') }}">
                    </div>

                    <div class="col-md-1 d-grid">
                        <button class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    {{-- ✅ FILTER FASILITAS --}}
                    @if(isset($facilities) && $facilities->count())
                        <div class="col-12 mt-3">
                            <div class="fw-bold mb-2">Fasilitas</div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($facilities as $f)
                                    <label class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <input type="checkbox"
                                               name="fac[]"
                                               value="{{ $f->id }}"
                                               class="form-check-input me-1"
                                               @checked(collect(request('fac'))->contains($f->id))>
                                        {{ $f->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            <div class="col-md-5 text-center">
                <img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?q=80&w=1200&auto=format&fit=crop"
                     class="img-fluid rounded-4 shadow-sm"
                     style="max-height:220px;object-fit:cover;">
            </div>
        </div>
    </div>


    {{-- ===== SECTION: PROMO NGEBUT (slider horizontal) ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h4 class="section-title mb-0">Promo Ngebut <span class="text-success">Semua Kota</span></h4>
            <div class="section-subtitle">Diskon spesial buat kamu</div>
        </div>

        <div class="d-flex gap-2">
            <div class="nav-arrow" onclick="scrollRow('promoRow',-1)">
                <i class="bi bi-chevron-left"></i>
            </div>
            <div class="nav-arrow" onclick="scrollRow('promoRow',1)">
                <i class="bi bi-chevron-right"></i>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-3 ms-2">Lihat semua</a>
        </div>
    </div>

    <div id="promoRow" class="scroll-row mb-4">
        @forelse($kosts as $kost)
            @include('public.kost._card', ['kost' => $kost])
        @empty
            <div class="text-muted">Belum ada kost tersedia.</div>
        @endforelse
    </div>


    {{-- ===== SECTION: REKOMENDASI ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
        <div>
            <h4 class="section-title mb-0">Rekomendasi kost di <span class="text-success">Bali</span></h4>
            <div class="section-subtitle">Pilihan paling populer</div>
        </div>

        <div class="d-flex gap-2">
            <div class="nav-arrow" onclick="scrollRow('rekomRow',-1)">
                <i class="bi bi-chevron-left"></i>
            </div>
            <div class="nav-arrow" onclick="scrollRow('rekomRow',1)">
                <i class="bi bi-chevron-right"></i>
            </div>
            <a href="#" class="btn btn-outline-secondary btn-sm rounded-3 ms-2">Lihat semua</a>
        </div>
    </div>

    <div id="rekomRow" class="scroll-row mb-5">
        @forelse($kosts as $kost)
            @include('public.kost._card', ['kost' => $kost])
        @empty
            <div class="text-muted">Belum ada kost tersedia.</div>
        @endforelse
    </div>



    {{-- ===== SECTION: ALL KOST (grid) ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="section-title mb-0">Semua kost</h4>
        <div class="section-subtitle">Total: {{ $kosts->total() }}</div>
    </div>

    <div class="row g-3">
        @forelse($kosts as $kost)
            <div class="col-md-4 col-lg-3">
                @include('public.kost._cardGrid', ['kost' => $kost])
            </div>
        @empty
            <p class="text-muted">Belum ada kost tersedia.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $kosts->withQueryString()->links() }}
    </div>
</div>

<script>
function scrollRow(id, dir){
    const el = document.getElementById(id);
    el.scrollBy({left: dir * 300, behavior: 'smooth'});
}
</script>
@endsection
