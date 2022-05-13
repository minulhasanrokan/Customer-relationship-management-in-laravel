<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Illuminate\Support\Facades\Auth;

Use App\Models\Customer;
Use App\Models\Project;

Use App\Models\user;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request){
        if($request->ajax()){
            if (Auth::id()) {
                if(Auth::user()->type=='0'){
                    $user_id=Auth::user()->id;
                    $query = $request->get('search','');
                    $tabledata = Customer::select('id','name','email','phone')
                                ->where('user_id',$user_id)
                                ->where('phone','LIKE','%'.$query.'%')
                                ->get();
                    $getdata = $tabledata;
                    $data=array();
                    foreach($getdata as $tabledata){
                        $data[]=array('value'=>$tabledata->name,'id'=>$tabledata->id,'phone'=>$tabledata->phone);
                    }
                    if(count($data) && !empty( $query )){
                        $dataVal = '<ul style="margin-top: 15px; background: black; padding: 10px;" class="no-bullets" id="selectval">';
                        foreach($data as $key=>$value){
                            $dataVal .=  '<li><a href="details-contact/'.$value['id'].'">'.$value['value'].'-'.$value['phone'].'</a></li>';
                        }
                        $dataVal .='</ul>';
                    }
                    else{
                          $dataVal = '<ul id="selectval">';
                          $dataVal .=  '<li>No result found..!</li>';
                          $dataVal .='</ul>';
                        }
                    echo $dataVal;
                    exit();
                }
                elseif(Auth::user()->type=='1'){
                    $admin_id=Auth::user()->id;
                                        $query = $request->get('search','');
                    $tabledata = Customer::select('id','name','email','phone')
                                ->where('admin_id',$admin_id)
                                ->where('phone','LIKE','%'.$query.'%')
                                ->get();
                    $getdata = $tabledata;
                    $data=array();
                    foreach($getdata as $tabledata){
                        $data[]=array('value'=>$tabledata->name,'id'=>$tabledata->id,'phone'=>$tabledata->phone);
                    }
                    if(count($data) && !empty( $query )){
                        $dataVal = '<ul style="margin-top: 15px; background: black; padding: 10px;" class="no-bullets" id="selectval">';
                        foreach($data as $key=>$value){
                            $dataVal .=  '<li><a href="view-admin-details-contact/'.$value['id'].'">'.$value['value'].'-'.$value['phone'].'</a></li>';
                        }
                        $dataVal .='</ul>';
                    }
                    else{
                          $dataVal = '<ul id="selectval">';
                          $dataVal .=  '<li>No result found..!</li>';
                          $dataVal .='</ul>';
                        }
                    echo $dataVal;
                    exit();
                }
                elseif(Auth::user()->type=='2'){

                    $query = $request->get('search','');
                    $tabledata = Customer::select('id','name','email','phone')
                                 ->where('name','LIKE','%'.$query.'%')
                                 ->orwhere('phone','LIKE','%'.$query.'%')
                                 ->get();
                    $getdata = $tabledata;
                    $data=array();
                    foreach($getdata as $tabledata){
                        $data[]=array('value'=>$tabledata->name,'id'=>$tabledata->id,'phone'=>$tabledata->phone);
                    }
                    if(count($data) && !empty( $query )){
                        $dataVal = '<ul style="margin-top: 15px; background: black; padding: 10px;" class="no-bullets" id="selectval">';
                        foreach($data as $key=>$value){
                            $dataVal .=  '<li><a href="view-details-contact/'.$value['id'].'">'.$value['value'].'-'.$value['phone'].'</a></li>';
                        }
                        $dataVal .='</ul>';
                    }
                    else{
                          $dataVal = '<ul id="selectval">';
                          $dataVal .=  '<li>No result found..!</li>';
                          $dataVal .='</ul>';
                        }
                    echo $dataVal;
                    exit();
                }
            }
        }
    }
}
