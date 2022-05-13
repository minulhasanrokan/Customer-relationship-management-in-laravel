<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;

Use App\Models\Project;
Use App\Models\Freelancer;
Use App\Actions\user;
Use App\Models\Customer;

class UserController extends Controller
{
    public function home(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id = Auth::id();
                // contact section.....
                $all_contacts = Customer::where('user_id',$user_id)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('user.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
            }
            elseif (Auth::user()->type=='1') {
                $admin_id = Auth::id();
                // contact section.....
                $all_contacts = Customer::where('admin_id',$admin_id)
                            ->where('status',0)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('admin.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
            }
            elseif (Auth::user()->type=='2') {
                // contact section.....
                $all_contacts = Customer::where('status',0)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('super-admin.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
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

    public function index(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id = Auth::id();
                // contact section.....
                $all_contacts = Customer::where('user_id',$user_id)
                            ->where('status',0)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('user_id',$user_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('user.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
            }
            elseif (Auth::user()->type=='1') {
                $admin_id = Auth::id();
                // contact section.....
                $all_contacts = Customer::where('admin_id',$admin_id)
                            ->where('status',0)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('admin_id',$admin_id)
                            ->where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('admin.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
            }
            elseif (Auth::user()->type=='2') {
                // contact section.....
                $all_contacts = Customer::where('status',0)
                            ->get();
                $count_all_contacts = count($all_contacts);

                $general_contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_general_contacts = count($general_contacts);

                $lead_contacts = Customer::where('lead',1)
                            ->where('presentation',0)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_lead_contacts = count($lead_contacts);

                $presentation_contacts = Customer::where('lead',0)
                            ->where('presentation',1)
                            ->where('sales',0)
                            ->where('status',0)
                            ->get();
                $count_presentation_contacts = count($presentation_contacts);

                $sales_contacts = Customer::where('lead',0)
                            ->where('presentation',0)
                            ->where('sales',1)
                            ->where('status',0)
                            ->get();
                $count_sales_contacts = count($sales_contacts);
                // end contact section.......
                
                return view('super-admin.home',compact('count_general_contacts','count_all_contacts','count_lead_contacts','count_presentation_contacts','count_sales_contacts'));
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
    public function add_contact(){
        if (Auth::id()) {
            if(Auth::user()->type=='0'){
                $user_id = Auth::user()->id;
                $freelancers = Freelancer::where('user_id',$user_id)
                    ->get();
                $divisions = Division::all();
                $projects = Project::all();

                return view('user.customer.add-contact',compact('divisions','projects','freelancers'));
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
            return view('auth.login');
        }
    }
}
