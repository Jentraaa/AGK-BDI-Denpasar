<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sponsor extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name', 
        'logo', 
        'link'
    ];

    /**
     * Accessor untuk mendapatkan URL logo secara otomatis.
     * Mempermudah pemanggilan di Blade: src="{{ $sponsor->logo_url }}"
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }
        
        // Kembalikan gambar placeholder jika logo kosong
        return 'https://via.placeholder.com/200x50?text=No+Logo';
    }
}