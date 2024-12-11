<?php
namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    public function store(StorePatientRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validated = $request->validated();

            $path = $request->file('document_photo')->store('documents', 'public');

            $patient = Patient::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'document_photo' => $path,
            ]);

            return response()->json([
                'message' => 'Patient registered successfully.',
                'patient' => $patient,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
