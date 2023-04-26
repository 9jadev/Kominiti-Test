<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\FireAndIceService;
use App\Http\Resources\FireAndIceCollection;
use App\Models\Authors;

class BookController extends Controller
{

    public function externalBooks(FireAndIceService $fireAndIceService) {
        $name = request()->query("name");
        $data =  $fireAndIceService->fetchBook($name);
        $bookData = [];
        if ($data == null) {
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "data" => []
            ], 200);
        }
        foreach ($data as $item) {
            $bookDataItem = [];
            $bookDataItem["url"] = $item["url"];
            $bookDataItem["name"] = $item["name"];
            $bookDataItem["isbn"] = $item["isbn"];
            $bookDataItem["authors"] = $item["authors"];
            $bookDataItem["numberOfPages"] = $item["numberOfPages"];
            $bookDataItem["publisher"] = $item["publisher"];
            $bookDataItem["publisher"] = $item["publisher"];
            $bookDataItem["country"] = $item["country"];
            $bookDataItem["mediaType"] = $item["mediaType"];
            $bookDataItem["released"] = $item["released"];
            $bookData[] = $bookDataItem;
        }
        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => collect($bookData)
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::get();
        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => $books
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateBookRequest $request)
    {
       $data = $request->validated();
       return $this->store($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        $authors = $data["authors"];
        unset($data["authors"]);
        $book = Book::create($data);
        foreach ($authors as $value) {
            Authors::create(["author_name" => $value, "book_id" => $book->id]);
        }
        $book->refresh();
        return response([
            "status_code" => 201,
            "status" => "success",
            "data" => $book
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response([
            "status_code" => 201,
            "status" => "success",
            "data" => $book
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CreateBookRequest $request,  Book $book)
    {
        $data = $request->validated();
       return $this->update($data, $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, Book $book)
    {

        $authors = $data["authors"];
        unset($data["authors"]);
        $book->update($data);
        foreach ($authors as $value) {
            Authors::create(["author_name" => $value, "book_id" => $book->id]);
        }
        $book->refresh();

        return response([
            "status_code" => 200,
            "status" => "success",
            "message" => "The book My First Book was updated successfully",
            "data" => $book
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => $book
        ], 200);
    }
}
