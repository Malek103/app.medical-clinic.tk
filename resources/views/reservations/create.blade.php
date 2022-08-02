@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">


        <div class="statbox widget box box-shadow create-widget">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{__('lang.create')}} {{__('lang.reservation')}}</h4>
                        <br/>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-arrow-right alert-icon-right alert-light-danger form-err"
                                     role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24"
                                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x close">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-alert-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12" y2="16"></line>
                                    </svg>
                                    <strong>{{$error}}</strong>
                                </div>
                            @endforeach
                        @endif
                        @if(session('success'))
                            <div class="alert alert-icon-left alert-light-success form-err" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-alert-triangle">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12" y2="17"></line>
                                </svg>
                                <strong>{{session('success')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="">
                <form action="/reservations/create" method="post" enctype='multipart/form-data'>
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.customer')}}</label>
                            <select required name="customer_id" class="form-control">
                                <option selected disabled value=''>{{__('lang.select')}}</option>
                                @foreach($customers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.date')}}</label>
                            @if(request()->get('date'))
                                <input name="date" value="{{request()->get('date')}}" type="date" class="form-control"
                                       id="inputEmail4">

                            @else
                                <select required name="date" id="date" class="form-control" onchange="myFunction()">
                                    <option selected disabled value=''>{{__('lang.select')}}</option>
                                    @foreach($dates as $item)
                                        <option value="{{$item['date']}}">{{$item['date']}}
                                            - {{$item['day_name']}}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>


                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.start_time')}}</label>
                            <select class="form-group col-md-12 form-control" name="work_time" id="work_time">
                                <option selected disabled>إختيار الوقت</option>
{{--                                @foreach($slots as $item)--}}
{{--                                    @foreach($item as $s)--}}
{{--                                        <option id="work_time">{{ $s }}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endforeach--}}
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.price')}}</label>
                            <input name="price" type="number" class="form-control" id="inputEmail4">

                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.status')}}</label>
                            @php
                                $status = array("booked","complete","not_visited","cancele");
                            @endphp
                            <select required name="status" class="form-control">
                                <option selected disabled value=''>{{__('lang.select')}}</option>
                                @foreach($status as $item)
                                    @php
                                        $ui_value = "";
                                        if($item == "booked") {
                                            $ui_value = __('lang.booked');
                                        }else if ($item == "complete") {
                                            $ui_value = __('lang.completed');
                                        }else if ($item == "not_visited") {
                                            $ui_value = __('lang.not_visited');
                                        }else {
                                            $ui_value = __('lang.canceled');
                                        }
                                    @endphp
                                    <option value="{{$item}}">{{$ui_value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">{{__('lang.note')}}</label>
                            <textarea name="note" class="form-control"></textarea>

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
<script src="{{asset('js/timework.js')}}"></script>
