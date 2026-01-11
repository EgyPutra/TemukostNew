@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Booking Masuk</h3>

    @forelse($bookings as $booking)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">{{ $booking->kost->nama }}</h5>

                <p class="mb-1">
                    <strong>Penyewa:</strong> {{ $booking->user->name }}
                </p>

                <p class="mb-2">
                    <strong>Tanggal Mulai:</strong> {{ $booking->start_date }}
                </p>

                {{-- STATUS --}}
                @if($booking->status === 'pending')
                    <span class="badge bg-warning">MENUNGGU KONFIRMASI</span>
                @elseif($booking->status === 'approved')
                    <span class="badge bg-success">DISETUJUI</span>
                @else
                    <span class="badge bg-danger">DITOLAK</span>
                @endif

                {{-- ACTION --}}
                <div class="mt-3 d-flex gap-2">
                    @if($booking->status === 'pending')
                        <form method="POST"
                              action="{{ route('owner.bookings.approve', $booking) }}">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                Setuju
                            </button>
                        </form>

                        <form method="POST"
                              action="{{ route('owner.bookings.reject', $booking) }}">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                Tolak
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('chat.show', $booking) }}"
                       class="btn btn-outline-primary btn-sm">
                        Chat
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada booking masuk.</p>
    @endforelse
</div>
@endsection
