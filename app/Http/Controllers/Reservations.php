<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\ResExam;
use App\Models\ResMedicine;
use App\Models\ResXRay;
use App\Models\MedicalExamination;
use App\Models\XRay;
use App\Models\Medicine;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\CarbonPeriod;
use App\Models\Worktime;
use DateTime;

use function Couchbase\defaultDecoder;

class Reservations extends Controller
{
    public function index() {

        $date_from = request()->get("date_from");
        $date_to   = request()->get("date_to");
        $status    = request()->get("status");
        $data = Reservation::where(function($query) use ($date_from, $date_to, $status) {
            if($date_from) {

                $query->where('date', ">=" , $date_from);
            }
            if($date_to) {
                $query->where('date', "<=" , $date_to);
            }
            if($status) {
                $query->where('status', $status);
            }

        })->orderBy("date","desc")->with('customer')->get();
        return view("reservations.index")->with(["data" => $data]);
    }

    public function create() {
        $customers = Customer::all();

        $dates = $this->getCurrentMonthDates();
            if (date("H", strtotime("19:00:00")) == "00") {
                $slots[] = $this->getTimeSlots(15, date("H:i", strtotime("08:00:00")), date("24:i", strtotime("19:00:00")));
            } else {
                $slots[] = $this->getTimeSlots(15, date("H:i", strtotime("08:00:00")), date("H:i", strtotime("19:00:00")));
            }


        return view("reservations.create")->with(["customers"=> $customers, "dates" => $dates,"slots"=>$slots]);
    }

    public function store(Request $request) {

        $worktime=Worktime::create();
        $worktime->time=$request->work_time;
        $worktime->date=$request->date;
        $worktime->save();
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['work_time']=$request->work_time;
        $data['day'] = date('l', strtotime($request->date));
        $reservation=Reservation::create($data);
        return redirect("/reservations");
    }

    public function edit($id) {
        $reservation = Reservation::find($id);
        $customers = Customer::all();

        $dates = $this->getCurrentMonthDates();

        return view("reservations.edit")->with(["customers"=> $customers, "dates" => $dates, "res" => $reservation]);
    }

