<?php

namespace App\Livewire\User;

use App\Models\Activity;
use App\Models\Material;
use App\Models\User;
use App\Models\UserLkpd;
use Livewire\Attributes\On;
use Livewire\Component;

class Detail extends Component
{
    public $user;
    public $completedActivity;
    public $completedMaterials;
    public function mount(User $user){
        $this->user = $user;
        $queriedActivity = Activity::with('lkpd')->whereHas('lkpd', function($query){
            $query->whereHas('userLkpd', function($resultQuery){
                $resultQuery->where('user_id', 1);
            });
        })->get();
        $completed = $queriedActivity->filter(function($item) use($user){
            $userLkpd = UserLkpd::where('user_id', $user->id)->where('lkpd_id', $item->lkpd->id)->first();
            return ($userLkpd?->point ?? 0) >= $item->lkpd->kkm;
        });

        $completedMaterials = Material::whereHas('userProgress', function($query){
            $query->where('is_completed', true);
        })->count();
        
        $this->completedMaterials = $completedMaterials / max(1, Material::all()->count());
        $this->completedActivity = $completed->count() / max(1, Activity::all()->count());
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
