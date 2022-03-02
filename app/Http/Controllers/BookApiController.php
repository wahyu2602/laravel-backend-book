<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all();

        return response()->json([
            'message' => 'success',
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required|max:30',
            'pengarang' => 'required',
            'image' => 'image|max:1024'
        ]);

        Book::create($validate);

        return response()->json(['message' => 'success created!'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book)
    {
        $data = Book::where('id', $book)->first();

        return response()->json([
            'message' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        $validate = $request->validate([
            'judul' => 'required|max:50',
            'pengarang' => 'required|max:30',
            'image' => 'image|max:1024'
        ]);

        Book::where('id', $book)->update([
            'judul' => $validate['judul'],
            'pengarang' => $validate['pengarang']
        ]);

        return response()->json([
            'message' => 'success updated!',
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        Book::where('id', $book)->delete();

        return response()->json([
            'message' => 'data success deleted!'
        ], Response::HTTP_ACCEPTED);
    }
}
