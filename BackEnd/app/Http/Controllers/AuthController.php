<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   /**
    * Create a new AuthController instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth:api', ['except' => ['login']]);
   }

   /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function login()
   {
      $credentials = request(['email', 'password']);

      $token = $this->guard()->attempt($credentials);

      if (!$token) {
         return response()->json(['message' => 'Usuário ou senha inválida'], 404);
      }

      return $this->respondWithToken($token);
   }

   /**
    * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function me()
   {
      return response()->json($this->guard()->user());
   }

   /**
    * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function logout()
   {
      $this->guard()->logout();

      return response()->json(['message' => 'Successfully logged out']);
   }

   /**
    * Refresh a token.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function refresh()
   {
      return $this->respondWithToken($this->guard()->refresh());
   }

   /**
    * Get the token array structure.
    *
    * @param  string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
   protected function respondWithToken($token)
   {
      return response()->json([
         'accessToken' => $token,
         'token_type' => 'bearer',
         'expires_in' => $this->guard()->factory()->getTTL() * 60
      ]);
   }

   public function guard()
   {
      return Auth::guard('api');
   }
}
