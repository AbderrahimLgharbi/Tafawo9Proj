<?php

namespace App\Http\Controllers;

use App\Models\Concour;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ConcourController extends Controller
{
    public function index()
    {
        $concours = Concour::all();
        return response()->json(['conc'=>$concours]);
    }

    public function create(Request $request){
        try {
                $validatedData = $request->validate([
                    'administration_id' => 'required|string',
                    'domaine_id' => 'required|string',
                    'grade_id' => 'required|string',
                    'file'=>'required|file|mimes:jpeg,png,pdf|max:32768',
                    'concour_pdf_correction'=>'nullable|file|mimes:jpeg,png,pdf|max:32768',
                    'counc_name' => 'required|string',
                    'feedback'=>'required|string',
                ]);


                $file=$request->file('file');
                $fileName = $file->getClientOriginalName();
                $fileSize=$file->getSize();
                $fileType=$file->getClientOriginalExtension();
                // uploadfile
                $request->file->move(public_path('upload'),$fileName);
                
                
                // correction Concours
                $fileNamecorr = null;
                if ($request->hasFile('concour_pdf_correction')) {
                    $filecorrection = $request->file('concour_pdf_correction');
                    $fileNamecorr = $filecorrection->getClientOriginalName();
                    $fileSizecorr = $filecorrection->getSize();
                    $fileTypecorr = $filecorrection->getClientOriginalExtension();
                    // Upload correction file
                    $filecorrection->move(public_path('uploadsCorrection'), $fileNamecorr);
                }
            
            $conc = Concour::create([
                'administration_id' => $validatedData['administration_id'],
                'domaine_id' => $validatedData['domaine_id'],
                'grade_id' => $validatedData['grade_id'],
                'counc_name' => $validatedData['counc_name'],
                'conc_pdf'=>$fileName,
                'generated_name' => $fileName,
                'concour_pdf_correction'=>$fileNamecorr,
                'generated_name_corr'=>$fileNamecorr,
                'feedback'=>$validatedData['feedback'],
                'submitted_at'=>now(),
            ]);

            // Check if the record is created successfully
            if (!$conc) {
                return response()->json([
                    'msg' => 'conc not created',
                    'errors' => ['general' => 'Unknown error occurred during creation'],
                ], 500); // 500 Internal Server Error
            }

            return response()->json([
                'msg' => 'conco created successfully',
                'data' => $conc,
            ], 201); // 201 Created
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Server Error',
                'errors' => ['exception' => $e->getMessage()],
            ], 500); // 500 Internal Server Error
        }
    }


    // public function upload(Request $request){

    //     if($request->hasFile('file')){
    //         $file=$request->file('file');
    //         $fileName = $file->getClientOriginalName();
    //         $fileSize=$file->getSize();
    //         $fileType=$file->getClientOriginalExtension();
    //         // uploadfile
    //         $request->file->move(public_path('upload'),$fileName);

    //         // Concour::create([
    //         //     'conc_pdf'=>$request->file('file'),
    //         // ]);

    //         return response()->json([
    //             'fileName'=>$fileName,
    //             'fileSize'=>$fileSize,
    //             'fileType'=>$fileType,
    //             'conc_name'=>$request->conc_name,
    //             'conc_pdf'=>$fileName
    //     ]);
    //     }
    //     else{
    //         return response()->json([
    //             "msg"=>"file not found"
    //         ]);
    //     }
    //     return response()->json(['message' => 'conco uploaded successfully']);
    // }


}