    public function update(Request $request) {

        $worktime=Worktime::where('date',$request->old_date)->where('time',$request->old_time)->first();

        $update_worktime=Worktime::find($worktime->id);
        $update_worktime->update(['time'=>$request->work_time,'date'=>$request->date]);
        $reservation = Reservation::find($request->id);
        $data = $request->all();
        $data['day'] = date('l', strtotime($request->date));
        $reservation->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function delete($id,$date,$time){
        $worktime=Worktime::where('date',$date)->where('time',$time)->first();
        $worktime::where('id',$worktime->id)->delete();
        Reservation::find($id)->delete();
        return redirect()->back();
    }

    public function show($id){

        $reservation = Reservation::find($id);

        $reservations=Reservation::where('customer_id',$reservation->customer_id)
        ->where('id','<>',$reservation->id)
        ->orderBy('id', 'DESC')->get();



        $customer = Customer::find($reservation->customer_id);

        $examinations = ResExam::where("reservation_id", $id)->orderBy('id', 'DESC')->get();


        $xrays = ResXRay::where("reservation_id", $id)->orderBy('id', 'DESC')->get();

        $medicines = ResMedicine::where("reservation_id", $id)->orderBy('id', 'DESC')->get();

        $payments  = Payment::where("reservation_id", $id)->orderBy('id', 'DESC')->get();


        $all_examinations = MedicalExamination::all();
        $all_xrays = XRay::all();
        $all_medicines = Medicine::all();

        foreach($examinations as $item) {
            $examination = MedicalExamination::find($item->examination_id);
            $item->examination = $examination;
        }
        foreach($xrays as $item){
            $xray = Xray::find($item->xray_id);
            $item->xray = $xray;
        }
        foreach($medicines as $item){
            $medicine = Medicine::find($item->medicine_id);
            $item->medicine = $medicine;
        }
        $total_prices=$reservations->sum('price');
        $total_payments=$reservations->sum('total_payments');
        $total_res= $total_payments - $total_prices;
        $attachments=Attachment::where('reservation_id',$id)->get();

        return view("reservations.show")->with(["res" => $reservation,"reservations"=>$reservations, "customer" => $customer, "examinations" => $examinations, "medicines" => $medicines, "xrays" => $xrays, "all_examinations" => $all_examinations,"all_xrays" => $all_xrays, "all_medicines" => $all_medicines,"payments" => $payments,"total_res"=>$total_res,"attachments"=>$attachments]);

    }

    public function addExamination(Request $request) {
        $data = $request->all();
        $res  = Reservation::find($request->reservation_id);
        $data['customer_id'] = $res->customer_id;
        ResExam::create($data);
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function updateExamination(Request $request) {
        $data = $request->all();
        $item  = ResExam::find($request->id);
        $item->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function deleteExamination($id) {
        ResExam::find($id)->delete();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function addXRay(Request $request) {
        $data = $request->all();
        $res  = Reservation::find($request->reservation_id);
        $data['customer_id'] = $res->customer_id;
        ResXRay::create($data);
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function updateXRay(Request $request) {
        $data = $request->all();
        $item  = ResXRay::find($request->id);
        $item->fill($data)->save();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function deleteXRay($id) {
        ResXRay::find($id)->delete();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function addMedicine(Request $request) {
        $data = $request->all();
        $res  = Reservation::find($request->reservation_id);
        $data['customer_id'] = $res->customer_id;
        ResMedicine::create($data);
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function deleteMedicine($id) {
        ResMedicine::find($id)->delete();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function addPayment(Request $request) {

        $data = $request->all();
        $res  = Reservation::find($request->reservation_id);
        $data['customer_id'] = $res->customer_id;
        $data['user_id'] = auth()->user()->id;
        $payment = Payment::create($data);
        $this->saveTransaction("payment",$payment->id, $payment->value);
        $total_payment=Payment::where('reservation_id',$request->reservation_id)->sum('value');
        $res->total_payments=$total_payment;
        $res->save();

        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function deletePayment($id) {
        Payment::find($id)->delete();
        Transaction::where([["item_id", $id],["type", "payment"]])->delete();
        return redirect()->back()->withSuccess(__('lang.changes_saved'));
    }

    public function calendar(Request $request) {




        if(request()->get('month')) {
            $year  = explode("-", request()->get('month'))[0];
            $month  = explode("-", request()->get('month'))[1];
        }else {
            $year = date("Y");
            $month = date("m");
        }

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
            $res = Reservation::with('customer')->whereDate("date", $full_date)->get();
            $results[] = [
                "day"          => $item["day"],
                "name"         => $item["day_name"],
                "date"         => $item['date'],
                "reservations" => $res
            ];


        }

        $current_date = date("Y M", strtotime($year . "-" . $month));

        return view("reservations.calendar")->with(["calendar" => $results, "current_date" => $current_date ]);
    }

    public function getcalendar($months){

    $now = new DateTime();
    $year = $now->format("Y");
        if($months) {
            $year  = $year;
            $month  = explode("-",$months )[1];
        }else {
            $year = date("Y");
            $month = date("m");
        }
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                $list[]=["date" => date('Y-m-d', $time), "day" => date('d', $time), "day_name" => date('l', $time)];
        }

        $results = [];

        foreach($list as $key => $item) {
            $full_date = $item['date'];
            $res = Reservation::with('customer')->whereDate("date", $full_date)->get();
            $results[] = [
                "day"          => $item["day"],
                "name"         => $item["day_name"],
                "date"         => $item['date'],
                "reservations" => $res
            ];


        }

        $current_date = date("Y M", strtotime($year . "-" . $month));

        return view("reservations.calendar")->with(["calendar" => $results, "current_date" => $current_date ]);


    }

    public function getCurrentMonthDates() {
        $list=array();
        $month = date("m");
        $year = date("Y");

        for($d=date('d'); $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                $list[]=["date" => date('Y-m-d', $time), "day" => date('d', $time), "day_name" => date('l', $time)];
        }

        return $list;
    }

    public function saveTransaction($type,$id,$value) {
        $tr = new Transaction;
        $tr->type = $type;
        $tr->item_id = $id;
        $tr->value   = $value;
        $tr->save();
        return true;
    }

    public function addNote(Request $request,$id){
        $reservation_customer=Reservation::findOrFail($id);
        $reservation=Reservation::where('customer_id',$reservation_customer->customer_id)->get();
        foreach($reservation as $data){
            $data->doctor_note=$request->note_doctor;
            $data->save();
                    }

        return redirect()->back();

    }
    public function ready($id){
        $reservation=Reservation::findOrFail($id);
        $reservation->is_active='true';
        $reservation->save();
        return redirect()->back();
    }

    public function unready($id){
        $reservation=Reservation::findOrFail($id);
        $reservation->is_active='false';
        $reservation->save();
        return redirect()->back();
    }
    function getTimeSlots($duration, $start, $end)
    {
        $data = [];
        $intervals = CarbonPeriod::since($start)->minutes($duration)->until($end)->toArray();
        foreach ($intervals as $i => $interval) {
            $to = next($intervals);
            if ($to !== false) {
                $start = date("H:i", strtotime($interval->toTimeString()));
                if (date("H", strtotime($interval->toTimeString())) == "00") {
                    $start = date("12:i", strtotime($interval->toTimeString()));
                }

                $end = date("H:i", strtotime($to->toTimeString()));
                if (date("H", strtotime($to->toTimeString())) == "00") {
                    $end = date("12:i", strtotime($to->toTimeString()));
                }
                array_push($data, $start . ' - ' . $end);
            }
        }
        return $data;
    }

    public function gettime($date){
        $data = Worktime::where('date',$date)->get(['time']);

       $times = [];
       foreach($data as $time){
array_push($times,$time['time']);
        }

        return response()->json($data);
    }

    public function getexaminationdate($mydate){

        $data = Reservation::where('date',$mydate)->get();
        return response()->json($data);
    }

     public function ReservationsReport($id){
         $res=Reservation::where('id',$id)->first();
        $date = date('Y-m-d');
        $res_medicines=ResMedicine::where('reservation_id',$id)->get();
        $customer=Customer::where('id',$res->customer_id)->first();
        return view('reports.prescription')->with(['customer'=>$customer,'date'=>$date,'res_medicines'=>$res_medicines]);
    }

    public function getinstructions($id){
        $data = Medicine::where('id',$id)->get('instructions');
        return response()->json($data);
    }
}
