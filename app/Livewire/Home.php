<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Exam;
use App\Models\UserLkpd;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Home")]
class Home extends Component
{
    public $activities;
    public $completedActivity;
    public $pretest;
    public $posttest;

    public function mount(){
        $this->activities = Activity::all();
        $user = Auth::user();

        $queriedActivity = Activity::with('lkpd')->whereHas('lkpd', function($query){
            $query->whereHas('userLkpd', function($resultQuery){
                $resultQuery->where('user_id', 1);
            });
        })->get();

        $completed = $queriedActivity->filter(function($item) use($user){
            $userLkpd = UserLkpd::where('user_id', $user->id)->where('lkpd_id', $item->lkpd->id)->first();
            return ($userLkpd?->point ?? 0) >= $item->lkpd->kkm;
        });

        $this->completedActivity = $completed->count() / max(1, Activity::all()->count());
        $this->pretest = Exam::whereNull('activity_id')->where('type', 'pretest')->first();
        $this->posttest = Exam::whereNull('activity_id')->where('type', 'posttest')->first();
    }
    public function render()
    {
        return view('livewire.home');
    }

    public function startNow(){
    }
}
