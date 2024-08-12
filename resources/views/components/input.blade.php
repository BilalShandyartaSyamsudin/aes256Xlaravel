<div>
    <input 
        type="{{ $type ?? '' }}" 
        name="{{ $name ?? '' }}" 
        id="{{ $id ?? '' }}" 
        value="{{ $value ?? '' }}" 
        placeholder="{{ $placeholder ?? '' }}"
        class="{{ $class ?? '' }} {{ in_array($type, ['text', 'email', 'number', 'password']) ? 'rounded-lg border-[1px] border-slate-700' : '' }}">
</div>
