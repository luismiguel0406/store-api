Ejecutar los comandos:
* Composer Install
* npm install

Descargar SQlite tool 
* Ejecutar en powerShell en la ruta donde esta SQlite el comando "./sqlite3.exe"
* Mejor opcion es agregar SQlite al path de variables de entorno. 

En archivo php.ini quitar punto y coma a:
* extension=fileinfo
* extension=pdo_sqlite

Migrations
* php artisan migrate

Sedders
* php artisan db:seed --env=local  o php artisan db:seed

Levantar Servidor
* php artisan serve
* Ir a localhost:8000
