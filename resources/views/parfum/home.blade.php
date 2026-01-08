<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PARFUMVAULT</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-black font-[Inter]">

<!-- NAVBAR -->
<header class="fixed top-0 left-0 w-full bg-white z-50 shadow-sm">
    <div class="max-w-6xl mx-auto flex justify-between items-center py-6 px-10">

        <a href="/home" class="text-xl font-semibold tracking-widest">
            PARFUMVAULT
        </a>

        <nav class="space-x-8 text-sm uppercase tracking-wider">
            <a href="/home" class="hover:text-[#C9A14A]">Home</a>
            <a href="/" class="hover:text-[#C9A14A]">Collection</a>
            <a href="/about" class="hover:text-[#C9A14A]">About</a>
            <a href="/contact" class="hover:text-[#C9A14A]">Contact</a>
        </nav>

    </div>
</header>

<!-- HERO -->
<section class="relative h-screen pt-24">
    <img src="https://images.unsplash.com/photo-1600185362679-1b3d34e63dc2?auto=format&fit=crop&w=1740&q=80"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 text-center text-white max-w-2xl mx-auto mt-32">
        <h1 class="text-6xl font-light tracking-wide mb-6">
            Discover Luxury Fragrances
        </h1>
        <p class="text-lg opacity-90 mb-10">
            A curated selection of scents — timeless, elegant, and unforgettable.
        </p>

        <a href="/" class="bg-white text-black px-10 py-4 uppercase tracking-widest hover:bg-[#C9A14A] hover:text-white transition">
            Explore Collection
        </a>
    </div>
</section>

<!-- FEATURE COLLECTION -->
<section class="max-w-6xl mx-auto py-24 px-10">

    <h2 class="text-3xl font-light tracking-wide mb-10">
        Featured Fragrances
    </h2>

    <div class="grid grid-cols-3 gap-12">

        @foreach($parfums as $p)
        <div class="group">

            @if($p['image'])
            <div class="overflow-hidden">
                <img src="{{asset('storage/'.$p['image'])}}"
                     class="w-full h-72 object-cover group-hover:scale-105 transition duration-700">
            </div>
            @endif

            <div class="mt-6">
                <p class="text-xs uppercase text-gray-500">{{$p['brand']}}</p>
                <h3 class="text-xl font-medium mt-2">{{$p['name']}}</h3>
                <p class="text-sm text-gray-600 mt-3">
                    {{ Str::limit($p['description'], 100) }}
                </p>
            </div>

        </div>
        @endforeach

    </div>

</section>

<!-- CALL TO ACTION -->
<section class="bg-[#F8F8F8] py-20 text-center">
    <p class="text-xl font-light mb-6">
        Want to add your own signature fragrance?
    </p>
    <a href="/create"
       class="border border-black px-12 py-4 uppercase text-sm tracking-widest hover:bg-black hover:text-white transition">
        Add New Product
    </a>
</section>

<!-- FOOTER -->
<footer class="bg-black text-white py-12 text-center text-sm uppercase tracking-wide">
    © 2025 PARFUMVAULT — All Rights Reserved
</footer>

</body>
</html>
