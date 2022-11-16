<?php

namespace App\Http\Controllers\Auth;

use App\Facades\UserControlFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function signUp(RegisterRequest $request):JsonResponse
    {
        return $this->apiOk([
            'user' => $user = UserControlFacade::createUser($request->all()),
            'token' => $user->createToken(User::API_AUTH_NAME)->accessToken
        ]);
    }
}
