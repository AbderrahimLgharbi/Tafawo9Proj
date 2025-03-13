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

    public function getAll(Request $request){
        try{
            $administrations=Administration::select("id","administration_name")->get();
            if ($administrations->isEmpty()) {
                return response()->json([
                    'msg' => 'Administrations data not found',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'data' => $administrations,
            ], 201); // 201 Created
            }
        catch(\Exception $e){
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }

    }

    public function update(Request $request){
        try {
            $validatedData = $request->validate([
                'administration_name' => 'required|string|max:255',
            ]);

            $administration = Administration::where("id",$request->id)->update([
                'administration_name' => $validatedData['administration_name'],
            ]);

            // Check if the record is created successfully
            if (!$administration) {
                return response()->json([
                    'msg' => 'Administration not updated',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'Administration updated successfully',
                'data' => $administration,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }

    public function delete(Request $request){


        try {

        $adminis=Administration::find($request->id);


            // Check if the record is created successfully
            if (!$adminis) {
                return response()->json([
                    'msg' => 'Administration not deleted',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            $adminis->delete();
            return response()->json([
                'msg' => 'Administration deleted successfully',
                'data' => $adminis,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }
}
