<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\UserController;
Use App\Http\Controllers\dynamicAddress;

Use App\Http\Controllers\CustomerController;
Use App\Http\Controllers\ProjectController;
Use App\Http\Controllers\FreelancerController;
Use App\Http\Controllers\AdminController;
Use App\Http\Controllers\SearchController;
Use App\Http\Controllers\AttendanceController;
Use App\Http\Controllers\DepartmentController;
Use App\Http\Controllers\DesignationController;
Use App\Http\Controllers\NoticeController;
use App\Http\Controllers\HolydayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//user section
Route::get('/',[UserController::class,'home']);

Route::get('/user',[UserController::class,'index'])->name('user');

Route::get('/add-contact',[UserController::class,'add_contact']);

// get district
Route::get('/getDistrict/{id}',[dynamicAddress::class,'getDistrict']);

// get upzila
Route::get('/getUpzila/{id}',[dynamicAddress::class,'getUpzila']);

//get union
Route::get('/getUnion/{id}',[dynamicAddress::class,'getUnion']);

// live search
Route::get('searchajax',[SearchController::class,'search']);


// user.......................................
//add contact
Route::post('/submit-customer',[CustomerController::class,'submit_customer']);

//view contact 
Route::get('/view-contact',[CustomerController::class,'view_contact']);

//view view genarel contact 
Route::get('/view-genarel-contact',[CustomerController::class,'view_genarel_contact']);

// view lead
Route::get('/view-lead',[CustomerController::class,'view_lead']);

// view presentation
Route::get('/view-presentation',[CustomerController::class,'view_presentation']);

// view sales
Route::get('/view-sales',[CustomerController::class,'view_sales']);


//move to lead 
Route::get('/make-lead/{id}',[CustomerController::class,'make_lead']);

//move to presentation
Route::get('/make-presentation/{id}',[CustomerController::class,'make_presentation']);

//move to sales
Route::get('/make-sales/{id}',[CustomerController::class,'make_sales']);

// leave application 

Route::get('/leave',[HolydayController::class,'leave_application']);

// leave application 

Route::post('/submit-leave',[HolydayController::class,'submit_leave']);

// all leave application

Route::get('/all-leave',[HolydayController::class,'all_leave']);

// leave report

Route::get('/leave-report',[HolydayController::class,'leave_report']);


//end user................................... 

// super admin...........................................
//add-project type
Route::get('/add-project-type',[ProjectController::class,'add_project_type']);
// submit-project-type
Route::post('/submit-project-type',[ProjectController::class,'submit_project_type']);


//add-projects
Route::get('/add-project',[ProjectController::class,'add_project']);
// submit project
Route::post('/submit-project',[ProjectController::class,'submit_project']);


//view contact ...................................................
Route::get('/view-all-contact',[CustomerController::class,'view_all_contact']);

//view view genarel contact 
Route::get('/view-all-genarel-contact',[CustomerController::class,'view_all_genarel_contact']);

// view lead
Route::get('/view-all-lead',[CustomerController::class,'view_all_lead']);

// view presentation
Route::get('/view-all-presentation',[CustomerController::class,'view_all_presentation']);

// view sales
Route::get('/view-all-sales',[CustomerController::class,'view_all_sales']);

// add attendance
Route::any('add-attendance',[AttendanceController::class,'add_attendance']);

//submit attendance
Route::post('submit-attendance',[AttendanceController::class,'submit_attendance']);

// add freelancer 
Route::get('/add-freelancer',[FreelancerController::class,'add_freelancer']);

// submit freelancer 
Route::post('/submit-freelancer',[FreelancerController::class,'submit_freelancer']);

//get user
Route::get('/getUser/{id}',[FreelancerController::class,'getUser']);


// view admin list

Route::get('/admin-list',[AdminController::class,'admin_list']);

// add department
Route::get('add-department',[DepartmentController::class,'add_department']);

// submit department
Route::post('submit-department',[DepartmentController::class,'submit_department']);

// view department
Route::get('view-department',[DepartmentController::class,'view_department']);

// add designation
Route::get('add-designation',[DesignationController::class,'add_designation']);

// submit designation
Route::post('submit-designation',[DesignationController::class,'submit_designation']);

// view department
Route::get('view-designation',[DesignationController::class,'view_designation']);

//add notice
Route::get('add-notice',[NoticeController::class,'add_notice']);
Route::get('getUserid/{id}',[NoticeController::class,'getUserid']);
Route::post('submit-notice',[NoticeController::class, 'submit_notice']);


//end super admin..................................... 


// admin section.............................

// view user list
Route::get('/user-list',[AdminController::class,'user_list']);

// view all admin contact
Route::get('/view-all-admin-contact',[CustomerController::class,'view_all_admin_contact']);

//view all admin genarel contact
Route::get('/view-all-admin-genarel-contact',[CustomerController::class,'view_all_admin_genarel_contact']);

//view all admin lead
Route::get('/view-all-admin-lead',[CustomerController::class,'view_all_admin_lead']);

//view all admin presentation
Route::get('/view-all-admin-presentation',[CustomerController::class,'view_all_admin_presentation']);
//view-all-admin-sales
Route::get('/view-all-admin-sales',[CustomerController::class,'view_all_admin_sales']);

//holy day
Route::get('/holyday',[HolydayController::class,'holyday']);

// submit hoyday
Route::post('/submit-holiday',[HolydayController::class,'submit_holiday']);

// hoyday type
Route::get('/holyday-type',[HolydayController::class,'holyday_type']);

// submit hoyday type
Route::post('/submit-holiday-type',[HolydayController::class,'submit_holiday_type']);

Route::get('/leave-application',[HolydayController::class,'all_leave_application']);

// get getremainingholyday
Route::get('/getremainingholyday/{id}',[HolydayController::class,'getremainingholyday']);

// get getremainingholyday
Route::get('/leave-application-action/{id}/{status}',[HolydayController::class,'leave_application_action']);

// end admin section.................................

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
