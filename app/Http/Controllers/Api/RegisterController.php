<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        //set validation
        $validator = Validator::make($request->all(), [
            'nik'       => 'required',
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        //if validation fails
        // if ($validator->fails()) {
        //     // return response()->json($validator->errors(), 422);
        //     return response()->json($validator->errors(),422);
        // }
        if ($validator->fails()) {
            return response($validator->errors(), 422);
        }
        

        //create user
        $user = User::create([
            'nik'       => $request->nik,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     =>$request->phone,
            'password'  => bcrypt($request->password)
        ]);

        //return response JSON user is created
        // if($user) {
        //     return response()->json([
        //         'success' => true,
        //         'user'    => $user,  
        //     ], 201);
        // }

        // //return JSON process insert failed 
        // return response()->json([
        //     'success' => false,
        // ], 409);
        if ($user) {
            return response([
                'success' => true,
                'user'    => $user,  
            ], 201);
        }
        
        // Return JSON indicating the failed insertion process
        return response([
            'success' => false,
        ], 409);
        
    }
}
