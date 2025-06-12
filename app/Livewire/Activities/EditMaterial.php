<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        $materials = $this->activity->materials()->get();

        $this->activeIndex = 0;
        if ($materials->isEmpty()) {
            $this->content = ["<h2>Judul Aktivitas</h2><p>Some initial <strong>bold</strong> text</p>"];
        } else {
            $this->content = $materials->map(fn($material) => $material->content)->toArray();
        }
    }
    public function render()
    {
        return view('livewire.activities.edit-material')->with('activity', $this->activity);
    }
    public function save()
    {
        $this->isSaved = true;
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
        $length = strlen($imageData);
        $lastSixCharacters = substr($imageData, $length - 20);

        $imageData = base64_decode($imageData);
        $filename = $lastSixCharacters . ".png";
        $path = "/material_images/$filename";

        Storage::disk('public')->put($path, $imageData);
        $url = asset("storage/$path");
        $this->content .= '<img style="" src="' . $url . '" alt="Uploaded Image"/>';
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
