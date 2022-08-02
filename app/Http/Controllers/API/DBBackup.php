<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class DBBackup extends Controller
{
    public function createBackup() {
        Artisan::call('backup:run --only-db');
        return response()->json(["status" => true], 200);
    }

    public function importBackup(Request $request) {
        if($request->hasFile("sql_file")) {
            $sql_file = $request->sql_file;
            \DB::unprepared(file_get_contents($sql_file));
            return response()->json(["status" => true], 200);
        }else {
            return response()->json(["status" => false], 200);
        }
    }
}
