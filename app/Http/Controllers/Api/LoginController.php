<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        ////set validation
        $validator = Validator::make($request->all(), [
            'phone'     => 'required',
            'password'  => 'required'
        ]);

         //if validation fails
         if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return response($validator->errors(),422);
        }

        //get credentials from request
        $credentials = $request->only('phone', 'password');

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response([
                'success' => false,
                'message' => 'No handphone atau Password anda salah'
            ]);
        }

        //if auth success
        return response([
            'success' =>true,
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);

    }
}
