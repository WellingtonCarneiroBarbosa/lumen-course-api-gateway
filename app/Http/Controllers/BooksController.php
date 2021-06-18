<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BooksController extends Controller
{
    use ApiResponse;

    /**
     * The service to consume books micro service
     *
     * @var \App\Services\BookService
     */
    protected $bookService;

     /**
     * The service to consume authors micro service
     *
     * @var \App\Services\AuthorService
     */
    protected $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
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
        if(! $request->author_id) {
            return $this->response(
                $request->all(),
                "author_id param is required",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        //Checks if author exist
        if(! $this->authorService->authorExist($request->author_id)['exist']) {
            return $this->response(
                $request->all(),
                "author_id param is invalid. Any author was found with this given id",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        };

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
        if(! $request->author_id) {
            return $this->response(
                $request->all(),
                "author_id param is required",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        //Checks if author exist
        if(! $this->authorService->authorExist($request->author_id)['exist']) {
            return $this->response(
                $request->all(),
                "author_id param is invalid. Any author was found with this given id",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        };

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
