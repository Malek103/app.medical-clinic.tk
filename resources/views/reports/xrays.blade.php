<!DOCTYPE html>
<html>
    {{-- <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('reports/xrays.css') }}">

</head>

<body>
    <button type="button" onClick="window.print()"
        style="left:46%;position: fixed;top: 80px;width: 120px;height: 40px;z-index:999">
        <b>طباعة التقرير</b>
    </button>
    {{-- <button type="button" class="btn btn-primary">Primary</button> --}}
    <div class="page-header d-none"
        style="text-align: center;border: 2px solid black;border-radius: 5px;margin-top: 20px;margin-left:100px">

        {{-- <img style=" height: 85px; float: right;margin-right: 5px;"
         src="{{ asset('images/logo.jpg') }}"> --}}
        {{-- right header --}}
        <div style="width: 300px;float: right">
            <p
                style="text-align: right;font-size: 24px; font-family: 'Times New Roman', Times ,serif;font-weight: bold;margin-right: 90px;">
                الدكتور</p>
            <p
                style="text-align: right;font-size: 24px; font-family: 'Times New Roman', Times ,serif;font-weight: bold;margin-right: 40px;">
                نضال عوض الشويكي</p>
            <p
                style="text-align: right;font-size: 16px; font-family: 'Times New Roman', Times ,serif;font-weight: bold;margin-right: 40px;">
                استشاري طب و جراحة مناظير المفاصل</p>
            <p
                style="text-align: right;font-size: 16px; font-family: 'Times New Roman', Times ,serif;font-weight: bold;margin-right: 50px;">
                استشاري جراحة مناظير المفاصل</p>
            <p
                style="text-align: right;font-size: 16px; font-family: 'Times New Roman', Times ,serif;font-weight: bold;margin-right: 70px;">
                و الاصابات الرياضية</p>

        </div>
        {{-- center header --}}
        <img style=" height: 150px; float: right;margin-right: -40px;" src="{{ asset('images/logo.jpg') }}">
        {{-- left header --}}
        <p
            style="text-align: left; font-size: 24px; font-family: 'Times New Roman', Times ,serif;margin-right: 0px;font-weight: bold; margin-left: 100px;">
            Dr.</p>
        <p
            style="text-align: left; font-size: 24px; font-family: 'Times New Roman', Times ,serif;margin-right: 0px;font-weight: bold; margin-left: 20px;">
            Nidal A. Al.Shwaiki</p>
        <p
            style="text-align: left; font-size: 16px; font-family: 'Times New Roman', Times ,serif;margin-right: 0px;font-weight: bold; margin-left: 20px;">
            Consultant Orthopedic Surgeon</p>
        <p
            style="text-align: left; font-size: 16px; font-family: 'Times New Roman', Times ,serif;margin-right: 0px;font-weight: bold; margin-left: 80px;">
            Arab Board</p>
        <p
            style="text-align: left; font-size: 16px; font-family: 'Times New Roman', Times ,serif;margin-right: 0px;font-weight: bold; margin-left: 40px;">
            (M.B.Ch.B/ABCOS/MRCS)</p>



        {{-- I'm The Header --}}
        <br />

    </div>

    <div class="page-footer">
        <table width="100%">

            <tr>
                <td width="250px">.................. :التوقيع</td>

                <td width="300px" style="direction: rtl"><span style="text-align: right;margin-right: 40px">التاريخ :{{ $date }}</span>
                </td>
            </tr>
        </table>

    </div>

    <table class="tabel1">

        <thead>
            <tr>
                <td>
                    <!--place holder for the fixed-position header-->
                    <div class="page-header-space"></div>
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    <?php $page_number = 1; ?>
                    <!--1 -->
                    <div>
                        <!--*** CONTENT GOES HERE ***-->
                        <div class="page">



                            <h1>Radiological Request form طلب صورة اشعة</h1>
                            <p
                                style="text-align:right;font-weight:600;font-size:14pt;    float: right;
    width: 50%;">
                                الاسم: <span style="border: 1px solid rgba(0,0,0,0.20);
    padding: 5px 15px;">{{ $customer->name }}
                                    </span></p>
                            <p
                                style="direction:rtl;text-align:left;font-weight:600;font-size:14pt;    float: right;
    width: 50%;">
                                العمر: <span
                                    style="border: 1px solid rgba(0,0,0,0.20);
    padding: 5px 15px;">{{ $customer->age }}</span></p>

                            <div class="xraycontent" style="width:700px;margin:0 auto;height:720px;border:1px solid black;margin-top:50px;border-radius: 10px;">
                            <p style="font-size: 27px;padding-left:20px;font-weight: bold">Rx:</p>
                            @if(count($res_xrays)>0)
                            @foreach ($res_xrays as $res_xray )
                            <p style="padding:0 30px;text-align: center;font-size: 24px;font-weight: bold">{{ $res_xray->xray->name }}</p>
                            <p style="padding:0 30px;text-align: center;font-size: 18px;font-weight: 500">{{ $res_xray->note }}</p>
                            @endforeach

                            @else
                            <p style="padding: 0 30px;text-align: center;font-size: 24px;font-weight: bold">لا يوجد طلب صورة اشعة</p>
                            @endif

                            </div>
                        </div>
                    </div>

                    </div>

                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <!--place holder for the fixed-position footer-->
                    <div class="page-footer-space"></div>
                </td>
            </tr>
        </tfoot>

    </table>

</body>

</html>
