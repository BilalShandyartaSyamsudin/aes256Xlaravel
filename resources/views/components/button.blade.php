<div>
    <button 
    type="{{ $type ?? 'button' }}" 
    class="{{ $class ?? 'px-10 py-2 rounded-lg bg-black text-white' }}">
        {{ $text ?? 'Submit' }}
    </button>
</div>
