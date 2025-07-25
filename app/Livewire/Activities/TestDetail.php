<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TestDetail extends Component
{
    public $activity;
    public $activeMaterial = null;
    public TestType $testType;
    public Exam $exam;
    public $examResults;
    public $isCompleted;
    public function mount(TestType $type){
        $this->testType = $type;
        $this->exam = Exam::where('activity_id', null)
        ->where('type', $type->value)
        ->first();
        $this->activity = null;
        $this->examResults = $this->exam->examResults()->where('user_id', Auth::user()->id)->get();
        $this->isCompleted = $this->exam->isCompleted();
    }
    public function render()
    {
        return view('livewire.activities.test-detail');
    }
}
