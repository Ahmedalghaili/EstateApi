<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;

class PropertyController extends Controller
{
    public function index()
    {
        try {
            // Retrieve all properties
            $properties = Property::all();
            return response()->json([
                'message' => 'Properties retrieved successfully.',
                'data' => $properties
            ]);
        } catch (Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'error' => 'Failed to retrieve properties.',
                'details' => $e->getMessage()
            ], 500); // Internal Server Error
        }
    }

    public function store(Request $request)
{
    try {
        // Validate incoming request with custom validation messages
        $validated = $request->validate([
            'type' => 'required|in:house,apartment', // Property type (House or Apartment)
            'address' => 'required|string', // Address of the property
            'size' => 'required|numeric', // Size of the property (numeric value)
            'bedrooms' => 'required|integer', // Number of bedrooms (integer value)
            'latitude' => 'required|numeric|between:-90,90', // Latitude (valid range)
            'longitude' => 'required|numeric|between:-180,180', // Longitude (valid range)
            'price' => 'required|numeric', // Price of the property (numeric value)
        ], [
            // Custom error messages for specific validation rules
            'type.required' => 'The property type is required.',
            'type.in' => 'The property type must be either "house" or "apartment".',
            'address.required' => 'The address of the property is required.',
            'size.required' => 'The size of the property is required.',
            'size.numeric' => 'The size must be a valid number.',
            'latitude.between' => 'Latitude must be between -90 and 90 degrees.',
            'longitude.between' => 'Longitude must be between -180 and 180 degrees.',
            'price.required' => 'The price of the property is required.',
        ]);

        // Check if a property with the same address and price already exists
        $existingProperty = Property::where('address', $validated['address'])
            ->where('type', $validated['type'])
            ->where('price', $validated['price'])
            ->first();

        if ($existingProperty) {
            return response()->json([
                'message' => 'A property with the same address and price already exists.',
                'data' => $existingProperty
            ], 409); // Conflict error
        }

        // Create a new property
        $property = Property::create($validated);

        // Return success response with the created property data
        return response()->json([
            'message' => 'Property created successfully!',
            'data' => $property
        ], 201); // Success response with status 201
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return detailed validation errors if validation fails
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors() // Get all the validation errors as an array
        ], 422); // Unprocessable Entity error (422)
    } catch (Exception $e) {
        // Catch any other unexpected errors
        return response()->json([
            'error' => 'An unexpected error occurred while creating the property.',
            'details' => $e->getMessage()
        ], 500); // Internal Server Error (500)
    }
}

    public function search(Request $request)
    {
        try {
            // Build query
            $query = Property::query();

            // Apply filters
            if ($request->has('type')) {
                $query->where('type', $request->input('type'));
            }
            if ($request->has('address')) {
                $query->where('address', 'like', '%' . $request->input('address') . '%');
            }
            if ($request->has('size')) {
                $query->where('size', '>=', $request->input('size'));
            }
            if ($request->has('bedrooms')) {
                $query->where('bedrooms', '>=', $request->input('bedrooms'));
            }
            if ($request->has('price')) {
                $query->where('price', '<=', $request->input('price'));
            }

            // Geographical search
            if ($request->has(['latitude', 'longitude', 'radius'])) {
                $latitude = $request->input('latitude');
                $longitude = $request->input('longitude');
                $radius = $request->input('radius');

                if (is_numeric($latitude) && is_numeric($longitude) && is_numeric($radius)) {
                    $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?", [
                        $longitude,
                        $latitude,
                        $radius * 1000 // Convert radius to meters
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Invalid geographical search parameters.'
                    ], 400); // Bad Request
                }
            }

            // Paginate results
            $properties = $query->paginate(10);

            if ($properties->isEmpty()) {
                return response()->json([
                    'message' => 'No properties found matching the given criteria.'
                ], 404); // Not Found
            }

            return response()->json([
                'data' => $properties->items(),
                'pagination' => [
                    'total' => $properties->total(),
                    'per_page' => $properties->perPage(),
                    'current_page' => $properties->currentPage(),
                    'last_page' => $properties->lastPage(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while searching for properties.',
                'details' => $e->getMessage()
            ], 500); // Internal Server Error
        }
    }
}
