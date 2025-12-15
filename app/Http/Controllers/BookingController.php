<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BOOKING MASUK (OWNER)
    |--------------------------------------------------------------------------
    */
    public function ownerIndex()
    {
        $bookings = Booking::whereHas('kost', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->with(['kost', 'user'])
            ->latest()
            ->get();

        return view('owner.bookings.index', compact('bookings'));
    }

    /*
    |--------------------------------------------------------------------------
    | BOOKING SAYA (SEEKER)
    |--------------------------------------------------------------------------
    */
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('kost')
            ->latest()
            ->get();

        return view('booking.my', compact('bookings'));
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM BOOKING (SEEKER)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, Kost $kost)
    {
        $request->validate([
            'start_date' => 'required|date',
        ]);

        Booking::create([
            'user_id'    => Auth::id(),
            'kost_id'    => $kost->id,
            'start_date' => $request->start_date,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Booking berhasil dikirim');
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE BOOKING (OWNER)
    |--------------------------------------------------------------------------
    */
    public function approve(Booking $booking)
    {
        // proteksi: hanya owner kost
        if ($booking->kost->owner_id !== Auth::id()) {
            abort(403);
        }

        $booking->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Booking disetujui');
    }

    /*
    |--------------------------------------------------------------------------
    | REJECT BOOKING (OWNER)
    |--------------------------------------------------------------------------
    */
    public function reject(Booking $booking)
    {
        if ($booking->kost->owner_id !== Auth::id()) {
            abort(403);
        }

        $booking->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Booking ditolak');
    }
    
}
