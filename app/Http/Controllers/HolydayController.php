<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\user;
Use Illuminate\Support\Facades\Auth;
use App\Models\Holyday;
use Carbon\Carbon;
Use App\Models\HolydayType;
Use App\Models\LeaveApplication;


class HolydayController extends Controller
{
    //holyday
    public function holyday(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                return view('super-admin.leave.holyday');
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
     
    //submit holyday
    public function submit_holiday(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $holyday = new Holyday;

                // get  data
                $holyday->holiday_name=$request->name;
                
                $fdate=$request->start_date;
                $tdate=$request->end_date;

                $holyday->from_date=$fdate;
                $holyday->to_date=$tdate;

                $diff = strtotime($fdate) - strtotime($tdate);
                $day_number = abs(round($diff / 86400));

                $day_number = $day_number+1;

                $year = Carbon::createFromFormat('Y-m-d', $fdate)->format('Y');
  
                $holyday->number_of_days=$day_number;

                $holyday->year=$year;

                //save holyday
                $holyday->save();

                // return back add holyday page and display success message..
                return redirect()->back()->with('success','New Holyday Added Successfully');

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

    // holy day type
    public function holyday_type(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                return view('super-admin.leave.holyday-type');
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

    // submit holyday type
    public function submit_holiday_type(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $holydaytype = new HolydayType;

                // get  data
                $holydaytype->name=$request->name;
                $holydaytype->leave_day=$request->total_day;
                $holydaytype->status=$request->Status;

                //save holyday type
                $holydaytype->save();

                // return back add holyday page and display success message..
                return redirect()->back()->with('success','New Holyday Type Added Successfully');

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

    //user section
    //leave application
    public function leave_application(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){

                $holydayTypes = HolydayType::all();
                return view('user.leave.leave',compact('holydayTypes'));
            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='2'){

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

    //get getremainingholyday
    public function getremainingholyday($id){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                
                $user_id=Auth::user()->id;
                
                $days = LeaveApplication::where('user_id',$user_id)
                        ->where('leave_type',$id)
                        ->get();
                
                $totalday = 0;
                
                foreach($days as $day){
                    $totalday = $totalday+$day->total_date;
                }

                $holydaytypes = HolydayType::where('id',$id)
                                ->get();

                $totalholydaytypes = 0;
                
                foreach($holydaytypes as $holydaytype){
                    $totalholydaytypes = $totalholydaytypes+$holydaytype->leave_day;
                }

                $RemainingHolyday = $totalholydaytypes-$totalday;
                
                return response()->json($RemainingHolyday);

            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='2'){

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

    // submit leave application 

    public function submit_leave(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){

                $leaveApplication = new LeaveApplication;

                $user_id=Auth::user()->id;
                $leaveApplication->user_id = $user_id;

                $RemainingHolyday = $request->RemainingHolyday;

                $leaveApplication->Start_date = $start_date = $request->start_date;
                $leaveApplication->end_date = $end_date = $request->end_date;


        
                $diff = strtotime($end_date) - strtotime($start_date);
                $day_number = abs(round($diff / 86400));

                $leaveApplication->total_date = $day_number = $day_number+1;


                $leaveApplication->leave_type = $request->holydaytype_id;
                $leaveApplication->resion = $request->leave_resion;

                if ($RemainingHolyday>=$day_number && $RemainingHolyday>0) {
                    
                    //save
                    $leaveApplication->save();

                    return redirect()->back()->with('message','Leave Application Submitted Successfully'); 
                }
                elseif($RemainingHolyday<$day_number){

                    return redirect()->back()->with('message','You Have Not Enough Leave That You want to Take'); 
                }
                elseif($RemainingHolyday<=0){
                    return redirect()->back()->with('message','You Have Not Enough Leave'); 
                }

            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='2'){

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

    // all leave

    public function all_leave(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){

                $user_id=Auth::user()->id;

                $holydayTypes = HolydayType::all();

                $all_leaves = LeaveApplication::where('user_id',$user_id)
                        ->get();
                
                return view('user.leave.all-leave',compact('all_leaves','holydayTypes'));
            }
            elseif(Auth::user()->type=='1'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='2'){

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

    // view user leave application in super admin section
    public function all_leave_application(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $holydayTypes = HolydayType::all();
                
                $all_leaves = LeaveApplication::all();
                
                $all_users = user::where('type',0)
                            ->get();

                return view('super-admin.leave.leave-application',compact('holydayTypes','all_leaves','all_users'));

            }
            elseif(Auth::user()->type=='0'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='1'){

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

    // Approve Or Un Approve leave application in super admin section
    public function leave_application_action($id, $status){
         if (Auth::id()) {
            if(Auth::user()->type=='2'){
                if ($status=='Approve') {

                    $id = $id;

                    // Update value
                    $updateApplication = LeaveApplication::where('id',$id)
                        ->update([
                            'status' => 2,
                        ]);

                    // update condition
                    if($updateApplication==true) {
                        // return back add view contact page and display success message..
                        return redirect()->back()->with('success','Leave Application Approved Successfully');
                    }
                    else{
                    
                        // return back add view contact page and display error message..
                        return redirect()->back()->with('error','Action Not Complitated');   
                    }
                }
                elseif($status=='unApprove'){

                    $id = $id;

                    // Update value
                    $updateApplication = LeaveApplication::where('id',$id)
                        ->update([
                            'status' => 1,
                        ]);

                    // update condition
                    if($updateApplication==true) {
                        // return back add view contact page and display success message..
                        return redirect()->back()->with('success','Leave Application Un Approved Successfully');
                    }
                    else{
                    
                        // return back add view contact page and display error message..
                        return redirect()->back()->with('error','Action Not Complitated');   
                    }

                }
                 elseif($status=='Pending'){

                    $id = $id;

                    // Update value
                    $updateApplication = LeaveApplication::where('id',$id)
                        ->update([
                            'status' => 0,
                        ]);

                    // update condition
                    if($updateApplication==true) {
                        // return back add view contact page and display success message..
                        return redirect()->back()->with('success','Leave Application Un Pending Successfully');
                    }
                    else{
                    
                        // return back add view contact page and display error message..
                        return redirect()->back()->with('error','Action Not Complitated');   
                    }

                }
                else{

                }

            }
            elseif(Auth::user()->type=='0'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='1'){

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

    // get all leave report 

    public function leave_report(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $allUsers = User::where('type',0)
                        ->where('status',1)
                        ->get();
                return view('super-admin.leave.leave-report',compact('allUsers'));
            }
            elseif(Auth::user()->type=='0'){
                return redirect()->route('user');
            }
            elseif(Auth::user()->type=='1'){

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
