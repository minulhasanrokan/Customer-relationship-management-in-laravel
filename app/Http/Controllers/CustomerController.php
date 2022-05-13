<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Illuminate\Support\Facades\Auth;

Use App\Models\Customer;
Use App\Models\Project;

Use App\Models\user;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // add customer
    public function submit_customer(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
        
                $customer = new customer;

                // get text data
                $customer->name=$request->name;
                $customer->phone=$request->phone;
                $customer->email=$request->email;
                $customer->fl_id=$request->fl_id;
                $customer->project_id=$request->project_id;
                $customer->division_id=$request->division_id;
                $customer->district_id=$request->district_id;
                $customer->upzilla_id=$request->upzilla_id;
                $customer->union_id=$request->union_id;
                $customer->village=$request->village;
                $customer->home=$request->home;
                $customer->profession=$request->profession;
                $customer->income=$request->income;

                // set default status
                $customer->status=0;

                //get user id
                $customer->user_id=Auth::user()->id;
                $customer->admin_id=Auth::user()->adminId;

                // get image or file
                
                if ($request->photo==true) {
                    $image = $request->photo;
                    $imageName=time().'.'.$image->getClientoriginalExtension();
                    $request->photo->move('photo',$imageName);
                    $customer->photo=$imageName;
                }
                if ($request->nid==true) {
                    $nid = $request->nid;
                    $nidName=time().'.'.$nid->getClientoriginalExtension();
                    $request->nid->move('nid',$nidName);
                    $customer->nid=$nidName;
                }
                if ($request->document==true) {
                    $document = $request->document;
                    $documentName=time().'.'.$document->getClientoriginalExtension();
                    $request->document->move('document',$documentName);
                    $customer->document=$documentName;
                }


                //save customer
                $customer->save();

                // return back add customer page and display success message..
                return redirect()->back()->with('success','New Customer Added Successfully');
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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
    // view  all contact
    public function view_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){

                $user_id=Auth::user()->id;
                
                $contacts = Customer::where('user_id',$user_id)
                                    ->where('status',0)
                                    ->get();
                $projects = Project::all();
                return view('user.customer.view-contact',compact('contacts','projects'));
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // view genarel contact

    public function view_genarel_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id=Auth::user()->id;
                
                $contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('user.customer.view-genarel-contact',compact('contacts','projects'));
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // view lead
    public function view_lead(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id=Auth::user()->id;
                
                $contacts = Customer::where('user_id',$user_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('user.customer.view-lead',compact('contacts','projects'));
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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


    // view presentation
    public function view_presentation(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id=Auth::user()->id;
                
                $contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('user.customer.view-presentation',compact('contacts','projects'));
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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
    
    // view sales
    public function view_sales(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id=Auth::user()->id;
                
                $contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('user.customer.view-sales',compact('contacts','projects'));
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // make lead
    public function make_lead($id){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
        
                //get user id
                $user_id=Auth::user()->id;

                // get value
                $contact = Customer::where('user_id',$user_id)
                    ->where('id',$id)
                    ->update([
                        'presentation' => 0,
                        'lead' => 1,
                        'sales'=>0,
                        'lead_time'=>Carbon::now()

                    ]);

                // upda condition
                if($contact==true) {
                    
                    // return back add view contact page and display success message..
                    return redirect()->back()->with('success','Contact Successfully move to Lead Section');
                }
                else{
                    
                    // return back add view contact page and display error message..
                    return redirect()->back()->with('error','Contact Not Found in Data Base');   
                }
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // move to presentation

    public function make_presentation($id){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                //get user id
                $user_id=Auth::user()->id;

                // get value
                $contact = Customer::where('user_id',$user_id)
                    ->where('id',$id)
                    ->update([
                        'presentation' => 1,
                        'lead' => 0,
                        'sales'=>0,
                        'lead_time'=>null,
                        'presentation_time'=>Carbon::now()
                    ]);

                // upda condition
                if($contact==true) {
                    
                    // return back add view contact page and display success message..
                    return redirect()->back()->with('success','Contact Successfully move to Presentation Section');
                }
                else{
                    
                    // return back add view contact page and display error message..
                    return redirect()->back()->with('error','Contact Not Found in Data Base');   
                }
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // move to sales 
    public function make_sales($id){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                //get user id
                $user_id=Auth::user()->id;

                // get value
                $contact = Customer::where('user_id',$user_id)
                    ->where('id',$id)
                    ->update([
                        'presentation' => 0,
                        'lead' => 0,
                        'sales'=>1,
                        'lead_time'=>null,
                        'presentation_time'=>null,
                        'sales_time'=>Carbon::now()
                    ]);

                // upda condition
                if($contact==true) {
                    
                    // return back add view contact page and display success message..
                    return redirect()->back()->with('success','Contact Successfully move to Sales Section');
                }
                else{
                    
                    // return back add view contact page and display error message..
                    return redirect()->back()->with('error','Contact Not Found in Data Base');   
                }
            }
            elseif (Auth::user()->type=='1') {
                return redirect()->route('user');
            }
            elseif (Auth::user()->type=='2') {
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

    // super admin section

    // view all contact

    public function view_all_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $contacts = Customer::where('status',0)
                                    ->get();
                $projects = Project::all();
                return view('super-admin.customer.view-contact',compact('contacts','projects'));
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
    
    // view all genarel contact
    public function view_all_genarel_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
        
                $contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('super-admin.customer.view-genarel-contact',compact('contacts','projects'));
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

    //view all lead
    public function view_all_lead(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
        
                $contacts = Customer::where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('super-admin.customer.view-lead',compact('contacts','projects'));
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

    // view all presentation
    public function view_all_presentation(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
        
                $contacts = Customer::where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('super-admin.customer.view-presentation',compact('contacts','projects'));
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

    // view all sales
    public function view_all_sales(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
        
                $contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                return view('super-admin.customer.view-sales',compact('contacts','projects'));
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

    // start admin section.......................................
    
    // view all admin contact list
    public function view_all_admin_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){

                $admin_id=Auth::user()->id;
                $contacts = Customer::where('admin_id',$admin_id)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.customer.view-contact',compact('contacts','projects','users'));

            }
            elseif(Auth::user()->type=='0'){
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
            return view('auth.login');
        }

    }

    // view all admin genarel contact
    public function view_all_admin_genarel_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){
                $admin_id=Auth::user()->id;
                $contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.customer.view-genarel-contact',compact('contacts','projects','users'));

            }
            elseif(Auth::user()->type=='0'){
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
            return view('auth.login');
        }
    }

    // view all admin lead
    public function view_all_admin_lead(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){
                $admin_id=Auth::user()->id;
                $contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.customer.view-lead',compact('contacts','projects','users'));
            }
            elseif(Auth::user()->type=='0'){
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
            return view('auth.login');
        }
    }

    // view all admin presentation
    public function view_all_admin_presentation(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){
                $admin_id=Auth::user()->id;
                $contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.customer.view-presentation',compact('contacts','projects','users'));
            }
            elseif(Auth::user()->type=='0'){
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
            return view('auth.login');
        }
    }

    // view all admin  sales
    public function view_all_admin_sales(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){
                $admin_id=Auth::user()->id;
                $contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $projects = Project::all();
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.customer.view-sales',compact('contacts','projects','users'));
            }
            elseif(Auth::user()->type=='0'){
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
            return view('auth.login');
        }
    }

    // end admin section.......................................
}
