@extends('layouts.app')
@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">


            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{__('lang.ready_list')}}</h4>
                            </div>
                        </div>
                    </div>
                    <table id="table" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>

                            <th>{{__('lang.reservation_id')}}</th>
                            <th>{{__('lang.customer')}}</th>
                            <th>{{__('lang.status')}}</th>


                            <th class="dt-no-sorting">{{__('lang.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->customer->name}}</td>
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

                                <td>
                                    <div class="btn-group">
                                        <a href="/reservations/{{$item->id}}/show" type="button" class="btn btn-dark btn-sm">{{__('lang.show')}}</a>
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference22">
                                            <a class="dropdown-item" href="/reservations/{{$item->id}}/edit"><i
                                                        class="fa fa-pen"></i> {{__('lang.edit')}}</a>
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
