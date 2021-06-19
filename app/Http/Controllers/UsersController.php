<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use ApiResponse;

    /**
     * The default form rules
     *
     * @var array
     */
    protected $rules = [
        "name"          => ['required', 'string', 'max:255'],
        "email"         => ['required', 'email', 'max:255', 'unique:users,email'],
        "password"      => ['required', 'min:8', 'confirmed']
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            User::paginate(15),
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, $this->rules);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $this->response(
            $user,
            "User created sucessfully",
            Response::HTTP_CREATED,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user)
    {
        $user = User::findOrFail($user);

        return $this->response($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);

        // Custom rules for updating
        $rules = $this->rules;

        $rules['email'][3] =  $rules['email'][3] . "," . $user;
        unset($rules['password'][0]);
        array_push($rules['password'], 'nullable');

        $data = $this->validate($request, $rules);

        if($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);

        if($user->isClean()) {
            return $this->response(
                [],
                "At least one value must change",
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user->save();

        return $this->response(
            $user,
            "User {$user->name} updated sucessfully",
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($user)
    {
        $user = User::findOrFail($user);

        $user->delete();

        return $this->response(
            [],
            "User {$user->title} deleted sucessfully",
            Response::HTTP_OK
        );
    }

    /**
     * Returns the current authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $this->response(
            $request->user(),
        );
    }
}
