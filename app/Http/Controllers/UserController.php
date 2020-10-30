<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Services\UserManager\UserManagementInterface;

class UserController extends Controller
{
    /**
	 * User Manager Service
	 *
	 * @var App\Services\UserManager\UserManagementInterface;
	 *
	 */
    protected $UserManagerService;

    public function __construct(
		UserManagementInterface $UserManagerService
	)
	{
		$this->UserManagerService = $UserManagerService;
    }

    /**
    * @OA\Get(
    *   path="/api/users",
    *   tags={"Usuarios"},
    *   summary="Lista de usuarios",
    *   description="Obtengo una lista de usuarios con paginación",
    *   operationId="getUsers",
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
    *   @OA\Parameter(
    *       description="Tamaño de la pagina",
    *       in="path",
    *       name="page[size]",
    *       required=false,
    *       @OA\Schema(
    *           type="integer",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Número de pagina",
    *       in="path",
    *       name="page[number]",
    *       required=false,
    *       @OA\Schema(
    *           type="integer",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Buscador de productos",
    *       in="path",
    *       name="filter",
    *       required=false,
    *       @OA\Schema(
    *           type="string",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Ordernar por campo",
    *       in="path",
    *       name="sort",
    *       required=false,
    *       @OA\Schema(
    *           type="string",
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->UserManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
    * @OA\Post(
    *   path="/api/users",
    *   tags={"Usuarios"},
    *   summary="Creación de usuario",
    *   description="Ruta para crear un nuevo usuario",
    *   operationId="createUser",
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
    *       description="Información del nuevo usuario",
    *       @OA\JsonContent(
    *           required={"name","username", "email", "password"},
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
    *       response=200,
    *       description="Success",
    *       @OA\JsonContent(
    *           @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
    *       )
    *   ),
    *
    *   @OA\Response(
    *      response=401,
    *       description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *   ),

    *   @OA\Response(
    *      response=422,
    *      description="Campos no validos o faltan campos requeridos",
    *   ),
    *
    *)
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        return $this->UserManagerService->create($request);
    }

    /**
    * @OA\Get(
    *   path="/api/users/{userId}",
    *   tags={"Usuarios"},
    *   summary="Obtener usuario por id",
    *   description="Esta ruta obtiene un usuario por el id",
    *   operationId="getUser",
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
    *   @OA\Parameter(
    *       description="ID del usuario a retornar",
    *       in="path",
    *       name="userId",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
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
    *   @OA\Response(
    *      response=404,
    *      description="Usuario no encontrado",
    *   ),
    *
    *
    *)
    **/
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->UserManagerService->getUser($id);
    }

    /**
    * @OA\Put(
    *   path="/api/users",
    *   tags={"Usuarios"},
    *   summary="Actualización de usuario",
    *   description="Ruta para actualizar un nuevo usuario",
    *   operationId="updateUser",
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
    *       description="Información a actualizar del usuario",
    *       @OA\JsonContent(
    *           required={"name","username", "email", "password"},
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
    *      response=401,
    *       description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Campos no validos o faltan campos requeridos",
    *   ),
    *
    *)
    /**
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->UserManagerService->update($request, $id);
    }

    /**
    * @OA\Delete(
    *   path="/api/users/{userId}",
    *   tags={"Usuarios"},
    *   summary="Eliminar usuario",
    *   description="Esta ruta elimina el usuario con el id pasado por parametro",
    *   operationId="deleteUser",
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
    *   @OA\Parameter(
    *       description="ID del usuario a eliminar",
    *       in="path",
    *       name="userId",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
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
    *   @OA\Response(
    *      response=404,
    *      description="Usuario no encontrado",
    *   ),
    *)
    **/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->UserManagerService->delete($request);
    }
}
