@extends('text.layouts.app')

@section('content')
    <div>
        <section>
            <div class="px-20 pt-24 flex flex-col gap-5">
                {{-- Form Encrypt --}}
                <x-form.encrypt :encryptedText="$encryptedText ?? null" :isEmpty="$isEmpty ?? false" :keySecret="$keySecret ?? null" />
            </div>
            <div class="px-20 pt-24 flex flex-col gap-5">
                {{-- Form Decrypt --}}
                <x-form.decrypt :decryptedText="$decryptedText ?? null" :decryptIsEmpty="$decryptIsEmpty ?? false" />
            </div>
        </section>
    </div>
@endsection
