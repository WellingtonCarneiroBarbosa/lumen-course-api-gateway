<?php

namespace App\Services;

use App\Traits\ConsumesInternalServices;
use Illuminate\Support\Facades\Request;

class BookService
{
    use ConsumesInternalServices;

    /**
     * The service base_uri
     *
     * @var string
     */
    public $base_uri;

    /**
     * BookService class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->base_uri = config('services.books.base_uri');
    }

    /**
     * Get Books
     *
     * @return array
     */
    public function getBooks()
    {
        return $this->performRequest("GET", "/books");
    }

    /**
     * Get a specific book
     *
     * @param int $book
     * @return array
     */
    public function getBook($book)
    {
        return $this->performRequest("GET", "/books/{$book}");
    }

    /**
     * Create a new book
     *
     * @param array $data
     *
     * @return array
     */
    public function createBook(array $data)
    {
        return $this->performRequest("POST", "/books", $data);
    }

    /**
     * Update a book
     *
     * @param array $data
     * @param int $book
     *
     * @return array
     */
    public function updateBook(array $data, $book)
    {
        return $this->performRequest("PUT", "/books/{$book}", $data);
    }

    /**
     * Destroy a book
     *
     * @param int $book
     *
     * @return array
     */
    public function destroyBook($book)
    {
        return $this->performRequest("DELETE", "/books/{$book}");
    }
}
