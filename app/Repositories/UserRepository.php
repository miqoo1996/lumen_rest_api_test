<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data):User
    {
        return $this->user->query()->create($data);
    }

    /**
     * @param array $conditions
     * @param array $data
     * @return int
     */
    public function update(array $conditions, array $data):int
    {
        return $this->user->query()->where($conditions)->update($data);
    }

    /**
     * @param string $email
     * @return Builder|Model|object|null
     */
    public function getByEmail(string $email): ?User
    {
        return $this->user->query()->where('email', $email)->first();
    }

}
