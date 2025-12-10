@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Kost Saya</h3>
        <a href="{{ route('owner.kost.create') }}" class="btn btn-primary">+ Tambah Kost</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>Kota</th>
                <th>Harga/bulan</th>
                <th>Sisa Kamar</th>
                <th>Status</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kosts as $kost)
                <tr>
                    <td>{{ $kost->nama }}</td>
                    <td>{{ $kost->kota }}</td>
                    <td>Rp {{ number_format($kost->harga_bulanan) }}</td>
                    <td>{{ $kost->sisa_kamar }}</td>
                    <td>
                        @if($kost->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-sm btn-warning" href="{{ route('owner.kost.edit',$kost) }}">Edit</a>

                        <form method="POST" action="{{ route('owner.kost.destroy',$kost) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus kost ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada kost.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $kosts->links() }}
</div>
@endsection
