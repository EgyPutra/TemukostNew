<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kost;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function kosts()
    {
        return $this->belongsToMany(Kost::class, 'facility_kost');
    }
}
