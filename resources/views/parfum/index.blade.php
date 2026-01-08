<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARFUMVAULT — Mine. x Bibit Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { letter-spacing: 0.01em; overflow-x: hidden; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .nav-link-active { color: #C9A14A; font-weight: 600; border-right: 3px solid #C9A14A; }
        .hero-gradient { background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 100%); }
        
        /* Sidebar Transitions */
        #sidebar { 
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .sidebar-closed #sidebar { 
            transform: translateX(-100%); 
        }
        #main-content { 
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); 
        }
        .sidebar-closed #main-content { 
            margin-left: 0; 
        }

        /* Float Button Logic */
        #floating-trigger { transition: all 0.3s ease; opacity: 0; pointer-events: none; }
        .sidebar-closed #floating-trigger { opacity: 1; pointer-events: auto; }

        /* Slider Logic */
        .slider-container { overflow: hidden; position: relative; width: 100%; }
        .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
        .slide-item { min-width: 100%; flex-shrink: 0; }

        /* Utility for anchor scroll offset */
        #archive-section { scroll-margin-top: 100px; }
        #training-section { scroll-margin-top: 100px; }
        #collection { scroll-margin-top: 50px; }
    </style>
</head>

<body class="bg-[#F8F8F8] text-[#1A1A1A] font-[Inter] antialiased sidebar-open">

    <button id="floating-trigger" onclick="toggleSidebar()" class="fixed top-8 left-8 z-[100] bg-white border border-gray-200 p-3 shadow-md hover:text-[#C9A14A] transition-all duration-300 group">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex min-h-screen">

        <aside id="sidebar" class="w-72 border-r border-gray-200 py-10 flex flex-col bg-white fixed h-screen top-0 left-0 z-[90]">
            
            <div class="px-10 flex justify-end mb-4">
                <button onclick="toggleSidebar()" class="text-gray-400 hover:text-black transition-transform hover:rotate-90 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <div class="px-12 mb-16">
                <div class="pt-6 border-t border-gray-100">
                    <h1 class="text-3xl tracking-[0.5em] font-bold text-black uppercase leading-none">
                        A<span class="text-[#C9A14A]">G</span>K
                    </h1>
                    <p class="text-[9px] tracking-[0.3em] text-gray-400 uppercase mt-3 font-medium">Essential Oil</p>
                </div>
            </div>

            <nav class="flex-1 text-[11px] uppercase tracking-[0.2em]">
                <a href="/" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors {{ request()->is('/') ? 'nav-link-active' : 'text-gray-400' }}">
                    Gallery
                </a>

                <a href="#training-section" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">
                    Training & Activity
                </a>
                
                @auth
                <div class="mt-4 pt-4 border-t border-gray-50">
                    <p class="px-12 pb-2 text-[8px] text-gray-400 font-bold tracking-widest">MASTER PANEL</p>
                    <a href="/create" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors {{ request()->is('create') ? 'nav-link-active' : 'text-gray-400' }}">
                        Add Product
                    </a>
                    <a href="/training/create" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors {{ request()->is('training/create') ? 'nav-link-active' : 'text-gray-400' }}">
                        Add Training
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="px-12 py-4">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors uppercase tracking-[0.2em]">
                            Logout
                        </button>
                    </form>
                </div>
                @else
                <a href="/login" class="flex items-center px-12 py-4 hover:text-[#C9A14A] transition-colors text-gray-400">
                    Staff Login
                </a>
                @endauth
            </nav>

            <div class="px-12 pt-10 border-t border-gray-100">
                <p class="text-[9px] tracking-[0.3em] text-gray-400 uppercase font-medium">
                    ESSENTIAL OIL
                </p>
                <p class="text-[8px] tracking-[0.1em] text-gray-300 mt-2 italic">
                    © 2026 AGK Studio
                </p>
            </div>
        </aside>

        <main id="main-content" class="flex-1 ml-72">

            <section class="relative w-full h-[85vh] bg-black overflow-hidden">
                <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&q=80&w=2000" 
                     class="absolute inset-0 w-full h-full object-cover opacity-70 grayscale-[20%]">
                
                <div class="absolute inset-0 hero-gradient"></div>

                <div class="relative h-full flex flex-col items-center justify-center text-center px-6">
                    <div class="flex items-center space-x-4 mb-8">
                        <span class="text-white text-xs tracking-[0.6em] uppercase opacity-80">BDI Denpasar</span>
                        <span class="text-[#C9A14A] text-xl">×</span>
                        <span class="text-[#C9A14A] text-xs tracking-[0.6em] uppercase font-bold">Arogya Gandha Kendra</span>
                    </div>
                    
                    <h2 class="text-white text-7xl md:text-8xl font-serif italic mb-10 leading-tight drop-shadow-2xl">
                        Essential <br> <span class="text-[#C9A14A] not-italic font-bold tracking-tighter">Oil</span>
                    </h2>

                    <a href="#collection" class="group relative overflow-hidden border border-white/30 text-white px-12 py-4 text-[10px] uppercase tracking-[0.5em] hover:text-black transition duration-500">
                        <span class="relative z-10">Explore Vault</span>
                        <div class="absolute inset-0 bg-white translate-y-[101%] group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                </div>
            </section>

            <div class="px-8 lg:px-24 py-20">
                
                <section id="collection" class="flex flex-col lg:flex-row items-stretch bg-white border border-gray-100 shadow-sm mb-32 overflow-hidden">
                    <div class="w-full lg:w-1/2 flex flex-col justify-center p-12 lg:p-24">
                        <h3 class="font-serif text-3xl font-bold mb-6 italic">Mine. x AGK Special Collections</h3>
                        <p class="text-gray-500 font-light text-lg mb-12 leading-relaxed italic">
                            "The scent of luxury and celebration. Curated exclusively at Balai Diklat Industri Denpasar for the modern connoisseur."
                        </p>
                        
                        <div>
                            <a href="#archive-section" class="relative inline-flex items-center group overflow-hidden px-10 py-4 border border-black hover:border-[#C9A14A] transition-colors duration-500">
                                <span class="relative z-10 text-[11px] font-bold uppercase tracking-[0.4em] text-black group-hover:text-white transition-colors duration-500">
                                    Learn More
                                </span>
                                <div class="absolute inset-0 bg-[#C9A14A] translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 h-4 w-4 ml-3 transform group-hover:translate-x-2 group-hover:text-white transition-all duration-500 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/2 relative min-h-[400px] lg:min-h-[500px] bg-[#0B3D2E]">
                        <img src="https://images.unsplash.com/photo-1583522862616-c7c406a05389?auto=format&fit=crop&q=80&w=1000" 
                             class="w-full h-full object-cover mix-blend-overlay opacity-90">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="text-white/10 text-6xl lg:text-[12rem] font-serif italic rotate-[-15deg]">Luxury</span>
                        </div>
                    </div>
                </section>

                <section id="training-section" class="mb-32">
                    <header class="mb-16 flex justify-between items-end">
                        <div>
                            <p class="text-[11px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold mb-4">Hands-on Experience</p>
                            <h2 class="text-5xl lg:text-6xl font-serif text-gray-900 leading-tight">Training & <span class="italic font-normal">Activity</span></h2>
                        </div>
                        <div class="hidden md:flex space-x-2">
                            <button onclick="prevSlide()" class="p-4 border border-gray-200 hover:bg-black hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 19l-7-7 7-7" stroke-width="2"/></svg>
                            </button>
                            <button onclick="nextSlide()" class="p-4 border border-gray-200 hover:bg-black hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg>
                            </button>
                        </div>
                    </header>

                    <div class="slider-container group">
                        <div class="slider-wrapper" id="trainingSlider">
                            @forelse($trainings as $t)
                            <div class="slide-item px-2">
                                <div class="relative overflow-hidden aspect-[21/9] bg-gray-100 border border-gray-100 group">
                                    <img src="{{ asset('storage/'.$t->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-1000">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex flex-col justify-end p-12">
                                        <div class="max-w-2xl">
                                            <h4 class="text-white text-3xl font-serif italic mb-3">{{ $t->title }}</h4>
                                            <div class="flex items-center space-x-6">
                                                <p class="text-[#C9A14A] text-xs tracking-[0.3em] uppercase font-bold">{{ $t->location }} • {{ $t->date }}</p>
                                                @auth
                                                <div class="flex space-x-4 border-l border-white/20 pl-6">
                                                    <a href="/training/edit/{{$t->id}}" class="text-white/50 hover:text-white text-[10px] uppercase tracking-widest underline">Edit</a>
                                                    <form action="/training/delete/{{$t->id}}" method="POST" onsubmit="return confirm('Delete record?')">
                                                        @csrf @method('DELETE')
                                                        <button class="text-red-400/70 hover:text-red-400 text-[10px] uppercase tracking-widest underline">Remove</button>
                                                    </form>
                                                </div>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="slide-item px-2">
                                <div class="relative overflow-hidden aspect-[21/9] bg-gray-900 flex items-center justify-center">
                                    <p class="text-gray-500 font-serif italic">The activity archive is currently being updated.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <hr class="border-gray-200 mb-32">

                <div id="archive-section">
                    <header class="mb-20 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                        <div>
                            <p class="text-[11px] tracking-[0.4em] text-[#C9A14A] uppercase font-bold mb-4">Balai Diklat Industri Denpasar</p>
                            <h2 class="text-5xl lg:text-6xl font-serif text-gray-900 leading-tight">Editorial <span class="italic font-normal">Archive</span></h2>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] tracking-[0.2em] text-gray-400 uppercase tabular-nums">
                                {{ date('F d, Y') }}
                            </p>
                        </div>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-10 gap-y-24">
                        @forelse($parfums as $p)
                        <div class="group">
                            <div class="relative overflow-hidden bg-gray-100 mb-8 aspect-[3/4]">
                                @if($p['image'])
                                    <img src="{{ asset('storage/'.$p['image']) }}" 
                                         class="h-full w-full object-cover grayscale-[30%] group-hover:grayscale-0 group-hover:scale-105 transition duration-[1.2s] ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 uppercase tracking-widest text-[10px] font-serif italic">No Visual</div>
                                @endif
                                
                                <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                                    <a href="/parfum/{{$p['id']}}" class="bg-white text-black px-8 py-3 text-[10px] uppercase tracking-[0.3em] font-bold hover:bg-[#C9A14A] hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500">
                                        View Detail
                                    </a>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <p class="text-[10px] tracking-[0.3em] text-[#C9A14A] uppercase font-bold">{{ $p['brand'] }}</p>
                                <h3 class="text-2xl font-serif italic group-hover:text-[#C9A14A] transition-colors leading-tight">{{ $p['name'] }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed font-light line-clamp-2 italic">"{{ $p['description'] }}"</p>
                                <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                                    <div class="flex space-x-6 text-[10px] tracking-[0.15em] uppercase font-bold">
                                        @auth
                                            <a href="/edit/{{$p['id']}}" class="text-gray-900 hover:text-[#C9A14A] transition">Edit</a>
                                            <a href="/delete/{{$p['id']}}" class="text-gray-300 hover:text-red-600 transition" onclick="return confirm('Archive this product?')">Delete</a>
                                        @else
                                            <span class="text-gray-300 font-normal italic">Editorial Entry</span>
                                        @endauth
                                    </div>
                                    <span class="text-[9px] text-gray-300 font-medium tracking-tighter uppercase">Vault-{{ substr($p['id'], -4) }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-40 text-center border-2 border-dashed border-gray-200 bg-white">
                            <p class="text-gray-400 tracking-[0.2em] uppercase text-xs font-serif italic">The vault is currently empty.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // SIDEBAR LOGIC
        function toggleSidebar() {
            const body = document.body;
            body.classList.toggle('sidebar-closed');
            body.classList.toggle('sidebar-open');
        }

        // CAROUSEL LOGIC
        const slider = document.getElementById('trainingSlider');
        const slides = document.querySelectorAll('.slide-item');
        let currentIndex = 0;
        let slideInterval;

        function updateSlider() {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlider();
        }

        // Auto play
        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 5000); // 5 Detik
        }

        function stopAutoSlide() {
            clearInterval(slideInterval);
        }

        // Event listeners for pause on hover
        const sliderContainer = document.querySelector('.slider-container');
        sliderContainer.addEventListener('mouseenter', stopAutoSlide);
        sliderContainer.addEventListener('mouseleave', startAutoSlide);

        // Initialize
        window.addEventListener('load', () => {
            if (window.innerWidth < 1024) {
                document.body.classList.add('sidebar-closed');
                document.body.classList.remove('sidebar-open');
            }
            if(slides.length > 0) startAutoSlide();
        });
    </script>

</body>
</html>