<?php

namespace App\Livewire\Activities;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMaterial extends Component
{
    public int $id;
    public int $totalPage = 1;
    
    public $title;
    public $trixId;
    public $photos = [];
    public $cover_image;
    public $content = '';
    public $tags;
    public $imageNames = [];


    public function addPage(){
        $this->totalPage++;
    }

    public function mount(int $id){
        $this->id = $id;
    }
    public function render()
    {
        $activity_name = "Activity ".$this->id;
        return view('livewire.activities.edit-material')->with('activity_name', $activity_name);
    }

    public function uploadImage($image){
        $imageData = substr($image, strpos($image, ',') + 1);
        $length = strlen($imageData);
        $lastSixCharacters = substr($imageData, $length - 20);

        $imageData = base64_decode($imageData);
        $filename = $lastSixCharacters . ".png";
        $path = "/material_images/$filename";

        Storage::disk('public')->put($path, $imageData);
        $url = asset("storage/$path");
        $this->content .= '<img style="" src="'.$url.'" alt="Uploaded Image"/>';
        return $this->dispatch('imageUploaded', $url);
    }
    public function deleteImage($image){
        $imageData = substr($image, strpos($image, ',')+1);
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
