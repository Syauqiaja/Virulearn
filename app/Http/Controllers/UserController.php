<?php

namespace App\Http\Controllers;

use App\Livewire\Activities\TestType;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $data = User::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('actions.user-action', ['user' => $row]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function chart(User $user)
    {
        $postTestPoints = Activity::all()->map(function ($activity) use ($user) {
            $postTest = $activity->tests(TestType::POSTTEST)
                ->first()
                ->examResults()
                ->where('user_id', $user->id)
                ->orderBy('point', 'desc')
                ->first();
            $preTest = $activity->tests(TestType::PRETEST)
                ->first()
                ->examResults()
                ->where('user_id', $user->id)
                ->orderBy('point', 'desc')
                ->first();
            $latsol = $activity->tests(TestType::LATSOL)
                ->first()
                ->examResults()
                ->where('user_id', $user->id)
                ->orderBy('point', 'desc')
                ->first();
            return [
                'pretest' => ($preTest?->point ?? 0) * 100,
                'latsol' => ($latsol?->point ?? 0) * 100,
                'posttest' => ($postTest?->point ?? 0) * 100,
            ];
        });

        $result = $postTestPoints->reduce(function ($carry, $item) {
            $carry['pretest'][] = $item['pretest'];
            $carry['posttest'][] = $item['posttest'];
            $carry['latsol'][] = $item['latsol'];
            return $carry;
        }, []);

        return [
            'labels' => range(1, Activity::all()->count()),
            'data' => $result,
        ];
    }
}
