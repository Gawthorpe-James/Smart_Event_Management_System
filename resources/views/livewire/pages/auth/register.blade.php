<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $username = '';
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <div>
            <x-text-input
                wire:model="username"
                label="Username"
                id="username"
                type="text"
                name="username"
                class="block mt-1 w-full"
                required
                autocomplete="username"
            />
        </div>
        <!-- Name -->
        <div>
            <x-text-input
                wire:model="first_name"
                label="First Name"
                id="first_name"
                type="text"
                name="first_name"
                class="block mt-1 w-full"
                required
                autocomplete="first-name"
            />
        </div>
        <div>
            <x-text-input
                wire:model="last_name"
                label="Last Name"
                id="last_name"
                type="text"
                name="last_name"
                class="block mt-1 w-full"
                required
                autocomplete="last-name"
            />
        </div>
        <!-- Email Address -->
        <div>
            <x-text-input
                wire:model="email"
                label="Email"
                id="email"
                type="email"
                name="email"
                class="block mt-1 w-full"
                required
                autocomplete="email"
            />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-text-input
                wire:model="password"
                label="Password"
                id="password"
                type="password"
                name="password"
                class="block mt-1 w-full"
                required
                autocomplete="new-password"
            />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-text-input
                wire:model="password_confirmation"
                label="Confirm Password"
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="block mt-1 w-full"
                required
                autocomplete="new-password"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-link
                href="{{ route('login') }}"
                wire:navigate
            >
                {{ __('Already registered?') }}
            </x-link>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
