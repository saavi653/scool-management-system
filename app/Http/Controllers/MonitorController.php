<?php

namespace App\Http\Controllers;

use App\Models\RoleId;
use App\Models\Subject;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['stdSub' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->get();
        $permissions =  RoleId::where('id', config('constants.MONITOR'))->with('features')->first();
        return view('monitor.index',compact('permissions','subjects'));
       
    }
}
