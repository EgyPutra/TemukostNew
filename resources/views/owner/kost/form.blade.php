<form method="POST"
      enctype="multipart/form-data"
      action="{{ $kost ? route('owner.kost.update',$kost) : route('owner.kost.store') }}">
    @csrf
    @if($kost) @method('PUT') @endif

    <div class="mb-2">
        <label class="form-label">Nama Kost</label>
        <input name="nama" class="form-control"
               value="{{ old('nama', $kost->nama ?? '') }}" required>
    </div>

    <div class="mb-2">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ old('alamat', $kost->alamat ?? '') }}</textarea>
    </div>

    <div class="mb-2">
        <label class="form-label">Kota</label>
        <input name="kota" class="form-control"
               value="{{ old('kota', $kost->kota ?? '') }}" required>
    </div>

    <div class="mb-2">
        <label class="form-label">Harga Bulanan</label>
        <input name="harga_bulanan" type="number" class="form-control"
               value="{{ old('harga_bulanan', $kost->harga_bulanan ?? '') }}" required>
    </div>

    <div class="mb-2">
        <label class="form-label">Tipe Kost</label>
        <select name="tipe" class="form-select" required>
            @foreach(['putra','putri','campur'] as $t)
                <option value="{{ $t }}"
                    @selected(old('tipe', $kost->tipe ?? '') == $t)>
                    {{ ucfirst($t) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col mb-2">
            <label class="form-label">Jumlah Kamar</label>
            <input name="jumlah_kamar" type="number" class="form-control"
                   value="{{ old('jumlah_kamar', $kost->jumlah_kamar ?? 0) }}" required>
        </div>
        <div class="col mb-2">
            <label class="form-label">Sisa Kamar</label>
            <input name="sisa_kamar" type="number" class="form-control"
                   value="{{ old('sisa_kamar', $kost->sisa_kamar ?? 0) }}" required>
        </div>
    </div>

    <div class="mb-2">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $kost->deskripsi ?? '') }}</textarea>
    </div>

    @if($kost)
        <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="is_active" class="form-select">
                <option value="1" @selected($kost->is_active)>Aktif</option>
                <option value="0" @selected(!$kost->is_active)>Nonaktif</option>
            </select>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Foto Kost (bisa banyak)</label>
        <input name="photos[]" type="file" multiple class="form-control">
        <div class="form-text">Max 2MB per foto.</div>
    </div>

    @if($kost && $kost->photos->count())
        <div class="row g-2 mb-3">
            @foreach($kost->photos as $p)
                <div class="col-md-3">
                    <img class="w-100 rounded" style="height:120px;object-fit:cover"
                         src="{{ asset('storage/'.$p->path) }}">
                </div>
            @endforeach
        </div>
    @endif

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('owner.kost.index') }}" class="btn btn-secondary">Batal</a>
</form>
