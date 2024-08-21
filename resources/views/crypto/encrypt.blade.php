<x-app-layout>
    <div class="flex justify-center h-full w-full mt-10 gap-5">
        <div class="rounded-lg border-2 border-slate-400">
            <div class="border-b-2 border-slate-400 p-5">
                <h1>{{ __('Input') }}</h1>
            </div>
            <div class="p-5">
                <form action="">
                    <x-input-label for="plaintext" :value="__('Plaintext')" /><br>
                    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="plaintext"
                        id="plaintext" cols="50" rows="7"></textarea><br><br>
                    <x-input-label for="password" :value="__('Password')" /><br>
                    <x-text-input class="block mt-1 w-full" id="password" name="password" type="text"
                        required /><br>
                    <x-input-label for="uniqued" :value="__('Uniqued')" /><br>
                    <x-text-input class="block mt-1 w-full" id="uniqued" name="uniqued" type="text" required />

                </form>
            </div>
        </div>
        <div class="rounded-lg border-2 border-slate-400">
            <div class="border-b-2 border-slate-400 p-5">
                <h1>{{ __('Output') }}</h1>
            </div>
            <div class="p-5">
                <x-input-label for="chipertext" :value="__('chipertext')" /><br>
                <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="chipertext"
                    id="chipertext" cols="50" rows="7"></textarea>
            </div>
        </div>
    </div>
</x-app-layout>
