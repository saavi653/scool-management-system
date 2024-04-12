<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Attendance;
use App\Models\RoleId;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id','!=',1)->simplePaginate(4);
        return view('index', compact('users'));
    }
    public function create()
    {
        return view('create'); 
    }

    public function store(StorePostRequest $req)
    {
      
        $attributes = $req->validated();

        $file = $req->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->storeAs('public/',$filename);
       
        $attributes += $req->validate([
            'password' => 'required|min:8|max:255',
            'cpassword' => 'required|same:password',

        ]);
        $attributes['password'] = Hash::make($attributes['password']);

        unset($attributes['cpassword']);

        $attributes['qualification'] = implode(',', $attributes['qualification']);
        $attributes['image'] = $filename;
       
        User::create($attributes);
        return redirect()->route('login')->with('success', 'User Registered successfully');;
    }

    public function edit(User $user)
    {

        return view('edit', compact('user'));
    }

    public function update(UpdatePostRequest $req, User $user)
    {
        // validation is a helper function
        $attributes = $req->validated();

        $attributes['qualification'] = implode(',', $attributes['qualification']);

        $user->update($attributes);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function delete(User $user)
    {
        $user->delete();
        return back()->with('danger', 'User deleted successfully');
    }

    public function createAjax()
    {
        return view('createAjax');
    }

    public function storeAjax(Request $req)
    {
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'qualification' => implode(',', $req->qualification),
            'password' => $req->password
        ];

        DB::table('users')->insert($data);
    }
    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|min:3|max:255',
            'password' => 'required'
        ]);

        $auth = Auth::attempt(['email' =>  $req->email, 'password' => $req->password]);


        if ($auth == false) {
            return back()->with('error', 'Invalid Credentials');
        } else {

            if (Auth()->user()->role_id == 1) {
                return redirect()->route('dashboard')->with('success', 'Welcome Admin');
            } 
            elseif(Auth()->user()->role_id == 2){
                return redirect()->route('teacherDashboard')->with('success', 'Welcome Teacher');
            } 
            elseif(Auth()->user()->role_id == 3){
                return redirect()->route('monitorDashboard')->with('success', 'Welcome Monitor');
            } 
            else
                return redirect()->route('studentDashboard');  
            } 
        }
    

    public function logout()
    {
       Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logout successfully');
    }
    public function redirect()
    {
        if(isset($_GET['role_id']) && !empty($_GET['role_id']))
        {
            $role=$_GET['role_id'];
                $users = User::where('role_id',$role)->get();
        }
        else
        {
            $users = User::where('role_id','!=',1)->get(); 
        }
        $teacher = User::where('role_id',2)->get()->count();
        $monitor = User::where('role_id',3)->get()->count();
        $student = User::where('role_id',4)->get()->count();
        return view('dashboard', compact('users', 'teacher', 'monitor', 'student'));
    }

    public function attendance()
    {
      
        $existingAttendance = Attendance::where('user_id', Auth()->user()->id)
            ->where('date', Carbon::today())
            ->first();
        
        if (!$existingAttendance){
          
            Attendance::create([
                'user_id' => Auth()->user()->id,
                'date' => Carbon::today(),
                'timein' => Carbon::now()->format('H:i:s')
            ]);
            return back()->with('success', 'Attendance marked successfully');
        }else {
            return back()->with('error', 'Attendance already recorded for today!');
        }
    }

    public function attendanceUpdate()
    {
        $existingAttendance = Attendance::where('user_id', Auth()->user()->id)
        ->where('date', Carbon::today())
        ->first();
        if($existingAttendance)
        {
            if($existingAttendance->timeout == null)
            {
                $existingAttendance->update([
                    'timeout' => Carbon::now()->format('H:i:s')
                ]);
                return back()->with('success', 'Attendance recorded successfully!');
            }
            else
            {
                return back()->with('error', 'Attendance already recorded for today!');
            }
        }else
        {
            return back()->with('error', 'Please mark your attendance first!');
        }

    }
    public function teachersAttendance()
    {
        $teachers = User::where('role_id',2)->with('attendanceToday')->get();
      
        return view('teacherAttendance',compact('teachers'));
    }

    public function search(Request $req)
    {
       $data = User::where('name', 'like', '%'.$req->search.'%')->where('role_id','!=',1)->get();
       return response()->json($data);
    }
   
}
