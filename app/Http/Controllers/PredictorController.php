<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Batch;
use Crop;

class PredictorController extends Controller
{
    public function index()
    {
        return view('predictor.index');
    }

    public function test(){
        return view('predictor.index');
    }

    public function list_crop_batch()
    {
        $crops = Crop::select(
            'batches.batch_number as batch_no', 
            'batches.date_started',
            'batches.date_ended',
            'crops.id',
            'crops.image_file',
            'crops.percentage',
            'crops.day_number',
            'crops.date_uploaded',
            'crops.status'
        )
        ->leftJoin('batches', 'batches.id', '=', 'crops.batch_id')
        ->orderBy('crops.id', 'desc')
        ->get();
        
        $data = [];
        foreach($crops as $m=>$crop){
            $data[] = [
                'id'            =>$crop->id, 
                'batch_no'      =>$crop->batch_no,
                'day_number'    =>$crop->day_number,
                'date_uploaded' =>$crop->date_uploaded,
                'percentage'    =>$crop->percentage.'%',
                'status'        =>$crop->status, 
                'crop_id'       =>$crop->id,
            ];
        }
        return response()->json(['data'=>$data], 200);
    }

    public function search_batch(){
        $batch_number = $_POST['batch_search'];
        
        $filters = [
            ['batch_id', '=', (int) $_POST['batch_search']],
        ];

        $crops = Crop::select(
            'batches.batch_number as batch_no', 
            'batches.date_started',
            'batches.date_ended',
            'crops.id as crop_id',
            'crops.image_file',
            'crops.percentage',
            'crops.day_number',
            'crops.date_uploaded',
            'crops.status'
        )
        ->leftJoin('batches', 'batches.id', '=', 'crops.batch_id')
        ->where($filters)
        ->orderBy('crops.id', 'desc')
        ->get();
        
        $data = [];
        foreach($crops as $m=>$crop){
            $data[] = [
                'id'            =>$crop->crop_id, 
                'batch_no'      =>$crop->batch_no,
                'day_number'    =>$crop->day_number,
                'date_uploaded' =>$crop->date_uploaded,
                'date_started'  =>$crop->date_started,
                'date_ended'    =>$crop->date_ended,
                'percentage'    =>$crop->percentage.'%',
                'status'        =>$crop->status, 
            ];
        }
        return response()->json($data, 200);
    }

    public function insert_batch(Request $request){
        $request->validate([
            'batch_number' => 'required',
            'date_started' => 'required',
            
        ]);
        
        $batch_number = ($_POST['batch_number']);
        $date_started = ($_POST['date_started']);
       
        Batch::updateOrInsert([
            'batch_number' => $batch_number,
            'date_started' => $date_started,
        ]);

        return redirect('/predictor')->with('success', 'Batch Saved!');
    }

    public function list_batch()
    {
        $batch_lists = Batch::all();
            
        $data = [];
        foreach($batch_lists as $m =>$batch_list){
            $data[] = [
                'id'            =>$batch_list->id, 
                'batch_number'  =>$batch_list->batch_number,
                'date_started'  =>$batch_list->date_started,
                'date_ended'    =>$batch_list->date_ended,
            ];
        }
        return response()->json(['data'=>$data], 200);
    }

    public function edit_crop()
    {
        $edit_key = $_POST['edit_id'];
     
        $crop =  Crop::where('id', $edit_key)->first();
        $batch = Batch::where('id', $crop->batch_id)->first();

        $data = 
        [
            'id'           =>$crop->id,
            'file'         =>$crop->image_file,
            'day_number'   =>$crop->day_number,
            'batch_number' =>$batch->batch_number,
        ];
        
        return response()->json(['result' => $data]); 
    }

    public function save_crop(Request $request){

        // if action is update
        // if browse has file update 
        // else if no file retain file field

        // if action is insert
        // if browse has file save
        // if browse has no file error 



        $validator = Validator::make($request->all(), 
        [
            'day_number' => 'required',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = ($_POST['file']);

        print($file);
        die();

        // $request->file->store('public');
    }

    public function delete_crop(){
        $delete_key = $_POST['delete_key'];
       
        $crops = Crop::select(
            'batches.batch_number as batch_no', 
            'batches.date_started',
            'batches.date_ended',
            'crops.id as crop_id',
            'crops.image_file',
            'crops.percentage',
            'crops.day_number',
            'crops.date_uploaded',
            'crops.status'
        )
        ->leftJoin('batches', 'batches.id', '=', 'crops.batch_id')
        ->where('crops.id', $delete_key)
        ->delete();
       
        return redirect('/predictor')->with('success', 'Crop Data Deleted!');
    }
}
