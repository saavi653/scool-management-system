<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\RoleId;
use App\Models\StudentSubject;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function createFeature()
    {
        $features =Feature::get();
        return view('feature',compact('features'));
    }

    public function store(Request $req)
    {
        $attributes = $req->validate([
            'name' => 'required'
        ]);
        Feature::create($attributes);
        return back()->with('success','Feature added successfully');
    }

    public function createPermission()
    {
        $features = Feature::get();
        $roles = RoleId::where('id','!=', config('constants.ADMIN'))->get();
        return view('permission',compact('features', 'roles'));
    }

    public function storePermission(Request $req)
    {
        $attributes = $req->validate([
            'permission' => 'required'
        ]);
        
        Permission::truncate();
        foreach($attributes['permission'] as $attribute)
        {
            $per =explode('_',$attribute);
           
           $permission = new Permission();
           $permission->role_id = $per[0];
           $permission->feature_id = $per[1];
           $permission->save();

        }
       
        return back()->with('success','permission granted successfully');
    }

    public function checkedPermission()
    {
        $permission = Permission::get()->toArray();
        
        foreach($permission as $per)
        {
           $response[]=$per['role_id'].'_'.$per['feature_id'];
        } 

        return response()->json($response);
    }
}
