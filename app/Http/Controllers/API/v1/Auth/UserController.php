<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function user(Request $request)
    {
        return response()->json([
            'data' => [
                'user' => $request->user()
            ],
        ], 201);
    }
}
