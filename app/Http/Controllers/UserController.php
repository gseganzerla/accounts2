<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Requests\UpdateUserPassword;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{

    public function __construct(
        private UserService $userService
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = $this->userService->show(auth()->user()->uuid);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUser  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request)
    {
        $user = $this->userService->update(auth()->user(), $request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->userService->destroy(auth()->user());

        return response()->json(['message' => 'Success']);
    }

    public function changeCurrentPassword(UpdateUserPassword $request)
    {
        $this->userService->changeCurrentPassword($request->all());

        return response()->json(['message' => 'Success']);
    }

    public function me()
    {
        $user = $this->userService->me();

        return new UserResource($user);
    }
}
