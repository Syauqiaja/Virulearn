<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\UserLkpd;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout("layouts.empty")]
class LkpdDetail extends Component
{
    public $activity;
    public $lkpd;

    #[Rule(['required', 'string'])]
    public $answer;

    public $point = null;
    public $isCompleted = false;
    public $activeMaterial = null;
    public $testType = 'lkpd';

    public function mount($id){
        $this->activity = Activity::find($id);
        $this->lkpd = $this->activity->lkpd;

        $currentAnswer = UserLkpd::where('lkpd_id', $this->lkpd->id)->where('user_id', Auth::user()->id)->first();
        if($currentAnswer){
            $this->answer = $currentAnswer->answer;
            $this->point = $currentAnswer->point;
        }
    }
    public function render()
    {
        return view('livewire.lkpd-detail');
    }
    public function save(){
        $this->validate();

        UserLkpd::updateOrCreate(['user_id' => Auth::user()->id, 'lkpd_id' => $this->lkpd->id], ['answer' => $this->answer]);

        flash('Berhasil menyelesaikan aktivitas '.$this->activity->title, 'success');
        $this->redirect(route('home'));
    }
}
