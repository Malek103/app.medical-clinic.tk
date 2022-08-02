@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(session('success'))
            <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <p style="    margin: 0;
    font-weight: bold;
    color: red;"><i class="fa fa-times"></i> {{session('success')}}</p>
                </div>
            </div>
            </div>
            @endif
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <br/>
                        <div class="text-muted f-w-400">
                            <h3 style="color:#333">الدخول</h3>
                            <form enctype='multipart/form-data' method="post" action="/backups/login">
                                @csrf
                                <p>كلمة المرور: </p>
                                <input required type="password" name="password" class="form-control">

                                <button class="btn btn-primary" type="submit" style="margin-top: 10px">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>الدخول 
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection