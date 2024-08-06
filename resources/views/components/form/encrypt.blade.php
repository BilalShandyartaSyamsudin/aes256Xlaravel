<div>
    @props(['encryptedText' => null, 'isEmpty' => false, 'keySecret' => null])
    <form action="{{ route('process') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="encrypt">
        <div class="flex gap-8 items-center">
            <x-label for="encrypt" text="Masukkan Teks"/>
            <x-input type="text" name="encrypt" id="encrypt" />
            <x-button type="submit" />
        </div>
    </form>

    @if (isset($encryptedText))
        <div class="mt-8 w-[100vh]">
            <h4>Hasil Enkripsi:</h4>
            <p class="py-2 px-3 rounded-lg break-words bg-gray-100 border border-gray-300">{{ $encryptedText }}</p>
        </div>
    @elseif(isset($isEmpty) && $isEmpty)
        <div class="mt-8">
            <h4 class="text-red-500">Teks Tidak Boleh Kosong</h4>
        </div>
    @endif
    @if (isset($keySecret))
        <p>Secret Key: {{ $keySecret }}</p>
    @endif
</div>
