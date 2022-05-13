<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Illuminate\Support\Facades\Auth;

Use App\Models\user;

Use App\Models\ProjectType;
Use App\Models\Project;

class ProjectController extends Controller
{
    //add project type 
    public function add_project_type(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                return view('super-admin.project.add-project-type');
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

    // add project type
    public function submit_project_type(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $project_type = new ProjectType;

                $project_type->project_type=$request->project_type;

                //save project type
                $project_type->save();

                // return back add project type page and display success message..
                return redirect()->back()->with('success','New Project Type Added Successfully');
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

    // add project page
    public function add_project(){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){

                $project_types = ProjectType::all();
                return view('super-admin.project.add-project',compact('project_types'));
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
    //submit project
    public function submit_project(Request $request){
        if (Auth::id()) {
            if(Auth::user()->type=='2'){
                $project= new Project;

                // file validation...
                if ($request->photo==true) {
                    $image = $request->photo;
                    $imageName=time().'.'.$image->getClientoriginalExtension();
                    $request->photo->move('project_3d',$imageName);
                    $project->photo=$imageName;
                }

                if ($request->brochure==true) {
                    $brochure = $request->brochure;
                    $brochureName=time().'.'.$brochure->getClientoriginalExtension();
                    $request->brochure->move('project_brochure',$brochureName);
                    $project->brochure=$brochureName;
                }

                if ($request->video==true) {
                    $video = $request->video;
                    $videoName=time().'.'.$video->getClientoriginalExtension();
                    $request->video->move('project_videoName',$videoName);
                    $project->video=$videoName;
                }

                $project->name=$request->name;
                $project->type=$request->type;
                $project->address=$request->address;
                $project->flat=$request->flat;
                $project->shop=$request->shop;
                $project->garage=$request->garage;
                $project->details=$request->details;

                //save customer
                $project->save();

                // return back add customer page and display success message..
                return redirect()->back()->with('success','New Project Added Successfully');
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
