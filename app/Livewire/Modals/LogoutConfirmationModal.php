<?php

namespace App\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class LogoutConfirmationModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.modals.logout-confirmation-modal');
    }
}
