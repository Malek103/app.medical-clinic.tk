<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\XRay;

class XRaysController extends Controller
{
    public function index() {
        $data = XRay::all();
        return response()->json(["status" => true, "data" => $data]);
    }

    public function store(Request $request) {
        $data = $request->all();
        XRay::create($data);
        return response()->json(["status" => true], 200);
    }

    public function update(Request $request) {
        $item = XRay::find($request->id);
        $data = $request->all();
        $item->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function delete($id) {
        $item = XRay::find($id);
        if($item) {
            $item->delete();
        }
        return response()->json(["status" => true], 200);
    }
}
