<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
/**
    * @OA\Info(
    *             title="Título que mostraremos en swagger", 
    *             version="1.0",
    *             description="Descripcion"
    * )
    *
    */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Obtener todos los libros",
     *     tags={"Libros"},
     *     description="Devuelve una lista de todos los libros.",
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="El Gran Libro"
     *                     ),
     *                     @OA\Property(
     *                         property="author",
     *                         type="string",
     *                         example="Autor Ejemplo"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error interno del servidor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Ocurrió un error interno"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $books = Book::all();

        return response()->json([
            "success" => true,
            "data" => $books,
            "message" => "Acción realizada exitosamente"
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/books",
     *     summary="Crear un nuevo libro",
     *     tags={"Libros"},
     *     description="Crea un nuevo libro y devuelve los detalles del libro creado.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos minimos para crear un libro.",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"author", "title", "published_year"},
     *             @OA\Property(
     *                 property="author",
     *                 type="string",
     *                 example="Leonel Enrique Silvera",
     *                 description="El campo de autor es obligatorio."
     *             ),
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 example="El Gran Libro",
     *                 description="El título del libro debe ser único en la base de datos."
     *             ),
     *             @OA\Property(
     *                 property="published_year",
     *                 type="integer",
     *                 example=2024,
     *                 description="El año de publicación del libro. Debe ser un número entero entre 1900 y el año actual."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="author",
     *                     type="string",
     *                     example="Leonel Enrique Silvera"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="El Gran Libro"
     *                 ),
     *                 @OA\Property(
     *                     property="published_year",
     *                     type="integer",
     *                     example=2024
     *                 ),
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Solicitud incorrecta, parámetros faltantes o inválidos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="El título debe ser único y el año de publicación debe estar entre 1900 y el año actual."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description= "Contenido no procesable.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="El título debe ser único y el año de publicación debe estar entre 1900 y el año actual."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="array",
     *                 @OA\items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example= "El título ya está tomado."
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */
    public function store(BookRequest $request)
    {
        $book = Book::create($request->all());
        
        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ], 200);
    }

    /**
     * Display the specified resource.
     */

     /**
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Obtener un libro por su ID",
     *     tags={"Libros"},
     *     description="Obtiene los detalles de un libro por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del libro",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="1"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="El Gran Libro"
     *                 ),
     *                 @OA\Property(
     *                     property="author",
     *                     type="string",
     *                     example="Leonel Enrique Silvera"
     *                 ),
     *                 @OA\Property(
     *                     property="published_year",
     *                     type="integer",
     *                     example=2024
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     example="prestado"
     *                 ),
     *                 @OA\Property(
     *                     property="borrowed_at",
     *                     type="string",
     *                     example="2024-12-11 00:00:00"
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Libro no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="El libro no fue encontrado."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */

    public function show(string $id)
    {
        $book = Book::find($id);

        if(!$book) {
            return response()->json([
                "success" => false,
                "message" => "El libro no fue encontrado."
            ], 404);
        }
        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

     /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     summary="Actualizar un libro",
     *     tags={"Libros"},
     *     description="Actualiza un libro existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del libro a actualizar",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="1"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Datos para actualizar el libro",
     *         @OA\JsonContent(
     *             type="object",
     *             required={"author", "title", "published_year"},
     *             @OA\Property(
     *                 property="author",
     *                 type="string",
     *                 example= "Nuevo autor"
     *             ),
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 example="Nuevo Título"
     *             ),
     *             @OA\Property(
     *                 property="published_year",
     *                 type="integer",
     *                 example=2015
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="author",
     *                     type="string",
     *                     example="Nuevo autor"
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="El Gran Libro Actualizado"
     *                 ),
     *                 @OA\Property(
     *                     property="published_year",
     *                     type="integer",
     *                     example=2000
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     example="disponible"
     *                 ),
     *                 @OA\Property(
     *                     property="borrowed_at",
     *                     type="string",
     *                     example="2024-12-11 00:00:00"
     *                 ),
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Libro no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="El libro no fue encontrado."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Datos no válidos",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Los datos proporcionados no son válidos."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */

    public function update(BookRequest $request, int $id)
    {
        $book = Book::find($id);
        if(!$book) {
            return response()->json([
                "success" => false,
                "message" => "El libro no fue encontrado."
            ]);
        }
        
        $book->update($request->all());

        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */

     /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Eliminar un libro",
     *     tags={"Libros"},
     *     description="Elimina un libro existente por su ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del libro a eliminar",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="1"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Libro no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="El libro no fue encontrado."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */

    public function destroy($id)
    {
        $book = Book::find($id);
        if(!$book) {
            return response()->json([
                "success" => false,
                "message" => "El libro no fue encontrado."
            ]);
        }
        $book->delete();
        return response()->json([
            "success" => true,
            "message" => "Acción realizada exitosamente."
        ]);

    }

    /**
     * @OA\Post(
     *     path="/api/books/filter-by-author",
     *     summary="Filtrar libros por autor",
     *     tags={"Libros"},
     *     description="Filtra libros según el nombre del autor proporcionado",
     *     @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="Nombre del autor a filtrar",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="Leonel Enrique Silvera"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example="Harry Potter and the Philosopher's Stone"
     *                     ),
     *                     @OA\Property(
     *                         property="author",
     *                         type="string",
     *                         example="Leonel Enrique Silvera"
     *                     ),
     *                     @OA\Property(
     *                         property="published_year",
     *                         type="integer",
     *                         example=1997
     *                     ),
     *                     @OA\Property(
     *                         property="status",
     *                         type="integer",
     *                         example="disponible"
     *                     ),
     *                     @OA\Property(
     *                         property="borrowed_at",
     *                         type="string",
     *                         example="2024-12-13 09:20:44"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron libros",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="No se encontraron libros para el autor especificado."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */

    public function filtered(Request $request)
    {
        $books = Book::where("author", "LIKE", "%".$request->author."%")->get();

        return response()->json([
            "success" => true,
            "data" => $books,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/books/{id}/borrow",
     *     summary="Prestar un libro",
     *     tags={"Libros"},
     *     description="Marca un libro como prestado y guarda la fecha y hora del préstamo.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del libro que se desea prestar",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="1"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Acción realizada exitosamente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Acción realizada exitosamente."
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Harry Potter and the Philosopher's Stone"
     *                 ),
     *                 @OA\Property(
     *                     property="author",
     *                     type="string",
     *                     example="J.K. Rowling"
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     example="prestado"
     *                 ),
     *                 @OA\Property(
     *                     property="borrowed_at",
     *                     type="string",
     *                     format="date-time",
     *                     example="2024-12-19T10:15:00"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Libro no encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Libro no encontrado."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sin autenticación necesaria",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example= "Unauthenticated."
     *             )
     *         )
     *     )
     * )
     */

    public function borrow(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                "success" => false,
                "message" => "Libro no encontrado."
            ], 404);
        }
        
        $book->status = "prestado";
        $book->borrowed_at = date("Y-m-d h:i:s");
        $book->save();

        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ]);
    }
}