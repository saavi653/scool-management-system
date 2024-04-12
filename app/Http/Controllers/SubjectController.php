<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects=Subject::with('teacher')->get();
       
        return view('subject.index',compact('subjects'));
    }
    public function create()
    {
        $teachers = User::where('role_id',config('constants.TEACHER'))->get();
        return view('subject.create',compact('teachers'));
    }
    public function store(Request $req)
    {
        $attributes= $req->validate([
            'subject' => [
                'required',
                Rule::unique('subjects', 'subject'),
            ],
            'description' => 'required',
            'teacher_id' => [
                'required',
                Rule::unique('subjects', 'teacher_id'),
            ],
        ]);
        Subject::create($attributes);
        return redirect()->route('subject.index')->with('success','subject added successfully');
    }
    public function edit(Subject $subject)
    {
       
        $teachers = User::where('role_id',config('constants.TEACHER'))->get();
        return view('subject.edit',compact(['subject','teachers']));
    }
    public function update(Request $req ,Subject $subject)
    {
        $attributes= $req->validate([
            'subject' => [
                'required',
                Rule::unique('subjects', 'subject')->ignore($subject),
            ],
            'description' => 'required',
            'teacher_id' => [
                'required',
                Rule::unique('subjects', 'teacher_id')->ignore($subject),
            ],
        ]);
        $subject->update($attributes);
        return redirect()->route('subject.index')->with('success','subject updated successfully');
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
        return back()->with('success','Subject deleted successfully');
    }
}
