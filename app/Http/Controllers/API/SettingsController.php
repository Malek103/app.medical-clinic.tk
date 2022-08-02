<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index() {
        $data = Setting::select("id","name","value")->get();
        return response()->json(["status" => true, "data" => $data]);
    }

    public function store(Request $request) {
        $data = $request->all();
        Setting::create($data);
        return response()->json(["status" => true], 200);
    }

    public function update(Request $request) {
        $item = Setting::find($request->id);
        $data = $request->all();
        $item->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function delete($id) {
        $item = Setting::find($id);
        if($item) {
            $item->delete();
        }
        return response()->json(["status" => true], 200);
    }
}
