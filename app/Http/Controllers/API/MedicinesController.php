<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicinesController extends Controller
{
    public function index() {
        $medicines = Medicine::all();
        return response()->json(["status" => true, "data" => $medicines]);
    }

    public function store(Request $request) {
        $data = $request->all();
        Medicine::create($data);
        return response()->json(["status" => true], 200);
    }

    public function update(Request $request) {
        $medicine = Medicine::find($request->id);
        $data = $request->all();
        $medicine->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function delete($id) {
        $medicine = Medicine::find($id);
        if($medicine) {
            $medicine->delete();
        }
        return response()->json(["status" => true], 200);
    }
}
