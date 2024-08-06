<div>
    <input type="{{ $type ?? '' }}" name="{{ $name ?? '' }}" id="{{ $id ?? '' }}" value="{{ $value ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}"
        class="py-2 px-3 
    @if (in_array($type, ['text', 'email', 'number'])) rounded-lg outline outline-1 outline-black @endif">
</div>
