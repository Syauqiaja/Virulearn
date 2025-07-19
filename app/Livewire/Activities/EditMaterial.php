<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\This;

use function PHPUnit\Framework\isEmpty;

class EditMaterial extends Component
{
    public int $id;
    public $activity;

    public $title;
    public $trixId;
    public $photos = [];
    public $cover_image;
    public $content = [];
    public $tags;
    public $imageNames = [];
    public bool $isSaved = false;
    public int $activeIndex = 0;

    public function addPage()
    {
        array_push($this->content, "<h2>Judul Aktivitas</h2><p>Some initial <strong>bold</strong> text</p>");
        $this->dispatch('page-updated');
    }

    public function mount(int $id)
    {
        $this->id = $id;

        $this->activity = Activity::find($this->id);
        $materials = $this->activity->materials()->orderBy('order')->get();

        $this->activeIndex = 0;
        if ($materials->isEmpty()) {
            $this->content = ["<h2>Judul Aktivitas</h2><p>Some initial <strong>bold</strong> text</p>"];
        } else {
            foreach ($materials as $material) {
                $this->content[$material->order] = $material->content;
            }
        }
    }
    public function render()
    {
        return view('livewire.activities.edit-material')->with('activity', $this->activity);
    }
    public function save()
    {
        $this->isSaved = true;

        $materials = $this->activity->materials()->orderBy('order')->get();
        $existingCount = $materials->count();
        $newCount = count($this->content);

        // Update existing materials
        for ($i = 0; $i < min($existingCount, $newCount); $i++) {
            $materials[$i]->update([
                'content' => $this->content[$i],
                'order' => $i,
            ]);
        }

        // Remove excessive materials
        if ($existingCount > $newCount) {
            for ($i = $newCount; $i < $existingCount; $i++) {
                $materials[$i]->delete();
            }
        }

        // Add more materials if needed
        if ($existingCount < $newCount) {
            for ($i = $existingCount; $i < $newCount; $i++) {
                $this->activity->materials()->create([
                    'content' => $this->content[$i],
                    'order' => $i
                ]);
            }
        }

        flash('Materi berhasil diperbarui', 'success');
        return $this->redirect(route('activities.index'), true);
    }

    public function changeIndex($index)
    {
        $this->activeIndex = $index;
        $this->dispatch('load-quill', ['content' => $this->content[$index]]);
    }
    public function updateContent($newContent)
    {
        $this->content[$this->activeIndex] = $newContent;
        $this->isSaved = false;
    }


    public function uploadImage($image)
    {
        $imageData = substr($image, strpos($image, ',') + 1);

        $imageData = base64_decode($imageData);

        // Generate a random alphanumeric string for the filename
        $filename = Str::random(20) . ".png";
        $path = "material_images/$filename";

        Storage::disk('public')->put($path, $imageData);
        $url = storage_url($path); // Assuming this helper function exists in your app

        $this->content[$this->activeIndex] .= '<img style="" src="' . $url . '" alt="Uploaded Image"/>';

        return $this->dispatch('imageUploaded', $url);
    }
    public function deleteImage($image)
    {
        $imageData = substr($image, strpos($image, ',') + 1);
        $length = strlen($imageData);
        $lastSixCharacters = substr($imageData, $length - 20);

        $imageData = base64_decode($imageData);
        $filename = $lastSixCharacters . ".png";
        $path = "/material_images/$filename";

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
