<?php

namespace App\Repositories;

use App\Models\Pet;

class PetRepository
{
    public function getAll()
    {
        return Pet::all(); // Get all pets from the database
    }

    public function find($id)
    {
        return Pet::findOrFail($id); // Find a pet by its ID from the database
    }

    public function create(array $data)
    {
        return Pet::create($data); // Create a new pet in the database
    }

    public function update($id, array $data)
    {
        $pet = Pet::findOrFail($id); // Find the pet by its ID
        $pet->update($data); // Update the pet
        return $pet; // Return the updated pet
    }

    public function delete($id)
    {
        $pet = Pet::findOrFail($id); // Find the pet by its ID
        return $pet->delete(); // Delete the pet
    }
}
