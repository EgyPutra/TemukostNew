<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KostController extends Controller
{
    /**
     * List kost milik owner
     */
public function index()
{
    $kosts = Kost::where('owner_id', Auth::id())
        ->with(['facilities', 'photos'])
        ->latest()
        ->paginate(10);

    return view('owner.kost.index', compact('kosts'));
}


    /**
     * Form tambah kost
     */
    public function create()
    {
        $facilities = Facility::orderBy('name')->get();

        return view('owner.kost.create', compact('facilities'));
    }

    /**
     * Simpan kost baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'harga_bulanan' => 'required|numeric',
            'tipe' => 'required|in:putra,putri,campur',
            'jumlah_kamar' => 'required|integer|min:0',
            'sisa_kamar' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'photos.*' => 'nullable|image|max:2048',

            // ✅ fasilitas
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $data['owner_id'] = Auth::id();
        $data['is_active'] = true;

        $kost = Kost::create($data);

        // ✅ simpan fasilitas ke pivot
        $kost->facilities()->sync($request->facilities ?? []);

        // simpan foto jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('kost', 'public');
                $kost->photos()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('owner.kost.index')
            ->with('success', 'Kost berhasil ditambahkan!');
    }

    /**
     * Detail kost owner (opsional)
     */
    public function show(Kost $kost)
    {
        $this->authorizeOwner($kost);

        $kost->load(['photos', 'facilities']);

        return view('owner.kost.show', compact('kost'));
    }

    /**
     * Form edit kost
     */
    public function edit(Kost $kost)
    {
        $this->authorizeOwner($kost);

        $facilities = Facility::orderBy('name')->get();
        $kost->load(['photos', 'facilities']);

        return view('owner.kost.edit', compact('kost', 'facilities'));
    }

    /**
     * Update kost
     */
    public function update(Request $request, Kost $kost)
    {
        $this->authorizeOwner($kost);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:100',
            'harga_bulanan' => 'required|numeric',
            'tipe' => 'required|in:putra,putri,campur',
            'jumlah_kamar' => 'required|integer|min:0',
            'sisa_kamar' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'photos.*' => 'nullable|image|max:2048',

            // ✅ fasilitas
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $kost->update($data);

        // ✅ update pivot fasilitas
        $kost->facilities()->sync($request->facilities ?? []);

        // tambah foto baru jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('kost', 'public');
                $kost->photos()->create(['path' => $path]);
            }
        }

        return redirect()
            ->route('owner.kost.index')
            ->with('success', 'Kost berhasil diperbarui!');
    }

    /**
     * Hapus kost
     */
    public function destroy(Kost $kost)
    {
        $this->authorizeOwner($kost);

        $kost->delete();

        return back()->with('success', 'Kost berhasil dihapus!');
    }

    /**
     * Cegah owner lain akses kost bukan miliknya
     */
    private function authorizeOwner(Kost $kost)
    {
        if ($kost->owner_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan.');
        }
    }
}
