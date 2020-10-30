<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Services\ArticleManager\ArticleManagementInterface;

class ArticleController extends Controller {

    /**
	 * Article Manager Service
	 *
	 * @var App\Services\ArticleManager\ArticleManagementInterface;
	 *
	 */
    protected $ArticleManagerService;

    public function __construct(
		ArticleManagementInterface $ArticleManagerService
	)
	{
		$this->ArticleManagerService = $ArticleManagerService;
    }

    /**
    * @OA\Get(
    *   path="/api/articles",
    *   tags={"Productos"},
    *   summary="Lista de productos",
    *   description="Obtengo una lista de productos con paginación",
    *   operationId="getArticles",
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
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="X-Requested-With",
    *       in="header",
    *       name="X-Requested-With",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="XMLHttpRequest"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Content-Type",
    *       in="header",
    *       name="Content-Type",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="application/vnd.api+json"
    *       )
    *   ),
    *
    *
    *   @OA\Parameter(
    *       description="Token de autorización",
    *       in="header",
    *       name="Authorization",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Tamaño de la pagina",
    *       in="query",
    *       name="page[size]",
    *       required=false,
    *       @OA\Schema(
    *           type="integer",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Número de pagina",
    *       in="query",
    *       name="page[number]",
    *       required=false,
    *       @OA\Schema(
    *           type="integer",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Buscador de productos",
    *       in="query",
    *       name="filter",
    *       required=false,
    *       @OA\Schema(
    *           type="string",
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Ordernar por campo [-campo => desc, campo => asc]",
    *       in="query",
    *       name="sort",
    *       required=false,
    *       @OA\Schema(
    *           type="string",
    *           default="-id"
    *       )
    *   ),
    *
    *   @OA\Response(
    *       response=200,
    *       description="Success",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="testItems",
    *                type="array",
    *                example={{
    *                  "firstName": "Bob",
    *                  "lastName": "Fanger",
    *                  "company": "Triple",
    *                  "id": "808",
    *                }, {
    *                  "firstName": "",
    *                  "lastName": "",
    *                  "company": "",
    *                  "id": ""
    *                }},
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="firstName",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="lastName",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="companyId",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="accountNumber",
    *                         type="number",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="netPay",
    *                         type="money",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *        ),
    *   ),
    *
    *   @OA\Response(
    *      response=401,
    *      description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="object",
    *                example={
    *                  "status": "401",
    *                  "title": "Acceso no autorizado",
    *                  "details": "Para acceder a este recurso inicie sesión",
    *                },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
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
        return $this->ArticleManagerService->getTableRowsWithPagination(request()->all());
    }

    /**
    * @OA\Post(
    *   path="/api/articles",
    *   tags={"Productos"},
    *   summary="Creación de productos",
    *   description="Ruta para crear un nuevo producto",
    *   operationId="createArticle",
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
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="X-Requested-With",
    *       in="header",
    *       name="X-Requested-With",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="XMLHttpRequest"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Content-Type",
    *       in="header",
    *       name="Content-Type",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="application/vnd.api+json"
    *       )
    *   ),
    *
    *
    *   @OA\Parameter(
    *       description="Token de autorización",
    *       in="header",
    *       name="Authorization",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Información del nuevo producto",
    *       @OA\JsonContent(
    *           required={"name","quantity", "price"},
    *           @OA\Property(property="sku", type="string", example="123456789"),
    *           @OA\Property(property="name", type="string", example="Producto 1"),
    *           @OA\Property(property="quantity", type="integer", example="10"),
    *           @OA\Property(property="price", type="float", example="35.50"),
    *           @OA\Property(property="remark", type="string", example="Esta es una descripción"),
    *           @OA\Property(property="image_url", type="string", example="URL"),
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
    *      description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="object",
    *                example={
    *                  "status": "401",
    *                  "title": "Acceso no autorizado",
    *                  "details": "Para acceder a este recurso inicie sesión",
    *                },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Campos no validos o faltan campos requeridos",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="array",
    *                example={{
    *                  "status": "422",
    *                  "title": "El campo ... es requerido",
    *                  "source": {"pointer": "campo"},
    *                }},
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="source",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *)
    **/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        return $this->ArticleManagerService->create($request);
    }

    /**
    * @OA\Get(
    *   path="/api/articles/{articleId}",
    *   tags={"Productos"},
    *   summary="Obtener producto por id",
    *   description="Esta ruta obtiene un producto por el id",
    *   operationId="getArticle",
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
    *       description="X-Requested-With",
    *       in="header",
    *       name="X-Requested-With",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="XMLHttpRequest"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Content-Type",
    *       in="header",
    *       name="Content-Type",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="application/vnd.api+json"
    *       )
    *   ),
    *
    *
    *   @OA\Parameter(
    *       description="Token de autorización",
    *       in="header",
    *       name="Authorization",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="ID del producto a retornar",
    *       in="path",
    *       name="articleId",
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
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="object",
    *                example={
    *                  "status": "401",
    *                  "title": "Acceso no autorizado",
    *                  "details": "Para acceder a este recurso inicie sesión",
    *                },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *   @OA\Response(
    *      response=404,
    *      description="Producto no encontrado",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="array",
    *                example={{
    *                  "status": "404",
    *                  "title": "Oops! Parece que hubo un error.",
    *                  "details": "Producto no encontrado",
    *                }},
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *)
    **/
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ArticleManagerService->getArticle($id);
    }

    /**
    * @OA\Put(
    *   path="/api/articles",
    *   tags={"Productos"},
    *   summary="Actualización de productos",
    *   description="Ruta para actualizar un producto",
    *   operationId="updateArticle",
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
    *       description="X-Requested-With",
    *       in="header",
    *       name="X-Requested-With",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="XMLHttpRequest"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Content-Type",
    *       in="header",
    *       name="Content-Type",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="application/vnd.api+json"
    *       )
    *   ),
    *
    *
    *   @OA\Parameter(
    *       description="Token de autorización",
    *       in="header",
    *       name="Authorization",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\RequestBody(
    *       required=true,
    *       description="Información a actualizar del producto",
    *       @OA\JsonContent(
    *           required={"name","quantity", "price"},
    *           @OA\Property(property="sku", type="string", example="123456789"),
    *           @OA\Property(property="name", type="string", example="Producto 1"),
    *           @OA\Property(property="quantity", type="integer", example="10"),
    *           @OA\Property(property="price", type="float", example="35.50"),
    *           @OA\Property(property="remark", type="string", example="Esta es una descripción"),
    *           @OA\Property(property="image_url", type="string", example="URL"),
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
    *      description="Acceso no autorizado, para acceder a este recurso debe iniciar sesión",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="object",
    *                example={
    *                  "status": "401",
    *                  "title": "Acceso no autorizado",
    *                  "details": "Para acceder a este recurso inicie sesión",
    *                },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *   @OA\Response(
    *      response=422,
    *      description="Campos no validos o faltan campos requeridos",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="array",
    *                example={{
    *                  "status": "422",
    *                  "title": "El campo ... es requerido",
    *                  "source": {"pointer": "campo"},
    *                }},
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="source",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *)
    **/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $data)
    {
        return $this->ArticleManagerService->update($request, $data);
    }


    /**
    * @OA\Delete(
    *   path="/api/articles/{articleId}",
    *   tags={"Productos"},
    *   summary="Eliminar producto",
    *   description="Esta ruta elimina el producto con el id pasado por parametro",
    *   operationId="deleteArticle",
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
    *       description="X-Requested-With",
    *       in="header",
    *       name="X-Requested-With",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="XMLHttpRequest"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="Content-Type",
    *       in="header",
    *       name="Content-Type",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="application/vnd.api+json"
    *       )
    *   ),
    *
    *
    *   @OA\Parameter(
    *       description="Token de autorización",
    *       in="header",
    *       name="Authorization",
    *       required=true,
    *       @OA\Schema(
    *           type="string",
    *           default="token_type + token"
    *       )
    *   ),
    *
    *   @OA\Parameter(
    *       description="ID del prodcuto a eliminar",
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
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="object",
    *                example={
    *                  "status": "401",
    *                  "title": "Acceso no autorizado",
    *                  "details": "Para acceder a este recurso inicie sesión",
    *                },
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *
    *   @OA\Response(
    *      response=404,
    *      description="Usuario no encontrado",
    *        @OA\JsonContent(
    *             type="object",
    *             @OA\Property(
    *                property="errors",
    *                type="array",
    *                example={{
    *                  "status": "404",
    *                  "title": "Oops! Parece que hubo un error.",
    *                  "details": "Usuario no encontrado",
    *                }},
    *                @OA\Items(
    *                      @OA\Property(
    *                         property="status",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="title",
    *                         type="string",
    *                         example=""
    *                      ),
    *                      @OA\Property(
    *                         property="details",
    *                         type="string",
    *                         example=""
    *                      ),
    *                ),
    *             ),
    *             @OA\Property(
    *                property="jsonapi",
    *                type="object",
    *                example={
    *                  "version": "1.0",
    *                },
    *             ),
    *        ),
    *   ),
    *)
    **/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($request)
    {
        return $this->ArticleManagerService->delete($request);
    }
}
