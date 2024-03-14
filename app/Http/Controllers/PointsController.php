<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\PlaceBet;
use App\Models\User;

class PointsController extends Controller
{
    //function to delete points 
    public function deletePoints(Request $request, $id){
        $points = Points::find($id);
        if(!$points){
            return response()->json(['message' => 'Un authorised'], 404);
        }
        $points->delete();
        return response()->json(['message' => 'points deleted successfully'], 200);
    }

    //function to get total points
    public function getAlluserpoints(Request $request){
        $getAlluserpoints = Points::all();
        return response()->json(['points' => $getAlluserpoints]);
    }

    //function to allow users to view thier points
    public function getMyPoints(Request $request, $userid){
        $user = User::find($userid);
        if(!$user){
            return response()->json(['message' => 'Unauthorised access or something went wrong'], 404);
        }

        $mypoints = $user->mypoints;
        return response()->json(['my_points' => $mypoints ], 200);
    }
    
   

}
