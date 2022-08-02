<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\ResExam;
use App\Models\ResXRay;
use App\Models\ResMedicine;
use App\Models\MedicalExamination;
use App\Models\XRay;
use App\Models\Medicine;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Transaction;

class ReservationsController extends Controller
{
    public function index() {
        $data = Reservation::with('customer')->get();
        return response()->json(["status" => true, "data" => $data]);
    }

    public function homeStatistics() {
        $today_reservations = Reservation::whereDate("date", date('Y-m-d'))->count();
        $total_reservations = Reservation::count();
        $customers          = Customer::count();
        $total_payments     = Payment::sum('value');
        $total_expenses     = Expense::sum("value");

        return response()->json(["status" => true, "today_reservations" => $today_reservations, "total_reservations" => $total_reservations, "customers" => $customers, "total_payments" => $total_payments, "total_expenses" => $total_expenses]);
    }

    public function currentMonthReservations() {
        // $data = Reservation::whereYear("date", Carbon::now()->year)->whereMonth('date', Carbon::now()->month)->get();
        // $attrs = [];
        // foreach ($data as $key => $value) {
        //     $attrs[$value->day][] = $value;
        // }
        $list=array();
        $month = date("m");
        $year = date("Y");
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $list[]=["date" => date('Y-m-d', $time), "day" => date('d', $time), "day_name" => date('l', $time)];
        }     

        $results = [];

        foreach($list as $key => $item) {
            $full_date = $item['date'];
            $res = Reservation::whereDate("date", $full_date)->get();
            $results[] = [
                "day"          => $item["day"],
                "name"         => $item["day_name"],
                "date"         => $item['date'],
                "reservations" => $res
            ];
            
 
        }   

