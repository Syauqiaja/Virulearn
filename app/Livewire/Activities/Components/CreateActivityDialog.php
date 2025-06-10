<?php

namespace App\Livewire\Activities\Components;

use App\Models\Activity;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateActivityDialog extends Component
{
    use WithFileUploads;

    #[Rule(['required'])]
    public string $title;
    #[Rule(['required'])]
    public string $description;
    #[Rule(['required', 'image'])]
    public $cover_image;
    public function render()
    {
        return view('livewire.activities.components.create-activity-dialog');
    }
    public function store(){
        $validated = $this->validate();

        $imagePath = $this->cover_image->store('material_images', 'public');
        $activity = Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'cover_image' => $imagePath,
        ]);

        $this->dispatch('activityCreated');
    }
}
