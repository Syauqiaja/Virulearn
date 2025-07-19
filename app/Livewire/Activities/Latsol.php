<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.empty")]
class Latsol extends Component
{
    public Activity $activity;
    public $activeMaterial = null;
    public TestType $testType;
    public Exam $exam;
    public $examResults;
    public $isCompleted;
    public function mount(Activity $activity){
        $this->testType = TestType::LATSOL;
        $this->exam = Exam::where('activity_id', $activity->id)
        ->where('type', $this->testType->value)
        ->first();
        $this->examResults = $this->exam->examResults()->where('user_id', Auth::user()->id)->get();
        $this->isCompleted = $this->exam->isCompleted();
    }
    public function render()
    {
        return view('livewire.activities.latsol');
    }
}
