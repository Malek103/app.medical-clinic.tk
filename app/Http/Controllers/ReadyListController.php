<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadyList;
use App\Models\Reservation;

class ReadyListController extends Controller
{
    public function getReadyList() {
        $data = Reservation::where('is_active','true')->orderBy('date', 'DESC')->get();
        return view("ready_list.index")->with(["data" => $data]);
    }
}
