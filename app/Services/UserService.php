<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        $data['email_token'] = $this->getEmailToken();
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
    }

    /**
     * @param User|null $user
     * @param string $password
     * @return bool
     */
    public function checkUserPassword(?User $user, string $password): bool
    {
         return $user && Hash::check($password, $user->password);
    }

    /**
     * @param string|null $email
     * @return User|null
     */
    public function getByEmail(?string $email):? User
    {
        return $this->userRepository->getByEmail($email);
    }

    /**
     * @param string $token
     * @param string $password
     * @return bool
     */
    public function identifyUserByEmailToken(string $token, string $password): bool
    {
        $user = User::query()->where('email_token', $token)->first();

        if ($user && $user->email_token == $token) {
            // updating old token and verifying the user.
            return $user->fill(['email_token' => $this->getEmailToken(), 'email_verified_at' => Carbon::now(), 'password' => Hash::make($password)])->save();
        }

        return false;
    }

    /**
     * @param string $email
     * @param bool $sendEmail
     * @return $this
     */
    public function processRecoveryEmail(string $email, bool $sendEmail = false): self
    {
        $user = $this->userRepository->getByEmail($email);

        DB::beginTransaction();

        $tokenSaved = $user->fill(['email_token' => $this->getEmailToken(), 'email_verified_at' => null])->save();

        if ($tokenSaved && $sendEmail) {
            $this->sendRecoveryEmail($user);

            DB::commit();
        } else {
            DB::rollBack();
        }

        return $this;
    }

    /**
     * @param User $user
     * @return void
     */
    public function sendRecoveryEmail(User $user): void
    {
        Mail::send('mail.email.recovery', ['user' => $user], function($message) use ($user) {
            $message->to($user->email, $user->full_name)->subject(__('Your email recovery token.'));
        });
    }

    /**
     * @return string
     */
    private function getEmailToken(): string
    {
        return Str::random(User::USER_EMAIL_TOKEN_LENGTH);
    }
}
