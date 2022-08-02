@extends('layouts.app')
@section('content')
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">


                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">
                                        <h4>{{__('lang.medical_examinations')}}</h4>
                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">

                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-3 col-3">

                                    </div>
                                    <div class="col-xl-3 col-md-3 col-sm-6 col-6"  >
                                        <a type="button" class="btn btn-outline-info" href="/medicines/create" style="float: left;margin-left: 30px;padding:5px 60px">{{__('lang.add')}}</a>

                                    </div>
                                </div>
                            </div>
                            <table id="table" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>{{__('lang.name')}}</th>
                                        <th>{{__('lang.category')}}</th>

                                        <th class="dt-no-sorting">{{__('lang.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->category->name}}</td>


                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-dark btn-sm">{{__('lang.open')}}</button>
                                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference22">
                                                    <a class="dropdown-item" href="/examinations/{{$item->id}}/edit"><i class="fa fa-pen"></i> {{__('lang.edit')}}</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item " href="/examinations/{{$item->id}}/delete"><i class="fas fa-trash"></i> {{__('lang.delete')}}</a>
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
