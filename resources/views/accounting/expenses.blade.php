@extends('layouts.app')
@section('style')
<style>
    .table > thead > tr > th, .table > tbody > tr > td {
        padding:20px !important
    }
</style>
@endsection
@section('modals')
<!-- Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.expense')}}</h5>
            </div>
            <form action="/accounting/expenses/create" method="post">
                <div class="modal-body">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label class="control-label">{{__('lang.name')}}</label>
                            <input type="text" name="name" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('lang.amount')}}</label>
                            <input type="number" name="value" class="form-control" required />
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('lang.note')}}</label>
                            <input type="text" name="notes" class="form-control"  />
                        </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}</div>
                    <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('content')
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">

                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4 style="float:right">{{__('lang.expenses')}}</h4>
                                        <a style="float:left" href="#!" data-toggle="modal" data-target="#expenseModal" class="btn btn-primary">{{__('lang.add')}}</a>
                                    </div>                 
                                </div>
                            </div>         
                            <br/>   
                            
                            <form action="/accounting/expenses" method="get">
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
                                        <th>{{__('lang.name')}}</th>
                                        <th>{{__('lang.note')}}</th>
                                        <th>{{__('lang.date')}}</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                        @php
                                            $total = $total + $item->value;
                                        @endphp
                                        <tr>
                                            <td>-</td>
                                            <td><strong>{{$item->value}}</strong></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->notes}}</td>
                                            <td>{{$item->created_at->format('Y-m-d h:i a')}}</td>
                                    
                        
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{__('lang.total')}}</td>
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