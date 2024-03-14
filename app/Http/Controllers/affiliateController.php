<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliate;
class affiliateController extends Controller
{

    //function to apply co become an affiliate
    public function applytobecomAffiliate(Request $request){
        $request->validate([
           'username' => 'required|string|min:8',
           'email' => 'required|string',
           'phone' => 'required',
           'first_name' => 'required|string',
           'last_name' => 'required|string',
           'age' => 'required|numeric|min:21|max:100',
           'address' => 'required|string',
           'region' => 'required|string',
           'gender' => 'required|string',
           'influencer_link' => 'string',
           'prove_identity_image' => 'required|image' 
        ]);
        $affiliate = new Affiliate();
        $affiliate->username = $request->username;
        $affiliate->email = $request->email;
        $affiliate->phone = $request->phone;
        $affiliate->first_name = $request->first_name;
        $affiliate->last_name = $request->last_name;
        $affiliate->age = $request->age;
        $affiliate->address = $request->address;
        $affiliate->region = $request->region;
        $affiliate->gender = $request->gender;
        if($request->has('prove_identity_image')){
            $image = $request->file('prove_identity_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $affiliate->prove_identity_image = $imageName;
        }

       $affiliate->save();

       return response()->json(['message' => 'Request created succesfully'], 200);
    }


    //function to get downlines of a particular affiliate
    public function deleteRequest(Request $request, $id){
        $findAffiliate = Affiliate::find($id);
        if(!$findAffiliate){
            return response()->json(['message' => 'Affiliate application not found'], 404);
        }
         
        $findAffiliate->delete();

        return response()->json(['message' => 'Affiliate request deleted successfully'], 200);
    }


    //function to get downlines of a particular affiliate
    public function getMydownlines(Request $request, $id){
        $idcheck = Affiliate::find($id);
        if(!$idcheck){
            return response()->json(['message' => 'Unauthourised Access'], 404);
        }
        $promoCode = $idcheck->promo_code;
        $downlines = $promoCode->user;
        return response()->json(['downlines' => $downlines], 200);
    }


    public function updateAffiliate(Request $request, $id){
        $affiliate = Affiliate::find($id);
        if(!$affiliate){
            return response()->json(['message' => 'could not find affiliate'], 404);
        }
        $affiliate->status = $request->input('status');
        $affiliate->promo_code = $request->input('promo_code');
         
        return response()->json(['message' => 'Updated succesfully'], 200);
    }

    public function getAllaffilaites(Request $request){
        $affiliates = Affiliate::all();
        return response()->json(['affiliates' => $affiliates], 200);
    }


}
