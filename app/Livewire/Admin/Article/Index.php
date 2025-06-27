<?php

namespace App\Livewire\Admin\Article;

use App\Models\Article;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $articles;
    public $query;

    #[On('articleCreated')]
    public function onArticleCreated()
    {
        $this->search();
    }
    public function mount()
    {
        $this->search();
    }
    public function render()
    {
        return view('livewire.admin.article.index');
    }
    public function search()
    {
        if ($this->query) {
            $this->articles = Article::where('title', 'like', '%' . $this->query . '%')->get();
        } else {
            $this->articles = Article::all();
        }
    }
}
