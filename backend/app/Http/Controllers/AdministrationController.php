<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administration;
use Illuminate\Support\Facades\Validator;

class AdministrationController extends Controller
{
    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'administration_name' => 'required|string|max:255',
            ]);

            $administration = Administration::create([
                'administration_name' => $validatedData['administration_name'],
            ]);

            // Check if the record is created successfully
            if (!$administration) {
                return response()->json([
                    'msg' => 'Administration not created',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'Administration created successfully',
                'data' => $administration,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }

}
