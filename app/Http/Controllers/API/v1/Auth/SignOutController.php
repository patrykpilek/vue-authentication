<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function signOut(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'data' => [
                'message' => 'Successfully logged out'
            ],
        ], 201);
    }
}
