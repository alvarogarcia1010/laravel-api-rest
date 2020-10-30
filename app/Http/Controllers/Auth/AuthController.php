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

    /**
    * @OA\Post(
    *   path="/api/register",
    *   tags={"Autenticación"},
    *   summary="Registro de usuario",
    *   description="Registro de usuario por correo",
    *   operationId="register",
    *   security={ {"bearer": {} }},
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Campos para realizar registro",
    *       @OA\JsonContent(
    *           required={"name", "email", "username", "password"},
    *           @OA\Property(property="name", type="string", example="Alvaro García"),
    *           @OA\Property(property="username", type="string", example="alvarogarcia1010"),
    *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
    *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
    *           @OA\Property(property="birth_date", type="string", format="date", example="1998-09-10"),
    *           @OA\Property(property="phone_number", type="string", example="7777-7777"),
    *       ),
    *   ),
    *
    *   @OA\Response(
    *       response=201,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Faltan campos requeridos, campos con formato invalido, o ya existe en la base de datos",
    *   ),
    *
    *)
    **/
    public function register(RegisterRequest $request)
    {
        return $this->AuthenticationManagerService->register($request);
    }

    /**
    * @OA\Post(
    *   path="/api/login",
    *   tags={"Autenticación"},
    *   summary="Inicio de sesión",
    *   description="Inicio de sesión con correo electrónico y contraseña",
    *   operationId="login",
    *   security={ {"bearer": {} }},
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Credenciales para iniciar sesión",
    *       @OA\JsonContent(
    *           required={"email","password"},
    *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
    *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
    *       ),
    *   ),
    *
    *   @OA\Response(
    *       response=200,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=401,
    *       description="Error de inicio de sesión",
    *   ),

    *   @OA\Response(
    *      response=422,
    *      description="Campos no validos o faltan campos requeridos",
    *   ),
    *
    *)
    **/
    public function login(LoginRequest $request)
    {
       return $this->AuthenticationManagerService->login($request);
    }

    /**
    * @OA\Get(
    *   path="/api/myuser",
    *   tags={"Autenticación"},
    *   summary="Obtener usuario loggeado",
    *   description="Se obtiene el usuario logeado actualmente con el token",
    *   operationId="getmyuser",
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Authorization",
    *       description="Con valor: Bearer + token",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Response(
    *       response=200,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=401,
    *      description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *   ),
    *
    *
    *)
    **/
    public function getLoggedUser(Request $request)
    {
        return $this->AuthenticationManagerService->getApiLoggedUser($request);
    }

    /**
    * @OA\Get(
    *   path="/api/logout",
    *   tags={"Autenticación"},
    *   summary="Cerrar sesión",
    *   description="Este método cierra la sesión en el servidor del token enviado por el headers",
    *   operationId="logout",
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Authorization",
    *       description="Con valor: Bearer + token",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Response(
    *       response=200,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=401,
    *      description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *   ),
    *
    *
    *)
    **/
    public function logout(Request $request)
    {
        return $this->AuthenticationManagerService->logout($request);
    }

    /**
    * @OA\Post(
    *   path="/api/reset-password",
    *   tags={"Autenticación"},
    *   summary="Recuperar contraseña",
    *   description="Se envia un link de recuperación de contraseña al correo proporcionado",
    *   operationId="resetPassword",
    *   security={ {"bearer": {} }},
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Campos para pedir reestablecer contraseña",
    *       @OA\JsonContent(
    *           required={"email"},
    *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
    *       ),
    *   ),
    *
    *   @OA\Response(
    *       response=201,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=400,
    *      description="El correo proporcionado no existe en la base de datos o token invalido",
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Faltan campos requeridos, campos con formato invalido",
    *   ),
    *
    *)
    **/
    public function sendPasswordResetEmail(ResetEmailRequest $request)
    {
        return $this->AuthenticationManagerService->sendPasswordResetEmail($request);
    }

    /**
    * @OA\Post(
    *   path="/api/password/reset",
    *   tags={"Autenticación"},
    *   summary="Cambiar contraseña",
    *   description="Se recibe el token enviado por correo y la nueva contraseña para poder reestablecerla",
    *   operationId="changePassword",
    *
    *   @OA\Header(
    *       header="X-Requested-With",
    *       description="Con valor: XMLHttpRequest",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\Header(
    *       header="Content-Type",
    *       description="Con valor: application/vnd.api+json",
    *       required=true,
    *       @OA\Schema(
    *           type="string"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Campos para realizar registro",
    *       @OA\JsonContent(
    *           required={"email", "password", "password_confirmation", "token"},
    *           @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
    *           @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
    *           @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
    *           @OA\Property(property="token", type="string", example="Cadena de caracteres aleatorios"),
    *       ),
    *   ),
    *
    *   @OA\Response(
    *       response=201,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Faltan campos requeridos, campos con formato invalido, o ya existe en la base de datos",
    *   ),
    *
    *)
    **/
    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->AuthenticationManagerService->resetPassword($request);
    }
}
