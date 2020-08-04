<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyUserEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8|string|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $avatarName = Str::uuid() . '.png';

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $avatarName,
            'email_activation_token' => Str::random(100)
        ]);

        $user->save();

        $user->notify(new VerifyUserEmail());

        $avatar = (new \Laravolt\Avatar\Avatar(config('laravolt.avatar')))->create($user->name)->getImageObject()->encode('png');
        Storage::disk('public')->put('avatars/'. $avatarName, $avatar);

        return response()->json([
            'data' => [
                'success' => 'Successfully created account!',
                'message' => 'Before sign in, please check your email to activate account.',
            ],
        ], 201);
    }
}
