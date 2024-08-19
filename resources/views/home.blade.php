<x-app-layout>
    <div class="flex min-h-full items-center justify-center py-40 px-20 z-0">
        @if (count($responseData) > 0)
            <div class="owl-carousel owl-theme z-0">
                @foreach ($responseData as $item)
                    <div
                        class="z-0 w-[280px] group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                        <div class="h-96 w-72 z-0">
                            <!-- Ganti gambar berdasarkan whcode -->
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125"
                                src="{{ asset('assets/img/' . $item['image']) }}" alt="{{ $item['whcode'] }}" />
                        </div>
                        <div
                            class="z-0 absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/70 group-hover:via-black/60 group-hover:to-black/70">
                        </div>
                        <div
                            class="z-0 absolute inset-0 flex translate-y-[45%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                            <h1 class="font-dmserif text-3xl font-bold text-white">{{ $item['whcode'] }}</h1>
                            <p
                                class="mb-3 text-lg italic text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                {{ $item['warehouse'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex justify-center items-center">
                <p class="font-sans font-bold text-5xl">Tidak ada data yang dimiliki.</p>
            </div>
        @endif
    </div>
</x-app-layout>
