<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW ACTIVITY — PARFUMVAULT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; letter-spacing: 0.02em; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .input-focus { outline: none; border-bottom: 1px solid #C9A14A; }
    </style>
</head>
<body class="bg-[#FBFBFB] text-[#1A1A1A]">

    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-20">
        
        <div class="text-center mb-12">
            <h1 class="text-[10px] tracking-[0.5em] text-[#C9A14A] uppercase font-bold mb-4">Laboratory Management</h1>
            <h2 class="text-4xl font-serif italic text-gray-900">Log New <span class="not-italic font-normal">Activity</span></h2>
        </div>

        <div class="w-full max-w-xl bg-white border border-gray-100 shadow-sm p-10 lg:p-16">
            <form action="/training/store" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="space-y-2">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Activity Name</label>
                    <input type="text" name="title" required placeholder="e.g. Fragrance Formulation Workshop"
                        class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent placeholder:text-gray-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Location</label>
                        <input type="text" name="location" required placeholder="e.g. BDI Denpasar"
                            class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Year/Date</label>
                        <input type="text" name="date" required placeholder="e.g. 2026"
                            class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Visual Documentation</label>
                    <div class="relative group">
                        <input type="file" name="image" required id="imgInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="border-2 border-dashed border-gray-100 py-12 text-center group-hover:border-[#C9A14A] transition-colors bg-gray-50/30">
                            <p id="fileName" class="text-xs text-gray-400 font-serif italic">Drag or click to upload cinematic image...</p>
                        </div>
                    </div>
                </div>

                <div class="pt-10 flex flex-col space-y-4">
                    <button type="submit" 
                        class="bg-black text-white text-[10px] uppercase tracking-[0.4em] font-bold py-5 hover:bg-[#C9A14A] transition-all duration-500 shadow-xl">
                        Add to Gallery
                    </button>
                    <a href="/" class="text-center text-[9px] uppercase tracking-widest text-gray-400 hover:text-black transition-colors pt-4">
                        Cancel & Return
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-16 opacity-20">
            <h1 class="text-2xl tracking-[0.8em] font-bold text-black uppercase">A<span class="text-[#C9A14A]">G</span>K</h1>
        </div>
    </div>

    <script>
        document.getElementById('imgInput').onchange = function() {
            const fileName = this.files[0] ? this.files[0].name : "Drag or click to upload cinematic image...";
            document.getElementById('fileName').textContent = fileName;
        };
    </script>

</body>
</html>