@extends('layouts.app')
@section('content')
    <input type="hidden" class="male-label" value="{{__('lang.male')}}"/>
    <input type="hidden" class="female-label" value="{{__('lang.female')}}"/>
    <input type="hidden" class="total-label" value="{{__('lang.total')}}"/>
    <input type="hidden" class="reservations-label" value="{{__('lang.reservations')}}"/>
    @if(\Cookie::get('darkmode'))
        <input type="hidden" class="color" value="#0e1726"/>
    @else
        <input type="hidden" class="color" value="#fff"/>

    @endif
    <!-- Data -->
    <input type="hidden" class="male-count" value="{{$male_customers}}"/>
    <input type="hidden" class="female-count" value="{{$female_customers}}"/>
    <input type="hidden" class="reservations-months" value="{{$reservations_months}}"/>
    <input type="hidden" class="reservations-numbers" value="{{$reservations_numbers}}"/>


    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    <div class="widget-heading">
                        <h5 class="">{{__('lang.latest_reservations')}}</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="th-content">{{__('lang.customer')}}</div>
                                    </th>
                                    <th>
                                        <div class="th-content">{{__('lang.date')}}</div>
                                    </th>
                                    <th>
                                        <div class="th-content">{{__('lang.time')}}</div>
                                    </th>
                                    <th>
                                        <div class="th-content th-heading">{{__('lang.price')}}</div>
                                    </th>
                                    <th>
                                        <div class="th-content">{{__('lang.status')}}</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latest_reservations as $item)
                                    <tr>
                                        <td><a href="/reservations/{{$item->id}}/show"
                                               class="td-content product-brand text-primary">{{$item->customer->name}}</a>
                                        </td>
                                        <td>{{$item->date}}</td>
                                        <td>
                                            <div class="td-content pricing">{{ $item->work_time }}</div>
                                        </td>
                                        <td>
                                            <div class="td-content">{{$item->price}}</div>
                                        </td>
                                        <td>
                                            <div class="td-content">
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
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">{{__('lang.customers')}}</h5>
                    </div>
                    <div class="widget-content">
                        <div id="chart-2" class=""></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">{{__('lang.reservations')}} <span
                                    style="color:blue">({{$total_reservations}})</span></h5>

                        <div class="task-action">

                        </div>
                    </div>

                    <div class="widget-content">
                        <div id="revenueMonthly"></div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-three">
                    <div class="widget-heading">
                        <h5 class="">{{__('lang.accounting')}}</h5>


                    </div>
                    <div class="widget-content">

                        <div class="order-summary">

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>{{__('lang.earnings')}}</h6>
                                        <p class="summary-count">{{$total_earnings}}</p>
                                    </div>


                                </div>

                            </div>

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>{{__('lang.expenses')}}</h6>
                                        <p class="summary-count">{{$total_expenses}}</p>
                                    </div>


                                </div>

                            </div>

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-tag">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7" y2="7"></line>
                                    </svg>
                                </div>
                                <div class="w-summary-details">

                                    <div class="w-summary-info">
                                        <h6>{{__('lang.profits')}}</h6>
                                        <p class="summary-count">{{$total_earnings - $total_expenses}}</p>
                                    </div>


                                </div>

                            </div>


                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-one">
                    <div class="widget-heading">
                        <h5 class="">{{__('lang.latest_transactions')}}</h5>

                    </div>

                    <div class="widget-content">


                        <div class="transactions-list t-info">
                            @foreach($latest_transactions as $item)
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">

                                                <span class="avatar-title"><i class="fas fa-money-bill"></i></span>

                                            </div>
                                        </div>
                                        <div class="t-name">
                                            @if($item->type == "payment")
                                                <h4>{{$item->info->name}}</h4>
                                            @else
                                                <h4>{{$item->info->name}}</h4>
                                            @endif
                                            <p class="meta-date">{{$item->created_at->format('Y-m-d h:i a')}}</p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p @if($item->type =="expense") style="color:red" @endif><span>@if($item->type =="payment")
                                                    + @else - @endif {{$item->value}}</span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>




        </div>

    </div>
@endsection
@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="/plugins/apex/apexcharts.min.js"></script>
    <script src="/assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endsection
