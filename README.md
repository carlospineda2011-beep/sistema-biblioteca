# Sistema de Biblioteca

Sistema de gestión de biblioteca desarrollado en PHP con MySQL, que permite administrar libros, usuarios y préstamos.

## Funcionalidades

### Gestión de Libros
- Agregar libros con título, autor, ISBN y cantidad de copias
- Listar todos los libros registrados

### Gestión de Usuarios
- Registrar usuarios con nombre, email y teléfono
- Listar todos los usuarios registrados

### Gestión de Préstamos
- Registrar préstamos de libros a usuarios, con fecha de préstamo
- Listar todos los préstamos con su estado (activo/devuelto)

## Tecnologías utilizadas

- PHP (con MySQLi y sentencias preparadas para prevenir inyección SQL)
- MySQL
- HTML

## Instalación y configuración

### Requisitos previos
- XAMPP (con Apache y MySQL)
- Un navegador web

### Pasos de instalación

1. Cloná este repositorio dentro de la carpeta `htdocs` de tu instalación de XAMPP:

git clone https://github.com/carlospineda2011-beep/sistema-biblioteca

2. Iniciá **Apache** y **MySQL** desde el panel de control de XAMPP.

3. Abrí phpMyAdmin en tu navegador (`http://localhost/phpmyadmin`).

4. Creá una base de datos nueva llamada `biblioteca`.

5. Andá a la pestaña **SQL** de esa base de datos, pegá el contenido del archivo `biblioteca.sql` incluido en este repositorio, y ejecutalo. Esto creará las tablas `libros`, `usuarios` y `prestamos`.

6. Abrí el archivo `Conexion.php` y confirmá que los datos de conexión coincidan con tu configuración local (por defecto: usuario `root`, sin contraseña).

7. Accedé al sistema desde tu navegador:
http://localhost/biblioteca/index.php

## Estructura del proyecto

- `Conexion.php` — Clase para la conexión a la base de datos
- `Libro.php` — Clase con las operaciones CRUD de libros
- `Usuario.php` — Clase con las operaciones CRUD de usuarios
- `Prestamo.php` — Clase con las operaciones CRUD de préstamos
- `index.php` — Página principal con los formularios y listados
- `biblioteca.sql` — Script SQL para crear la base de datos y sus tablas

## Autor

Carlos Peña