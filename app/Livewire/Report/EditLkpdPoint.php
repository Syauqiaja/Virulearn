<?php

namespace App\Livewire\Report;

use App\Models\User;
use App\Models\UserLkpd;
use Livewire\Attributes\On;
use Livewire\Component;

class EditLkpdPoint extends Component
{
    public $user;
    public $userLkpd;
    public $point;
    public function render()
    {
        return view('livewire.report.edit-lkpd-point');
    }

    public function save(){
        if(!$this->point) return;

        $this->userLkpd->point = $this->point;
        $this->userLkpd->save();
        $this->resetInput();
        $this->dispatch('lkpd-updated');
    }
    public function resetInput(){
        $this->reset();
    }

    #[On('edit-lkpd')]
    public function editLkpd(UserLkpd $userLkpd){
        $this->user = $userLkpd->user;
        $this->userLkpd = $userLkpd;
        $this->point = $userLkpd->point;
    }
}
