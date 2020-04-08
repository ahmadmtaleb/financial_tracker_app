<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Resources\Currency as CurrencyResource;

class CurrencyController extends Controller
{
    
    public function index()
    {
        $currencies = Currency::all();

        return response()->json([
             'success' => true,
             'data' => $currencies
        ]);
        //return CurrencyResource::collection($currencies);
    }
 
     /**
      * Display the specified resource.
      *
      * @param $id
      * @return \Illuminate\Http\JsonResponse
      */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);

        return response()->json([
             'success' => true,
             'data' => $currency
        ]);
        //return new CurrencyResource($currency);
    }

    public function getCurrencyByCode($code){
        $currency = Currency::where('code', $code)->get();
         return response()->json([
             'success' => true,
             'data' => $currency
         ]);      
    }
}

