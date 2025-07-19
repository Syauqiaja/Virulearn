<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Lkpd;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateLKPD extends Component
{
    use WithFileUploads;
    public $activity;

    #[Rule(['required'])]
    public $file;
    public $kkm;

    #[On('edit-lkpd')]
    public function editLKPD($id){
        $this->activity = Activity::where('id', $id)->first();
    }
    public function save(){
        $this->validate();

        $filePath = $this->file->store('lkpd', 'public');

        Lkpd::updateOrCreate([
            'activity_id' => $this->activity->id,
        ], [
            'kkm' => $this->kkm ?? 0,
            'file' => $filePath
        ]);

        $this->resetInput();

        $this->dispatch('activityCreated');
    }
    public function render()
    {
        return view('livewire.create-l-k-p-d');
    }
    public function resetInput(){
        $this->reset();
    }
}
