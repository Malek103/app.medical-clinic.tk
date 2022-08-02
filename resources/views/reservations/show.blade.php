@extends('layouts.app')
@section('style')
    <style>
        table {
            border: 1px solid rgba(0, 0, 0, 0.05) !important
        }

        [data-msg]{
            position: relative;
        }
        [data-msg]:focus::before,[data-msg]:hover::before{
            content: attr(data-msg);
            position: absolute;
            width: 100%;
            min-width: 500px;
            padding: 1rem;
            background-color: #d9d9d9;
            left: 50%;
            top: -1rem;
            transform: translate(-50%,-100%)
        }
        [data-msg]:focus::after,[data-msg]:hover::after{
            content:'';
            position: absolute;
            left: 50%;
            top: -18px;
            transform: translate(-50%);
            border-top: 15px solid white;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}

@endsection

@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="examinationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.exam')}}</h5>
                </div>
                <form action="/reservations/examinations/create" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">{{__('lang.exam')}}</label>
                            <select name="examination_id" id="examination_id" required class="form-control">
                                @foreach($all_examinations as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label class="control-label">{{__('lang.note')}}</label>
                            <textarea class="form-control" name="note" rows="3"></textarea>
                        </div>
                        <div class="addExam" style="display: none">
                            <label class="control-label">{{__('lang.exam')}}</label>
                            <input class="form-control" id="exam_name" name="exam_name"></input>
                            <button type="button" id="add_examination" class="btn btn-primary mt-3"><i
                                        class="fa fa-save" onclick="addexamination()">{{__('lang.save')}}</i>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="reservation_id" value="{{$res->id}}"/>
                        <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                        <a href="#" class="btn btn-info addbtn"
                           style="float: left">{{__('lang.create')}} {{__('lang.exam')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="xrayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.xray')}}</h5>
                </div>
                <form action="/reservations/xrays/create" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">{{__('lang.xray')}}</label>
                            <select name="xray_id" id="xray_id" required class="form-control">
                                @foreach($all_xrays as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label class="control-label">{{__('lang.note')}}</label>
                            <textarea class="form-control" name="note" rows="3"></textarea>
                        </div>
                        <div class="addXray" style="display: none">
                            <label class="control-label">{{__('lang.xray')}}</label>
                            <input class="form-control" id="xray_name" name="xray_name"></input>
                            <button type="button" id="add_examination" class="btn btn-primary mt-3"><i
                                        class="fa fa-save" onclick="xtrayAdd()">{{__('lang.save')}}</i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reservation_id" value="{{$res->id}}"/>
                        <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                        <a href="#" class="btn btn-info addxray" id="addxray"
                           style="float: left">{{__('lang.create')}} {{__('lang.xray')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.medicine')}}</h5>
                </div>
                <form action="/reservations/medicines/create" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">{{__('lang.medicine')}}</label>
                            <select onchange="instructionsfun()" name="medicine_id" id="medicine_id" required class="form-control">
                                @foreach($all_medicines as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>

                                @endforeach
                            </select>
                            <label for="inputEmail4">{{__('lang.instructions')}}</label>
                                <textarea rows="1" name="instructions"  type="text" class="form-control" id="demo" placeholder="{{__('lang.instructions')}}"></textarea>
                            <label class="control-label">{{__('lang.note')}}</label>
                            <textarea class="form-control" name="note" rows="3"></textarea>
                        </div>
                        <div class="addMedicines" style="display: none">
                            <label class="control-label">{{__('lang.medicine')}}</label>
                            <input class="form-control" id="medicine_name" name="medicine_name"></input>
                            <button type="button" id="add_examination" class="btn btn-primary mt-3"><i
                                        class="fa fa-save" onclick="mediciesAdd()">{{__('lang.save')}}</i>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reservation_id" value="{{$res->id}}"/>
                        <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                        <a href="#" class="btn btn-info addmedicines"
                           style="float: left">{{__('lang.create')}} {{__('lang.medicine')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.payments')}}</h5>
                </div>
                <form action="/reservations/payments/create" method="post">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">{{__('lang.amount')}}</label>
                            <input type="number" name="value" class="form-control" required/>
                        </div>
                        <label class="control-label">{{__('lang.note')}}</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reservation_id" value="{{$res->id}}"/>
                        <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Attachments model --}}
    <div class="modal fade" id="AttachmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('lang.add')}} {{__('lang.attachments')}}</h5>
                </div>
                <form action="/reservations/attachments/create/{{$res->id}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label">{{__('lang.attachments')}}</label>
                            <input class="form-control form-control-sm" type="file" name="image" id="folder-opener" id="folder-opener"/>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reservation_id" value="{{$res->id}}"/>
                        <div class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('lang.cancel')}}
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="layout-px-spacing">


        <div class="statbox widget box box-shadow create-widget">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="row" style="float: left">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="float: left">
                        <a href="/xrays/reportXrays/{{$res->id}}" type="button" class="btn btn-outline-info"> {{__('lang.xray_report')}} <i
                            class="fa fa-file" style="padding: 5px"></i></a>
                        <a href="/medicines/reportMedicines/{{$res->id}}" type="button" class="btn btn-outline-info">{{__('lang.exam_report')}}<i
                            class="fa fa-file" style="padding: 5px"></i></a>
                        <a href="/reservations/prescription/{{$res->id}}" type="button" class="btn btn-outline-info">{{__('lang.prescription_report')}}<i
                            class="fa fa-file" style="padding: 5px"></i></a>
                    </div>
                    </div>
                    <div class="row" style="float: left;margin-left: 2px">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12" style="float: left">
                        <a href="/reservations/{{$res->id}}/edit" type="button" class="btn btn-outline-warning"> {{__('lang.edit')}} <i
                            class="fa fa-pen" style="padding: 5px"></i></a>
                        <a href="/reservations/{{$res->id}}/{{$res->date}}/{{$res->work_time}}/delete" type="button" class="btn btn-outline-danger">{{__('lang.delete')}}<i
                            class="fa fa-trash" style="padding: 5px"></i></a>
                            @if($res->is_active==='false')
                                <a href="/reservations/{{$item->id}}/ready" type="button" class="btn btn-outline-success">{{__('lang.ready')}}<i
                                class="fa fa-check" style="padding: 5px"></i></a>
                            @else
                                <a href="/reservations/{{$item->id}}/unready" type="button" class="btn btn-outline-danger">{{__('lang.unready')}}<i
                                class="fa fa-undo" style="padding: 5px"></i></a>
                            @endif
                    </div>
                </div>
                        <h4>{{__('lang.show')}} {{__('lang.reservation')}} #{{$res->id}}</h4>
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
            <div class="row">
                <div class="col-lg-7">
                    <p class="res-label">{{__('lang.customer_data')}}</p>
                    <table id="table2" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>


                            <th>{{__('lang.name')}}</th>
                            <th>{{__('lang.note')}}</th>
                            <th>{{__('lang.sensitive')}}</th>
                            <th>{{__('lang.sick')}}</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$customer->name}}</td>
                            @if($customer->note)
                            <td>
                               {{ $customer->note }}

                            </td>
                            @else
                            <td>{{ __('lang.no_note') }}</td>
                            @endif

                                @if($customer->is_sensitive==0)
                                <td>لا يوجد حساسية</td>
                                @else
                                <td>يوجد حساسية</td>
                                @endif

                           @if($customer->is_sick==0)
                           <td> لا يوجد امراض سابقة</td>
                           @else
                           <td>يوجد امراض سابقة</td>
                           @endif
                        </tr>
                        </tbody>
                    </table>

                    <p class="res-label">{{__('lang.reservation_data')}}</p>
                    <table id="table2" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>


                            <th>{{__('lang.date')}}</th>
                            <th>{{__('lang.day')}}</th>
                            <th>{{__('lang.time')}}</th>
                            <th>{{__('lang.price')}}</th>
                            <th>{{__('lang.remaining')}}</th>
                            <th>{{__('lang.status')}}</th>


                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation )
                            <tr>
                                <td><a href="/reservations/{{$reservation->id}}/show">{{$reservation->date}}</a> </td>
                                <td>
                                    {{$reservation->day}}

                                </td>
                                <td>
                                   {{$reservation->work_time}}
                                </td>
                                <td>{{$reservation->price}}</td>
                                <td>{{$reservation->remaining}}</td>
                                <td>
                                    @php
                                        $ui_value = "";
                                        if($reservation->status == "booked") {
                                            $ui_value = __('lang.booked');
                                        }else if ($reservation->status == "complete") {
                                            $ui_value = __('lang.completed');
                                        }else if ($reservation->status == "not_visited") {
                                            $ui_value = __('lang.not_visited');
                                        }else {
                                            $ui_value = __('lang.canceled');
                                        }
                                    @endphp

                                    {{$ui_value}}
                                </td>

                            </tr>
                            @endforeach
                            <tr>
                                <td>{{__('lang.total_amount_remaining')}}</td>
                                <td>{{ $total_res }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>


                    <!-- Payments -->
                    <p class="res-label">{{__('lang.payments')}} <a href="#!" class="btn btn-primary data-btn"
                                                                    data-toggle="modal"
                                                                    data-target="#paymentModal">{{__('lang.add')}}</a>
                    </p>
                    @if(count($payments) > 0)
                        @php
                            $total = 0;
                        @endphp
                        <table id="table2" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>


                                <th>-</th>
                                <th>{{__('lang.amount')}}</th>
                                <th>{{__('lang.note')}}</th>
                                <th>{{__('lang.date')}}</th>
                                <th>{{__('lang.actions')}}</th>


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
                                    @if($item->note)
                                        <td style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch; padding-top: 22px">{{$item->note}}
                                            <span class="popuptext" id="myPopup">{{$item->note}}</span></td>
                                    @else
                                        <td>{{__('lang.no_note')}}</td>
                                    @endif
                                    <td>{{$item->created_at->format('Y-m-d h:i a')}}</td>

                                    <td>

                                        <a class="btn btn-primary" href="/reservations/payments/{{$item->id}}/delete"><i
                                                    class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td>{{__('lang.total')}}</td>
                                <td>{{$total}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <p class="data-label">{{__('lang.no_data')}}</p>
                    @endif

                </div>
                <div class="col-lg-5">

                    <p class="res-label">{{__('lang.medical_examinations')}} <a href="#!"
                                                                                class="btn btn-primary data-btn"
                                                                                data-toggle="modal"
                                                                                data-target="#examinationModal">{{__('lang.add')}}</a>
                    </p>
                    @if(count($examinations) > 0)
                        <div class="table-responsive">
                            <table id="table2" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                <tr>


                                    <th>{{__('lang.name')}}</th>
                                    <th>{{__('lang.note')}}</th>
                                    <th>{{__('lang.results')}}</th>
                                    <th>{{__('lang.actions')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($examinations as $item)
                                    <tr>
                                        <form action="/reservations/examinations/update" method="post">
                                            {{csrf_field()}}
                                            <td>{{$item->examination->name}}</td>
                                            {{--                                    <td style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch; padding-top: 22px"><p  title="Header" data-toggle="popover" data-placement="top" data-content={{$item->note}}>{{$item->note}}</p></td>--}}
                                            @if($item->note)
                                                {{-- <td data-msg="{{ $item->note }}" style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch; padding-top: 22px">{{$item->note}}
                                                    <span data-msg="{{ $item->note }}" class="popuptext" id="myPopup">{{$item->note}}</span></td>
                                                    <td> --}}
                                                    <td>
                                                        <a data-msg="{{ $item->note }}"><span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch;">{{$item->note}}</span> </a>
                                                    </td>
                                            @else
                                                <td>{{__('lang.no_note')}}</td>
                                            @endif
                                            <td>
                                                <textarea name="result" class="form-control data-textarea" cols="100"
                                                          rows="5">{{$item->result}}</textarea>
                                            </td>
                                            <td>

                                                <button class="btn btn-primary"><i class="fa fa-check"></i></button>

                                                <a class="btn btn-primary"
                                                   href="/reservations/examinations/{{$item->id}}/delete"><i
                                                            class="fa fa-trash"></i></a>
                                                <input type="hidden" name="id" value="{{$item->id}}"/>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="data-label">{{__('lang.no_data')}}</p>
                    @endif


                <!-- Xrays -->
                    <p class="res-label">{{__('lang.xrays')}} <a href="#!" class="btn btn-primary data-btn"
                                                                 data-toggle="modal"
                                                                 data-target="#xrayModal">{{__('lang.add')}}</a></p>
                    @if(count($xrays) > 0)
                        <table id="table2" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>


                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.note')}}</th>
                                <th>{{__('lang.results')}}</th>
                                <th>{{__('lang.actions')}}</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($xrays as $item)
                                <tr>
                                    <form action="/reservations/xrays/update" method="post">
                                        {{csrf_field()}}
                                        <td>{{$item->xray->name}}</td>
                                        @if($item->note)
                                            {{-- <td style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch; padding-top: 22px">{{$item->note}}
                                                <span class="popuptext" id="myPopup">{{$item->note}}</span></td> --}}
                                                <td>
                                                    <a data-msg="{{ $item->note }}"><span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch;">{{$item->note}}</span> </a>
                                                </td>
                                        @else
                                            <td>{{__('lang.no_note')}}</td>
                                        @endif
                                        <td>
                                            <textarea name="result"
                                                      class="form-control data-textarea">{{$item->result}}</textarea>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-check"></i></button>

                                            <a class="btn btn-primary"
                                               href="/reservations/xrays/{{$item->id}}/delete"><i
                                                        class="fa fa-trash"></i></a>
                                            <input type="hidden" name="id" value="{{$item->id}}"/>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="data-label">{{__('lang.no_data')}}</p>
                    @endif


                <!-- Medicines -->
                    <p class="res-label">{{__('lang.medicines')}} <a href="#!" class="btn btn-primary data-btn"
                                                                     data-toggle="modal"
                                                                     data-target="#medicineModal">{{__('lang.add')}}</a>
                    </p>
                    @if(count($medicines) > 0)
                        <table id="table2" class="table table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>


                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.note')}}</th>
                                <th>{{__('lang.instructions')}}</th>
                                <th>{{__('lang.actions')}}</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($medicines as $item)
                                <tr>

                                    <td>{{$item->medicine->name}}</td>
                                    @if($item->note)
                                        {{-- <td style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch; padding-top: 22px">{{$item->note}}
                                            <span class="popuptext" id="myPopup">{{$item->note}}</span></td> --}}
                                            <td>
                                                <a data-msg="{{ $item->note }}"><span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 14ch;">{{$item->note}}</span> </a>
                                            </td>
                                    @else
                                        <td>{{__('lang.no_note')}}</td>
                                    @endif
                                    <td>
                                        {{$item->instructions}}
                                    </td>
                                    <td>

                                        <a class="btn btn-primary"
                                           href="/reservations/medicines/{{$item->id}}/delete"><i
                                                    class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="data-label">{{__('lang.no_data')}}</p>
                    @endif

                    {{-- Attachments --}}

                    <p class="res-label">{{__('lang.attachments')}} <a style="float: left" href="/attachment/{{ $res->id }}" class="btn btn-primary">{{__('lang.add')}}</a>
                    </p>
                    @if(count($attachments) > 0)
                        <table id="table2" class="table table-hover non-hover" style="width:100%">
                            <thead>
                                    <tr>


                                        <th>#</th>
                                        <th>{{__('lang.attachments')}}</th>
                                        <th>{{__('lang.date')}}</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($attachments as $key=> $item)
                                        <tr>

                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a target="_blank" href="/storage/file/{{ $item->image }}"><img width="70px" src="/storage/file/{{ $item->image }}"></a>
                                            </td>
                                            <td>{{ $item->created_format }}</td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                                @else
                                                <p class="data-label">{{__('lang.no_attachment')}}</p>
                                                @endif


                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="res-label">{{__('lang.note')}}</p>
                    <form action="/reservations/examinations/{{$res->id}}/addNote" method="post">
                        {{csrf_field()}}
                        <textarea id="body" class="form-control"
                                  name="note_doctor"
                                  placeholder="{{__('lang.note')}}">{{$res->doctor_note}}</textarea>
                        <button type="submit" class="btn btn-primary"
                                style="float: left;margin-top: 5px">{{__('lang.save')}}</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
    {{-- <script>
        document.getElementById('folder-opener').addEventListener('change', function(event) {
  // Selected folder's absolute path:
            console.log(event.target.files[0].path);
        });
    </script> --}}
    <script>
        function instructionsfun(){
            var x = document.getElementById("medicine_id").value;
            var headers = {
        "Contect-Type": "application/json",
    };
            $.ajax({
        headers: headers,
        type: "GET",
        url: "/reservations/getinstructions/"+x,

        dataType: 'json',

        success: function (data) {
            document.getElementById("demo").innerHTML =data[0]['instructions'];
            console.log(data[0]['instructions'])
        },
        dataType: "json",
        error: function (error) {
            console.log('error');
        }
    })
        }
       </script>
    <script src="{{asset('js/reservations.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('public/js/tinymce/tinymce.min.js')}}"></script>

    <script>
        tinymce.init({
            selector: 'textarea#body',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            // content_css: '//www.tiny.cloud/css/codepen.min.css',
            link_list: [
                {title: 'My page 1', value: 'https://www.codexworld.com'},
                {title: 'My page 2', value: 'https://www.xwebtools.com'}
            ],
            image_list: [
                {title: 'My page 1', value: 'https://www.codexworld.com'},
                {title: 'My page 2', value: 'https://www.xwebtools.com'}
            ],
            image_class_list: [
                {title: 'None', value: ''},
                {title: 'Some class', value: 'class-name'}
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {text: 'My text'});
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {alt: 'My alt text'});
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg'});
                }
            },
            templates: [
                {
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...'},
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });

    </script>

@endsection
