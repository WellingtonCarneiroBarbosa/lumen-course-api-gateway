<?php

namespace App\Services;

use App\Traits\ConsumesInternalServices;

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

}
