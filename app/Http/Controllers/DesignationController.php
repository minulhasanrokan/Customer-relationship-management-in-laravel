<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
Use App\Models\user;
use Illuminate\Http\Request;
Use App\Models\Designation;

class DesignationController extends Controller
{
        //add designation page
    public function add_designation(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                return view('super-admin.designation.add-designmation');
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

    // submit designation
    public function submit_designation(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $designation = new Designation;

                // get text data
                $designation->name=$request->name;
                $designation->details=$request->details;

                //save designation
                $designation->save();

                // return back add designation page and display success message..
                return redirect()->back()->with('success','New Designation Added Successfully');
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

    // view designation
    public function view_designation(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $designations = Designation::all();
                $serial = 1;
                
                return view('super-admin.designation.view-designation',compact('designations','serial'));
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
