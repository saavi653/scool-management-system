<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\RoleId;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class teacherController extends Controller
{
    public function index()
    {
        $students = Subject::where('teacher_id', auth()->user()->id)
        ->with(['assignedUser' => function($query) {
             $query->where('status', 'pending');
        }])
        ->first();

        $permissions =  RoleId::where('id',config('constants.TEACHER'))->with('features')->first();
      
        return view('teacher.index',compact('permissions','students'));
    }

    public function attendanceShow()
    {
        $subject= Subject::where('teacher_id',Auth()->user()->id)->pluck('id');
     
        $users= StudentSubject::whereIn('subject_id',$subject)
                                    ->where('status','approved')->pluck('user_id');
                    
                                    
                $students=User::whereIn('id',$users)->get();
                                   
       

        return view('teacher.showAttendance',compact('students'));

    }
    
    public function attendanceDetailTeacher(User $teacher)
    {
        
        $attendances= Attendance::where('user_id',$teacher->id)->get();
    
        foreach($attendances as $attendance)
        {
             $timein = Carbon::parse($attendance->timein);
             $timeout = Carbon::parse($attendance->timeout);
             $difference = $timeout->diff($timein);
             $attendance->difference = $difference;
        }
         return view('AttendanceDetailTeacher',compact('attendances'));
    }
}
