<?php

namespace App\Http\Controllers;

use App\Models\ResExam;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicalExamination;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Validation\Rule;

class Medicines extends Controller
{
    public function index() {
        $data = Medicine::orderBy('id', 'DESC')->get();
        return view("medicines.index")->with(["data" => $data]);
    }

    public function create() {
        return view("medicines.create");
    }

    public function store(Request $request) {
        $data = $request->all();
        Medicine::create($data);
        return redirect("/medicines");
    }

    public function edit($id) {
        $item = Medicine::find($id);
        return view("medicines.edit")->with(["item" => $item]);
    }

    public function update(Request $request) {
        $item = Medicine::find($request->id);

        $data = $request->all();

        $item->fill($data)->save();

        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function destroy($id) {
        Medicine::find($id)->delete();
        return redirect()->back();
    }

    public function getmedicines(){
        $data = Medicine::get(['id','name']);
        return response()->json($data);
    }

    public function MedicinesReport($id){
        $res=Reservation::where('id',$id)->first();
        $date = date('Y-m-d');
        $categories=Category::all();
        $medicines=MedicalExamination::all();
        $res_exams=ResExam::where('reservation_id',$id)->get();

        $customer=Customer::where('id',$res->customer_id)->first();
        return view('reports.medicines')->with(['date'=>$date,'medicines'=>$medicines,'res_exams'=>$res_exams,'customer'=>$customer,'categories'=>$categories]);
    }


}
