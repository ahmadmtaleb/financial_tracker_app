<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * TransactionController constructor.
     */
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
        /**
     * @return mixed
     */
    public function index()
    {
        $transactions = $this->user->transactions()->get(['title', 'description'])->toArray();

        return $transactions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'description' => 'required',
        ]);
 
        $transaction = new Transaction();
        $transaction->title = $request->title;
        $transaction->description = $request->description;
 
        if ($this->user->transactions()->save($transaction))
            return response()->json([
               'success' => true,
                'transaction' => $transaction
         ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction could not be added.'
            ], 500);
    } 
    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
     public function show($id)
     {
         $transaction = $this->user->transactions()->find($id);
 
         if (!$transaction) {
             return response()->json([
                 'success' => false,
                 'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
             ], 400);
         }
 
         return $transaction;
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }
    
    /*** Update the specified resource in storage.
    * @param Request $request
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(Request $request, $id)
    {
        $transaction = $this->user->transactions()->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $transaction->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction could not be updated.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function destroy($id)
    {
        $transaction = $this->user->transactions()->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, transaction with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($transaction->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'transaction could not be deleted.'
            ], 500);
        }
    }
}
