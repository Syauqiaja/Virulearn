<?php

namespace App\Http\Controllers;

use App\Livewire\Activities\TestType;
use App\Models\Activity;
use App\Models\ExamResult;
use App\Models\Material;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\UserLkpd;
use App\Models\UserMaterialProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Features\SupportConsoleCommands\Commands\MakeCommand;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\returnSelf;

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
        $latsolPoints = Activity::all()->map(function ($activity) use ($user) {
            $latsol = $activity->latsol()
                ->first()?->examResults()
                ->where('user_id', $user->id)
                ->orderBy('point', 'desc')
                ->first();
            return [
                'latsol' => ($latsol?->point ?? 0) * 100,
            ];
        });

        $result = $latsolPoints->reduce(function ($carry, $item) {
            $carry['latsol'][] = $item['latsol'];
            return $carry;
        }, []);

        return [
            'labels' => Activity::all()->pluck('title'),
            'data' => $result,
        ];
    }

    public function activityReport(Activity $activity){
        $data = User::orderBy('name')->get();
        $table = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('material', function($row)use($activity){
                $totalMat = Material::where('activity_id', $activity->id)->count();
                $userProgress = UserMaterialProgress::with('material')->where('user_id', $row->id)
                    ->whereHas('material', function($q)use($activity){
                    $q->where('activity_id', $activity->id);
                })->where('is_completed', 1)->count();
                return floor($userProgress / (max($totalMat, 1)) * 100)."%";
            })
            ->addColumn('latsol', function($row)use($activity){
                $latsol = $activity->tests(TestType::LATSOL)
                ->first()?->examResults()
                ->where('user_id', $row->id)
                ->orderBy('point', 'desc')
                ->first();

                return floor( ($latsol?->point ?? 0) * 100)."%";
            })
            ->addColumn('lkpd', function($row)use($activity){
                $lkpd = UserLkpd::with(['lkpd'])->where('user_id', $row->id)->whereHas('lkpd', function($q) use($activity){
                    $q->where('activity_id', $activity->id);
                })->first();

                return floor( ($lkpd?->point ?? 0))."%";
            })
            ->addColumn('lkpd_status', function($row) use ($activity){
                $lkpd = $activity->lkpd->userLkpd()->where('user_id', $row->id)->first();
                if($lkpd->answer == null){
                    return view('actions.lkpd-status', ['userLkpd' => $lkpd, 'type' => 'danger', 'status' => 'Kosong']);
                }else if($lkpd->answer != null){
                    if($lkpd->is_corrected){
                        return view('actions.lkpd-status', ['userLkpd' => $lkpd, 'type' => 'success', 'status' => 'Selesai']);
                    }else{
                        return view('actions.lkpd-status', ['userLkpd' => $lkpd, 'type' => 'warning', 'status' => 'Perlu Dikoreksi']);
                    }
                }
            })
            ->addColumn('action', function ($row) {
                return view('actions.user-action', ['user' => $row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $table;
    }
}
