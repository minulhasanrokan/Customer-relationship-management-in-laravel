<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use DB;

class dynamicAddress extends Controller
{
    public function getDistrict($id)
    {
        $district_id = DB::table("districts")
            ->where("division_id", $id)
            ->pluck("name", "id");
        return response()->json($district_id);
    }
    public function getUpzila($id){

        $upzilla_id = DB::table("upazilas")
            ->where("district_id", $id)
            ->pluck("name", "id");
        return response()->json($upzilla_id);
    }

    public function getUnion($id){
        $union_id = DB::table("unions")
            ->where("upazilla_id", $id)
            ->pluck("name", "id");
        return response()->json($union_id);
    }
}
