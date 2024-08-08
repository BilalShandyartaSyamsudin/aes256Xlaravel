<div>
    <div class="ml-44 mt-20">
        <x-label text="Private Message" />
        <textarea rows="13" cols="100" readonly>
            @isset($data)
{{ json_encode($data, JSON_PRETTY_PRINT) }}
@endisset
        </textarea>
    </div>
    <div class="ml-44 mt-20">
        <x-label text="Encrypted Private Message Using (AES256)" />
        <textarea rows="13" cols="100" readonly>
            @isset($encryptedData)
{{ $encryptedData }}
@endisset
        </textarea>
    </div>
    <div class="ml-44 mt-20">
        <x-label text="JSON Public Message" />
        <textarea rows="13" cols="100" readonly>
            @isset($data)
{
                "apikey": "{{ $apikey }}",
                "uniqued": "{{ $uniqued }}",
                "timestamp": "{{ $timestamp }}",
                "encryptedData": "{{ $encryptedData }}"
            }
@endisset
        </textarea>
    </div>
</div>
