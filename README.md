Instalación:

Crear una base de datos mysql

Clonar o descargar el proyecto en el directorio de tu servidor web

Acceder mediante terminal a la carpeta del proyecto

Ejecutar: Composer install

Crear el archivo .env con los comandos: cp .env.example .env

Generar la API key ejecutando: php artisan key:generate

En el archivo .env colocar el nombre de la base de datos

Para ejecutar las migraciones: php artisan migrate

Ejecutar npm install para las dependencias de node.js

10 Ejecutar php artisan serve para visualizarlo en el navegador o puedes usar Laragon, xammp, etc.
