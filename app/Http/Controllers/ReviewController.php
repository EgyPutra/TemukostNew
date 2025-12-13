<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Kost $kost)
    {
        // sementara kosong dulu
        return back();
    }
}
