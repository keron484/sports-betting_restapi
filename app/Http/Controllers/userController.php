<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class userController extends Controller
{
    public function getUsers(Request $request){
        $uselist = User::all();
        return response()->json(['users' => $uselist], 200);
    }

    public function updateBettinglimit(Request $request, $id){
         $user = User::find($id);
         if(!$user){
            return response()->json(['message' => 'unauthorised access'], 404);
         }
         $user->betting_limit = $request->input('betting_limit');

         return response()->json(['message' => 'Betting limit updated succesfully'], 200);
    }

    //public function verifyAccount(Request $request, $id){
        //$user = User::find($id);
        //if(!$user){
          //  return response()->json(['message' => 'unauthorised access or network error'], 404);
        //}
        
       // $request->validate([
            
     //   ]);


   // }
}
