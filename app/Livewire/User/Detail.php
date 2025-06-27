<?php

namespace App\Livewire\User;

use App\Models\Activity;
use App\Models\Material;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    public $user;
    public $completedActivity;
    public $completedMaterials;
    public function mount(User $user){
        $this->user = $user;
        $queriedActivity = Activity::with('postTests')->whereHas('postTests', function($query){
            $query->whereHas('examResults', function($resultQuery){
                $resultQuery->where('user_id', 1);
            });
        })->get();
        $completed = $queriedActivity->filter(function($item){
            return $item->postTests()->first()->isCompleted();
        });

        $completedMaterials = Material::whereHas('userProgress', function($query){
            $query->where('is_completed', true);
        })->count();

        $this->completedMaterials = $completedMaterials / Material::all()->count();
        $this->completedActivity = $completed->count() / Activity::all()->count();
    }
    public function render()
    {
        return view('livewire.user.detail');
    }

    #[On('profileUpdated')]
    public function profileUpdated(){
        $this->user = User::find($this->user->id);
    }
}