        return response()->json(["status" => true, "data" => $results]); 
    }

    public function filterReservations(Request $request) {
        $year  = $request->get('year', false);
        $month = $request->get('month', false);
        $list=array();
        
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);          
            if (date('m', $time)==$month)       
                $list[]=["date" => date('Y-m-d', $time), "day" => date('d', $time), "day_name" => date('l', $time)];
        }     

        $results = [];

        foreach($list as $key => $item) {
            $full_date = $item['date'];
            $res = Reservation::whereDate("date", $full_date)->get();
            $results[] = [
                "day"          => $item["day"],
                "name"         => $item["day_name"],
                "date"         => $item['date'],
                "reservations" => $res
            ];
            
 
        }  
        return response()->json(["status" => true, "data" => $results]);    
    }

    public function store(Request $request) {
        $data = $request->all();
        $reservation=Reservation::create($data);
        return response()->json(["status" => true,"reservation"=>$reservation], 200);
    }

    public function update(Request $request) {
        $item = Reservation::find($request->id);
        $data = $request->all();
        $item->fill($data)->save();
        return response()->json(["status" => true,"reservation"=>$item], 200);
    }

    public function delete($id) {
        $item = Reservation::find($id);
        if($item) {
            $item->delete();
        }
        return response()->json(["status" => true,"reservation"=>$item], 200);
    }

    public function addExamination(Request $request) {
        $data = $request->all();
        $reservation = Reservation::find($request->reservation_id);
        $data['customer_id'] = $reservation->customer_id;
        $res_exam=ResExam::create($data);
        return response()->json(["status" => true,"res_exam"=>$res_exam], 200);
    }

    public function updateExamination(Request $request) {
        $data = $request->all();
        $res_exam = ResExam::find($request->id);
        $res_exam->fill($data)->save();
        return response()->json(["status" => true,"res_exam"=>$res_exam], 200);
    }

    public function addXRay(Request $request) {
        $data = $request->all();
        $reservation = Reservation::find($request->reservation_id);
        $data['customer_id'] = $reservation->customer_id;
        $res_xray=ResXRay::create($data);
        return response()->json(["status" => true,"res_xray"=>$res_xray], 200);
    }

    public function updateXRay(Request $request) {
        $data = $request->all();
        $res_exam = ResXRay::find($request->id);
        $res_exam->fill($data)->save();
        return response()->json(["status" => true,"res_exam"=>$res_exam], 200);
    }

    public function addMedicine(Request $request) {
        $data = $request->all();
        $reservation = Reservation::find($request->reservation_id);
        $data['customer_id'] = $reservation->customer_id;
        $res_medicine=ResMedicine::create($data);
        return response()->json(["status" => true,"res_medicine"=>$res_medicine], 200);
    }
    
    public function deleteExamination($id) {
        $item = ResExam::find($id);
        if($item){
            $item->delete();
        }
        return response()->json(["status" => true,"data"=>$item], 200);
    }    
    
    public function deleteXRay($id) {
        $item = ResXRay::find($id);
        if($item){
            $item->delete();
        }
        return response()->json(["status" => true,"data"=>$item], 200);
    }    
    
    public function deleteMedicine($id) {
        $item = ResMedicine::find($id);
        if($item){
            $item->delete();
        }
        return response()->json(["status" => true,"data"=>$item], 200);
    }

    public function showSingleReservation($id) {
        $reservation  = Reservation::find($id);
        $examinations = ResExam::select('id','examination_id','result','created_at')->where('reservation_id', $id)->get();
        $xrays        = ResXRay::select('id','xray_id','result','created_at')->where('reservation_id', $id)->get();
        $medicines    = ResMedicine::select('id','medicine_id','created_at')->where('reservation_id', $id)->get();
        $payments     = Payment::select("id","value","created_at")->where('reservation_id', $id)->get();
        $total_paid   = Payment::where('reservation_id', $id)->sum("value");
        $customer     = Customer::find($reservation->customer_id);
        $customers     = Customer::get(['id','name']);
        foreach($examinations as $item) {
            $exam = MedicalExamination::select("name")->find($item->examination_id);
            $item->name = $exam->name;
        }
        foreach($xrays as $item) {
            $xray = XRay::select("name")->find($item->xray_id);
            $item->name = $xray->name;
        }
        foreach($medicines as $item) {
            $med = Medicine::select("name","instructions")->find($item->medicine_id);
            $item->name = $med->name;
            $item->instructions = $med->instructions;
        }
        return response()->json(["status" => true, "reservation" => $reservation, "examinations" => $examinations, "xrays" => $xrays, "medicines" => $medicines, "customer" => $customer,"customers"=>$customers, "payments" => $payments, "total_paid" => $total_paid], 200);
    }

    public function addPayment(Request $request) {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $reservation = Reservation::find($request->reservation_id);
        $data['customer_id'] = $reservation->customer_id;
        $payment = Payment::create($data);
        $this->saveTransaction("payment",$payment->id, $payment->value);
        return response()->json(["status" => true,"payment"=>$payment], 200);
    }

    public function saveTransaction($type,$id,$value) {
        $tr = new Transaction;
        $tr->type = $type;
        $tr->item_id = $id;
        $tr->value   = $value;
        $tr->save();
        return true;
    }

    public function deletePayment($id) {
        $item = Payment::find($id);
        if($item){
            $item->delete();
        }
        return response()->json(["status" => true,"data"=>$item], 200);
    }

    public function transactions() {
        $data = Transaction::all();
        return response()->json(["status" => true, "data" => $data]);
    }

    public function payments(Request $request){
        $year  = $request->get('year', false);
        $month = $request->get('month', false);
        if($year && $month) {
            $payments = Payment::whereYear("created_at", $year)->whereMonth("created_at", $month)->get();  
        }else {
            $payments = Payment::all();
        }
        return response()->json(["status" => true, "data" => $payments]);
    } 

    public function expenses(Request $request){
        $year  = $request->get('year', false);
        $month = $request->get('month', false);
        if($year && $month) {
            $data = Expense::whereYear("created_at", $year)->whereMonth("created_at", $month)->get();  
        }else {
            $data = Expense::all();
        }
        return response()->json(["status" => true, "data" => $data]);
    }
}
