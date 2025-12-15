<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(Booking $booking)
    {
        // hanya owner kost & penyewa yang boleh chat
        if (
            $booking->user_id !== Auth::id() &&
            $booking->kost->owner_id !== Auth::id()
        ) {
            abort(403);
        }

        $messages = $booking->messages()->with('user')->get();

        return view('chat.show', compact('booking', 'messages'));
    }

    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        // proteksi akses
        if (
            $booking->user_id !== Auth::id() &&
            $booking->kost->owner_id !== Auth::id()
        ) {
            abort(403);
        }

        Message::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back();
    }
}
