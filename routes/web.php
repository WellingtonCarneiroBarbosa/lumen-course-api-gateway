<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => config('app.name') . " - " . $router->app->version(),
        "status" => 200,
    ], 200);
});

/**
 * User authenticated routes
 */
$router->group(['middleware' => 'auth:api'], function () use ($router) {
    /**
     * User Routes
     *
     */
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get("/", "UsersController@index");
        $router->get("/me", "UsersController@me");

        // User id prefix routes
        $router->group(['prefix' => "{user}"], function () use ($router) {
            $router->get("/", "UsersController@show");
            $router->put("/", "UsersController@update");
            $router->delete("/", "UsersController@destroy");
        });
    });

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

/**
 * App Authenticated routes
 */
$router->group(['middleware' => 'client.credentials'], function () use ($router) {
    $router->post("/", "UsersController@store");
});

