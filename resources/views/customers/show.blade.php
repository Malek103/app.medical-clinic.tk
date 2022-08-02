@extends('layouts.app')
@section('style')
<style>
    table {
        border:1px solid rgba(0,0,0,0.05) !important
    }
</style>
@endsection


@section('content')

<div class="layout-px-spacing">


            <div class="statbox widget box box-shadow create-widget">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{__('lang.show')}} {{__('lang.customer')}} #{{$customer->id}}</h4>
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
                <div class="row">
                    <div class="col-lg-12">
                    <p class="res-label">{{__('lang.customer_data')}}</p>
                    <table id="table2" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>


                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.phone')}}</th>
                                <th>{{__('lang.email')}}</th>
                                <th>{{__('lang.sensitive')}}</th>
                                <th>{{__('lang.sick')}}</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$customer->name}}</td>
                                <td>
                                    {{$customer->phone1}} /
                                    {{$customer->phone2}}

                                </td>
                                <td>
                                    {{$customer->email}}
                                </td>
                                @if($customer->is_sensitive==0)
                                <td>لا يوجد حساسية</td>
                                @else
                                <td>يوجد حساسية</td>
                                @endif
                                @if($customer->is_sick==0)
                                <td>لا يوجدامراض</td>
                                @else
                                <td>يوجد امراض سابقة</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>

                    <p class="res-label">{{__('lang.reservations')}}</p>
                    <table id="table2" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>


                                <th>{{__('lang.date')}}</th>
                                <th>{{__('lang.day')}}</th>
                                <th>{{__('lang.time')}}</th>
                                <th>{{__('lang.price')}}</th>
                                <th>{{__('lang.status')}}</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $item)
                            <tr>
                                <td>{{$item->date}}</td>
                                <td>
                                    {{$item->day}}

                                </td>
                                <td>
                                    {{ $item->work_time }}
                                </td>
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

                            </tr>
                            @endforeach
                        </tbody>
                    </table>





                                        <!-- Payments -->
                    <p class="res-label">{{__('lang.payments')}} </p>
                    @if(count($payments) > 0)
                    @php
                        $total = 0;
                    @endphp
                    <table id="table2" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>


                                <th>-</th>
                                <th>{{__('lang.amount')}}</th>
                                <th>{{__('lang.date')}}</th>




                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $item)
                            @php
                                $total = $total + $item->value;
                            @endphp
                            <tr>
                               <td>-</td>
                                <td>{{$item->value}}</td>
                                <td>{{$item->created_at->format('Y-m-d h:i a')}}</td>



                            </tr>
                            @endforeach
                            <tr>
                                <td>{{__('lang.total')}}</td>
                                <td>{{$total}}</td>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>
                    @else
                        <p class="data-label">{{__('lang.no_data')}}</p>
                    @endif

                    </div>

            </div>


</div>
@endsection
