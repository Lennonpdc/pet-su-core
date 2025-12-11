<?php

namespace App\Services;

use App\Repositories\PetRepository;

class PetService
{
    protected $petRepository; // Dependency injection

    public function __construct(PetRepository $petRepository) // Dependency injection from PetRepository
    {
        $this->petRepository = $petRepository; // $this->petRepository is an instance of PetRepository that will be used to interact with the database
    }

    public function getPet($id) // A function to get a pet
    {
        return $this->petRepository->find($id); // Find a pet by its ID from the database
    }

    public function getAllPets() // A function to get all pets
    {
        return $this->petRepository->getAll(); // Get all pets from the database
    }

    public function createPet(array $data) // A function to create a pet
    {
        return $this->petRepository->create($data); // Create a new pet in the database
    }

    public function deletePet($id) // A function to delete a pet
    {
        return $this->petRepository->delete($id); // Delete a pet from the database
    }

    public function updatePet(array $data, $id) // A function to update a pet
    {
        return $this->petRepository->update($data, $id); // Update a pet in the database
    }
}
