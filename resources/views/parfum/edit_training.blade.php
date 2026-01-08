<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Training | AGK Vault</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; letter-spacing: 0.02em; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#FBFBFB] text-[#1A1A1A] antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        
        <div class="mb-12 text-center">
            <h1 class="text-[10px] tracking-[0.5em] text-[#C9A14A] uppercase font-bold mb-4">Master Editorial Panel</h1>
            <h2 class="text-4xl md:text-5xl font-serif italic text-gray-900">Edit <span class="not-italic font-normal">Training Record</span></h2>
        </div>

        <div class="w-full max-w-2xl bg-white border border-gray-100 shadow-sm p-8 md:p-12 relative">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#C9A14A]"></div>

            <form action="{{ route('training.update', $training->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="group">
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2 group-focus-within:text-[#C9A14A] transition-colors">Activity Title</label>
                    <input type="text" name="title" value="{{ old('title', $training->title) }}" required
                        class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent font-serif text-xl italic"
                        placeholder="e.g., Essential Oil Distillation Workshop">
                    @error('title') <p class="text-red-500 text-[10px] mt-2 uppercase tracking-widest">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2 group-focus-within:text-[#C9A14A] transition-colors">Location</label>
                        <input type="text" name="location" value="{{ old('location', $training->location) }}" required
                            class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent text-sm"
                            placeholder="e.g., BDI Denpasar">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2 group-focus-within:text-[#C9A14A] transition-colors">Event Date</label>
                        <input type="text" name="date" value="{{ old('date', $training->date) }}" required
                            class="w-full border-b border-gray-200 py-3 focus:outline-none focus:border-[#C9A14A] transition-colors bg-transparent text-sm"
                            placeholder="e.g., October 2025">
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Visual Documentation</label>
                    
                    <div class="relative aspect-[21/9] w-full bg-gray-50 border border-gray-100 overflow-hidden group">
                        @if(!empty($training->image))
                            <img id="preview" src="{{ asset('storage/' . $training->image) }}" class="w-full h-full object-cover">
                        @else
                            <div id="no-image" class="w-full h-full flex items-center justify-center text-gray-300 italic font-serif">No current image</div>
                        @endif
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="text-white text-[10px] uppercase tracking-widest">Change Photo</span>
                        </div>
                    </div>

                    <input type="file" name="image" id="imageInput" onchange="previewImage(event)"
                        class="block w-full text-xs text-gray-400
                        file:mr-4 file:py-2 file:px-4
                        file:border-0 file:text-[10px] file:font-bold
                        file:uppercase file:tracking-widest
                        file:bg-black file:text-white
                        hover:file:bg-[#C9A14A] file:transition-colors
                        cursor-pointer">
                    <p class="text-[9px] text-gray-400 italic">Ideal: 21:9 Aspect Ratio (e.g. 1920x822px) for full slider display.</p>
                </div>

                <div class="pt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="{{ url('/') }}" class="text-[10px] uppercase tracking-[0.3em] text-gray-400 hover:text-black transition-colors font-bold">
                        ← Cancel & Back
                    </a>
                    
                    <button type="submit" class="w-full md:w-auto bg-black text-white px-12 py-4 text-[11px] uppercase tracking-[0.4em] font-bold hover:bg-[#C9A14A] transition-all duration-500 shadow-xl">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-12 text-[9px] tracking-[0.3em] text-gray-300 uppercase">AGK Essential Oil • Internal Management</p>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('preview');
            const noImage = document.getElementById('no-image');

            reader.onload = function() {
                if(output) {
                    output.src = reader.result;
                } else {
                    const newImg = document.createElement('img');
                    newImg.id = "preview";
                    newImg.src = reader.result;
                    newImg.className = "w-full h-full object-cover";
                    noImage.parentNode.replaceChild(newImg, noImage);
                }
            }
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
</body>
</html>