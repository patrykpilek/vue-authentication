<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verifyEmail($token)
    {
        $user = User::where('email_activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'error' => [
                    'message' => 'This activation token is invalid.'
                ],
            ], 404);
        }
        $user->email_verified_at = Carbon::now();
        $user->email_activation_token = null;
        $user->save();
        return response()->json([
            'data' => [
                'user' => $user
            ],
        ], 201);
    }
}
