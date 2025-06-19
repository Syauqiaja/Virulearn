<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use App\Models\Material;
use Carbon\Carbon;
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

    public function mount(Activity $id)
    {
        $this->activity = $id;
        $this->prevUrl = url()->previous();
        $material = $id->materials()->whereHas('userProgress', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->orderBy('order', 'desc')->first();

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
        $this->activeMaterial = $material;

        $this->activeMaterial->userProgress()->updateOrCreate([
            'is_completed' => false,
            'user_id' => Auth::user()->id,
            'last_viewed_at' => Carbon::now(),
        ]);
    }
    public function previous()
    {
        $this->activeMaterial->userProgress()->update([
            'last_viewed_at' => Carbon::now(),
        ]);

        $material = $this->activeMaterial->previous();
        if (!$material) return;
        $this->activeMaterial = $material;

        $this->activeMaterial->userProgress()->update([
            'last_viewed_at' => Carbon::now(),
        ]);
    }
    public function complete()
    {
        $this->activeMaterial->userProgress()->update([
            'is_completed' => true,
            'last_viewed_at' => Carbon::now(),
        ]);

        return $this->redirect($this->prevUrl ?? route('home'), navigate: true);
    }
}
