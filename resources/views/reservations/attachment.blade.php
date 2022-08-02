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
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                    <br/>
                    @if (count($allfiles))
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>اسم الملف</th>
                        <th>صورة</th>
                        <th>تاريخ الانشاء</th>

                        <th>خصائص</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($allfiles as $allfile)
                    @if(date('Y-m-d h:i a',$allfile['last_modified']) > $date)
                        <tr>
                            <td>{{ $allfile['file_name'] }}</td>
                            <td><img width="70px" src="/storage/{{ $allfile['file_name'] }}"></td>
                            <td>
                                {{ date('Y-m-d h:i a',$allfile['last_modified']) }}
                            </td>


                            <td class="text-right">
                                <a class="btn btn-success"
                                   href="{{ url($allfile['file_name'].'/'.$id) }}"><i
                                        class="fa fa-cloud-download"></i>حفظ الصورة</a>

                            </td>
                        </tr>
                        @endif
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
