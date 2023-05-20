<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Client\Response;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
// use Illuminate\Http\Request;


// use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): Response
    {
        //
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        
        if ($removeToken) {
            return new Response([
                'success' => true,
                'message' => 'Logout Berhasil!',
            ], 200);
        } else {
            return new Response([
                'success' => false,
                'message' => 'Logout Gagal!',
            ], 400);
        }
    }
}
