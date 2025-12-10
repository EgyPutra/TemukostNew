@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Tambah Kost</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          enctype="multipart/form-data"
          action="{{ route('owner.kost.store') }}">
        @csrf

        <div class="mb-2">
            <label class="form-label">Nama Kost</label>
            <input name="nama" class="form-control"
                   value="{{ old('nama') }}" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-2">
            <label class="form-label">Kota</label>
            <input name="kota" class="form-control"
                   value="{{ old('kota') }}" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Harga Bulanan</label>
            <input name="harga_bulanan" type="number" class="form-control"
                   value="{{ old('harga_bulanan') }}" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Tipe Kost</label>
            <select name="tipe" class="form-select" required>
                @foreach(['putra','putri','campur'] as $t)
                    <option value="{{ $t }}" @selected(old('tipe')==$t)>
                        {{ ucfirst($t) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col mb-2">
                <label class="form-label">Jumlah Kamar</label>
                <input name="jumlah_kamar" type="number" class="form-control"
                       value="{{ old('jumlah_kamar',0) }}" required>
            </div>
            <div class="col mb-2">
                <label class="form-label">Sisa Kamar</label>
                <input name="sisa_kamar" type="number" class="form-control"
                       value="{{ old('sisa_kamar',0) }}" required>
            </div>
        </div>

        <div class="mb-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        {{-- ✅ FASILITAS --}}
        <hr class="my-4">
        <div class="mb-3">
            <label class="form-label fw-bold">Fasilitas Kost</label>
            <div class="row g-2">
                @foreach($facilities as $f)
                    <div class="col-md-4 col-6">
                        <label class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="facilities[]"
                                   value="{{ $f->id }}"
                                   {{ in_array($f->id, old('facilities', [])) ? 'checked' : '' }}>
                            <span class="form-check-label">{{ $f->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Kost (bisa banyak)</label>
            <input name="photos[]" type="file" multiple class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('owner.kost.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
