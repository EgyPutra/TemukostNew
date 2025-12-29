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
        // ❌ CEK STOK KAMAR
        if ($kost->sisa_kamar <= 0) {
            return back()->with('error', 'Maaf, kamar sudah penuh.');
        }

        // ✅ VALIDASI TANGGAL
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        Booking::create([
            'user_id'    => Auth::id(),
            'kost_id'    => $kost->id,
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Booking berhasil dikirim, menunggu persetujuan pemilik.');
    }

    /*
    |--------------------------------------------------------------------------
    | APPROVE BOOKING (OWNER)
    |--------------------------------------------------------------------------
    */
    public function approve(Booking $booking)
    {
        // 🔐 HANYA OWNER YANG BERHAK
        if ($booking->kost->owner_id !== Auth::id()) {
            abort(403);
        }

        // ❌ JANGAN APPROVE ULANG
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking sudah diproses.');
        }

        // ❌ CEK STOK
        if ($booking->kost->sisa_kamar <= 0) {
            return back()->with('error', 'Stok kamar sudah habis.');
        }

        // ✅ APPROVE
        $booking->update([
            'status' => 'approved'
        ]);

        // ✅ KURANGI STOK KAMAR
        $booking->kost->decrement('sisa_kamar');

        return back()->with('success', 'Booking disetujui & stok kamar dikurangi.');
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

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking sudah diproses.');
        }

        $booking->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Booking ditolak.');
    }
}
