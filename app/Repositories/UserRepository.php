<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all(); // Get all users from the database
    }

    public function find($id)
    {
        return User::findOrFail($id); // Find a user by its ID from the database
    }

    public function findByEmail($email) // Find a user by its email from the database for login
    {
        return User::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return User::create($data); // Create a new user in the database
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id); // Find the user by its ID
        $user->update($data); // Update the user
        return $user; // Return the updated user
    }
    public function delete($id)
    {
        $user = User::findOrFail($id); // Find the user by its ID
        return $user->delete(); // Delete the user
    }
}
