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

        return CurrencyResource::collection($currencies);
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

        return new CurrencyResource($currency);
    }

}

