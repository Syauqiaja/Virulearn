<?php

namespace App\Livewire;

use App\Livewire\Activities\TestType;
use App\Models\Activity;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.empty")]
class ExamTest extends Component
{
    public $activity;
    public TestType $testType;
    public Exam $exam;
    public $userProgression;
    public $questions;
    public int $activeIndex;
    public $answers = [];
    public ?string $selectedAnswer = null;
    public function mount(Exam $id)
    {
        $this->exam = $id;
        $this->testType = TestType::from($id->type);
        $this->activity = $id->activity;
        $this->questions = $this->exam->questions()->get();
        $this->activeIndex = 0;
    }
    public function render()
    {
        return view('livewire.exam-test');
    }

    public function switchIndex($index)
    {
        $this->activeIndex = $index;
        $this->selectedAnswer = $this->answers[$index] ?? null;
    }
    public function saveAnswer($index)
    {
        $this->answers[$index] = $this->selectedAnswer;
    }
    public function next()
    {
        $this->switchIndex($this->activeIndex + 1);
    }
    public function prev()
    {
        $this->switchIndex($this->activeIndex - 1);
    }
    public function save()
    {
        $examResult = ExamResult::create([
            'user_id' => Auth::user()->id,
            'exam_id' => $this->exam->id,
            'point' => 0
        ]);
        foreach ($this->answers as $key => $answer) {
            UserAnswer::updateOrCreate([
                'exam_result_id' => $examResult->id,
                'question_id' => $this->questions[$key]->id,
            ], [
                'answer' => $answer,
                'is_correct' => strtolower($answer) == strtolower($this->questions[$key]->correct_answer),
            ]);
        }
        $examResult->point = $examResult->answers()->get()->reduce(function ($carry, $answer) {
            return $carry + ($answer->is_correct ? 1 : 0);
        }, 0) / $this->questions->count();
        $examResult->save();
        if($this->activity){
            $this->redirect(route('activities.test', ['activity' => $this->activity->id]));
        }else{
            $this->redirect(route('exam.detail', ['type' => $this->testType->value]));
        }
    }
}
