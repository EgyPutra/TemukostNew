@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-3">Booking</h4>

    @forelse($bookings as $booking)
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="fw-bold">{{ $booking->kost->nama }}</h6>
                <p class="mb-1">
                    <strong>Tanggal Mulai:</strong> {{ $booking->start_date }}
                </p>
                @php
                    $statusLabel = [
                    'pending'   => 'Menunggu Konfirmasi',
                    'approved'  => 'Disetujui',
                    'rejected'  => 'Ditolak',
                    'cancelled' => 'Dibatalkan',
                    'completed' => 'Selesai',
                ];

                    $statusColor = [
                    'pending'   => 'bg-warning text-dark',
                    'approved'  => 'bg-success',
                    'rejected'  => 'bg-danger',
                    'cancelled' => 'bg-secondary',
                    'completed' => 'bg-primary',
                ];
                @endphp

                <span class="badge {{ $statusColor[$booking->status] ?? 'bg-dark' }}">
                    {{ $statusLabel[$booking->status] ?? ucfirst($booking->status) }}
                </span>

                <div class="mt-2">
                    <a href="{{ route('chat.show', $booking) }}"
                       class="btn btn-sm btn-outline-primary">
                        Chat Pemilik
                    </a>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada booking.</p>
    @endforelse
</div>
@endsection
