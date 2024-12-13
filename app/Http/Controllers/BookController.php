<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        return response()->json([
            "success" => true,
            "data" => $books,
            "message" => "Acción realizada exitosamente."
        ]);
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
    public function store(BookRequest $request)
    {
        $book = Book::create($request->all());
        
        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ]);
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
    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->all());
        // $book = Book::find($id);
        // $book->title = $request->title;
        // $book->author = $request->author;
        // $book->published_year = $request->published_year;
        // $book->status = $request->status;
        // $book->borrowed_at = $request->borrowed_at;
        // $book->save();
        
        return response()->json([
            "success" => true,
            "data" => $book,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            "success" => true,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    public function filtered(Request $request)
    {
        $books = Book::where("author", "LIKE", "%".$request->author."%")->firstOrFail();

        return response()->json([
            "success" => true,
            "data" => $books,
            "message" => "Acción realizada exitosamente."
        ]);
    }

    public function borrow(string $id)
    {
        $book = Book::find($id);
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