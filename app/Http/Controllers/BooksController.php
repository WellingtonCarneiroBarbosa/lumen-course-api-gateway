<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    use ApiResponse;

    /**
     * The service to consume books micro service
     *
     * @var \App\Services\BookService
     */
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFromInternalService(
            $this->bookService->getBooks()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->responseFromInternalService(
            $this->bookService->createBook($request->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function show($book)
    {
        return $this->responseFromInternalService(
            $this->bookService->getBook($book)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        return $this->responseFromInternalService(
            $this->bookService->updateBook($request->all(), $book)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        return $this->responseFromInternalService(
            $this->bookService->destroyBook($book)
        );
    }
}
