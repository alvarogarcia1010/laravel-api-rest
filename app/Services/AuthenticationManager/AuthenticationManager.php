<?php
/**
 * @file
 * Module App Management Interface Implementation.
 *
 * All ModuleName code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Services\AuthenticationManager;

use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserInterface;
use Carbon\Carbon;

class AuthenticationManager implements AuthenticationManagementInterface {

    /**
	* User
	*
	* @var App\Repositories\User\UserInterface;
	*
	*/
    protected $User;

    /**
    * Carbon instance
    *
    * @var Carbon\Carbon
    *
    */
    protected $Carbon;

	public function __construct(
        UserInterface $User,
        Carbon $Carbon
    )
	{
        $this->User = $User;
		$this->Carbon = $Carbon;
    }

    public function login($request)
    {
        $credentials = request(['email', 'password']);

        if(! Auth::attempt($credentials))
        {
            return response()->json([
                'errors' => [
                    'status' => '401',
                    'title' => __('auth.failure'),
                    'detail' => __('auth.failAuthAttempt')
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if($request->remember_me)
        {
            $token->expires_at = $this->Carbon->now()->addWeeks(1);
        }

        $token->save();

        return response()->json([
            'data' => [
                'type' => 'auth',
                'id' => strval($user->id),
                'message' => __('auth.success'),
                'attribute' => $user,
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => $this->Carbon->parse($tokenResult->token->expires_at)->toDateTimeString()
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 200);
    }

    public function register($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'birth_date' => !empty($request->birt_date)? $this->Carbon->createFromFormat('d/m/Y', $request->birt_date)->format('Y-m-d') : null,
            'phone_number' => $request->phone_number
        ];

        $user = $this->User->create($data);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        return response()->json([
            'data' => [
                'type' => 'user',
                'id' => strval($user->id),
                'message' => __('auth.success'),
                'attribute' => $user,
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => $this->Carbon->parse($tokenResult->token->expires_at)->toDateTimeString()
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }

    public function getApiLoggedUser($request, $json = true)
    {
        if($json)
        {
            return response()->json([
                'data' => [
                    'type' => 'user',
                    'id' => strval($request->user()->id),
                    'attribute' => $request->user(),
                ],
                'jsonapi' => [
                    'version' => "1.00"
                ]
            ], 200);
        }
        else {
            return $request->user();
        }
    }

    public function logout($request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'data' => [
                'type' => 'auth',
                'message' => __('auth.logoutSuccess'),
            ],
            'jsonapi' => [
                'version' => "1.00"
            ]
        ], 201);
    }
}
