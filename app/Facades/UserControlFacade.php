<?php

namespace App\Facades;

use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static User createUser(array $data)
 * @method static User|null getByEmail(?string $email):? User
 * @method static bool checkUserPassword(?User $user, string $password)
 * @method static bool identifyUserByEmailToken($token, string $password)
 * @method static self processRecoveryEmail(string $email, bool $sendEmail = false)
 * @method static void sendRecoveryEmail(User $user)
 */
class UserControlFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'user_control';
    }
}
