<?php

namespace App\Services;

use App\Traits\ConsumesInternalServices;
use Symfony\Component\HttpFoundation\Response;

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
     * Checks if authors exist
     *
     * @param int $author_id
     * @return array
     */
    public function authorExist($author_id) {
        $author_service_response = $this->getAuthor($author_id);

        if($author_service_response['status'] === Response::HTTP_NOT_FOUND) {
            return [
                "exist" => false,
                "response" => $author_service_response,
            ];
        }

        return [
            "exist" => true,
            "response" => $author_service_response,
        ];
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
