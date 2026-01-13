<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGK Essential Oil</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { letter-spacing: 0.01em; overflow-x: hidden; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .nav-link-active { color: #C9A14A; font-weight: 600; border-right: 3px solid #C9A14A; }
        .hero-gradient { background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%); }
        
        /* Sidebar Logic */
        #sidebar { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-closed #sidebar { transform: translateX(-100%); }
        
        /* Main Content Logic */
        #main-content { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); width: 100%; }
        .sidebar-open #main-content { padding-left: 18rem; }
        .sidebar-closed #main-content { padding-left: 0; }

        /* Container Utama - Menengahkan konten agar seimbang */
        .container-center {
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        #floating-trigger { transition: all 0.3s ease; opacity: 0; pointer-events: none; }
        .sidebar-closed #floating-trigger { opacity: 1; pointer-events: auto; }

        /* Slider */
        .slider-container { overflow: hidden; position: relative; width: 100%; }
        .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
        .slide-item { min-width: 100%; flex-shrink: 0; }

        .dot-indicator { 
            width: 8px; height: 8px; border-radius: 99px; 
            background: rgba(255,255,255,0.3); transition: all 0.5s ease;
        }
        .dot-indicator.active { width: 32px; background: #C9A14A; }

        #archive-section, #training-section, #collection { scroll-margin-top: 100px; }

        /* Sponsor Animation - Colorful */
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .sponsor-track { display: flex; width: max-content; animation: scroll 35s linear infinite; }
        .sponsor-track:hover { animation-play-state: paused; }
        .sponsor-item { width: 220px; display: flex; align-items: center; justify-content: center; padding: 0 40px; }
        .sponsor-item img { max-height: 55px; filter: none; opacity: 1; transition: all 0.5s ease; object-fit: contain; }
    </style>
</head>

<body class="bg-[#F8F8F8] text-[#1A1A1A] font-[Inter] antialiased sidebar-closed">

    <button id="floating-trigger" onclick="toggleSidebar()" class="fixed top-8 left-8 z-[100] bg-white border border-gray-200 p-3 shadow-md hover:text-[#C9A14A] transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" /></svg>
    </button>

    <div class="flex min-h-screen">
        <aside id="sidebar" class="w-72 border-r border-gray-200 py-10 flex flex-col bg-white fixed h-screen top-0 left-0 z-[90]">
            <div class="px-10 flex justify-end mb-4">
                <button onclick="toggleSidebar()" class="text-gray-400 hover:text-black transition-transform hover:rotate-90 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" /></svg>
                </button>
            </div>
            <div class="px-12 mb-16">
                <div class="pt-6 border-t border-gray-100">
                    <h1 class="text-3xl tracking-[0.5em] font-bold text-black uppercase leading-none">A<span class="text-[#C9A14A]">G</span>K</h1>
                    <p class="text-[9px] tracking-[0.3em] text-gray-400 uppercase mt-3 font-medium">Essential Oil</p>
                </div>
            </div>
            <nav class="flex-1 text-[11px] uppercase tracking-[0.2em]">
                <a href="/" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors {{ request()->is('/') ? 'nav-link-active' : 'text-gray-400' }}">Gallery</a>
                <a href="#training-section" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">Training & Activity</a>
                <a href="#archive-section" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">Products</a>
                
                @auth
                <div class="mt-4 pt-4 border-t border-gray-50">
                    <p class="px-12 pb-2 text-[8px] text-gray-400 font-bold tracking-widest">MASTER PANEL</p>
                    <a href="/create" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">Add Product</a>
                    <a href="/training/create" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">Add Training</a>
                    <form method="POST" action="{{ route('logout') }}" class="px-12 py-4">@csrf<button type="submit" class="text-red-400 hover:text-red-600 transition-colors uppercase tracking-[0.2em]">Logout</button></form>
                </div>
                @else
                <a href="/login" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">Staff Login</a>
                @endauth
            </nav>
        </aside>

        <main id="main-content" class="flex-1">
            <section class="relative w-full h-[85vh] bg-black overflow-hidden">
                <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&q=80&w=2000" class="absolute inset-0 w-full h-full object-cover opacity-70">
                <div class="absolute inset-0 hero-gradient"></div>
                <div class="relative h-full flex flex-col items-center justify-center text-center px-6">
                    <div class="flex items-center space-x-4 mb-8">
                        <span class="text-white text-xs tracking-[0.6em] uppercase opacity-80">BDI Denpasar</span>
                        <span class="text-[#C9A14A] text-xl">×</span>
                        <span class="text-[#C9A14A] text-xs tracking-[0.6em] uppercase font-bold">Arogya Gandha Kendra</span>
                    </div>
                    <h2 class="text-white text-7xl md:text-8xl font-serif italic mb-10 leading-tight">Essential <br> <span class="text-[#C9A14A] not-italic font-bold tracking-tighter">Oil</span></h2>
                    <a href="#collection" class="group relative overflow-hidden border border-white/30 text-white px-12 py-4 text-[10px] uppercase tracking-[0.5em] hover:text-black transition duration-500">
                        <span class="relative z-10">Explore Vault</span>
                        <div class="absolute inset-0 bg-white translate-y-[101%] group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                </div>
            </section>

            <div class="container-center py-24">
                
                <section id="collection" class="flex flex-col lg:flex-row items-stretch bg-white border border-gray-100 shadow-sm mb-32 overflow-hidden">
                    <div class="w-full lg:w-1/2 flex flex-col justify-center p-12 lg:p-20">
                        <h3 class="font-serif text-3xl font-bold mb-6 italic">BDI Denpasar x AGK</h3>
                        <p class="text-gray-500 font-light text-lg mb-12 leading-relaxed italic">"The scent of luxury and celebration. Curated exclusively at Balai Diklat Industri Denpasar for the modern connoisseur."</p>
                        <div>
                            <a href="#training-section" class="relative inline-flex items-center group overflow-hidden px-10 py-4 border border-black hover:border-[#C9A14A] transition-colors duration-500">
                                <span class="relative z-10 text-[11px] font-bold uppercase tracking-[0.4em] text-black group-hover:text-white transition-colors duration-500">Learn More</span>
                                <div class="absolute inset-0 bg-[#C9A14A] translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 h-4 w-4 ml-3 group-hover:text-white transition-all duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 relative min-h-[400px] bg-[#0B3D2E]">
                        <img src="https://images.unsplash.com/photo-1583522862616-c7c406a05389?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover mix-blend-overlay opacity-90">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="text-white/10 text-6xl lg:text-[8rem] font-serif italic rotate-[-15deg]">Luxury</span>
                        </div>
                    </div>
                </section>

                <section id="training-section" class="mb-32">
                    <header class="mb-12 flex justify-between items-end">
                        <div>
                            <p class="text-[11px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold mb-4">Hands-on Experience</p>
                            <h2 class="text-5xl lg:text-6xl font-serif text-gray-900 leading-tight">Training & <span class="font-normal">Activity</span></h2>
                        </div>
                        <div class="hidden md:flex space-x-2">
                            <button onclick="prevSlide()" class="p-4 border border-gray-200 hover:bg-black hover:text-white transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7" stroke-width="2"/></svg></button>
                            <button onclick="nextSlide()" class="p-4 border border-gray-200 hover:bg-black hover:text-white transition-all duration-300"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg></button>
                        </div>
                    </header>
                    <div class="slider-container group h-[450px] shadow-2xl relative overflow-hidden bg-stone-900">
                        <div class="slider-wrapper h-full" id="trainingSlider">
                            @forelse($trainings as $index => $t)
                            <div class="slide-item h-full relative">
                                <img src="{{ asset('storage/'.$t['image']) }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/20 to-transparent"></div>
                                <div class="absolute inset-0 z-20 flex flex-col justify-center p-8 md:p-20">
                                    <div class="max-w-2xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-700">
                                        <span class="text-[#C9A14A] text-[10px] tracking-[0.5em] uppercase font-bold mb-4 block">{{ $t['location'] }} — {{ $t['date'] }}</span>
                                        <h4 class="text-white text-4xl md:text-5xl font-serif italic mb-8 leading-tight">{{ $t['title'] }}</h4>
                                        
                                        @auth
                                        <div class="flex space-x-6">
                                            <a href="/training/edit/{{$t['id']}}" class="text-white/70 hover:text-[#C9A14A] text-[10px] uppercase tracking-widest underline underline-offset-8 transition">Edit</a>
                                            <form action="/training/delete/{{$t['id']}}" method="POST" onsubmit="return confirm('Delete record?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400/70 hover:text-red-400 text-[10px] uppercase tracking-widest underline underline-offset-8 transition">Delete</button>
                                            </form>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="slide-item h-full w-full flex items-center justify-center"><p class="text-gray-500 font-serif italic">No Activity Recorded.</p></div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <hr class="border-gray-200 mb-32">

                <div id="archive-section">
                    <header class="mb-20 flex flex-col md:flex-row justify-between items-start md:items-end gap-10">
                        <div class="flex-1">
                            <p class="text-[11px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold mb-4">Balai Diklat Industri Denpasar</p>
                            <h2 class="text-5xl lg:text-6xl font-serif text-gray-900 leading-tight">Oil <span class=" font-normal">Products</span></h2>
                        </div>
                        <div class="w-full md:w-80">
                            <form action="/#archive-section" method="GET" class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Find products..." class="w-full bg-transparent border-b border-gray-200 py-3 pr-10 text-sm focus:outline-none focus:border-[#C9A14A] transition-all">
                                <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#C9A14A] transition-colors"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="1.5"/></svg></button>
                            </form>
                        </div>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-10 gap-y-20">
                        @forelse($parfums as $p)
                        <div class="group bg-white p-4 border border-transparent hover:border-gray-100 hover:shadow-2xl transition-all duration-700 flex flex-col items-center text-center">
                            <div class="relative overflow-hidden bg-[#FBFBFB] mb-8 aspect-square w-full flex items-center justify-center">
                                <img src="{{ asset('storage/'.$p['image']) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-[1.5s]">
                                <div class="absolute inset-0 bg-white/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500 backdrop-blur-[2px] flex items-center justify-center">
                                    <a href="/parfum/{{$p['id']}}" class="bg-black text-white px-8 py-3 text-[10px] uppercase tracking-[0.3em] font-bold hover:bg-[#C9A14A] transition-all transform translate-y-8 group-hover:translate-y-0">View Detail</a>
                                </div>
                            </div>
                            <div class="space-y-3 w-full">
                                <p class="text-[9px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold">{{ $p['brand'] }}</p>
                                <h3 class="text-xl font-serif text-gray-800 leading-tight">{{ $p['name'] }}</h3>
                                <div class="w-8 h-[1px] bg-gray-200 mx-auto my-4"></div>
                                <p class="text-[13px] text-gray-400 leading-relaxed line-clamp-2 px-4">"{{ $p['description'] }}"</p>
                                
                                @auth
                                <div class="flex justify-center items-center space-x-6 pt-6 border-t border-gray-50 mt-4">
                                    <a href="/edit/{{$p['id']}}" class="text-[10px] font-bold uppercase tracking-widest text-gray-600 hover:text-[#C9A14A] transition">Edit</a>
                                    <form action="/delete/{{$p['id']}}" method="POST" onsubmit="return confirm('Archive product?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-[10px] font-bold uppercase tracking-widest text-red-400 hover:text-red-600 transition">Delete</button>
                                    </form>
                                </div>
                                @endauth
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-40 text-center text-gray-400 italic font-serif">Empty Vault.</div>
                        @endforelse
                    </div>
                </div>
            </div> 

            <footer class="bg-white border-t border-gray-100">
                <div class="py-14 border-b border-gray-50 bg-[#FBFBFB]/50 overflow-hidden relative">
                    <div class="sponsor-track">
                       <div class="sponsor-item"><img src="{{ asset('logo mitra/3.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/4.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/5.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/6.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/7.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/8.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/9.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/10.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/11.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/12.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/1.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/2.png') }}"></div>

<div class="sponsor-item"><img src="{{ asset('logo mitra/3.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/4.png') }}"></div>
<div class="sponsor-item"><img src="{{ asset('logo mitra/5.png') }}"></div>
                    </div>
                </div>

                <div class="container-center py-16 grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="md:col-span-2 space-y-6">
                        <h1 class="text-3xl font-bold uppercase tracking-[0.4em]">A<span class="text-[#C9A14A]">G</span>K</h1>
                        <p class="text-[12px] text-gray-400 italic leading-relaxed max-w-sm">"Essence of the archipelago. Collaboration between BDI Denpasar and Arogya Gandha Kendra."</p>
                    </div>
                    <div class="text-[10px] tracking-[0.2em] text-gray-500 uppercase">
                        <p class="font-bold text-black border-b border-gray-100 pb-2 mb-4">Navigation</p>
                        <ul class="space-y-3">
                            <li><a href="/" class="hover:text-[#C9A14A]">Gallery</a></li>
                            <li><a href="#archive-section" class="hover:text-[#C9A14A]">Products</a></li>
                            <li><a href="#training-section" class="hover:text-[#C9A14A]">Training</a></li>
                        </ul>
                    </div>
                    <div class="text-[10px] tracking-[0.2em] text-gray-500 uppercase">
                        <p class="font-bold text-black border-b border-gray-100 pb-2 mb-4">Location</p>
                        <p>BDI Denpasar<br>Bali, Indonesia<br>Est. 2026</p>
                    </div>
                </div>

                <div class="py-10 bg-[#1A1A1A] text-center">
                    <p class="text-[9px] tracking-[0.5em] text-gray-500 uppercase">&copy; 2026m AGK x BDI Denpasar &bull; All Rights Reserved</p>
                </div>
            </footer>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const body = document.body;
            body.classList.toggle('sidebar-closed');
            body.classList.toggle('sidebar-open');
        }

        const slider = document.getElementById('trainingSlider');
        const slides = document.querySelectorAll('.slide-item');
        let currentIndex = 0;

        function updateSlider() {
            if(!slider || slides.length === 0) return;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function nextSlide() { currentIndex = (currentIndex + 1) % slides.length; updateSlider(); }
        function prevSlide() { currentIndex = (currentIndex - 1 + slides.length) % slides.length; updateSlider(); }

        window.addEventListener('load', () => {
            document.body.classList.add('sidebar-closed');
            if(slides.length > 0) setInterval(nextSlide, 6000);
        });
    </script>
</body>
</html>