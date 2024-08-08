<div>
    <input 
        type="{{ $type ?? '' }}" 
        name="{{ $name ?? '' }}" 
        id="{{ $id ?? '' }}" 
        value="{{ $value ?? '' }}" 
        placeholder="{{ $placeholder ?? '' }}"
        class="{{ $class ?? '' }} {{ in_array($type, ['text', 'email', 'number']) ? 'rounded-lg outline outline-1 outline-black' : '' }}">
</div>
