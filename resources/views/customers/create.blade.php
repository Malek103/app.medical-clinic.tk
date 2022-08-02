@extends('layouts.app')
@section('content')
<div class="layout-px-spacing">


            <div class="statbox widget box box-shadow create-widget">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{__('lang.create')}} {{__('lang.customer')}}</h4>
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
                    <form action="/customers/create" method="post" enctype='multipart/form-data'>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.name')}}</label>
                                <input name="name" required type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.email')}}</label>
                                <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="{{__('lang.email')}}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.phone')}} 1</label>
                                <input name="phone1"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.phone')}} 1">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.phone')}} 2</label>
                                <input name="phone2"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.phone')}} 2">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.birthdate')}}</label>
                                <input name="birthdate" type="date"  class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.sex')}}</label>
                                <select name="gender" class="form-control">
                                    <option value="none">{{__('lang.none')}}</option>
                                    <option value="male">{{__('lang.male')}}</option>
                                    <option value="female">{{__('lang.female')}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.blood_type')}}</label>
                                <select name="blood_type" class="form-control">
                                    <option value="none">{{__('lang.none')}}</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>AB</option>
                                    <option>O</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.image')}}</label>
                                <input name="image"   type="file" class="form-control" id="inputEmail4">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.height')}}</label>
                                <input name="height"  type="number" class="form-control" id="inputEmail4" placeholder="{{__('lang.height')}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.marital_status')}}</label>
                                <input name="marital_status"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.marital_status')}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.job')}}</label>
                                <input name="job"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.job')}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">{{__('lang.id_number')}}</label>
                                <input  name="id_number"  type="text" class="form-control" id="inputEmail4" placeholder="{{__('lang.id_number')}}">
                            </div>
                            <div class="form-check">
                                <label style="padding-left:25px" class="form-check-label" for="flexCheckDefault">
                                    {{ __('lang.Does_he_have_allergies') }}
                                  </label>
                                <input  class="form-check-input" name="sensitive" type="checkbox" id="flexCheckDefault">

                              </div>
                              <div class="form-check">
                                <label style="padding-left:25px" class="form-check-label" for="flexCheckChecked">
                                   {{ __('lang.Are_there_any_previous_illnesses') }}
                                  </label>
                                <input class="form-check-input" name="sick" type="checkbox" id="flexCheckChecked">

                              </div>
                              <div class="form-group col-md-12">
                                <label for="inputEmail4">{{__('lang.note')}}</label>
                                <textarea rows="5" name="note" class="form-control"></textarea>

                            </div>
                         <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.final_report')}}</label>
                            <textarea rows="20" name="final_report" class="form-control"></textarea>

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
