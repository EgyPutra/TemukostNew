<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'nama',
        'alamat',
        'kota',
        'harga_bulanan',
        'tipe',
        'jumlah_kamar',
        'sisa_kamar',
        'deskripsi',
        'is_active',
        'luas_kamar'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function facilities()
{
    return $this->belongsToMany(Facility::class);
}

    public function photos()
    {
        return $this->hasMany(KostPhoto::class);
    }
    public function bookings()
{
    return $this->hasMany(Booking::class);
}

    

}
