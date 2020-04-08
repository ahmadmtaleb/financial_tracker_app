<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validate(
        Request $request,
        array $rules,
        array $messages = [],
        array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                $rules, $messages,
                $customAttributes
            );
        if ($validator->fails()) {
            $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
            $message = (new \Illuminate\Validation\ValidationException($validator))->getMessage();
            throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                [
                    'success' => false,
                    'message' => $message,
                    'errors' => $errors
                ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
