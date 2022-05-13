<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;

Use App\Models\user;
Use App\Models\Department;
Use App\Models\Designation;
Use Carbon\Carbon; 
Use App\Models\Attendance;
Use DB;

class AttendanceController extends Controller
{
    // add attendance
    public function add_attendance( Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){


                $department_id = $request->department;
                $date = $request->date;

                $attendances = Attendance::where('attendence_date',$date)
                            ->get();
                $attendance_id = [];
                foreach($attendances as $attendance){
                    $attendance_id[]=$attendance->user_id;
                }
                $users = User::where('department',$department_id)
                        ->whereNotIn('id',  $attendance_id)
                        ->get();
                $departments = Department::all();
                $designations = Designation::all();
                $serial = 1;
                return view('super-admin.attendance.add-attendance',compact('departments','users','serial','date','department_id','designations','attendances'));
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

    // submit attendance
    public function submit_attendance(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                //dd($request->all());
                 $Attendance = new Attendance;

                $date = $request->date;
                $user_id = $request->user_id;
                $in_time = $request->in_time;
                $out_time = $request->out_time;
                $status = $request->status;
                for ($i=0; $i <count($user_id) ; $i++) {
                    if ($status[$i]==true) {
                        $date_save = [
                            'user_id'=>$user_id[$i],
                            'attendence_date'=>$date[$i],
                            'in_time'=>$in_time[$i],
                            'out_time'=>$out_time[$i],
                            'attendence_status'=>$status[$i],
                            'created_at'=>$date[$i],
                        ];
                        DB::table('attendances')->insert($date_save);
                    }
                }
                // return back add add attendance page and display success message..
                return redirect()->back()->with('success','attendance Added Successfully');

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
