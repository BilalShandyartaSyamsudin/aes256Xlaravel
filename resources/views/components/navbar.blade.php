<div>
    <nav class="flex gap-5 bg-slate-200 shadow-lg py-4 items-center sticky">
        <div class="px-10 w-96 mr-96">
            <a href="{{ route('home.show') }}">
                <h1 class="text-red-600 text-4xl font-sans font-black hover:opacity-80">AES<span class="text-black">256</span></h1>
            </a>
        </div>
        <div>
            <ul class="flex gap-24 pl-96 text-[#cf2d00] font-bold font-sans ">
                <li><a href="{{ route('text-encrypt.show') }}" class="hover:text-[#db542e]">Text</a></li>
                <li><a href="{{ route('file-encrypt.show') }}" class="hover:text-[#db542e]">File</a></li>
            </ul>
        </div>
    </nav>
</div>
