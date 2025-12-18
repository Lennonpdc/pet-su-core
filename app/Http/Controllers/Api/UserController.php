<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

// Import the UserService — this connects your controller to the Service layer.
// The UserService in turn talks to the UserRepository, which interacts with the database.
use App\Services\UserService;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Declare a protected property to hold the UserService instance.
    // This will be automatically injected by Laravel's service container.
    protected $userService;

    // 🧩 The constructor uses Dependency Injection.
    // Laravel automatically creates an instance of UserService (and its dependencies)
    // and passes it to this controller when it is initialized.
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function fetchUsers()
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return response()->json($this->userService->createUser($data));
    }
}