<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;

class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->currency_id = $request->currency_id;
        $user->password = bcrypt($request->password);
        $user->save();

        $defaultCategories = ['Family', 'Work', 'Health'];
      
        foreach($defaultCategories as $defaultCategory){
            $category = new Category();
            $category->name = $defaultCategory;

            $user->categories()->save($category);
        }

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function checkUser(Request $request){

        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if($user){
                return response()->json([
                    'success'=> true,
                    'data' => $user,
                ]);
            }else {
                return response()->json([
                    'success'=> false,
                    'message' => "Authentication error",
                ]);
            }
    
        }catch(Exception $error){
            return response()->json([
                'success'=> false,
                'message' => "Authentication error",
            ]);
        }

        
    }
}