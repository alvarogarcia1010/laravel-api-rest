<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
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

	/**
	 * Input
	 *
	 * @var Illuminate\Http\Request
	 *
	 */
	protected $Input;

    public function __construct(
		AuthenticationManagementInterface $AuthenticationManagerService,
		Request $Input
	)
	{
		$this->AuthenticationManagerService = $AuthenticationManagerService;
		$this->Input = $Input;
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
}
