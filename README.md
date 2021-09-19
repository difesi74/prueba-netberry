## Prueba Netberry

El framework utilizado para el backend ha sido **Laravel 8** para PHP.

En la parte frontend se ha utilizado **Vue.js** (versión 2.6), **HTML5**, **CSS** y **Bootstrap 4**.

## Despliegue en localhost

- Desde terminal, y posicionados en el directorio de nuestros proyectos, ejecutar `git clone https://github.com/difesi74/prueba-netberry.git`.
- Desde la raíz del proyecto, cambiar permisos de carpetas mediante `sudo chmod -R 777 storage bootstrap/cache`.
- Copiar `.env.local` a `.env` mediante `cp .env.local .env`.
- Ejecutar `composer install` desde la raíz del proyecto, para descargar las dependencias de PHP en `/vendor`.
- Ejecutar `npm install & npm run dev` desde la raíz del proyecto, para descargar las dependencias de JS en `/node_modules` y ejecutar la configuración de webpack (hacerlo con **sudo**, y por separado, si no funciona).
- Crear una BD en MySQL que se llame **prueba_netberry**, con un usuario con ese mismo nombre que tenga permisos sobre la misma y password **Prueba@20210917**. El cotejamiento es indiferente (puede ser **utf8_general_ci**).
- Ejecutar `php artisan migrate --seed`desde la raíz del proyecto para generar las tablas necesarias en la BD y ejecutar el seeder.
- Finalmente ejecutar `php artisan serve` desde la raíz del proyecto para desplegar la aplicación en [localhost:8000](http://localhost:8000)