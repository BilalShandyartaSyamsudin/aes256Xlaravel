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
        $this->validateRegistration($request);

        $user = $this->createUser($request);

        $encryptedData = $this->encryptUserData($user);

        $this->saveMessage($user, $encryptedData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home.show', absolute: false));
    }

    /**
     * Validate the registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRegistration(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }

    /**
     * Create a new user with the validated data.
     */
    private function createUser(Request $request): User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    /**
     * Encrypt user data before saving it to the database.
     */
    private function encryptUserData(User $user): string
    {
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

        return strtoupper(bin2hex(openssl_encrypt(
            json_encode($data),
            'aes-256-cbc',
            env('PASSWORD'),
            OPENSSL_RAW_DATA,
            env('UNIQUED')
        )));
    }

    /**
     * Save the encrypted message data in the messages table.
     */
    private function saveMessage(User $user, string $encryptedData)
    {
        Message::create([
            'user_id' => $user->id,
            'data' => $encryptedData,
            'timestamp' => now()->format('Y/m/d H:i:s'),
        ]);
    }
}
