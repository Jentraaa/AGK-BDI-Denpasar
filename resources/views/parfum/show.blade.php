<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $parfum['name'] }} — AGK Essential Oil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { letter-spacing: 0.01em; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        .fade-in {
            animation: fadeIn 1.2s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol Back yang diperbagus: Lebih Jelas & Modern */
        .btn-back {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            color: #1a1a1a;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .btn-back:hover {
            background: #1a1a1a;
            color: white;
            transform: translateY(-2px);
        }

        /* Efek Dekorasi Quote */
        .about-quote::before {
            content: '"';
            position: absolute;
            top: -15px;
            left: -10px;
            font-size: 60px;
            color: #C9A14A;
            opacity: 0.15;
            font-family: serif;
        }
    </style>
</head>

<body class="bg-white text-[#1A1A1A] font-[Inter] antialiased">

<div class="min-h-screen flex flex-col lg:flex-row">

    <div class="w-full lg:w-1/2 h-[60vh] lg:h-screen bg-[#FBFBFB] sticky top-0 overflow-hidden flex items-center justify-center p-12 lg:p-20">
        
        <a href="/" class="btn-back absolute top-8 left-8 z-[50] px-5 py-2.5 text-[10px] tracking-[0.3em] transition-all duration-300 uppercase font-bold flex items-center group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Gallery
        </a>
        
        @if($parfum['image'])
            <img src="{{ asset('storage/'.$parfum['image']) }}" 
                 class="w-full h-full object-contain drop-shadow-2xl transition duration-1000 transform hover:scale-105"
                 alt="{{ $parfum['name'] }}">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300 uppercase tracking-widest text-xs">No Visual Available</div>
        @endif
    </div>

    <div class="w-full lg:w-1/2 px-8 lg:px-24 py-20 flex flex-col justify-center bg-white fade-in">
        
        <header class="mb-12">
            <div class="flex items-center space-x-4 mb-4">
                <span class="h-[1px] w-6 bg-[#C9A14A]"></span>
                <p class="text-[14px] tracking-[0.5em] text-[#C9A14A] uppercase font-bold">
                    {{ $parfum['brand'] }}
                </p>
            </div>
            <h1 class="text-4xl lg:text-5xl font-serif font-bold tracking-tight leading-tight mb-6">
                {{ $parfum['name'] }}
            </h1>
            <div class="flex space-x-1">
                <span class="w-10 h-1 bg-black"></span>
                <span class="w-3 h-1 bg-[#C9A14A]"></span>
            </div>
        </header>

        <section class="space-y-12">
            <div class="relative">
                <p class="text-[11px] tracking-[0.3em] text-gray-400 uppercase mb-4 font-bold">
                    01. About the Essence
                </p>
                <div class="about-quote relative">
                    <p class="text-sm lg:text-base leading-relaxed text-gray-600 font-light italic text-justify lg:pr-12">
                        "{{ $parfum['description'] }}"
                    </p>
                </div>
            </div>

            <div>
                <p class="text-[11px] tracking-[0.3em] text-gray-400 uppercase mb-4 font-bold">
                    02. Primary Components
                </p>
                <div class="border-l-2 border-gray-50 pl-6 py-1">
                    <p class="text-base leading-relaxed text-gray-500 font-mono tracking-tight bg-gray-50 p-4 rounded-sm border border-gray-100">
                        {{ $parfum['components'] ?? 'Entry Components.' }}
                    </p>
                </div>
            </div>

            <div class="pt-10 border-t border-gray-100 flex justify-between items-center">
                <div class="space-y-1">
                    <p class="text-[8px] tracking-[0.3em] text-gray-400 uppercase font-medium">
                        Product of Arogya Gandha Kendra
                    </p>
                </div>
                
                @auth
                <a href="/edit/{{ $parfum['id'] }}" class="flex items-center text-[9px] tracking-[0.2em] text-gray-500 hover:text-[#C9A14A] uppercase font-bold transition-all">
                    Edit Entry
                </a>
                @endauth
            </div>
        </section>

    </div>
</div>

</body>
</html>