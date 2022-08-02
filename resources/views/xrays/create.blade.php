@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">


            <div class="statbox widget box box-shadow create-widget">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{__('lang.create')}} {{__('lang.xrays')}}</h4>
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger form-err" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                        <strong>{{$error}}</strong>
                                    </div>
                                @endforeach
                            @endif  
                            @if(session('success'))
                                <div class="alert alert-icon-left alert-light-success form-err" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                    <strong>{{session('success')}}</strong>
                                </div>                            
                            @endif                             
                        </div>                                                                        
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="/xrays/create" method="post" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">{{__('lang.name')}}</label>
                                <input name="name" required type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.name')}}">
                            </div>                            
                

                            <div class="col-12">

                            <button type="submit" class="btn btn-primary mt-3">{{__('lang.save')}}</button>
                            </div>
                        </div>

                        
                    </form>

                </div>
            </div>
     

</div>
@endsection