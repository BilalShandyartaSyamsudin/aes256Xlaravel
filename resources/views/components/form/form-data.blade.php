<div>
    <form action="{{ route('data.submit') }}" method="POST">
        @csrf
        <div class="flex gap-5">
            <div class="flex flex-col gap-5">
                <x-label text="Url" />
                <x-input name="url" id="url" value="http://sereg.alcorsys.com:8989/JDataClassQuery"
                    class="w-96" type="text" />
                <x-label text="ApiKey" />
                <x-input name="apikey" id="apikey" value="06EAAA9D10BE3D4386D10144E267B681" class="w-96"
                    type="text" />
                <x-label text="Uniqued" />
                <x-input name="uniqued" id="uniqued" value="JFKlnUZyyu0MzRqj" class="w-96" type="text" />
                <x-label text="Password" />
                <x-input name="password" id="password" value="A9CCF340D9A490104AC5159B8E1CBXXX" class="w-96"
                    type="text" />
                <x-label text="TimeStamp" />
                <x-input name="timestamp" id="timestamp" value="{{ now()->format('Y/m/d H:i:s') }}"
                    class="w-96" type="text" />
            </div>
            <div class="flex flex-col gap-5">
                <x-label text="datacore" />
                <x-input name="datacore" id="datacore" value="core_002" class="w-96" type="text" />
                <x-label text="dataclass" />
                <x-input name="dataclass" id="dataclass" value="wareHouse" class="w-96" type="text" />
                <div class="flex gap-3">
                    <div>
                        <x-label text="recordsperpage" />
                        <x-input name="recordsperpage" id="recordsperpage" value="0" type="text"
                            class="w-40" />
                    </div>
                    <div>
                        <x-label text="currentpageno" />
                        <x-input name="currentpageno" id="currentpageno" value="0" class="w-40"
                            type="text" />
                    </div>
                </div>
                <x-label text="condition" />
                <x-input name="condition" id="condition" value="whtype='SL'" class="w-96" type="text" />
                <x-label text="order" />
                <x-input name="order" id="order" value="warehouse" class="w-96" type="text" />
                <x-label text="recordcount" />
                <x-input name="recordcount" id="recordcount" value="yes" class="w-96" type="text" />
                <x-label text="fields" />
                <x-input name="fields" id="fields" value="whcode, warehouse" class="w-96"
                    type="text" />
                <x-label text="userid" />
                <x-input name="userid" id="userid" value="ganiadi@thepyxis.net" class="w-96"
                    type="text" />
                <x-label text="groupid" />
                <x-input name="groupid" id="groupid" value="XCYTUA" class="w-96" type="text" />
                <x-label text="businessid" />
                <x-input name="businessid" id="businessid" value="PJLBBS" class="w-96" type="text" />
            </div>
        </div>
        <div class="mt-10">
            <x-button type="submit" />
        </div>
    </form>
</div>
