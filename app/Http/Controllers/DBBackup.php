<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class DBBackup extends Controller
{
    public function index() {
        if(!request()->get('pass')) {
            return redirect("/backups/login");
        }
        if(request()->get('pass') != env('BACKUP_PASSWORD')) {
            return redirect("/backups/login");
        }
        $disk = Storage::disk('backup');

        $files = $disk->files("backup");
        $backups = [];
        foreach ($files as $k => $f) {
           if (substr($f, -4) == '.zip' && $disk->exists($f)) {
               $backups[] = [
               'file_path' => $f,
               'file_name' => str_replace("backup" .'/', '', $f),
               'file_size' => $disk->size($f),
               'last_modified' => $disk->lastModified($f),
                ];
           }
        }
	    $backups = array_reverse($backups);

        return view('backups.index')->with(["backups" => $backups]);
    }

    public static function humanFileSize($size,$unit="") {
        if( (!$unit && $size >= 1<<30) || $unit == "GB")
             return number_format($size/(1<<30),2)."GB";
        if( (!$unit && $size >= 1<<20) || $unit == "MB")
             return number_format($size/(1<<20),2)."MB";
        if( (!$unit && $size >= 1<<10) || $unit == "KB")
             return number_format($size/(1<<10),2)."KB";
        return number_format($size)." bytes";
  }

    public function download($file_name) {
        $file = 'backup/'. $file_name;
        $disk = Storage::disk('backup');
        if ($disk->exists($file)) {

            $fs = Storage::disk('backup')->getDriver();

            $stream = $fs->readStream($file);


            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "Backup file doesn't exist.");
        }
    }

    //  public function delete($file_name){
    //     $disk = Storage::disk('backup');
    //       if ($disk->exists(config('laravel-backup.backup.name') . '/'.env('APP_NAME').'/' . $file_name)) {
    //            $disk->delete(config('laravel-backup.backup.name') . '/'.env('APP_NAME').'/' . $file_name);
    //            return redirect()->back()->withSuccess("تم حذف النسخة الاحتياطية بنجاح");

    //       } else {
    //            abort(404, "Backup file doesn't exist.");
    //       }
    //  }

    public function login() {
        return view("backups.auth");
    }

    public function checkLogin(Request $request) {
        if($request->password == env('BACKUP_PASSWORD')) {
            return redirect("/backups?pass=" . $request->password);
        }else {
            return redirect()->back()->withSuccess("بيانات الدخول غير صحيحة");
        }
    }

    public function getBackup()
    {
        if(!request()->get('pass')) {
            return redirect("/backups/login");
        }
        if(request()->get('pass') != env('BACKUP_PASSWORD')) {
            return redirect("/backups/login");
        }
        $parameters = [];
        $outputBuffer = null;
        $b = \Artisan::queue('backup:run --only-db --disable-notifications',  $parameters, $outputBuffer);

        return redirect()->back()->withSuccess("تم انشاء النسخة الاحتياطية");
    }

    public function restore(Request $request) {
        if($request->password != env("BACKUP_PASSWORD")) {
            return redirect("/backups/login");

        }
        if($request->hasFile("file")) {
            $sql_file = $request->file;
            \DB::unprepared(file_get_contents($sql_file));
            return redirect()->back()->withSuccess("تم استعادة النسخة الاحتياطية");
        }else {
            return redirect()->back()->withSuccess("فشل استعادة النسخة");
        }
    }
}
