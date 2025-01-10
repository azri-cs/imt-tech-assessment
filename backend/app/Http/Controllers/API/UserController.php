<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    public function store(StoreUserRequest $request)
    {
        //TODO
    }

    public function show(string $id): AnonymousResourceCollection
    {
        return UserResource::collection(User::find($id));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        //TODO
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        //TODO
    }
}
