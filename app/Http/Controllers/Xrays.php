<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ResXRay;
use Illuminate\Http\Request;
use App\Models\XRay;
use Illuminate\Validation\Rule;

class Xrays extends Controller
{
    public function index() {
        $data = XRay::orderBy('id', 'DESC')->get();
        return view("xrays.index")->with(["data" => $data]);
    }

    public function create() {

        return view("xrays.create");
    }

    public function store(Request $request) {
        $rules=$this->rules();
        $request->validate($rules);
        $data = $request->all();
        XRay::create($data);
        return redirect("/xrays");
    }

    public function edit($id) {
        $item = XRay::find($id);
        return view("xrays.edit")->with(["item" => $item]);
    }

    public function update(Request $request) {
        $rules=$this->rules($request->id);
        $request->validate($rules);
        $item = XRay::find($request->id);

        $data = $request->all();

        $item->fill($data)->save();

        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function destroy($id) {
        XRay::find($id)->delete();
        return redirect()->back();
    }

    public function getxrays(){
        $data = XRay::get(['id','name']);
        return response()->json($data);
    }
    public function xraysReport($id){
       $res=Reservation::where('id',$id)->first();
       $res_xrays=ResXRay::where('reservation_id',$id)->get();
        $customer=Customer::where('id',$res->customer_id)->first();
        $date = date('Y-m-d');
        return view('reports.xrays')->with(["date"=>$date,"customer"=>$customer,"res_xrays"=>$res_xrays]);
    }

    public function rules($id = 0){

        return  [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('xrays', 'name')->ignore($id, 'id'),
            ],

        ];

    }
}
