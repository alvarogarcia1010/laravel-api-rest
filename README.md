# Laravel Api Rest
URL: [https://laravel-api-rest-nmtpm.ondigitalocean.app/](https://laravel-api-rest-nmtpm.ondigitalocean.app/)

Versión: 1.0

Esta api ha sido desarrollada en PHP con su framework de Laravel, cuenta con un modulo de autenticación, método para recuperar contraseñas y rutas protegidas las cuales realizan las operaciones básicas de un CRUD tanto para productos como para usuarios como lo son: crear, leer, actualizar y eliminar un registro de la base de datos.

## Indice
  - [Requisitos](#requisitos)
  - [Paquetes utilizados](#paquetes-utilizados)
  - [Instalación](#instalación)
    - [Primeros pasos](#primeros-pasos)
    - [Migraciones](#migraciones)
    - [Generando configuración](#generando-configuración)
  - [Uso](#uso)
  - [Arquitectura utilizada](#arquitectura-utilizada)
  - [Anexos](#anexos)

## Requisitos

- PHP 7.3^
- Laravel 8
- MySQL 5.7^

## Paquetes utilizados

- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
Utilizado para la generación de la documentación en formato OpenApi.
- [Laravel Passport](https://github.com/laravel/passport)
Utilizado para realizar la autenticación con el estandar OAuth 2.0.

## Instalación

### Primeros pasos

En primer lugar procedemos a clonar el repositorio en nuestro entorno local con el siguiente comando:

> ``git clone https://github.com/alvarogarcia1010/laravel-api-rest.git``

Ahora procedemos a crear nuestro archivo .env
> ``cp .env.example .env``

Y colocamos nuestras configuraciones necesarias para poder correr la api en nuestro entorno local.
- Colocar configuraciones de CLIENT_URL y DOCUMENTATION_URL
- Colocar configuraciones de base de datos
- Colocar configuraciones de servidor de correos
- Colocar configuraciones de l5-swagger

Ahora ejecutamos los siguientes comandos.

> ``composer install``
> 
> ``php artisan key:generate``

### Migraciones
Para crear las tablas necesarias para la aplicación procedemos a correr las migraciones, pasamos el parametro --seed poblar la base con Dummy Data.

IMPORTANTE: La base de datos a la que nos queremos conectar ya debe estar creada.
> ``php artisan migrate --seed``

NOTA: Si se desea conectar a otro servidor de base de datos que no sea mysql o si sucede algun error durante las migraciones deberá eliminar la linea
<code>
    DB::statement('SET SESSION sql_require_primary_key=0');
</code>
de los siguientes archivos:
- 2016_06_01_000001_create_oauth_auth_codes_table.php
- 2016_06_01_000002_create_oauth_access_tokens_table.php
- 2016_06_01_000003_create_oauth_refresh_tokens_table.php

### Generando configuración

Para finalizar los pasos de instalación en su entorno local debebera ejecutar los siguientes comandos:

> ``php artisan passport:install``
> 
> ``php artisan l5-swagger:generate``

## Uso

Acontinuación se presenta la [documentación](https://laravel-api-rest-nmtpm.ondigitalocean.app/api/documentation) con los puntos de acceso de la api.

Cabe recalcar que para realizar las peticiones son necesarios los siguientes Headers:

<table>
  <tr>
    <td>Llave</td>
    <td>Valor</td>
    <td>Requerido</td>
  </tr>
  <tr>
    <td>Content-Type</td>
    <td>application/json</td>
    <td>:heavy_check_mark:</td>
  </tr>
  <tr>
    <td>X-Requested-With</td>
    <td>XMLHttpRequest</td>
    <td>:heavy_check_mark:</td>
  </tr>
  <tr>
    <td>Authorization</td>
    <td>Token</td>
    <td>Con peticiones a las que se necesite autorización</td>
  </tr>
</table>


## Arquitectura utilizada

Para realizar esta api se utilizo una arquitectura MVC personalizada la cual contiene:
- Modelos
- Repositorios
- Servicios
- Controladores

## Anexos

- [Documentación OpenApi](https://laravel-api-rest-nmtpm.ondigitalocean.app/api/documentation)

- [Documentación en Postman](https://documenter.getpostman.com/view/5842059/TVYKaw9h)
  
- [Importar colección Postman](https://www.getpostman.com/collections/f49bcdcb9e0e4bb44a4f)

- [Backup de la base de datos](https://drive.google.com/file/d/18sPXzsJaYkSIpIVl8Sjpg9msUW3aofse/view?usp=sharing)
