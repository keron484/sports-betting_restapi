<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Freebets;
use App\Models\PlaceBet;
use App\Models\User;
use App\Rules\FreebetselectionRule;
class freebetsController extends Controller
{
     //function to get all free generated promo codes
    public function getAllfreebetpromocode(Request $request){
       $getAllfreebets = Freebets::all();
        return response()->json(['free_bets_promocode' => $getAllfreebets], 200);
    }

    //function to place free bets
    public function placeFreebet(Request $request, $code, $user_id){
        $request->validate([
            'user_id' => 'required',//the user_id is required for added security
            'num_events' => 'required|numeric|min:7',//minimum number of events on the slip must be above 7
            'status' => 'required|string',//status of the bet slip which can take three values <---Accepted, Won, Loss--->
            'potential_winnings' => 'required|numeric',
            'selections' => ['required', 'array',  new FreebetselectionRule],
            'total_odds' => 'required|numeric'
        ]);
       
      //checking if the user exist 
      $user = User::find($user_id);
       if(!$user){
          return response()->json(['message' => 'User not found or network error'], 400);
       }

       //checking if the coupon code exist for that particular user
       $freebetcode = Freebets::where('user_id', $user_id)->where('id', $code)->first();
       if(!$freebetcode){
          return response()->json(['message' => 'Invalid code or network error'], 404);
       }

       //checking if the code has expired
       if(now() > $freebetcode->expire_date){
           return response()->json(['message' => 'Code is no longer valid or has expired'], 404);
       }

       //calculating the potential winnings based on the value of the freebet code and the odds

       $stake = $freebetcode->value;
       $potential_winnings = $stake * $request->total_odds;
      
       //placing the free bet with the about credentials
       $placefreeBet = new PlaceBet();
       $placefreeBet->user_id = $user_id;
       $placefreeBet->num_events = $request->num_events;
       $placefreeBet->status = $request->status;
       $placefreeBet->type = $request->type;
       $placefreeBet->total_odds = $request->total_odds;
       $placefreeBet->selections = $request->selections;
       $placefreeBet->stake = $stake;
       $placefreeBet->potential_winnings = $potential_winnings;
       $placefreeBet->save();

       //deleting the freebet code if the bet has been successfully created 
       $freebetcode->delete();
      
        return response()->json(['message' => 'Bet has placed succesfully'], 200);
    }

    //function to delete free bet code
    public function deleteFreebet(Request $request, $id){
        $freebet = Freebets::find($id);
        if(!$freebet){
            return response()->json(['message' => 'Free bet promo code not found'], 404);
        }
      
        $freebet->delete();
        return response()->json(['message' => 'Free bet promo code deleted succesfully'], 200);
    }

    //function to update freebets
   // public function updateFreebet(Request $request, $id){

    //}

    
    //create a freebet after five accumulator losses
    public function createFreebet(Request $request, $user_id){
         //checking losses
         $losses = PlaceBet::Where('user_id', $user_id)
         ->where('type', 'accumulator')
         ->where('status', 'loss')
         ->count();
        if($losses != 0 && $losses % 5 == 0)//for every five losses for every user a free bet code is generated
        {
             $averageStake = PlaceBet::where('user_id', $user_id)
             ->where('type', 'accumulator')
             ->where('status', 'loss')
             ->avg('stake');
             $freebet = new Freebets();
             $freebet->user_id = $user_id;
             $freebet->value = $averageStake;
             $freebet->expire_date = now()->addHours(24);
        }
        return response()->json(['message' => 'Free bet created successfully']);
    }

    //function to get the freebet code generated for a particular user
    public function getMyFreeBet(Request $request, $user_id){
        //first check if the user exist
        $getUser = User::find($user_id);
        if(!$getUser){
           return response()->json(['message' => 'user not found or authourised'], 404);
        }
        
        //get the users freebets from the freebets table
        $myFreebets = $getUser->Myfreebets;
        return response()->json(['my_free_bets' => $myFreebets], 200);
    }
}
