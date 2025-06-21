<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.empty")]
class TestDetail extends Component
{
    public Activity $activity;
    public $activeMaterial = null;
    public TestType $testType;
    public Exam $exam;
    public $examResults;
    public $isCompleted;
    public function mount(Activity $id, TestType $type){
        $this->activity = $id;
        $this->testType = $type;
        $this->exam = Exam::where('activity_id', $this->activity->id)
        ->where('type', $type->value)
        ->first();
        $this->examResults = $this->exam->examResults()->where('user_id', Auth::user()->id)->get();
        $this->isCompleted = $this->exam->isCompleted();
    }
    public function render()
    {
        return view('livewire.activities.test-detail');
    }
}
