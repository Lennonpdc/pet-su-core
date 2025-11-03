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

    public function getAllPets() // A function to get all pets
    {
        return $this->petRepository->getAll(); // Get all pets from the database
        // return $this->petRepository->findById($id); // Get 1 data from the database
    }

    public function createPet(array $data) // A function to create a pet
    {
        return $this->petRepository->create($data); // Create a new pet in the database
    }
}
