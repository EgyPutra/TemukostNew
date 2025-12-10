<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Facility;
use Illuminate\Http\Request;

class PublicKostController extends Controller
{
    public function index(Request $request)
    {
        $query = Kost::with(['photos','facilities'])
            ->where('is_active', true);

        if ($request->filled('kota')) {
            $query->where('kota', 'like', '%'.$request->kota.'%');
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('min')) {
            $query->where('harga_bulanan', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('harga_bulanan', '<=', $request->max);
        }

        // ✅ filter fasilitas
        if ($request->filled('fac')) {
            $facIds = $request->fac;
            $query->whereHas('facilities', function ($q) use ($facIds) {
                $q->whereIn('facilities.id', $facIds);
            });
        }

        $facilities = Facility::orderBy('name')->get();
        $kosts = $query->latest()->paginate(12);

        return view('public.kost.index', compact('kosts','facilities'));
    }

    public function show(Kost $kost)
    {
        $kost->load('photos','owner','facilities');

        return view('public.kost.show', compact('kost'));
    }
}
