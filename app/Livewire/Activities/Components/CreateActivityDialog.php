<?php

namespace App\Livewire\Activities\Components;

use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Laravel\Prompts\error;

class CreateActivityDialog extends Component
{
    use WithFileUploads;

    #[Rule(['required'])]
    public string $title;
    #[Rule(['required'])]
    public string $description;
    public $cover_image;
    public $previousImage = null;

    public Activity $editedActivity;
    public function render()
    {
        return view('livewire.activities.components.create-activity-dialog');
    }

    public function store()
    {
        $validated = $this->validate();

        if (isset($this->editedActivity)) {
            $this->editedActivity->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'cover_image' => $this->cover_image ? $this->cover_image->store('material_images', 'public') : $this->editedActivity->cover_image,
            ]);
        }else{
            if(!$this->cover_image){
                flash('Cover image is required', 'danger');
                return redirect(request()->header('Referer'));
            }

            $imagePath = $this->cover_image->store('material_images', 'public');
            Activity::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'cover_image' => $imagePath,
            ]);
        }

        $this->reset();

        $this->dispatch('activityCreated');
    }

    #[On('edit-mode')]
    public function editMode(int $id)
    {
        $this->editedActivity = Activity::find($id);
        $this->title = $this->editedActivity->title;
        $this->description = $this->editedActivity->description;

        $this->previousImage = $this->editedActivity->cover_image;
    }

    public function resetInput()
    {
        $this->reset();
    }
}
