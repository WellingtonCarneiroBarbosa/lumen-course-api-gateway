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

}
