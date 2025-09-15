## Pasos para levantar el proyeto

-   Configurar la base de datos .env copiando desde .env.example y agregar el JWT_SECRET con el comando "php artisan jwt:secret"

-   Levantar los servidor con laragon y configurar la version de php.

-   php artisan make:migration create_users_table
-   php artisan make:model User
-   php artisan make:request User\CreateUserRequest
-   php capa de servicio manual
-   php artisan make:controller UserController
-   php artisan migrate:fresh

Al final configuar la ruta instalar

-   php artisan install:api

Instalar JWT Laravel

-   https://jwt-auth.readthedocs.io/en/develop/laravel-installation/

-   composer require tymon/jwt-auth
-   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
-   php artisan jwt:secret

Configurar las Exceptions y Middlewares
