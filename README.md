# Sistema de Gestión de Biblioteca

Mini-aplicación en PHP orientada a objetos para gestionar libros, usuarios y préstamos de una biblioteca.

## Funcionalidades

### Gestión de Libros
- Agregar libros (título, autor, ISBN, cantidad)
- Listar libros disponibles

### Gestión de Usuarios
- Registrar usuarios (nombre, email, teléfono)
- Listar usuarios

### Gestión de Préstamos
- Registrar préstamo de un libro a un usuario (actualiza el stock automáticamente)
- Registrar devolución (actualiza fecha de devolución, estado, y repone el stock)
- Ver listado de préstamos activos

## Tecnologías utilizadas

- PHP con PDO (sentencias preparadas para prevenir inyección SQL)
- MySQL
- Programación orientada a objetos
- HTML

## Estructura del proyecto

biblioteca/
├── classes/
│   ├── Database.php     # Conexión PDO a la base de datos
│   ├── Biblioteca.php   # Lógica CRUD completa (libros, usuarios, préstamos)
│   ├── Libro.php        # Modelo de datos: Libro
│   ├── Usuario.php      # Modelo de datos: Usuario
│   └── Prestamo.php     # Modelo de datos: Préstamo
├── index.php             # Interfaz web (navegación por ?action=)
├── biblioteca.sql        # Script de creación de la base de datos
└── README.md


## Instalación y configuración

### Requisitos previos
- XAMPP (Apache + MySQL)

### Pasos

1. Cloná este repositorio dentro de la carpeta `htdocs` de XAMPP:

git clone https://github.com/carlospineda2011-beep/sistema-biblioteca.git


2. Iniciá **Apache** y **MySQL** desde el panel de XAMPP.

3. Abrí phpMyAdmin (`http://localhost/phpmyadmin`) y creá una base de datos llamada `biblioteca`.

4. En la pestaña **SQL** de esa base, pegá y ejecutá el contenido de `biblioteca.sql`.

5. Confirmá que `classes/Database.php` tenga los datos correctos de tu conexión local (por defecto: usuario `root`, sin contraseña).

6. Accedé al sistema desde el navegador:

http://localhost/biblioteca/index.php


## Navegación

El sistema usa un parámetro `?action=` en la URL para moverse entre secciones:
- `index.php` — Libros (sección por defecto)
- `index.php?action=usuarios` — Usuarios
- `index.php?action=prestamos` — Préstamos

## Autor

Carlos Peña