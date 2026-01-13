<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    // Form tambah mitra
    public function create()
    {
        return view('sponsors.create');
    }

    // Simpan mitra baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'link' => 'nullable|url'
        ]);

        // Simpan file logo ke folder storage/app/public/sponsors
        $path = $request->file('logo')->store('sponsors', 'public');

        Sponsor::create([
            'name' => $request->name,
            'logo' => $path,
            'link' => $request->link,
        ]);

        return redirect('/')->with('success', 'Mitra berhasil ditambahkan ke archive.');
    }

    // Hapus mitra
    public function destroy($id)
    {
        $sponsor = Sponsor::findOrFail($id);

        // Hapus file gambar dari storage agar tidak memenuhi memori
        if ($sponsor->logo) {
            Storage::disk('public')->delete($sponsor->logo);
        }

        $sponsor->delete();

        return back()->with('success', 'Mitra telah dihapus.');
    }
}