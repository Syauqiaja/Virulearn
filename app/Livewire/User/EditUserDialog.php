<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Contracts\Role;

class EditUserDialog extends Component
{
    use WithFileUploads;
    #[Rule(["required"])]
    public $name;
    #[Rule(["required"])]
    public $email;
    public $photo;
    public $user;
    public $isAdmin;
    public function render()
    {
        return view('livewire.user.edit-user-dialog');
    }
    #[On('edit-profile')]
    public function initInput($id)
    {
        $user = User::find($id);
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->photo = $user->photo;

        $this->isAdmin = $user->hasRole('admin');
    }
    public function store()
    {
        if(is_file($this->photo)){
            $imagePath = $this->photo->store('profile_picture', 'public');
        }
        $this->user->update([
            'name' => $this->name, 
            'email' => $this->email, 
            'photo' => isset($imagePath) ? $imagePath : $this->photo,
        ]);

        if(!$this->user->hasRole('admin') && $this->isAdmin){
            $this->user->assignRole('admin');
            $this->user->save();
        }else if($this->user->hasRole('admin') && !$this->isAdmin){
            $this->user->removeRole('admin');
            $this->user->save();
        }

        $this->dispatch('profileUpdated');
    }
}
