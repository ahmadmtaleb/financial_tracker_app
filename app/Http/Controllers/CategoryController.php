<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 
    /**
     * @var
     */
    protected $user;

    /**
     * CategoryController constructor.
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
        $categories = $this->user
                            ->categories()
                            ->get()
                            ->toArray();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
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
             'name' => 'required',
        ]);
 
        $category = new Category();
        $category->name = $request->name;

        
        if ($this->user->categories()->save($category))
            return response()->json([
               'success' => true,
                'data' => $category
         ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category could not be added.'
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
         $category = $this->user->categories()->find($id);
 
         if (!$category) {
             return response()->json([
                 'success' => false,
                 'message' => 'Sorry, category with id ' . $id . ' cannot be found.'
             ], 400);
         }
 
         return $category;
     }
    
    /*** Update the specified resource in storage.
    * @param Request $request
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(Request $request, $id)
    {
        $category = $this->user->categories()->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $category->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category could not be updated.'
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
        $category = $this->user->categories()->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, category with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($category->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'category could not be deleted.'
            ], 500);
        }
    }
}
