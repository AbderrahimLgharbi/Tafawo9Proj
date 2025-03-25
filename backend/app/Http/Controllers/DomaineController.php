<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'domain_name' => 'required|string|max:255',
            ]);

            $domaine = Domaine::create([
                'domain_name' => $validatedData['domain_name'],
            ]);

            // Check if the record is created successfully
            if (!$domaine) {
                return response()->json([
                    'msg' => 'domaine not created',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'grade created successfully',
                'data' => $domaine,
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
            $domaines=Domaine::select("id","domain_name")->get();
            if ($domaines->isEmpty()) {
                return response()->json([
                    'msg' => 'domaines
     data not found',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json($domaines); // 201 Created
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
                'domain_name' => 'required|string|max:255',
            ]);

            $domaine = Domaine::where("id",$request->id)->update([
                'domain_name' => $validatedData['domain_name'],
            ]);

            // Check if the record is created successfully
            if (!$domaine) {
                return response()->json([
                    'msg' => 'domaine not updated',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'domaine updated successfully',
                'data' => $domaine,
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

        $domaine=Domaine::find($request->id);


            // Check if the record is created successfully
            if (!$domaine) {
                return response()->json([
                    'msg' => 'domaine not deleted',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            $domaine->delete();
            return response()->json([
                'msg' => 'domaine deleted successfully',
                'data' => $domaine,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }
}
