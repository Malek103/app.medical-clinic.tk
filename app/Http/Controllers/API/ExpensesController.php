<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Transaction;

class ExpensesController extends Controller
{
    public function index() {
        $data = Expense::all();
        return response()->json(["status" => true, "data" => $data]);
    }

    public function store(Request $request) {
        $data = $request->all();
        $ex = Expense::create($data);
        $this->saveTransaction("expense",$ex->id, $ex->value);
        return response()->json(["status" => true,"expense"=>$ex], 200);
    }

    public function saveTransaction($type,$id,$value) {
        $tr = new Transaction;
        $tr->type = $type;
        $tr->item_id = $id;
        $tr->value   = $value;
        $tr->save();
        return true;
    }

    public function update(Request $request) {
        $item = Expense::find($request->id);
        $data = $request->all();
        $item->fill($data)->save();
        return response()->json(["status" => true,"expense"=>$item], 200);
    }

    public function delete($id) {
        $item = Expense::find($id);
        if($item) {
            $item->delete();
        }
        return response()->json(["status" => true,"expense"=>$item], 200);
    }

    public function single($id) {
        $item = Expense::find($id);
        return response()->json(["status" => true,"data" => $item], 200);
    }

    
}
