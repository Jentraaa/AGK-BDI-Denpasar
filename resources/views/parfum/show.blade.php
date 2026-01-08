<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $parfum['name'] }} — PARFUMVAULT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { letter-spacing: 0.01em; }
        .fade-in {
            animation: fadeIn 1.2s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-white text-[#1A1A1A] font-[Inter] antialiased">

<div class="min-h-screen flex flex-col lg:flex-row">

    <div class="w-full lg:w-1/2 h-[50vh] lg:h-screen bg-[#F8F8F8] sticky top-0 overflow-hidden">
        <a href="/" class="absolute top-10 left-10 z-20 text-[10px] tracking-[0.3em] text-white mix-blend-difference hover:text-[#C9A14A] transition-colors uppercase font-medium">
            ← Back to Gallery
        </a>
        
        @if($parfum['image'])
            <img src="{{ asset('storage/'.$parfum['image']) }}" 
                 class="w-full h-full object-cover grayscale-[10%] hover:grayscale-0 transition duration-1000">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300 uppercase tracking-widest text-xs">No Visual Available</div>
        @endif
    </div>

    <div class="w-full lg:w-1/2 px-8 lg:px-24 py-20 flex flex-col justify-center fade-in">
        
        <header class="mb-12">
            <p class="text-[11px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold mb-4">
                {{ $parfum['brand'] }}
            </p>
            <h1 class="text-6xl font-light tracking-tight leading-none mb-6 italic">
                {{ $parfum['name'] }}
            </h1>
            <div class="h-1 w-12 bg-black"></div>
        </header>

        <section class="space-y-10">
            <div>
                <p class="text-[10px] tracking-[0.2em] text-gray-400 uppercase mb-4 font-semibold">About the Scent</p>
                <p class="text-lg leading-relaxed text-gray-600 font-light max-w-lg italic">
                    "{{ $parfum['description'] }}"
                </p>
            </div>

            {{-- Bagian Edit Detail dan Vault ID telah dihapus sepenuhnya untuk estetika --}}
            
            <div class="pt-12 border-t border-gray-50">
                <p class="text-[9px] tracking-[0.3em] text-gray-300 uppercase font-medium">
                    Curated for PARFUMVAULT Editorial
                </p>
            </div>
        </section>

    </div>
</div>

</body>
</html>