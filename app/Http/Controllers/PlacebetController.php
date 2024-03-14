<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlaceBet;
use App\Models\User;

class PlacebetController extends Controller
{ 
    // function which allows users to place bets 
    public function placeBet(Request $request){

        $request->validate([
             'stake' => 'numeric|min:1',// you can set the max betting amount later
             'potential_winnings' => 'numeric|min:1',
             'num_events' => 'numeric|min:1|max:50',
             'status' => 'required',
             'selections' => 'required',
             'bonus' => 'numeric|min:1',
             'type' => 'required',
             'total_odds' => 'required|numeric|min:0',
             'user_id' => 'required'
        ]);
         $user = User::find($request->user_id);

         if(!$user) {
            return response()->json(['error' => 'user Not found'], 404);
         }

         $stake = $request->input('stake');

         if($user->account_balance < $stake){
            return response()->json(['error' => 'Insufficient Balance'], 400);
         }

         $user->account_balance -= $stake;

         $user->save();

          PlaceBet::create([
            'stake' => $request->stake,
            'potential_winnings' => $request->potential_winnings,
            'num_events' => $request->num_events,
            'status' => $request->status,
            'selections' => $request->selections,
            'bonus' => $request->bonus,
            'type' => $request->type,
            'total_odds' => $request->total_odds,
            'user_id' => $request->user_id
         ]);

         return response()->json(['message' => 'Bet placed successfully'], 200);

    }

    //function to delete bet slip
    public function deleteBetHistory(Request $request, $id){
        $bethistory = PlaceBet::find($id);
        if(!$bethistory){
          return response()->json(['message' => 'bethistory not found'], 404);
        }

        $bethistory->delete();

        return response()->json(['message' => 'bet history deleted sucessfully'], 200);
    }

    //function to get user bet history
    public function getUserBethistory(Request $request, $userid){
      $user = User::find($userid);
      if(!$user){
          return response()->json(['message' => 'user not found'], 404);
      }
      $bethistory = $user->Mybets;

      return response()->json(['bet_history' => $bethistory], 200);
    }

    //function to update betslip
   // public function updateBetslip(){

    //}

    //function to get all bets placed 

    public function getAllbetsplaced(Request $request){
       $allbetplaced = PlaceBet::all();
       return response()->json(['all_bets_palced' => $allbetplaced]);
    }

    //function to validate betslip

}
