<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
// Import the PetService — this connects your controller to the Service layer.
// The PetService in turn talks to the PetRepository, which interacts with the database.
use App\Services\PetService;

// Request class is used to handle and validate incoming HTTP requests
use Illuminate\Http\Request;

class PetController extends Controller
{
    // Declare a protected property to hold the PetService instance.
    // This will be automatically injected by Laravel's service container.
    protected $petService;

    // 🧩 The constructor uses Dependency Injection.
    // Laravel automatically creates an instance of PetService (and its dependencies)
    // and passes it to this controller when it is initialized.
    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function fetchPet($id)
    {
        return response()->json($this->petService->getPet($id));
    }

    // 📡 GET /api/pets
    // This method will handle requests to list all pets.
    public function fetchAllPets()
    {
        // The controller calls the Service layer instead of directly calling the model.
        // The PetService (app/Services/PetService.php) has a method getAllPets()
        // which internally calls the PetRepository to fetch data from the database.
        return response()->json($this->petService->getAllPets());
    }

    // 📨 POST /api/pets
    // This method handles the creation of a new pet.
    public function createPetProfile(Request $request)
    {
        // 🧮 Step 1: Validate incoming request data.
        // This ensures that required fields like "name" and "species" are provided.
        $data = $request->validate([
            'name' => 'required|string',
            'species' => 'required|string',
            'age' => 'nullable|integer',
        ]);

        // 🧩 Step 2: Pass validated data to the Service layer.
        // PetService handles the business logic (like transformation, additional checks, etc.)
        // and delegates to PetRepository for actual database insertion.
        $createdPet = $this->petService->createPet($data);

        // 🧾 Step 3: Return a JSON response with the created pet and a 201 (Created) status code.
        return response()->json($createdPet, 201);
    }

    public function updatePetProfile(Request $request, $id)
    {
        // 1. Validation (422 handled by Laravel)
        $data = $request->validate([
            'name' => 'required|string',
            'species' => 'required|string',
            'age' => 'nullable|integer',
        ]);

        // 2. Manual 404 Check (The Find or Fail Method)
        // If the pet is NOT found, Laravel throws a ModelNotFoundException, 
        // which automatically returns a 404 Not Found response.
        $pet = Pet::findOrFail($id);

        // 3. Business Logic: Update the Model via the Service
        // You now pass the $data and the retrieved Model's ID.
        $updatedPet = $this->petService->updatePet($data, $pet->id);

        // 4. System Error Check (Assuming service returns null/false on low-level failure)
        if (!$updatedPet) {
            return response()->json([
                'message' => 'System error during update.',
                'id' => $id
            ], 500);
        }

        // 5. Response if success:
        return response()->json([
            'message' => 'Pet updated successfully.',
            'data' => $updatedPet
        ], 200);
    }

    public function deletePetProfile($id)
    {
        $deletedPet = $this->petService->deletePet($id);

        if ($deletedPet === false) {
            return response()->json([
                'message' => 'System error during deletion.',
                'id' => $id
            ], 500);
        }

        return response()->json([
            'message' => 'Pet deleted successfully.',
            'id' => $id
        ], 200);
    }
}
