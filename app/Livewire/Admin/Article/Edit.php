<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{   
    use WithFileUploads;

    #[Rule(['required'])]
    public $title;

    #[Rule(['required'])]
    public $url;

    public $thumbnail = null;
    public $overview = null;
    public Article $editedArticle;
    public $previousThumbnail = null;
    public function render()
    {
        return view('livewire.admin.article.edit');
    }
    
    public function delete(){

    }
    public function store(){
        $validated = $this->validate();
        if($this->thumbnail){
            $imagePath = $this->thumbnail->store('article_images', 'public');
        }
        if($this->editedArticle){
            $this->editedArticle->update([
                'title' => $validated['title'],
                'url' => $validated['url'],
                'overview' => $this->overview,
                'thumbnail' => isset($imagePath) ? $imagePath : $this->editedArticle->thumbnail,
            ]);
        }else{
            Article::create([
                'title' => $validated['title'],
                'url' => $validated['url'],
                'overview' => $this->overview,
                'thumbnail' => isset($imagePath) ? $imagePath : null,
            ]);
        }

        $this->reset();

        $this->dispatch('articleCreated');
    }
    #[On('edit-mode')]
    public function editMode(int $id){
        $this->editedArticle = Article::find($id);
        $this->title = $this->editedArticle->title;
        $this->overview = $this->editedArticle->overview;
        $this->url = $this->editedArticle->url;

        $this->thumbnail = $this->editedArticle->thumbnail;
        $this->previousThumbnail = $this->editedArticle->thumbnail;
    }

    public function resetInput(){
        $this->reset();
    }
}
