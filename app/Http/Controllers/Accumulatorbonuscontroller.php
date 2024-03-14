<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccumulatorBonus;
class Accumulatorbonuscontroller extends Controller
{
    
    //function to get accumulator bonus
    public function getAccumulatorBonus(Request $request){
      $conditions = AccumulatorBonus::all();
       return response()->json(['acc_conditions' => $conditions]);
    }

    //function to create bonus
    public function createAccumulatorbonus(Request $request){
        $request->validate([
            'status' => ['required'],
            'min_odds' => ['required', 'numeric'],
            'bonus_percentage' => ['required', 'numeric']
        ]);
        
        $condition = new AccumulatorBonus();
        $condition->status = $request->status;
        $condition->min_odds = $request->min_odds;
        $condition->bonus_percentage = $request->bonus_percentage;

        $condition->save();

        return response()->json(['message' => 'Accumulator bonus condition has been created succesfully'], 200);
    }

    //function to update bonus
    public function updateAccumulatorBonus(Request $request, $id){
        $condition = AccumulatorBonus::find($id);
        if(!$condition){
            return response()->json(['message' => 'Unauthurised access or netwoerk error'], 404);
        }
        $condition->status = $request->input('status');
        $condition->min_odds = $request->input('min_odds');
        $condition->bonus_percentage = $request->input('bonus_percentage');

        return response()->json(['message' => 'updated succesfully'], 200);
    }

    //function to delete bonus
    public function deleteBonus(Request $request, $id){
        $condition = AccumulatorBonus::find($id);
        if(!$condition){
            return response()->json(['message' => 'Network error or something went wrong'], 404);
        }
        $condition->delete();
        return response()->json(['message' => 'succesfully deleted'], 200);
    }
}
