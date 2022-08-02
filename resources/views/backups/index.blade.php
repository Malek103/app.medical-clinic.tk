@extends('layouts.app')

@section('content')
<br/>
<br/>
    <div class="container">
        <div class="row">
            @if(session('success'))
            <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <p style="    margin: 0;
    font-weight: bold;
    color: green;margin-bottom:15px;"><i class="fa fa-check"></i> {{session('success')}}</p>
                </div>
            </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="tile">
                    <div class="tile-body">
                        <div class="text-muted f-w-400">
                            <h3 style="color:#333">استعادة نسخة احتياطية</h3>
                            <form enctype='multipart/form-data' method="post" action="/backups/restore">
                                @csrf
                                <p>ملف sql: </p>
                                <input type="file" name="file" class="form-control">
                                <input type="hidden" name="password" value="{{request()->get('pass')}}" />
                                <button class="btn btn-primary" type="submit" style="margin-top: 10px">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>استعادة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">

                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6">

                                <a class="btn btn-primary" href="/backups/create?pass={{request()->get('pass')}}"
                                   style="    height: auto;
    padding-top: initial;
    width: 100%;
    margin-top: 10px;
    padding: 19px;
    font-weight: bold;">انشاء نسخة احتياطية</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                    <br/>
                    @if (count($backups))
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>اسم الملف</th>
                        <th>حجم الملف</th>
                        <th>تاريخ الانشاء</th>
                    
                        <th>خصائص</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <td>{{ $backup['file_name'] }}</td>
                            <td>{{ \App\Http\Controllers\DBBackup::humanFilesize($backup['file_size']) }}</td>
                            <td>
                                {{ date('Y-m-d h:i a',$backup['last_modified']) }}
                            </td>

                            <td class="text-right">
                                <a class="btn btn-success"
                                   href="{{ url('backup/download/'.$backup['file_name']) }}"><i
                                        class="fa fa-cloud-download"></i> تحميل</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="well">
                 
                    <h4>لا يوجد نسخ احتياطية</h4>
                </div>
            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection