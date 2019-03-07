<?php

namespace App\Services;

use App\Repositories\UsersRepository;

class UsersService
{
    protected $users = null;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function dealRegister($data)
    {
    	return $this->users->createUser($data);
    }

    public function dealSocialLogin($user)
    {
    	return $this->users->checkSocialLogin($user);
    }
}