@extends('layouts.app')
@section('style')
    <style>
        .table-responsive {
            min-height: 150px
        }
    </style>
@endsection
@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing ">


            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                @if(request()->get("date_from") && request()->get("date_to") && request()->get("date_from") == date("Y-m-d") && request()->get("date_to") == date("Y-m-d") )

                                    <h4 style="float:right">{{__('lang.today_reservations')}}</h4>

                                @else
                                    <h4 style="float:right">{{__('lang.reservations')}}</h4>
                                @endif
                                <a style="float:left" href="/reservations/create"
                                   class="btn btn-primary">{{__('lang.add')}}</a>
                            </div>
                        </div>
                    </div>

                    @if(request()->get("date_from") && request()->get("date_to") && request()->get("date_from") == date("Y-m-d") && request()->get("date_to") == date("Y-m-d") )
                    @else
                        <br/>
                        <form action="/reservations" method="get">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">{{__('lang.from_date')}}</label>
                                        <input @if(request()->get('date_from')) value="{{request()->get('date_from')}}"
                                               @endif type="date" name="date_from" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{__('lang.to_date')}}</label>
                                        <input @if(request()->get('date_to')) value="{{request()->get('date_to')}}"
                                               @endif type="date" name="date_to" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        @php
                                            $status = array("booked","complete","not_visited","cancele");
                                        @endphp
                                        <label class="control-label">{{__('lang.stats')}}</label>
                                        <select name="status" class="form-control">
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
                                                <option @if(request()->get('status') && request()->get('status') == $item ) selected
                                                        @endif value="{{$item}}">{{$ui_value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">

                                        <button class="btn btn-primary mt-35">{{__('lang.filter')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                    <table id="table" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>

                            <th>#</th>
                            <th>{{__('lang.customer')}}</th>
                            <th>{{__('lang.date')}}</th>
                            <th>{{__('lang.day')}}</th>
                            <th>{{__('lang.time')}}</th>
                            <th>{{__('lang.price')}}</th>
                            <th>{{__('lang.status')}}</th>
                            <th>{{__('lang.note')}}</th>


                            <th class="dt-no-sorting">{{__('lang.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key=> $item)
                            @if($item->is_active==='true')
                            <tr  style="background: #66d9ff">
                                @else
                                    <tr>
                                        @endif
                                <td>{{$key+1}}</td>
                                <td>{{$item->customer->name}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->day}}</td>
                                <td>{{$item->work_time}}</td>
                                <td>{{$item->price}}</td>
                                <td>
                                    @php
                                        $ui_value = "";
                                        if($item->status == "booked") {
                                            $ui_value = __('lang.booked');
                                        }else if ($item->status == "complete") {
                                            $ui_value = __('lang.completed');
                                        }else if ($item->status == "not_visited") {
                                            $ui_value = __('lang.not_visited');
                                        }else {
                                            $ui_value = __('lang.canceled');
                                        }
                                    @endphp
                                    {{$ui_value}}

                                </td>
                                <td>{{$item->note}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/reservations/{{$item->id}}/show" type="button" class="btn btn-dark btn-sm">{{__('lang.show')}}</a>
                                        <button type="button"
                                                class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split"
                                                id="dropdownMenuReference22" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-chevron-down">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference22">

                                            <a class="dropdown-item" href="/reservations/{{$item->id}}/edit"><i
                                                        class="fa fa-pen"></i> {{__('lang.edit')}}</a>
                                            @if($item->is_active==='false')
                                            <a class="dropdown-item" href="/reservations/{{$item->id}}/ready"><i
                                                        class="fa fa-check"></i> {{__('lang.ready')}}</a>
                                            @else
                                                <a class="dropdown-item" href="/reservations/{{$item->id}}/unready"><i
                                                            class="fa fa-undo"></i> {{__('lang.unready')}}</a>
                                            @endif
                                            <a class="dropdown-item" href="/xrays/reportXrays/{{$item->id}}"><i
                                                class="fa fa-file"></i> {{__('lang.xray_report')}}</a>
                                                <a class="dropdown-item" href="/medicines/reportMedicines/{{$item->id}}"><i
                                                    class="fa fa-file"></i> {{__('lang.exam_report')}}</a>
                                                    <a class="dropdown-item" href="/reservations/prescription/{{$item->id}}"><i
                                                        class="fa fa-file"></i> {{__('lang.prescription_report')}}</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item " href="/reservations/{{$item->id}}/{{$item->date}}/{{$item->work_time}}/delete"><i
                                                        class="fas fa-trash"></i> {{__('lang.delete')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection
