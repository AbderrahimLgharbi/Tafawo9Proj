<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'grade_name' => 'required|string|max:255',
            ]);

            $grades = Grade::create([
                'grade_name' => $validatedData['grade_name'],
            ]);

            // Check if the record is created successfully
            if (!$grades) {
                return response()->json([
                    'msg' => 'grades not created',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'grade created successfully',
                'data' => $grades,
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
            $grades=Grade::select("id","grade_name")->get();
            if ($grades->isEmpty()) {
                return response()->json([
                    'msg' => 'grades data not found',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json($grades); // 201 Created
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
                'grade_name' => 'required|string|max:255',
            ]);

            $grade = Grade::where("id",$request->id)->update([
                'grade_name' => $validatedData['grade_name'],
            ]);

            // Check if the record is created successfully
            if (!$grade) {
                return response()->json([
                    'msg' => 'grade not updated',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'grade updated successfully',
                'data' => $grade,
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

        $grade=Grade::find($request->id);


            // Check if the record is created successfully
            if (!$grade) {
                return response()->json([
                    'msg' => 'grade not deleted',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            $grade->delete();
            return response()->json([
                'msg' => 'grade deleted successfully',
                'data' => $grade,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }
}
