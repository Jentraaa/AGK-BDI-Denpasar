<!DOCTYPE html>
<html>
<head>
<title>{{$parfum['name']}} — ParfumVault</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#FAFAFA] text-[#111] font-[Inter]">

<header class="border-b bg-white">
<div class="max-w-7xl mx-auto flex justify-between items-center py-6 px-20">
    <a href="/" class="text-lg tracking-[0.3em]">PARFUMVAULT</a>
    <div class="space-x-10 text-xs uppercase tracking-widest">
        <a href="/home">Home</a>
        <a href="/">Collection</a>
        <a href="/about">About</a>
    </div>
</div>
</header>

<section class="max-w-7xl mx-auto grid grid-cols-2 gap-24 px-20 py-24">

<!-- IMAGE -->
<div class="bg-[#F3F3F3] p-10">
    <img src="{{ asset('storage/'.$parfum['image']) }}"
         class="w-full h-[600px] object-cover">
</div>

<!-- INFO -->
<div>
    <p class="text-xs tracking-widest text-gray-500 uppercase">{{$parfum['brand']}}</p>

    <h1 class="text-6xl font-light tracking-wide mt-6">
        {{$parfum['name']}}
    </h1>

    <div class="w-20 h-[1px] bg-[#C9A14A] my-10"></div>

    <p class="text-lg text-gray-700 leading-relaxed max-w-xl">
        {{$parfum['description']}}
    </p>

    <div class="mt-16 space-x-6">
        <a href="/edit/{{$parfum['id']}}"
           class="border px-12 py-4 uppercase tracking-widest hover:bg-black hover:text-white transition">
           Edit
        </a>

        <a href="/delete/{{$parfum['id']}}"
           class="border border-red-500 text-red-500 px-12 py-4 uppercase tracking-widest hover:bg-red-500 hover:text-white transition">
           Delete
        </a>
    </div>
</div>

</section>

<footer class="border-t py-12 text-center text-xs uppercase tracking-widest bg-white">
© 2025 PARFUMVAULT
</footer>

</body>
</html>
