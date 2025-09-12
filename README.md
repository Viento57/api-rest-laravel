## Pasos para levantar el proyeto

-   Configurar la base de datos .env

-   Levantar los servidor con laragon y configurar la version de php.

-   php artisan make:migration create_users_table
-   php artisan make:model User
-   php artisan make:request User\CreateUserRequest
-   php capa de servicio manual
-   php artisan make:controller UserController
-   php artisan migrate:fresh

Al final configuar la ruta instalar

-   php artisan install:api
