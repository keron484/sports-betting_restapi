<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paymentmethod;
class PaymentmethodController extends Controller
{

    //function to create payment method in laravel
    public function AddPaymentmethod(Request $request){
        //$getadminid = Paymentmethod::find($admin_id);
        //if(!$getadminid){
          //  return response()->json(['message' => 'Unauthorised access or Network error'], 404);
        //}
        $request->validate([
            'country' => 'string|required',
            'type' => 'string|required',
            'api' => 'string|required',
            'status' => 'required'
        ]);

        Paymentmethod::create([
          'country' => $request->country,
          'type' => $request->type,
          'api' => $request->api,
          'status' => $request->status
        ]);

        return response()->json(['message' => 'Payment method created succesfully'], 200);
    }

    //function to delete payment method
    public function Deletepaymentmethod(Request $request, $id){
        $findpaymentmethod = Paymentmethod::find($id);
        if(!$findpaymentmethod){
            return response()->json(['message' => 'could not find payment method or network errot'], 404);
        }
        $findpaymentmethod->delete();
        return response()->json(['message' => 'Payment method deleted successfully'], 200);

    }

    //function to get all paymentmethod

    public function Getallpaymentmethod(Request $request){
        $allpaymentmethod = Paymentmethod::all();
        return response()->json(['payment_method' => $allpaymentmethod], 200);
    }

    //function to update the payment method

    public function Updatepaymentmethod(Request $request, $id){
        $paymentmethod = Paymentmethod::find($id);
        if(!$paymentmethod){
            return response()->json(['message'=>'something went wrong refresh the page and start again'], 404);
        }
        $paymentmethod->country =  $request->input('country');
        $paymentmethod->type = $request->input('type');
        $paymentmethod->status = $request->input('status');
        $paymentmethod->api = $request->input('api');
        return response()->json(['message' => 'Payment method succesfully update'], 200);
    }
}
