<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
Use Illuminate\Support\Facades\Auth;

Use App\Models\Freelancer;

Use App\Models\user;
use Carbon\Carbon;

class FreelancerController extends Controller
{
    // super admin section.......................................
    // add freelancer
    public function add_freelancer(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                $divisions = Division::all();
                $admins = User::where('type',1)
                            ->get();
                return view('super-admin.freelancer.add-freelancer',compact('divisions','admins'));
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
    
    //get user
    public function getUser($id){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                $user_id = User::where('adminId',$id)
                            ->pluck("name", "id");
                return response()->json($user_id);
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

    //submit freelancer
    public function submit_freelancer(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $freelancer = new Freelancer;
                // get text data
                $freelancer->name=$request->name;
                $freelancer->phone=$request->phone;
                $freelancer->email=$request->email;
                $freelancer->fl_id=$request->fl_id;
                $freelancer->division_id=$request->division_id;
                $freelancer->district_id=$request->district_id;
                $freelancer->upzilla_id=$request->upzilla_id;
                $freelancer->union_id=$request->union_id;
                $freelancer->village=$request->village;
                $freelancer->home=$request->home;
                $freelancer->profession=$request->profession;
                $freelancer->income=$request->income;

                // set default status
                $freelancer->status=0;

                //get user id
                $freelancer->user_id=$request->user_id;
                $freelancer->admin_id=$request->admin_id;

                // get image or file
                
                if ($request->photo==true) {
                    $image = $request->photo;
                    $imageName=time().'.'.$image->getClientoriginalExtension();
                    $request->photo->move('photo',$imageName);
                    $freelancer->photo=$imageName;
                }
                if ($request->nid==true) {
                    $nid = $request->nid;
                    $nidName=time().'.'.$nid->getClientoriginalExtension();
                    $request->nid->move('nid',$nidName);
                    $freelancer->nid=$nidName;
                }

                //save freelancer
                $freelancer->save();

                // return back add freelancer page and display success message..
                return redirect()->back()->with('success','New freelancer Added Successfully');
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
    // end super admin section.......................................
}
