<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
Use App\Models\user;

Use App\Models\Department;

class DepartmentController extends Controller
{
    //add department page
    public function add_department(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                return view('super-admin.depertment.add-department');
            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='0'){

                return redirect()->route('user');
            }
            else{
                Auth::logout();
                return redirect('login');
            }
        }
        else{
            return view('auth.login');
        }
    }

    // submit department
    public function submit_department(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $department = new Department;

                // get text data
                $department->name=$request->name;
                $department->details=$request->details;

                //save department
                $department->save();

                // return back add Department page and display success message..
                return redirect()->back()->with('success','New Department Added Successfully');
            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='0'){

                return redirect()->route('user');
            }
            else{
                Auth::logout();
                return redirect('login');
            }
        }
        else{
            return view('auth.login');
        }
    }

    // view department
    public function view_department(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $departments = Department::all();
                $serial = 1;
                
                return view('super-admin.depertment.view-department',compact('departments','serial'));
            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='0'){

                return redirect()->route('user');
            }
            else{
                Auth::logout();
                return redirect('login');
            }
        }
        else{
            return view('auth.login');
        }
    }
}
