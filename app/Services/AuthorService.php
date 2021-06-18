<?php

namespace App\Services;

use App\Traits\ConsumesInternalServices;

class AuthorService
{
    use ConsumesInternalServices;

    /**
     * The service base_uri
     *
     * @var string
     */
    public $base_uri;

    /**
     * AuthorService class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->base_uri = config('services.authors.base_uri');
    }

    /**
     * Get Authors
     *
     * @return array
     */
    public function getAuthors()
    {
        return $this->performRequest("GET", "/authors");
    }

    /**
     * Get a specific author
     *
     * @param int $author
     * @return array
     */
    public function getAuthor($author)
    {
        return $this->performRequest("GET", "/authors/{$author}");
    }

    /**
     * Create a new author
     *
     * @param array $data
     *
     * @return array
     */
    public function createAuthor(array $data)
    {
        return $this->performRequest("POST", "/authors", $data);
    }

    /**
     * Update a author
     *
     * @param array $data
     * @param int $author
     *
     * @return array
     */
    public function updateAuthor(array $data, $author)
    {
        return $this->performRequest("PUT", "/authors/{$author}", $data);
    }

    /**
     * Destroy a author
     *
     * @param int $author
     *
     * @return array
     */
    public function destroyAuthor($author)
    {
        return $this->performRequest("DELETE", "/authors/{$author}");
    }
}
