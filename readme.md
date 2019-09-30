# Embirrados
## Proyecto
Desarrollamos un juego de preguntas y respuestas cuya temática y sistema de premios están pensados para adaptarse a los bares, pubs y locales gastronómicos que soliciten el juego.
Los participantes obtendrán 1 punto por cada respuesta correcta, conforme avance el juego, se generará un ranking de usuarios y el establecimiento será el encargado del sistema de premios.

## Instalación del sistema
- Clonar el repo desde [nuestro GitHub](https://github.com/team-trueno/embirrados-laravel)
- Ejecutar __composer update__
- Duplicar el archivo **.env.example**, y renombrarlo a **.env**
- Ejecutar el comando __php artisan key:generate__
- Crear una base de datos y cargar los datos de acceso en el archivo **.env**
- Rellenar los datos del **usuario superadmin de la APP** en el archivo **.env** en caso de que quieran ser personalizados, caso contrario usará los valores por defecto.
- Ejecutar el comando __composer dump-autoload__
- Ejecutar __php artisan migrate --seed__

## Team Trueno®
- Darío Marañes
- Luis Fernández Blanco
- Santiago Facchini
