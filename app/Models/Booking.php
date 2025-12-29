<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kost_id',
        'start_date',
        'end_date',     // ✅ tanggal akhir sewa
        'status',       // pending | approved | rejected
    ];

    /**
     * Relasi ke Kost
     */
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    /**
     * Relasi ke User (Penyewa)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Chat / Message
     */
    public function messages()
    {
        return $this->hasMany(\App\Models\Message::class);
    }

    /**
     * Helper: hitung durasi sewa (bulan)
     */
    public function getDurationInMonthsAttribute()
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        $start = \Carbon\Carbon::parse($this->start_date);
        $end   = \Carbon\Carbon::parse($this->end_date);

        return max(1, $start->diffInMonths($end));
    }
}
