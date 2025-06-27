<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.empty")]
class Detail extends Component
{
    public $activity;
    public Material $activeMaterial;
    public $userProgression;
    public $prevUrl;
    public TestType $testType;

    public function mount(Activity $id, Request $request)
    {
        $this->activity = $id;
        if(!$this->activity->tests(TestType::PRETEST)->first()->isCompleted()){
            return redirect()->route('activities.test', ['id' => $id->id, 'type' => TestType::PRETEST]);
        }

        $this->prevUrl = url()->previous();
        $this->testType = TestType::UNDEFINED;
        if(filled($request->m)) {
            $material = Material::where("id", $request->m)->first();
        }else{
            if($this->activity->tests(TestType::LATSOL)->first()->isCompleted()){
                return redirect()->route('activities.test', ['id' => $id->id, 'type' => TestType::POSTTEST]);
            }else if($this->activity->materials()->orderBy('order', 'desc')->first()->userProgress()->first()?->is_completed){
                return redirect()->route('activities.test', ['id' => $id->id, 'type' => TestType::LATSOL]);
            }

            $material = $id->materials()->whereHas('userProgress', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->orderBy('order', 'desc')->first();
        }

        if (!$material) {
            $material = $id->materials()->first();
            $material->userProgress()->create([
                'is_completed' => false,
                'user_id' => Auth::user()->id,
                'last_viewed_at' =>
                Carbon::now()
            ]);
        }

        $this->activeMaterial = $material;
    }
    public function render()
    {
        return view('livewire.activities.detail');
    }

    public function switchMaterial(Material $material)
    {
        $this->activeMaterial = $material;
        $this->activeMaterial->userProgress()->update([
            'last_viewed_at' => Carbon::now(),
        ]);
    }

    public function next()
    {
        $this->activeMaterial->userProgress()->update([
            'is_completed' => true,
            'last_viewed_at' => Carbon::now(),
        ]);

        $material = $this->activeMaterial->next();
        if (!$material) return;

        $material->userProgress()->updateOrCreate([
            'is_completed' => false,
            'user_id' => Auth::user()->id,
            'last_viewed_at' => Carbon::now(),
        ]);
        return $this->redirect(route('activities.detail', ['id'=> $this->activity->id, 'm' => $material->id]));
    }
    public function previous()
    {
        $this->activeMaterial->userProgress()->update([
            'last_viewed_at' => Carbon::now(),
        ]);

        $material = $this->activeMaterial->previous();
        if (!$material) return;

        $material->userProgress()->update([
            'last_viewed_at' => Carbon::now(),
        ]);
        return $this->redirect(route('activities.detail', ['id'=> $this->activity->id, 'm' => $material->id]));
    }
    public function complete()
    {
        $this->activeMaterial->userProgress()->update([
            'is_completed' => true,
            'last_viewed_at' => Carbon::now(),
        ]);

        return $this->redirect(route('activities.test', ['id' => $this->activity->id, 'type' => TestType::LATSOL]), navigate: true);
    }
}
