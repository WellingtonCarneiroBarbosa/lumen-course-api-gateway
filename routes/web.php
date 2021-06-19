<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => config('app.name') . " - " . $router->app->version(),
        "status" => 200,
    ], 200);
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    /**
     * Books Routes
     *
     */
    $router->group(['prefix' => 'books'], function () use ($router) {
        $router->get("/", "BooksController@index");
        $router->post("/", "BooksController@store");

        // Book id prefix routes
        $router->group(['prefix' => "{book}"], function () use ($router) {
            $router->get("/", "BooksController@show");
            $router->put("/", "BooksController@update");
            $router->delete("/", "BooksController@destroy");
        });
    });

    /**
     * Authors Routes
     *
     */
    $router->group(['prefix' => 'authors'], function () use ($router) {
        $router->get("/", "AuthorsController@index");
        $router->post("/", "AuthorsController@store");

        // Author id prefix routes
        $router->group(['prefix' => "{author}"], function () use ($router) {
            $router->get("/", "AuthorsController@show");
            $router->put("/", "AuthorsController@update");
            $router->delete("/", "AuthorsController@destroy");
        });
    });
});

