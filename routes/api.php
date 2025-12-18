<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\UserController;

//PETS
Route::get('/pets', [PetController::class, 'fetchAllPets']);
Route::get('/pets/{id}', [PetController::class, 'fetchPet']);
Route::post('/pets', [PetController::class, 'createPetProfile']);
Route::delete('/pets/{id}', [PetController::class, 'deletePetProfile']);
Route::put('/pets/{id}', [PetController::class, 'updatePetProfile']);

//USERS
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::post('/users', [UserController::class, 'createUser']);
Route::get('/users/{id}', [UserController::class, 'fetchUsers']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);