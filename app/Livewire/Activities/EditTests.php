<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Exam;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;

use function Laravel\Prompts\error;

class EditTests extends Component
{
    public int $id;
    public TestType $type;
    public $activity;
    public Exam $test;
    public $questions = [];
    public $answers = [];
    public $options = [];
    public int $hour;
    public int $minute;
    public int $kkm;

    protected $rules = [
        'questions.*' => 'required|string',
        'answers.*.*' => 'required|string',
        'options.*' => 'required|in:A,B,C,D',
        'hour' => 'required_with:minute',
        'minute' => 'required_with:hour',
    ];
    public function mount(TestType $type, int $id){
        $this->type = $type;
        $this->activity = Activity::find( $id );
        $this->test = Exam::firstOrCreate(['activity_id' => $id, 'type' => $type->value]);

        foreach ($this->test->questions()->get()->toArray() as $key => $value) {
            $number = $value['order'];
            $this->questions[$number] = $value['question_text'];
            foreach (['A', 'B', 'C', 'D'] as $opt) {
                $this->answers[$number][$opt] = $value["answer_".strtolower($opt)];
            }
            $this->options[$number] = $value["correct_answer"];
        }
        if($this->test->duration != null){
            $this->hour = ($this->test->duration - ($this->test->duration % 60)) / 60;
            $this->minute = $this->test->duration % 60;
        }
        if($this->test->kkm != null){
            $this->kkm = $this->test->kkm;
        }
        if(count($this->questions) == 0){
            $this->questions[0] = null;
            $this->answers[0]["A"] = null;
            $this->answers[0]["B"] = null;
            $this->answers[0]["C"] = null;
            $this->answers[0]["D"] = null;
            $this->options[0] = null;
        }
    }
    public function render()
    {
        return view('livewire.activities.edit-tests');
    }
    public function addQuestion(){
        array_push(
            $this->questions,
            null
        );
        array_push(
            $this->answers,
            [
                "A" => null,
                "B" => null,
                "C" => null,
                "D" => null,
            ]
        );
        array_push(
            $this->options,
            null
        );
    }
    public function delete(int $index){
        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);

        unset($this->answers[$index]);
        $this->answers = array_values($this->answers);

        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }
    public function save(){
        $validated = $this->validate();
        $qst = $this->test->questions;
        $existingCount = $qst->count();
        $newCount = count($this->questions);

        for ($i=0; $i < min($existingCount, $newCount); $i++) { 
            $qst[$i]->update([
                'question_text' => $this->questions[$i],
                'answer_a' => $this->answers[$i]['A'],
                'answer_b' => $this->answers[$i]['B'],
                'answer_c' => $this->answers[$i]['C'],
                'answer_d' => $this->answers[$i]['D'],
                'correct_answer' => $this->options[$i],
                'order' => $i,
            ]);
        }
        
        if($existingCount < $newCount){
            for ($i=$existingCount; $i < $newCount; $i++) { 
                $this->test->questions()->create([
                    'type' => $this->type->value,
                    'question_text' => $this->questions[$i],
                    'answer_a' => $this->answers[$i]['A'],
                    'answer_b' => $this->answers[$i]['B'],
                    'answer_c' => $this->answers[$i]['C'],
                    'answer_d' => $this->answers[$i]['D'],
                    'correct_answer' => $this->options[$i],
                    'order' => $i,
                ]);
            }
        }

        if($existingCount > $newCount){
            for ($i=$newCount; $i < $existingCount; $i++) { 
                $qst[$i]->delete();
            }
        }

        if(isset($this->hour) && isset($this->minute) ){
            $this->test->duration = $this->hour * 60 + $this->minute;
        }else{
            $this->test->duration = null;
        }
        if(isset($this->kkm)){
            $this->test->kkm = $this->kkm;
        }else{
            $this->test->kkm = null;
        }

        $this->test->save();

        flash('Soal '.$this->type->name.' berhasil diperbarui', 'success');
        return $this->redirect(route('activities.index'), true);
    }
}

enum TestType: string{
    case PRETEST = "pretest";
    case LATSOL = "latsol";
    case POSTTEST = "posttest";
    case UNDEFINED = 'undefined';
}
