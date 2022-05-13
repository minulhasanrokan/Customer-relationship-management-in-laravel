<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Illuminate\Support\Facades\Auth;

Use App\Models\user;

class AdminController extends Controller
{
    //super admin section.........................................
    //view admin list
    public function admin_list(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                $admins = User::where('type',1)
                            ->get();
                return view('super-admin.admin.admin',compact('admins'));
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
    // end super admin section.............................

    // start admin section.................

    // view user list

    public function user_list(){
        if (Auth::id()) {
            if(Auth::user()->type=='1'){

                $admin_id=Auth::user()->id;
                $users = User::where('type',0)
                        ->where('adminId',$admin_id)
                            ->get();
                return view('admin.user.user',compact('users'));
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
    // end admin section.............
}
