<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Data yang akan disimpan di tabel messages
        $data = [
            'datacore' => env('DATACORE'),
            'dataclass' => env('DATA_CLASS'),
            'recordsperpage' => env('RECORDSPERPAGE'),
            'currentpageno' => env('CURRENTPAGENO'),
            'condition' => env('CONDITION'),
            'order' => env('ORDER'),
            'recordcount' => env('RECORDCOUNT'),
            'fields' => env('FIELDS'),
            'userid' => $user->email,
            'groupid' => env('GROUP_ID'),
            'businessid' => env('BUSINESS_ID')
        ];

        Message::create([
            'user_id' => $user->id,
            'url' => env('API_URL'),
            'apikey' => env('API_KEY'),
            'uniqued' => env('UNIQUED'),
            'password' => env('PASSWORD'),
            'timestamp' => now()->format('Y/m/d H:i:s'),
            'data' => $data,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home.show', absolute: false));
    }
}
