<?php

namespace App\Http\Controllers\Auth;

use App\Facades\UserControlFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\IdentifyRecoveryRequest;
use App\Http\Requests\LogInRequest;
use App\Http\Requests\RecoveryRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LogInController extends Controller
{
    /**
     * @param LogInRequest $request
     * @return JsonResponse
     */
    public function signIn(LogInRequest $request): JsonResponse
    {
        $user = UserControlFacade::getByEmail($request->email);

        if (!UserControlFacade::checkUserPassword($user, $request->password)) {
            return $this->apiFail(['error' => __('Email or password is incorrect')], 422);
        }

        return $this->apiOk(['token' => $user->createToken(User::API_AUTH_NAME)->accessToken, 'user' => $user]);
    }

    public function submitRecoverPassword(RecoveryRequest $request): JsonResponse
    {
        try {
            UserControlFacade::processRecoveryEmail($request->email, true);

            return $this->apiOk(['message' => __('Successfully sent.')]);
        } catch (\Throwable $throwable) {}

        return $this->apiFail(['message' => __('Something went wrong')], 422);
    }

    public function recoverPassword(IdentifyRecoveryRequest $request): JsonResponse
    {
        $identified = UserControlFacade::identifyUserByEmailToken($request->email_token, $request->password);

        if (!$identified) {
            return $this->apiFail(['message' => __('Invalid token was sent.')], 422);
        }

        return $this->apiOk(['message' => __('Password was successfully changed.')]);
    }

}
