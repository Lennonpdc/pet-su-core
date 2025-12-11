<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::get('/pets', [PetController::class, 'fetchAllPets']);
Route::get('/pets/{id}', [PetController::class, 'fetchPet']);
Route::post('/pets', [PetController::class, 'createPetProfile']);
Route::delete('/pets/{id}', [PetController::class, 'deletePetProfile']);
Route::put('/pets/{id}', [PetController::class, 'updatePetProfile']);
