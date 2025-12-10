@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row g-4">
        {{-- GALERI FOTO --}}
        <div class="col-lg-7">
            <div class="bg-white rounded-4 shadow-sm p-3">
                @if($kost->photos->count())
                    <div class="row g-2">
                        @foreach($kost->photos as $photo)
                            <div class="col-6 col-md-4">
                                <img class="w-100 rounded-3"
                                     style="height:160px;object-fit:cover"
                                     src="{{ asset('storage/'.$photo->path) }}" />
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted text-center py-5">Belum ada foto</div>
                @endif
            </div>
        </div>

        {{-- INFO KOST --}}
        <div class="col-lg-5">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $kost->nama }}</h3>
                        <div class="text-muted">{{ $kost->alamat }}, {{ $kost->kota }}</div>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                        {{ ucfirst($kost->tipe) }}
                    </span>
                </div>

                <hr>

                <div class="mb-2">
                    <div class="fw-bold fs-4">Rp {{ number_format($kost->harga_bulanan) }}</div>
                    <div class="text-muted">per bulan</div>
                </div>

                <div class="mb-3">
                    <span class="badge bg-success">Aktif</span>
                    @if($kost->sisa_kamar <= 3)
                        <span class="badge bg-danger">Sisa {{ $kost->sisa_kamar }} kamar</span>
                    @endif
                </div>

                <h6 class="fw-bold">Deskripsi</h6>
                <p class="text-muted">
                    {{ $kost->deskripsi ?? 'Belum ada deskripsi.' }}
                </p>

                <h6 class="fw-bold mt-3">Kontak Pemilik</h6>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-4"></i>
                    <div>
                        <div class="fw-semibold">{{ $kost->owner->name }}</div>
                        <div class="text-muted small">{{ $kost->owner->email }}</div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-4 rounded-3">
                    Ajukan Sewa / Chat Pemilik
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
