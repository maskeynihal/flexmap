<?php

namespace App\Http\Controllers\Authentication;

use App\Actions\Authentication\LoginMobileUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginMobileUserRequest;

class UserLoginController extends Controller
{
    public function login(LoginMobileUserRequest $request)
    {
        $credentials = LoginMobileUser::execute(
            $request->email,
            $request->password,
            $request->device_name
        );

        return response()->json([
            'token' => $credentials,
        ]);
    }
}
