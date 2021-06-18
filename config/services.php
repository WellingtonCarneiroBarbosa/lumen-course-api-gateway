<?php

return [
    /**
     * Authors service configurations
     *
     */
    'authors' => [
        'base_uri' => env('AUTHORS_SERVICE_BASE_URL', 'http://localhost:4001'),
    ],

    /**
     * Books service configurations
     *
     */
    'books' => [
        'base_uri' => env('BOOKS_SERVICE_BASE_URL', 'http://localhost:4002'),
    ],
];
