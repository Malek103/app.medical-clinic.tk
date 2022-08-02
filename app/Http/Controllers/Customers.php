<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Reservation;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Customers extends Controller
{
    public function index() {
        $data = Customer::orderBy('id', 'DESC')->get();
        return view("customers.index")->with(["data" => $data]);
    }

    public function create() {
        return view("customers.create");
    }

    public function store(Request $request) {
        $rules=$this->rules();
        $request->validate($rules);
        $data = $request->all();
        if (!isset($request->sensitive)) {

            $data['is_sensitive'] = false;
        } else {
            $data['is_sensitive'] = true;
        }

        if (!isset($request->sick)) {

            $data['is_sick'] = false;
        } else {
            $data['is_sick'] = true;
        }
        if ($request->hasFile('image')) {
            $name = time() . "_customer." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }
        Customer::create($data);
        return redirect("/customers");
    }

    public function edit($id) {
        $customer = Customer::find($id);
        return view("customers.edit")->with(["item" => $customer]);
    }

    public function update(Request $request) {
        $rules=$this->rules($request->id);
        $request->validate($rules);
        $item = Customer::find($request->id);

        $data = $request->all();

        if (!isset($request->sensitive)) {

            $data['is_sensitive'] = false;
        } else {
            $data['is_sensitive'] = true;
        }

        if (!isset($request->sick)) {

            $data['is_sick'] = false;
        } else {
            $data['is_sick'] = true;
        }

        if ($request->hasFile('image')) {
            $name = time() . "_customer." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move('uploads', $name);
            $data['image'] = $name;
        }

        $item->fill($data)->save();

        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function destroy($id) {
        Customer::find($id)->delete();
        return redirect()->back();
    }

    public function show($id) {
        $customer = Customer::find($id);
        $reservations = Reservation::where("customer_id", $id)->get();
        $payments     = Payment::where("customer_id", $id)->get();
        return view("customers.show")->with(["customer" => $customer, "reservations" => $reservations, "payments"=> $payments]);
    }

    public function wordExport($id){
        $ldate = date('Y-m-d');
        $customer=Customer::findOrFail($id);
        $templateProcessor=new TemplateProcessor('word-template/customer.docx');
        $age = Carbon::parse($customer->birthdate)->diff(Carbon::now())->y;
        $templateProcessor->setValue('name',$customer->name);
        $templateProcessor->setValue('gender',$customer->gender);
        $templateProcessor->setValue('age',$age);
        $templateProcessor->setValue('report',$customer->final_report);
        $templateProcessor->setValue('date',$ldate);
        $fileName=$customer->name;
        $templateProcessor->saveAs($fileName.'.docx');
        return response()->download($fileName.'.docx')->deleteFileAfterSend(true);
    }

    public function rules($id=0){

        return  [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('customers', 'name')->ignore($id, 'id'),
            ],
        ];

    }
}
