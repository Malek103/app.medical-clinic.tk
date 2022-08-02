@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">


            <div class="statbox widget box box-shadow create-widget">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{__('lang.create_user')}}</h4>
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger form-err" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                        <strong>{{$error}}</strong>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="/users/create" method="post" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.name')}}</label>
                                <input name="name" required type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.email')}}</label>
                                <input name="email" required type="email" class="form-control" id="inputEmail4" placeholder="{{__('lang.email')}}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.phone')}}</label>
                                <input name="phone"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.phone')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.birthdate')}}</label>
                                <input name="birthdate" type="date" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.sex')}}</label>
                                <select name="gender" class="form-control">
                                    <option value="male">{{__('lang.male')}}</option>
                                    <option value="female">{{__('lang.female')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.user_type')}}</label>
                                <select name="user_type" class="form-control">
                                    <option value="admin">{{__('lang.admin')}}</option>
                                    <option value="dr">{{__('lang.dr')}}</option>
                                    <option value="secretary">{{__('lang.secretary')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.password')}}</label>
                                <input name="password" required type="password" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.image')}}</label>
                                <input name="image"  type="file" class="form-control" id="inputEmail4">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">{{__('lang.save')}}</button>

                        </div>


                    </form>

                </div>
            </div>


</div>
@endsection
