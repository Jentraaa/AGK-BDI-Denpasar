<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Fragrance — PARFUMVAULT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { letter-spacing: 0.01em; }
        .input-focus-effect { transition: all 0.3s ease; border-color: #E5E7EB; }
        .input-focus-effect:focus { border-color: #C9A14A; }
    </style>
</head>

<body class="bg-white text-[#1A1A1A] font-[Inter] antialiased">

<div class="min-h-screen flex">

    <aside class="hidden lg:flex w-72 border-r border-gray-100 px-12 py-16 flex-col bg-white sticky h-screen top-0">
        <h1 class="text-xl tracking-[0.4em] font-semibold mb-24">
            PARFUM<span class="text-[#C9A14A]">VAULT</span>
        </h1>

        <nav class="space-y-10 text-[11px] uppercase tracking-[0.2em]">
            <a href="/" class="block text-gray-400 hover:text-[#C9A14A] transition-colors">Dashboard</a>
            <a href="/#products" class="block text-gray-400 hover:text-[#C9A14A] transition-colors">Products</a>
            <a href="/create" class="block text-[#C9A14A] font-semibold tracking-[0.3em]">Add Product</a>
        </nav>
    </aside>

    <div class="w-full lg:flex-1 px-12 lg:px-24 py-16 flex flex-col justify-center bg-white">
        
        <div class="mb-12">
            <a href="/" class="text-[10px] tracking-[0.3em] text-gray-400 hover:text-[#C9A14A] transition-colors uppercase block mb-8">
                ← Back to Dashboard
            </a>
            <p class="text-[11px] tracking-[0.3em] text-[#C9A14A] uppercase font-semibold mb-3">Inventory Entry</p>
            <h1 class="text-5xl font-light tracking-tight">New <span class="italic font-normal">Fragrance</span></h1>
        </div>

        @if ($errors->any())
        <div class="mb-8 p-4 bg-red-50 text-red-600 text-[11px] tracking-widest uppercase italic">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="/store" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <div class="grid grid-cols-2 gap-10">
                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Brand Name</label>
                    <input name="brand" value="{{ old('brand') }}" required autocomplete="off"
                           class="w-full border-b border-gray-200 py-3 text-lg focus:outline-none input-focus-effect focus:border-[#C9A14A] placeholder-gray-200"
                           placeholder="e.g. BYREDO">
                </div>
                <div class="relative">
                    <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Fragrance Name</label>
                    <input name="name" value="{{ old('name') }}" required autocomplete="off"
                           class="w-full border-b border-gray-200 py-3 text-lg focus:outline-none input-focus-effect focus:border-[#C9A14A] placeholder-gray-200"
                           placeholder="e.g. MOJAVE GHOST">
                </div>
            </div>

            {{-- Slot Price telah dihapus agar tampilan lebih bersih --}}

            <div>
                <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-2">Olfactory Description</label>
                <textarea name="description" rows="3" required
                          class="w-full border-b border-gray-200 py-3 text-lg focus:outline-none input-focus-effect focus:border-[#C9A14A] resize-none leading-relaxed">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-4">Bottle Visual</label>
                <div class="flex items-center space-x-4">
                    <label class="flex-1 border-2 border-dashed border-gray-100 px-6 py-10 text-center cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="text-[10px] tracking-widest text-gray-400 uppercase" id="file-label">Select File</span>
                        <input type="file" name="image" id="image-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </label>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit"
                        class="bg-[#1A1A1A] text-white px-16 py-5 text-[11px] tracking-[0.3em] hover:bg-[#C9A14A] transition-all duration-500 uppercase">
                    Register Fragrance
                </button>
            </div>
        </form>
    </div>

    <div class="hidden lg:flex w-1/3 bg-[#F8F8F8] items-center justify-center relative overflow-hidden border-l border-gray-100">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none">
            <h1 class="text-[20rem] font-bold">VAULT</h1>
        </div>

        <div id="preview-container" class="relative z-10 w-3/5 h-4/5 flex flex-col items-center justify-center border border-gray-100 bg-white shadow-2xl p-4 transition-all duration-1000">
            <img id="image-preview" src="#" class="hidden w-full h-full object-cover grayscale-[30%] hover:grayscale-0 transition-all duration-700">
            <div id="preview-placeholder" class="text-center p-10">
                <p class="text-[10px] tracking-[0.4em] text-gray-300 uppercase">Awaiting Visual</p>
                <p class="mt-4 text-[9px] text-gray-400 italic font-light">The preview of the editorial image will appear here after selection.</p>
            </div>
        </div>
    </div>

</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('preview-container');
        const placeholder = document.getElementById('preview-placeholder');
        const label = document.getElementById('file-label');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            label.innerText = input.files[0].name;

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>