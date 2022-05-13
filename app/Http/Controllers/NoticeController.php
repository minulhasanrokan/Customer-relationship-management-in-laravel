<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;

Use App\Models\user;
Use App\Models\Department;
Use App\Models\Notice;

class NoticeController extends Controller
{
    // add notice page
    public function add_notice(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $departments = Department::all();
                $users = User::where('type','!=',2)
                        ->get();
                return view('super-admin.notice.add-notice',compact('departments','users'));
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
            Auth::logout();
            return redirect('login');
        }
    }

    // get user list by department
    public function getUserid($id){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                
                $user_id = User::where('department',$id)
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
            Auth::logout();
            return redirect('login');
        }
    }
    // submit notice
    public function submit_notice(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                
                $notice = new notice;

                // get text data
                $notice->department_id=$request->department_id;
                $notice->employee_id=$request->employee_id;
                $notice->date=$request->date;
                $notice->title=$request->title;
                $notice->details=$request->details;

                // get image or file
                
                if ($request->file==true) {
                    $file = $request->file;
                    $fileName=time().'.'.$file->getClientoriginalExtension();
                    $request->file->move('notice',$fileName);
                    $notice->file=$fileName;
                }
                //save customer
                $notice->save();

                // return back add customer page and display success message..
                return redirect()->back()->with('success','New notice Added Successfully');

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
            Auth::logout();
            return redirect('login');
        }
    }
}
