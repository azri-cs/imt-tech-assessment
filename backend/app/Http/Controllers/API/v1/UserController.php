<?php

namespace app\Http\Controllers\API\v1;

use App\Constants\ResponseStatusCodeConstants;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $users = User::all();

            return ResponseHelpers::success(
                UserResource::collection($users)
            );
        } catch (\Exception $e) {
            Log::error('Failed to retrieve users: ' . $e->getMessage());
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_NOT_FOUND
            );
        }
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = User::create($validated);

            return ResponseHelpers::success();
        } catch (HttpResponseException) {
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_CREATE_FAILED
            );
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_CREATE_FAILED
            );
        }
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $user = User::findOrFail($validated['id']);

            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }

            $user->update($validated);

            return ResponseHelpers::success();
        } catch (HttpResponseException|ModelNotFoundException) {
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_UPDATE_FAILED
            );
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_UPDATE_FAILED
            );
        }
    }

    public function destroy(DeleteUserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $user = User::findOrFail($validated['id']);
            $user->delete();

            return ResponseHelpers::success();
        } catch (HttpResponseException|ModelNotFoundException) {
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_DELETE_FAILED
            );
        } catch (\Exception $e) {
            Log::error('User deletion failed: ' . $e->getMessage());
            return ResponseHelpers::error(
                ResponseStatusCodeConstants::USER_DELETE_FAILED
            );
        }
    }
}
