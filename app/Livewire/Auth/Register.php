<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

use function Illuminate\Log\log;
use function Laravel\Prompts\error;

#[Layout("layouts.guest")]
class Register extends Component
{
    #[Rule(["required"])]
    public string $name;
    #[Rule(["required", 'email'])]
    public string $email;
    #[Rule(["required", 'min:8', 'confirmed'])]
    public string $password;
    public string $password_confirmation;
    public function register()
    {
        $this->validate();
        if (User::where('email', $this->email)->exists()) {
            $this->addError('email', 'This email is already registered.');
            return;
        }
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 1,
        ]);

        Auth::login($user);

        return redirect(route("home"))->with('success', 'Successfully registered new user');
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
