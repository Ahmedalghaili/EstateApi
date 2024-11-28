<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and assigned to the
| "api" middleware group. Build your API for real estate management!
|
*/

// Default API route
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Real Estate API!',
        'available_endpoints' => [
            'POST /api/properties' => 'Create a new property',
            'GET /api/properties' => 'List all properties',
            'GET /api/properties/search' => 'Search for properties by criteria',
        ],
    ]);
});

// Property routes
Route::post('properties', [PropertyController::class, 'store']);   // Create a new property
Route::get('properties', [PropertyController::class, 'index']);   // List all properties
Route::get('properties/search', [PropertyController::class, 'search']); // Search properties by criteria

// Authenticated user endpoint (optional, requires Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
