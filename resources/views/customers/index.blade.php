@extends('layouts.app')
@section('content')
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">


                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                        <h4>{{__('lang.customers')}}</h4>
                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">

                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">

                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-6 col-6"  >
                                        <a type="button" class="btn btn-outline-info" href="/customers/create" style="float: left;margin-left: 30px;padding:5px 60px">{{__('lang.add')}}</a>

                                    </div>
                                </div>
                            </div>
                            <table id="table" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{__('lang.image')}}</th>
                                        <th>{{__('lang.name')}}</th>
                                        <th>{{__('lang.email')}}</th>
                                        <th>{{__('lang.phone')}}</th>
                                        <th>{{__('lang.sex')}}</th>

                                        <th>{{__('lang.birthdate')}}</th>
                                        <th>{{__('lang.blood_type')}}</th>
                                        <th>{{__('lang.id_number')}}</th>
                                        <th>{{__('lang.height')}}</th>
                                        <th>{{__('lang.marital_status')}}</th>
                                        <th>{{__('lang.job')}}</th>
                                        <th class="dt-no-sorting">{{__('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td><img src="{{$item->image_url}}" class="preview-image-table" /></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone1}}<br/>{{$item->phone2}}</td>
                                        <td>{{__('lang.' . $item->gender)}}</td>
                                        <td>{{$item->birthdate}}</td>

                                        <td>{{ $item->blood_type === "none" ? "غير محدد" : $item->blood_type }}</td>
                                        <td>{{$item->id_number}}</td>
                                        <td>{{$item->height}}</td>
                                        <td>{{$item->marital_status}}</td>
                                        <td>{{$item->job}}</td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="/customers/{{$item->id}}/show" type="button" class="btn btn-dark btn-sm">{{__('lang.show')}}</a>
                                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference22">
                                                    <a class="dropdown-item" href="/customers/{{$item->id}}/edit"><i class="fa fa-pen"></i> {{__('lang.edit')}}</a>
                                                    <a class="dropdown-item" href="/customers/{{$item->id}}/word-export"><i class="fa fa-file"></i> {{__('lang.report')}}</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item " href="/customers/{{$item->id}}/delete"><i class="fas fa-trash"></i> {{__('lang.delete')}}</a>
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
