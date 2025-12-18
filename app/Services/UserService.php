<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository; // Dependency injection

    public function __construct(UserRepository $userRepository) // Dependency injection from userRepository
    {
        $this->userRepository = $userRepository; // $this->userRepository is an instance of userRepository that will be used to interact with the database
    }

    public function getAllUsers() // A function to get all users
    {
        return $this->userRepository->getAll(); // Get all users from the database
    }

    public function createUser(array $data) // A function to create a user
    {
        return $this->userRepository->create($data); // Create a new user in the database
    }

    public function updateUser(array $data, $id) // A function to update a user
    {
        return $this->userRepository->update($data, $id); // Update a user in the database
    }

    public function deleteUser($id) // A function to delete a user
    {
        return $this->userRepository->delete($id); // Delete a user from the database
    }

    public function getUser($id) // A function to get a user
    {
        return $this->userRepository->find($id); // Find a user by its ID from the database
    }
}