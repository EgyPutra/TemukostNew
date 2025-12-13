<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Booking;   // ✅ WAJIB ADA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function store(Request $request, Kost $kost)
    {
        $request->validate([
            'start_date' => 'required|date',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'kost_id'    => $kost->id,
            'start_date' => $request->start_date,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Booking berhasil dikirim');
    }
}
