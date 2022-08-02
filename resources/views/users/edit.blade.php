@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">


            <div class="statbox widget box box-shadow create-widget">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{__('lang.edit')}} {{$item->name}}</h4>
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
                    <form action="/users/update" method="post" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.name')}}</label>
                                <input name="name" value="{{$item->name}}" required type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.name')}}">
                            </div>                            
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.email')}}</label>
                                <input name="email" value="{{$item->email}}" required type="email" class="form-control" id="inputEmail4" placeholder="{{__('lang.email')}}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.phone')}}</label>
                                <input name="phone" value="{{$item->phone}}"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.phone')}}">
                            </div>                            
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.birthdate')}}</label>
                                <input name="birthdate" value="{{$item->birthdate}}" type="date" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.sex')}}</label>
                                <select name="sex" class="form-control">
                                    <option @if($item->gender == "male") selected @endif value="male">{{__('lang.male')}}</option>
                                    <option @if($item->gender == "female") selected @endif value="female">{{__('lang.female')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.user_type')}}</label>
                                <select name="user_type" class="form-control">
                                    <option @if($item->user_type == "admin") selected @endif value="admin">{{__('lang.admin')}}</option>
                                    <option @if($item->user_type == "dr") selected @endif value="dr">{{__('lang.dr')}}</option>
                                    <option @if($item->user_type == "secretary") selected @endif value="secretary">{{__('lang.secretary')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.update_password')}}</label>
                                <input name="password"  type="password" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.image')}}</label>
                                <input name="image"  type="file" class="form-control" id="inputEmail4">
                                <img class="preview-image" src="/uploads/{{$item->image}}"  />

                            </div>

                            <input type="hidden" name="id" value="{{$item->id}}" />

                            <button type="submit" class="btn btn-primary mt-3">{{__('lang.save')}}</button>

                        </div>

                        
                    </form>

                </div>
            </div>
     

</div>
@endsection