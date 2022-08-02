@extends('layouts.app')
@section('style')
<style>
    .table > thead > tr > th, .table > tbody > tr > td {
        padding:20px !important
    }
</style>
@endsection
@section('content')
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">

                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{__('lang.transactions')}}</h4>
                                    </div>                 
                                </div>
                            </div>         
                            <br/>   
                            
                            <form action="/accounting/transactions" method="get">
                                {{csrf_field()}}
                            <div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">{{__('lang.from_date')}}</label>
                                        <input @if(request()->get('date_from')) value="{{request()->get('date_from')}}" @endif type="date" name="date_from" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{__('lang.to_date')}}</label>
                                        <input @if(request()->get('date_to')) value="{{request()->get('date_to')}}" @endif type="date" name="date_to" class="form-control"/>
                                    </div>
                                </div>

                            
                                <div class="col-lg-2">
                                    <div class="form-group">
                                       
                                        <button class="btn btn-primary mt-35">{{__('lang.filter')}}</button>
                                    </div>
                                </div>
                            </div>    
                            </form>  
                            @php 
                                $total = 0;
                            @endphp
                            <table id="table2" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                      
                                        <th>-</th>
                                        <th>{{__('lang.amount')}}</th>
                                        <th>{{__('lang.transaction_type')}}</th>
                                        <th>{{__('lang.info')}}</th>
                                        <th>{{__('lang.date')}}</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        @php
                                            if($item->type == "payment") {
                                                $type = __('lang.earnings');
                                                $total = $total + $item->value;
                                            }else if($item->type == "expense") {
                                                $type = __('lang.expense');
                                                $total = $total - $item->value;
                                            }

                                        @endphp
                                        <tr>
                                            <td>-</td>
                                            <td><strong>{{$item->value}}</strong></td>
                                            <td>{{$type}}</td>
                                            <td>{{$item->info->name}}</td>
                                            <td>{{$item->created_at->format('Y-m-d h:i a')}}</td>
                                    
                        
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{__('lang.cash_total')}}</td>
                                        <td><strong>{{$total}}</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
    
@endsection