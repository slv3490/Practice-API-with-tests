# Practica del uso de APIs y testeo del mismo

## Introducción

Desarrolle una pequeña api de libros donde se realiza un C.R.U.D tipico de libros que aparte de la funcionalidad crud, tambien los libros pueden ser prestados y filtrados por el nombre del autor.

La meta principal del proyecto es repasar los conceptos basicos de API y testing.

## Tabla de Contenidos

##### 1. [Introducción](#introducción)

##### 2. [Requisitos Previos](#requisitos-previos)

##### 3. [Instalación](#instalación)

##### 4. [Uso del Proyecto](#uso-del-proyecto)

##### 5. [Arquitectura del Proyecto](#arquitectura-del-proyecto)

##### 6. [Configuración](#configuración)

##### 7. [Contribuciones](#contribuciones)

##### 8. [Pruebas](#pruebas)

##### 9. [Despliegue](#despliegue)

##### 10. [Licencia](#licencia)

##### 11. [Autor o Mantenedores](#autor-o-mantenedores)

##### 12. [Preguntas Frecuentes (FAQ)](#preguntas-frecuentes-faq)

##### 13. [Referencias](#referencias)

## Requisitos Previos

Antes de comenzar, asegúrate de que tu entorno cumple con los siguientes requisitos:

1. Sistema Operativo
    - Windows, macOS o Linux.
2. PHP
    - Versión requerida: ^8.2

Verifica la versión instalada ejecutando:

> php -v

3. Composer
    - Es necesario para gestionar las dependencias de PHP.
Instálalo desde [getcomposer.org](https://getcomposer.org/)

4. Node.js y NPM (opcional)
    - Si planeas trabajar con el frontend del proyecto (en caso de que lo tenga).
Verifica su instalación con:

> node -v
> npm -v

5. Docker (opcional)
    - Si deseas usar Laravel Sail para gestionar el entorno de desarrollo.
Descarga Docker desde docker.com.

6. Dependencias del Proyecto

    Estas dependencias serán instaladas automáticamente al ejecutar `composer install`:
    
    - **Laravel Framework:** `^11.31`
    - **Laravel Sanctum:** `^4.0` (para autenticación basada en tokens)
7. Dependencias para Desarrollo (opcional)
    - **Laravel Sail:** `^1.26` (entorno Docker)
    - **Laravel Pint:** `^1.13` (formateo de código)
    - **PHPUnit:** `^11.0.1` (pruebas automatizadas)
    - **Mockery:** `^1.6` (mocking para pruebas)
    - **Nunomaduro Collision:** `^8.1` (mejora en mensajes de error)

#### Comprobaciones Básicas
Asegúrate de que las herramientas clave están instaladas correctamente:

> #### Verifica PHP
> php -v
>
> #### Verifica Composer
> composer -v
>
> #### Verifica Docker (si usas Sail)
> docker --version

## Instalación

Sigue estos pasos para instalar y configurar el proyecto localmente:

### 1. Clonar el Repositorio

    git clone https://github.com/slv3490/Practice-API-with-tests.git
    
    cd Practice-API-with-tests
    
### 2. Instalar Dependencias

Instala las dependencias necesarias con Composer:

    composer install
    
### 3. Configurar Variables de Entorno

Puedes copiar el archivo `.env.example` y renómbralo como `.env` y luego, configura las credenciales de tu base de datos y otros ajustes en el archivo `.env`:
    
    APP_NAME="Nombre de tu API"
    APP_URL=http://127.0.0.1:8000
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_datos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña
