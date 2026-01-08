<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParfumController extends Controller
{
    private string $file = "parfum.json";
    private string $trainingFile = "training.json"; // File tambahan untuk training

    /* ===========================
        CORE JSON STORAGE (Universal)
    =========================== */

    private function getData($fileName): array
    {
        if (!Storage::disk('local')->exists($fileName)) {
            Storage::disk('local')->put($fileName, json_encode([]));
        }
        return json_decode(Storage::disk('local')->get($fileName), true);
    }

    private function saveData($fileName, array $data): void
    {
        Storage::disk('local')->put($fileName, json_encode(array_values($data), JSON_PRETTY_PRINT));
    }

    /* ===========================
        FRONT STORE (HOME)
    =========================== */

    public function index()
    {
        // Ambil data produk
        $parfums = $this->getData($this->file);
        
        // Ambil data training (Agar tidak error: Undefined variable $trainings)
        $trainings = $this->getData($this->trainingFile);

        return view('parfum.index', compact('parfums', 'trainings'));
    }

    public function show($id)
    {
        $parfums = $this->getData($this->file);
        $parfum = collect($parfums)->firstWhere('id', $id);

        if (!$parfum) abort(404);

        return view('parfum.show', compact('parfum'));
    }

    /* ===========================
        PRODUCT MANAGEMENT (CRUD)
    =========================== */

    public function create() { return view('parfum.create'); }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $this->getData($this->file);
        $img = $r->hasFile('image') ? $r->file('image')->store('parfum', 'public') : null;

        $data[] = [
            "id" => time(),
            "name" => $r->name,
            "brand" => $r->brand,
            "description" => $r->description,
            "image" => $img,
            "created_at" => now()->toDateTimeString()
        ];

        $this->saveData($this->file, $data);
        return redirect('/')->with('success', 'Fragrance added.');
    }

    public function edit($id)
    {
        $parfums = $this->getData($this->file);
        $parfum = collect($parfums)->firstWhere('id', $id);
        if (!$parfum) abort(404);
        return view('parfum.edit', compact('parfum'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $this->getData($this->file);
        foreach ($data as &$p) {
            if ($p['id'] == $id) {
                if ($r->hasFile('image')) {
                    if (!empty($p['image'])) Storage::disk('public')->delete($p['image']);
                    $p['image'] = $r->file('image')->store('parfum', 'public');
                }
                $p['name'] = $r->name;
                $p['brand'] = $r->brand;
                $p['description'] = $r->description;
                $p['updated_at'] = now()->toDateTimeString();
                break;
            }
        }
        $this->saveData($this->file, $data);
        return redirect('/')->with('success', 'Updated.');
    }

    public function destroy($id)
    {
        $data = $this->getData($this->file);
        $item = collect($data)->firstWhere('id', $id);
        if ($item && !empty($item['image'])) Storage::disk('public')->delete($item['image']);
        $filtered = array_filter($data, fn($p) => $p['id'] != $id);
        $this->saveData($this->file, $filtered);
        return redirect('/')->with('success', 'Removed.');
    }

    /* ===========================
        TRAINING MANAGEMENT (CRUD)
    =========================== */

    public function createTraining()
    {
        return view('parfum.create_training'); // Pastikan buat file view ini
    }

    public function storeTraining(Request $r)
    {
        $r->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string',
            'date' => 'required|string',
            'image' => 'required|image|max:2048'
        ]);

        $trainings = $this->getData($this->trainingFile);
        $img = $r->file('image')->store('training', 'public');

        $trainings[] = [
            "id" => time(),
            "title" => $r->title,
            "location" => $r->location,
            "date" => $r->date,
            "image" => $img,
            "created_at" => now()->toDateTimeString()
        ];

        $this->saveData($this->trainingFile, $trainings);
        return redirect('/')->with('success', 'Training activity recorded.');
    }

    public function destroyTraining($id)
    {
        $trainings = $this->getData($this->trainingFile);
        $item = collect($trainings)->firstWhere('id', $id);
        if ($item && !empty($item['image'])) Storage::disk('public')->delete($item['image']);
        $filtered = array_filter($trainings, fn($t) => $t['id'] != $id);
        $this->saveData($this->trainingFile, $filtered);
        return redirect('/')->with('success', 'Training removed.');
    }
}