<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $credentials = request(['email', 'password']);
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials, $request->get('remember_me'))) {
            return response()->json([
                'error' => [
                    'message' => 'These credentials do not match our records.'
                ],

            ], 401);
        }

        if (is_null($request->user()->email_verified_at) ) {
            return response()->json([
                'error' => [
                    'message' => 'Email address is not verified.'
                ],
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->get('remember_me')) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
}
