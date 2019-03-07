<?php

namespace App\Repositories;

use App\Entities\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
	public function createUser($data)
	{
		return User::create([
            'username' => $data['username'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : '',
            'name' => $data['name'],
            'email' => $data['email']
        ]);
	}

	public function checkSocialLogin($user)
	{
		$checkUser = User::where('username', $user->id)->first();

		if ($checkUser) {
			return [
				'result' => 'success',
				'userId' => $checkUser->id
			];
		} else {
			if (User::where('email', $user->email)->first()) {
				return [
					'result' => 'email exists',
					'userId' => ''
				];
			} else {
				return [
					'result' => 'not register',
					'userId' => ''
				];
			}
		}
	}
}