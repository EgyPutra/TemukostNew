@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">
        Chat – {{ $booking->kost->nama }}
    </h4>

    <div class="card mb-3">
        <div class="card-body" style="height:350px; overflow-y:auto;">
            @forelse($messages as $msg)
                <div class="mb-2">
                    <strong>{{ $msg->user->name }}</strong>
                    <div class="small text-muted">
                        {{ $msg->created_at->diffForHumans() }}
                    </div>
                    <div class="bg-light rounded p-2">
                        {{ $msg->message }}
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada pesan.</p>
            @endforelse
        </div>
    </div>

    <form method="POST" action="{{ route('chat.store', $booking) }}">
        @csrf
        <div class="input-group">
            <input type="text"
                   name="message"
                   class="form-control"
                   placeholder="Ketik pesan..."
                   required>
            <button class="btn btn-primary">Kirim</button>
        </div>
    </form>

</div>
@endsection
