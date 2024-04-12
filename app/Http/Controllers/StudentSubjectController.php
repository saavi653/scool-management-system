<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    public function approved(User $student)
    { 
       $teacher=Auth()->User()->id;
       $subjects = Subject::where('teacher_id',$teacher)->pluck('id');

       StudentSubject::where('subject_id',$subjects)->where('user_id',$student->id)->update([
        'status' => 'approved'
       ]);

       return back()->with('success','student approved');
    
    }
    

    public function rejected(User $student,Request $req)
    {   
        $teacher=Auth()->User()->id;
        $subjects = Subject::where('teacher_id',$teacher)->pluck('id');
       
        StudentSubject::where('subject_id',$subjects)->where('user_id',$student->id)->update([
         'status' => 'rejected',
         'reason' => $req->reason
        ]);
 
        return back()->with('success','student rejected');
    }
}
