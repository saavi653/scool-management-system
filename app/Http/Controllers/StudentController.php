<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\RoleId;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['stdSub' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->get();
      
        $permissions =  RoleId::where('id',config('constants.STUDENT'))->with('features')->first();
        return view('student.index',compact('permissions','subjects'));
    }

    public Function selectedSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required'
        ]);
        foreach($request['subject_id'] as $subject)
        {
            if(StudentSubject::where('subject_id', $subject)->where('user_id', auth()->user()->id)->get()->isEmpty())
            {
                StudentSubject::create([
                    'subject_id'=> $subject,
                    'user_id' => auth()->user()->id,
                    'status' => 'pending'
                ]);
            } 
        }

        return back()->with('success','Subject request sent successfully');
    }
    public function attendanceDetail(User $student)
    {
       $attendances= Attendance::where('user_id',$student->id)->get();
       foreach($attendances as $attendance)
       {
            $timein = Carbon::parse($attendance->timein);
            $timeout = Carbon::parse($attendance->timeout);
            
            $difference = $timeout->diff($timein);
            $attendance->difference = $difference;
       }

        return view('teacher.studentAttendance',compact('attendances'));
    }
}
