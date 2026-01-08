<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fragrance — PARFUMVAULT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { letter-spacing: 0.01em; }
        .input-focus-effect { transition: all 0.3s ease; border-color: #E5E7EB; }
        .input-focus-effect:focus { border-color: #C9A14A; }
        /* Menambahkan smooth scroll agar transisi ke anchor produk lebih halus */
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-white text-[#1A1A1A] font-[Inter] antialiased">

<div class="min-h-screen flex">

    <aside class="w-72 border-r border-gray-100 px-12 py-16 flex flex-col bg-white sticky h-screen top-0">
        <h1 class="text-xl tracking-[0.4em] font-semibold mb-24">
            PARFUM<span class="text-[#C9A14A]">VAULT</span>
        </h1>

        <nav class="space-y-10 text-[11px] uppercase tracking-[0.2em]">
            <a href="/" class="block text-gray-400 hover:text-[#C9A14A] transition-colors">Dashboard</a>
            
            <a href="/#products" class="block text-gray-400 hover:text-[#C9A14A] transition-colors">Products</a>
            
            <a href="/create" class="block text-gray-400 hover:text-[#C9A14A] transition-colors">Add Product</a>
            <div class="pt-4 border-t border-gray-50">
                <span class="text-[#C9A14A] font-semibold">Editing Mode</span>
            </div>
        </nav>
    </aside>

    <main class="flex-1 px-20 py-16 bg-[#FAFAFA]">
        
        <header class="mb-16">
            <p class="text-[11px] tracking-[0.3em] text-[#C9A14A] uppercase font-semibold mb-3">Editorial Adjustment</p>
            <h2 class="text-5xl font-light tracking-tight text-gray-900 leading-tight">
                Modify <span class="italic font-normal">{{ $parfum['name'] }}</span>
            </h2>
        </header>

        <form action="{{ route('parfum.update', $parfum['id']) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="grid grid-cols-12 gap-16">
            
            @csrf
            @method('PUT') {{-- Mendukung route PUT di web.php --}}

            <div class="col-span-7 space-y-12">
                
                <div class="bg-white p-10 border border-gray-100 shadow-sm space-y-10">
                    <div class="grid grid-cols-2 gap-10">
                        <div>
                            <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $parfum['brand']) }}"
                                   class="w-full border-b border-gray-100 py-3 text-lg focus:outline-none input-focus-effect">
                        </div>
                        <div>
                            <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $parfum['name']) }}"
                                   class="w-full border-b border-gray-100 py-3 text-lg focus:outline-none input-focus-effect">
                        </div>
                    </div>

                    {{-- Bagian Price Telah Dihapus --}}

                    <div>
                        <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Description</label>
                        <textarea name="description" rows="6" 
                                  class="w-full border border-gray-100 p-4 text-sm leading-relaxed focus:outline-none focus:border-[#C9A14A] resize-none">{{ old('description', $parfum['description']) }}</textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-6">
                    <a href="/" class="text-[10px] tracking-[0.2em] uppercase text-gray-400 hover:text-black transition">
                        Cancel Changes
                    </a>
                    <button type="submit" 
                            class="bg-[#1A1A1A] text-white px-12 py-5 text-[11px] tracking-[0.3em] uppercase hover:bg-[#C9A14A] transition-all duration-500 shadow-lg">
                        Update Database
                    </button>
                </div>
            </div>

            <div class="col-span-5 space-y-8">
                <div class="bg-white border border-gray-100 p-4 shadow-sm relative group">
                    <p class="absolute top-8 left-8 z-10 text-[9px] tracking-[0.3em] text-white bg-black/50 px-3 py-1 uppercase backdrop-blur-md">Current Visual</p>
                    
                    <div class="aspect-[3/4] overflow-hidden bg-gray-50">
                        <img id="image-preview" 
                             src="{{ asset('storage/'.$parfum['image']) }}" 
                             class="w-full h-full object-cover transition duration-700">
                    </div>
                </div>

                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-4 text-center">Replace Editorial Image</label>
                    <label class="flex items-center justify-center border border-dashed border-gray-300 py-10 px-4 cursor-pointer hover:bg-white hover:border-[#C9A14A] transition-all">
                        <span id="file-name" class="text-[10px] tracking-widest text-gray-400 uppercase">Click to upload new file</span>
                        <input type="file" name="image" class="hidden" onchange="updatePreview(this)">
                    </label>
                    <p class="text-[9px] text-gray-400 italic mt-3 text-center">Leave empty to keep existing image</p>
                </div>
            </div>

        </form>
    </main>
</div>

<script>
    function updatePreview(input) {
        const preview = document.getElementById('image-preview');
        const fileName = document.getElementById('file-name');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            fileName.innerText = input.files[0].name;
            fileName.classList.add('text-[#C9A14A]');

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.add('scale-105');
                setTimeout(() => preview.classList.remove('scale-105'), 500);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>