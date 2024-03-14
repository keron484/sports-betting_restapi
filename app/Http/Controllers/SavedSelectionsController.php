<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSelections;
use App\Models\User;
class SavedSelectionsController extends Controller
{

    //function to  save selections or picks by the user
    public function savedBetsSelections(Request $request){
        $request->validate([
             'user_id' => 'required',
             'count' => 'required|min:1|max:50',
             'type' => 'required',
             'total_odds' => 'required|numeric|min:0',
             'selections' => 'required'
        ]);
        $user = User::find($request->user_id);
        if(!$user){
            return response()->json(['message' => 'User is not found'], 404);
        }
       
        $savedselection = new SavedSelections();
        $savedselection->user_id = $request->user_id;
        $savedselection->count = $request->count;
        $savedselection->type = $request->type;
        $savedselection->total_odds = $request->total_odds;
        $savedselection->selections = $request->selections;

        $savedselection->save();

        return response()->json(['message' => 'Selections saved successfully'], 200);
    }

    //function to get saved selections
    public function getSavedSelections(Request $request, $id){
       $code = SavedSelections::find($id);
       if(!$code){
         return response()->json(['message' => 'Code invalide or Not found'], 404);
       }

       return response()->json(['saved_selections' => $code]);
    }

    //funciton to get all saved selections
    public function getAllsavedSelections(Request $request){
        $savedPicks = SavedSelections::all();
        return response()->json(['all_saved_selections' => $savedPicks], 200);
    }

    //function to delete saved selections
    public function deleteSavedselections(Request $request, $id){
        $savedselection = SavedSelections::find($id);
        if(!$savedselection){
            return response()->json(['message' => 'not found'], 404);
        }
        $savedselection->delete();

        return response()->json(['message' => 'Saved selection deleted successfully'], 200);
    }
}
