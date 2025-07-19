<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityDeleteController extends Controller
{
    public function delete(Activity $id){
        $id->delete();
        return redirect(route('activities.index'));
    }
}
