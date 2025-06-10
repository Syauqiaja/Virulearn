<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout("layouts.guest")]
class Login extends Component
{
    #[Rule(["required", 'email'])]
    public string $email;
    #[Rule(["required", 'min:8'])]
    public string $password;
    public function render()
    {
        return view('livewire.auth.login');
    }
    public function login(){
        $validated = $this->validate();
        if(Auth::attempt($validated)){
            $this->redirect(route('home'));
        }else{
            flash('Email atau password salah', 'danger');
        }
    }
}
