<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UsersService;
use Socialite;
use Auth;

class UsersController extends Controller
{
	protected $usersService = null;

	public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

	// facebook login
    public function socialLogin($provider = null)
    {
    	return Socialite::driver($provider)->redirect();
    }

    public function socialCallback(Request $request, $provider = null)
    {
    	if (! $request->has('code') || $request->has('denied')) {
			return redirect('/#');
		}

		$user = Socialite::driver($provider)->user();

		if (! Auth::check()) {
			session()->regenerate();
		}

		$status = $this->usersService->dealSocialLogin($user);

		switch ($status['result']) {
			case 'success':
				Auth::loginUsingId($status['userId']);
				return redirect('/home#');
			case 'email exists':
				return redirect('/#')->with('soicalLogin', 'email-fail');
			case 'not register':
				$data = [
					'username' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
				];
				$createUser = $this->usersService->dealRegister($data);
				Auth::loginUsingId($createUser->id);
				return redirect('/home#');
		}
    }
}
