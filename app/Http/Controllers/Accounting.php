<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Transaction;
use App\Models\Customer;

class Accounting extends Controller
{
    public function payments() {
        $date_from  = request()->get('date_from', false);
        $date_to    = request()->get('date_to', false);
       
        $payments = Payment::with("customer")->where(function($query) use ($date_from, $date_to) {
            if($date_from) {
                $query->whereDate('created_at', ">=" , $date_from);
            }
            if($date_to) {
                $query->whereDate('created_at', "<=" , $date_to);
            }
        })->orderBy("id","asc")->get();  
  
        
        return view("accounting.payments")->with(["data" => $payments]);
    }

    public function expenses() {
        $date_from  = request()->get('date_from', false);
        $date_to    = request()->get('date_to', false);
       
        $expenses = Expense::where(function($query) use ($date_from, $date_to) {
            if($date_from) {
                $query->whereDate('created_at', ">=" , $date_from);
            }
            if($date_to) {
                $query->whereDate('created_at', "<=" , $date_to);
            }
        })->orderBy("id","asc")->get();   
  
        
        return view("accounting.expenses")->with(["data" => $expenses]);  
    }

    public function storeExpense(Request $request) {
        $data = $request->all();
        $expense = Expense::create($data);
        $this->saveTransaction("expense",$expense->id, $expense->value);
        return redirect()->back();
    }

    public function transactions() {
        $date_from  = request()->get('date_from', false);
        $date_to    = request()->get('date_to', false);
       
        $transactions = Transaction::where(function($query) use ($date_from, $date_to) {
            if($date_from) {
                $query->whereDate('created_at', ">=" , $date_from);
            }
            if($date_to) {
                $query->whereDate('created_at', "<=" , $date_to);
            }
        })->orderBy("id","asc")->get();  

        foreach($transactions as $item) {
            if($item->type == "payment") {
                $payment = Payment::find($item->item_id);
                $info    = Customer::find($payment->customer_id);
                $item->info = $info;
            }else if ($item->type == "expense") {
                $expense = Expense::find($item->item_id);
                $item->info = $expense;
            }
        }

        return view("accounting.transactions")->with(["data" => $transactions]); 
    }


    public function saveTransaction($type,$id,$value) {
        $tr = new Transaction;
        $tr->type = $type;
        $tr->item_id = $id;
        $tr->value   = $value;
        $tr->save();
        return true;
    }
}
