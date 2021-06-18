<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    use ApiResponse;

    /**
     * The service to consume authors micro service
     *
     * @var \App\Services\AuthorService
     */
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $author
     * @return \Illuminate\Http\Response
     */
    public function show($author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($author)
    {
        //
    }
}
