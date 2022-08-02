<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomersController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return response()->json(["data" => $customers], 200);
    }

    public function store(Request $request) {
        $data = $request->all();
        if($request->hasFile('image')) {
            $name = time() . "_customer." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $data['user_id'] = auth()->user()->id;
        Customer::create($data);
        return response()->json(["status" => true], 200);
    }

    public function update(Request $request) {
        $customer = Customer::find($request->customer_id);
        $data = $request->all();
        if($request->hasFile('image')) {
            $name = time() . "_customer." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        $customer->fill($data)->save();
        return response()->json(["status" => true], 200);
    }

    public function delete($id) {
        $customer = Customer::find($id);
        if($customer){
            $customer->delete();
        }
        return response()->json(["status" => true], 200);
    }
}
