<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthenticationManager\AuthenticationManagementInterface;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
	 * Authentication Manager Service
	 *
	 * @var App\Services\AuthenticationManager\AuthenticationManagementInterface;
	 *
	 */
	protected $AuthenticationManagerService;

    public function __construct(
		AuthenticationManagementInterface $AuthenticationManagerService
	)
	{
		$this->AuthenticationManagerService = $AuthenticationManagerService;
    }

    public function login(LoginRequest $request)
    {
       return $this->AuthenticationManagerService->login($request);
    }

    public function register(RegisterRequest $request)
    {
        return $this->AuthenticationManagerService->register($request);
    }

    public function logout(Request $request)
    {
        return $this->AuthenticationManagerService->logout($request);
    }

    public function getLoggedUser(Request $request)
    {
        return $this->AuthenticationManagerService->getApiLoggedUser($request);
    }

    public function sendPasswordResetEmail(ResetEmailRequest $request)
    {
        return $this->AuthenticationManagerService->sendPasswordResetEmail($request);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->AuthenticationManagerService->resetPassword($request);
    }
}
