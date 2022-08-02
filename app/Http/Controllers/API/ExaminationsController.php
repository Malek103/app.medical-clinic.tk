<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalExamination;

class ExaminationsController extends Controller
{
    public function index() {
        $data = MedicalExamination::get(['id','name']);
        return response()->json(["status" => true, "data" => $data]);
    }

    

    public function store(Request $request) {
        $data = $request->all();
        MedicalExamination::create($data);
        return response()->json(["status" => true], 200);
    }

    public function update(Request $request) {
        $item = MedicalExamination::find($request->id);
        $data = $request->all();
        $item->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function delete($id) {
        $item = MedicalExamination::find($id);
        if($item) {
            $item->delete();
        }
        return response()->json(["status" => true], 200);
    }
}
