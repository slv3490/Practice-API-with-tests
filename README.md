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
    
    APP_NAME="Nombre de tu aplicación"
    APP_URL=http://127.0.0.1:8000
    
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_datos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña

### 4. Generar la Clave de la Aplicación

Ejecuta el siguiente comando para generar una clave única para la aplicación:

    php artisan key:generate

### 5. Migrar la Base de Datos

Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

    php artisan migrate

### 6. Instalar Sanctum

Publica los archivos de configuración de Laravel Sanctum:

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

### 7. Iniciar el Servidor Local

Inicia el servidor de desarrollo de Laravel:

    php artisan serve

## Uso del Proyecto

El uso de esta API está documentado de manera interactiva mediante **Swagger UI**. Esta herramienta permite explorar los endpoints disponibles, probar las solicitudes directamente y obtener respuestas detalladas en tiempo real.

### Acceso a Swagger UI

Puedes acceder a la documentación de Swagger en la siguiente URL (asegúrate de tener el servidor en funcionamiento)

### Autenticación

Los endpoints de Books requieren autenticación mediante un token Bearer. Para autenticarte:

1. Haz clic en el botón **Authorize** en la parte superior derecha de la interfaz de Swagger.
2. Ingresa tu token de autenticación en el formato: Bearer {tu_token_aqui}
3. Haz clic en **Authorize** y luego en **Close**.

Una vez autenticado, Swagger UI enviará automáticamente el token en cada solicitud protegida.

### Ejemplo de uso

Haz click en el botón Try it out y rellenas los datos minimos para crear un libro.

#### Crear un Libro

```json
{
  "author": "Leonel Enrique Silvera",
  "title": "El Gran Libro",
  "published_year": 2024
}
```

## Arquitectura del Proyecto

Este proyecto sigue una arquitectura basada en el framework **Laravel**, con una separación clara de responsabilidades y componentes para facilitar la escalabilidad y el mantenimiento.

### Autenticación y Seguridad

El proyecto utiliza **Laravel Sanctum** para la autenticación basada en tokens. Esto permite:

- Proteger rutas de la API.
- Gestionar tokens personales para los usuarios.
- Manejar autenticación stateless (sin sesiones).

### Flujo de Trabajo de la API

1. **Solicitudes Entrantes:**  
   Las solicitudes llegan a través de las rutas definidas en `routes/api.php`.

2. **Middleware:**  
   Las solicitudes pasan por los middlewares, como la validación de tokens con Sanctum.

3. **Controladores:**  
   Los controladores procesan la solicitud, interactúan con los modelos y devuelven respuestas JSON.

4. **Respuestas:**  
   Las respuestas se estructuran en formato JSON para ser consumidas por clientes externos, como aplicaciones web o móviles.

### Tecnología y Herramientas Utilizadas

- **PHP ^8.2**: Lenguaje base del proyecto.
- **Laravel ^11.31**: Framework principal.
- **Sanctum ^4.0**: Autenticación basada en tokens.
- **MySQL**: Sistema de gestión de base de datos.
- **Swagger ^8.6 (L5 Swagger)**: Documentación interactiva de la API.

## Testing

Este proyecto incluye pruebas para garantizar la funcionalidad de los componentes clave.

Para ejecutar las pruebas, asegúrate de haber instalado todas las dependencias del proyecto y de tener configurada la base de datos de pruebas si es necesario. Usa el siguiente comando:

```
php artisan test
```

### Configuración de la Base de Datos de Pruebas

Si las pruebas requieren una base de datos, asegúrate de configurar correctamente el entorno de pruebas en el archivo `.env.testing`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_base_de_datos_testing
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### Ejemplo de una Prueba

A continuación, un ejemplo de una prueba de característica para la creación de un recurso:

#### Test para crear un libro

```
public function test_can_create_a_book(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route("books.store"), [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);

        $response->assertStatus(200);

        $response->assertValid(['author', 'title', 'published_year']);

        $response->assertExactJson([
            "success" => true,
            "data" => [
                "title" => "Un titulo loren ipsum dolor a acts",
                "author" => "Leonel Enrique Silvera",
                "published_year" => 2024,
                "status" => "disponible",
                "borrowed_at" => "2024-12-12",
                "id" => 1
            ],
            "message" => "Acción realizada exitosamente."
        ]);
        $this->assertDatabaseCount("books", 1);
        $this->assertDatabaseHas("books", [
            "title" => "Un titulo loren ipsum dolor a acts",
            "author" => "Leonel Enrique Silvera",
            "published_year" => 2024,
            "status" => "disponible",
            "borrowed_at" => "2024-12-12"
        ]);
    }
```