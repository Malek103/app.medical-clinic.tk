@extends('layouts.app')
@section('style')
<style>
    .table-responsive {
        min-height:150px
    }

    .ui-datepicker-calendar {
    display: none;
    }
</style>
@endsection
@section('content')

    <div class="layout-px-spacing">


                <div class="row layout-top-spacing ">

                    <div class="col-xl-9 col-lg-9 col-sm-9  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                        <h4 style="float:right">{{__('lang.calendar')}}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="container" style="display: grid;grid-template-rows: 40px 40px;grid-template-columns: 100px 100px 100px 100px 100px 100px 100px 100px 100px 100px 100px 100px ;justify-content: center;align-content: center;gap: 1px">
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-01" }}/getcalendar" type="button"> <p style="color: white;text-align:center;font-size: 20px;margin: auto;">1 Jan</p> </a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"> <a name="month" href="/reservations/{{ "2022-02" }}/getcalendar" href="/reservations/calendar"  type="button"> <p style="color: white;text-align:center;font-size: 20px;margin: auto;">2 Feb</p></a> </div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-03" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">3 Mar</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-04" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">4 Apr</p> </a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-05" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">5 May</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-06" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">6 Jun</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-07" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">7 Jul</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-08" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">8 Aug</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-09" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">9 Sep</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-10" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">10 Oct</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-11" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">11 Nav</p></a></div>
                                <div style="border: 0.5px solid #b3b3cc;border-radius: 15px;" class="btn btn-info"><a name="month" href="/reservations/{{ "2022-12" }}/getcalendar" href="/reservations/calendar" type="button"> <p style="text-align:center;font-size: 20px;margin: auto;color: white">12 Dec</p></a></div>
                              </div>
                            <br/>
                            <div class="col-lg-12">
                                <div class="calendar">
                                    <div class="month">
                                        <h1>{{$current_date}}</h1>

                                    </div>

                                    <ul class="days">
                                        @foreach($calendar as $item)

                                        <li onclick="myfun()"  @if($item['date'] == date('Y-m-d')) class="active" @endif>
                                            <p  id="datehover">{{$item['date']}}</p>


                                            <time id="getday" datetime="2022-02-01">{{$item['day']}}</time> {{$item['name']}}
                                            @if($item['date'] >= date('Y-m-d'))
                                                <a style="width: 80px;padding: 0px" href="/reservations/create?date={{$item['date']}}" class="btn btn-primary">{{__('lang.add')}}</a>
                                            @endif
                                           <div class="calendar-menu">
                                               <p>{{__('lang.reservations')}}</p>
                                               @if(count($item['reservations']) > 0)
                                                   @foreach($item['reservations'] as $res)
                                                   <a href="/reservations/{{$res->id}}/show" class="res-item">{{$res->customer->name}}</a>
                                                   @endforeach
                                               @else
                                                   <p class="no-results">{{__('lang.no_data')}}</p>
                                               @endif

                                           </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            <br/>
                            <br/>

                            <form action="/reservations/calendar" method="get">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">{{__('lang.month')}}</label>
                                            <input @if(request()->get('month')) value="{{request()->get('month')}}" @endif type="month" name="month" class="form-control"/>
                                        </div>
                                    </div>



                                    <div class="col-lg-2">
                                        <div class="form-group">

                                            <button class="btn btn-primary mt-35">{{__('lang.show')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="col-lg-3" style="margin: 50px 0px">
                        <div class="widget-content widget-content-area br-6">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                    </div>
                                </div>
                            </div>
                            <br/>




                            <div class="col-lg-12">
                                <div class="cal">
                                    <div class="rex">
                                        <ul class="days">
                                            @foreach($calendar as $item)
{{--                                                <li @if($item['date'] == date('Y-m-d')) class="active" @endif>--}}
{{--                                                    <time datetime="2022-02-01">{{$item['day']}}</time> {{$item['name']}}--}}
                                                    <div class="calendar-menu" id="examinations-menu">
{{--
{{--                                                        @if($item['date']==$date)--}}
{{--                                                        <p>{{__('lang.reservations')}}</p>--}}
{{--                                                        @if(count($item['reservations']) > 0)--}}


{{--                                                            @foreach($item['reservations'] as $res)--}}

{{--                                                                <a href="/reservations/{{$res->id}}/show" class="res-item">{{$res->customer->name}}</a>--}}


{{--                                                            @endforeach--}}
{{--                                                        @else--}}
{{--                                                            <p class="no-results">{{__('lang.no_data')}}</p>--}}
{{--                                                        @endif--}}
{{--                                                        @if($item['date'] >= date('Y-m-d'))--}}
{{--                                                            <a href="/reservations/create?date={{$item['date']}}" class="btn btn-primary">{{__('lang.add')}}</a>--}}
{{--                                                        @endif--}}
{{--                                                            @endif--}}
                                                    </div>
{{--                                                </li>--}}
                                            @endforeach

                                        </ul>
                                    </div>


                                </div>
                            </div>

                            <br/>
                            <br/>

                        </div>
                    </div>

                    </div>

                </div>

            </div>

@endsection

<script>

    // function getdate(){
    //     const datehovers=document.querySelector("#datehover");
    //     // console.log(datehovers);
    //     // console.log('datehovers');
    // }

    function myfun(){


        const myday=document.getElementById("getday").innerHTML;
        const mydate=document.getElementById("datehover").innerHTML;


        const menu=document.getElementById("examinations-menu");

        console.log(mydate);
        var headers = {
            "Contect-Type": "application/json",
        };
        $.ajax({
            headers: headers,
            type: "GET",
            url: "/reservations/getexaminationdate/"+mydate,

            dataType: 'json',
            // success: success,
            success: function (data) {

                $.each(data, function (index, value) {

                   // const p =document.createElement('p');
                   // p.textContent=value.id
                   //  menu.append(p);
                    for(let i=0;i<data.length;i++){
                        menu.innerHTML=`
                        <p>{{__('lang.reservations')}}</p>.
                        <ul>
                        <li><a href="/reservations/${value.id}/show" class="res-item">${value.customer_id}</a></li>
                        </ul>

                    `;

                    }




                });
                // console.log(['data']);
                console.log('malek success')
                console.log(data);
            },
            dataType: "json",
            error: function (error) {
                console.log('malek error');
                console.log(data);

            }
        })

    }



    $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years"
});
</script>
