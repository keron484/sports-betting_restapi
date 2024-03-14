<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freebetconditions;
class FreebetcondtionsController extends Controller
{
    //function to create condtion
    public function createCondition(Request $request){
         $request->validate([
            'active' => 'required',
            'min_odds' => 'required|numeric',
            'min_numevents' => 'required|numeric',
            'min_numwager' => 'required|numeric'
         ]);

         $condition = new Freebetconditions();
         $condition->active = $request->active;
         $condition->min_odds = $request->min_odds;
         $condition->min_numevents = $request->min_numevents;
         $condition->min_numwager = $request->min_numwager;

         $condition->save();

         return response()->json(['message' => 'Condition created succesfully'], 200);
    }

    //function to update condtion
    public function updateCondtion(Request $request, $id){
         $condition = Freebetconditions::find($id);
         if(!$condition){
            return response()->json(['message' => 'something went wrong'], 404);
         }

         $condition->active = $request->input('active');
         $condition->min_odds = $request->input('min_odds');
         $condition->min_numevents = $request->input('min_numevents');
         $condition->min_numwager = $request->input('min_numwager');

         return response()->json(['message' => 'Updated succesfully'], 200);
    }
    
    //function to delete condition
    public function deleteCondition(Request $request, $id){
        $condition = Freebetconditions::find($id);
        if(!$condition){
            return response()->json(['message' => 'Somethin went wrong'], 404);
        }
        $condition->delete();
    }

    //function to getcondtion

    public function getCondtion(Request $request){
        $condition = Freebetconditions::all();
        return response()->json(['freebet_condition' => $condition], 200);
    }
}
