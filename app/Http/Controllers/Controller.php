<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    /**
     * @SWG\Swagger(
     *     schemes={"https"},
     *      @OA\Info(
     *          version="1.0.0",
     *          title="Documentación de Alvaro's Laravel Api",
     *          description="Esta es una api simple hecha con laravel 8.0 con autenticación realizada con Oauth 2.0",
     *          @OA\Contact(
     *              email="alvarogarcia1010@gmail.com"
     *          ),
     *          @OA\License(
     *              name="Apache 2.0",
     *              url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *          )
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Alvaro's Api"
     * )
     *
     * @OA\Tag(
     *     name="Autenticación",
     *     description="Todo lo relacionado con la autenticación"
     * )
     *
     * @OA\Tag(
     *     name="Productos",
     *     description="Operaciones CRUD para manejar los productos"
     * )
     *
     * @OA\Tag(
     *     name="Usuarios",
     *     description="Operaciones CRUD para manejar los usuarios"
     * )
     *
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
