<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Transaction;

class Home extends Controller
{
    public function index() {

        $male_customers   = Customer::where("gender","male")->count();
        $female_customers = Customer::where("gender","female")->count();
        $total_reservations = Reservation::count();
        $reservations = Reservation::select('id', 'date')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->date)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];
        foreach ($reservations as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            $month_key = date("M",mktime(0, 0, 0, $i, 10));
            if(!empty($usermcount[$i])){
                $userArr[$month_key] = $usermcount[$i];
            }else{

                $userArr[$month_key] = 0;
            }
        }

        $reservations_months  = [];
        $reservations_numbers = [];
        foreach($userArr as $key => $item) {
            $reservations_months[]  = $key;
            $reservations_numbers[] = $item;
        }

        $total_earnings = Payment::sum('value');
        $total_expenses = Expense::sum('value');

        $latest_transactinos = Transaction::orderBy("id","desc")->limit(5)->get();
        $latest_reservations = Reservation::with('customer')->orderBy("id","desc")->limit(5)->get();

        foreach($latest_transactinos as $item) {
            if($item->type == "payment") {
                $payment = Payment::find($item->item_id);
                $item->info = Customer::find($payment->customer_id);
            }else if ($item->type == "expense") {
                $expense = Expense::find($item->item_id);
                $item->info = $expense;
            }
        }


        return view("index")->with(["male_customers" => $male_customers, "female_customers" => $female_customers, "reservations_months" => json_encode($reservations_months), "reservations_numbers" => json_encode($reservations_numbers), "total_reservations" => $total_reservations, "total_earnings" => $total_earnings, "total_expenses" => $total_expenses, "latest_transactions" => $latest_transactinos, "latest_reservations"=> $latest_reservations]);
    }
}
