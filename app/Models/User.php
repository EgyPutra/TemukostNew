<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // optional kalau mau email verification
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // penting untuk owner / seeker
    ];

    /**
     * Relasi: satu user (owner) punya banyak kost
     */
    public function kosts()
    {
        return $this->hasMany(\App\Models\Kost::class, 'owner_id');
    }
    public function bookings()
{
    return $this->hasMany(Booking::class);
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
