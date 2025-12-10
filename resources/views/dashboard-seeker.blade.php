@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h3>Halo, {{ auth()->user()->name }} 👋</h3>
    <p>Yuk cari kost terbaikmu di Bali.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Cari Kost</a>
</div>
@endsection
