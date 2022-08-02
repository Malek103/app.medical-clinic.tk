<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function create($name,$id){

        $data=new Attachment();
        if ($name) {
                $file = $name;
                $path = storage_path("app/public/attachments/" . $file);
                $data->image = $file;

        }
        $data->reservation_id=$id;
        $data->save();
        return redirect('/reservations/'.$id.'/show');

    }

    public function index($id){

        $disk=Storage::disk('file');
        $files=$disk->files('file');
        $allfiles=[];
        foreach($files as $k=>$f){
            if($disk->exists($f)){
                $allfiles[]=[
                    'file_path'=>$f,
                    'file_name'=>str_replace("backup" .'/', '', $f),
                    'last_modified'=>$disk->lastModified($f),
                ];
            }
        }
        $date = date('Y-m-d 00:00:00');

        $allfiles=array_reverse($allfiles);
        // dd($allfiles);
        return view('reservations.attachment')->with(["allfiles"=>$allfiles,"date"=>$date,"id"=>$id]);
    }
}
