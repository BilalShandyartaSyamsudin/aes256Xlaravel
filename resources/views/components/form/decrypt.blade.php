<div>
    @props(['decryptedText' => null, 'decryptIsEmpty' => false])
    <form action="{{ route('process') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="decrypt">
        <div class="flex gap-8 items-center">
            <x-label for="encrypt" text="Masukkan Teks Enkripsi"/>
            <x-input type="text" name="decrypt" id="decrypt" />
            <x-input type="text" name="keySecret" id="keySecret" placeholder="Secret Key" />
            <x-button type="submit" />
        </div>
    </form>

    @if (isset($decryptedText))
        <div class="mt-8 w-[100vh]">
            <h4>Hasil Dekripsi:</h4>
            <p class="py-2 px-3 rounded-lg break-words bg-gray-100 border border-gray-300">{{ $decryptedText }}</p>
        </div>
    @elseif(isset($decryptIsEmpty) && $decryptIsEmpty)
        <div class="mt-8">
            <h4 class="text-red-500">Teks Tidak Boleh Kosong</h4>
        </div>
    @endif
</div>
