<!DOCTYPE html>
<html>
    {{-- <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('reports/prescription.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;500;900&display=swap" rel="stylesheet">

</head>
<style type="text/css" media="print">
    @page {
        size: landscape;
    }



</style>
<body>
    <button type="button" onClick="window.print()"
        style="left:40%;position: fixed;top: 80px;width: 120px;height: 40px;z-index:999">
        <b>طباعة التقرير</b>
    </button>
    <div style="width: 80%" class="page-header">



        <h1 style="border: none;color:#b30000;font-size:20px;text-align: right">الرجاء الالتزام بالوصفة الطبية و عدم تبديل الدواء</h1>
        <p style="text-align:right;font-weight:600;font-size:14pt;float:right;width: 40%;">
            الاسم: <span style="border: 1px solid rgba(0,0,0,0.20);padding: 5px 15px;">{{ $customer->name }}</span></p>
        <p style="direction:rtl;text-align:left;font-weight:600;font-size:14pt;float:right;width: 20%;">
            العمر: <span style="border: 1px solid rgba(0,0,0,0.20);padding: 5px 15px;">{{ $customer->age }}</span></p>

        <div class="xraycontent" style="width:650px;height:600px;border:1px solid black;margin-top:50px;border-radius: 10px;float: right;">
        <p style="font-size: 27px;padding-left:20px;font-weight: bold">Rx:</p>
        @foreach ($res_medicines as $key=>$res_medicine )
            <div style="padding:0 20px">
                <p style="font-size: 26px;font-weight: bold">{{ $key+1 }} - {{ $res_medicine->medicine->name }}</p>
            <p style="padding-left: 80px;font-size: 18px">{{ $res_medicine->instructions }}</p>
            </div>


        @endforeach


        </div>
    </div>

    <div class="page-header">



        <div class="xraycontent" style="width:300px;margin:0;height:670px;border:1px solid black;margin-top:70px;border-radius: 10px;float: left;">
        {{-- <div style="background: blue;width: 300px">1</div> --}}
        <div class="headerPre">
            <h1 style="border: none;width: 90px;font-size: 30px;padding: auto;font-family: 'Cairo', sans-serif;font-weight: 400;color: #002733 ">الدكتور</h1>
            <h1 style="border: none;width:300px;font-size: 30px;padding-left:5px; 'Cairo', sans-serif;font-weight: 400;line-height: 1.6;color: #002733 ">نضال عوض الشويكي</h1>
            <p style="width:90px;font-size: 18px;padding-left:130px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.5;color: #002733">استشاري</p>
            <p style="width:170px;font-size: 18px;padding-left:80px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">جراحة العظام و المفاصل</p>
            <p style="width:90px;font-size: 18px;padding-left:130px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.5;color: #002733">استشاري</p>
            <p style="width:350px;font-size: 18px;padding-left:20px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.5;color: #002733">جراحة مناظير المفاصل و الاصابات الرياضية</p>
            <img src="{{ asset('images/logo.jpg') }}" alt="" style="height: 90px;border: 1px solid #baa945;padding:20px;margin-left: 90px;border-radius: 300px;margin-top: -10px;color: #002733">
            <p style="width:240px;font-size: 18px;padding-left:50px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">الزمالة الملكية البريطانية في الجراحة</p>
            <p style="width:300px;font-size: 18px;padding-left:30px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">البورد العربي في جراحة العظام و المفاصل</p>
            <p style="width:130px;font-size: 18px;padding-left:100px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">المستشفى الاهلي</p>
            <p style="width:240px;font-size: 18px;padding-left:55px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">ومستشفى الميزان التخصصي حاليا</p>
            <p style="width:130px;font-size: 18px;padding-left:100px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">مستشفى المقاصد</p>
            <p style="width:300px;font-size: 18px;padding-left:40px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">مستشفى حمد الطبي الدولي / قطر سابقا</p>
            <div style="">
                <h1 style="width: 50px;border: none;line-height: 0.3;color: #002733">Dr.</h1>
                <p style="width:200px;font-size: 25px;padding-left:50px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.1;color: #002733">Nidal A.Al.Shwaiki</p>
                <p style="width:400px;font-size: 16px;padding-left:10px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">Consultant Orthopedic Surgeon Arab Board</p>
                <p style="width:300px;font-size: 18px;padding-left:35px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">(M.B.Ch.B / ABCOS / MRCS)</p>
                <p style="width:300px;font-size: 15px;padding-left:15px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">الخليل-عمارة الهدى-بجانب التربية و التعليم-الطابق الاول</p>
                <p style="width:300px;font-size: 15px;padding-left:40px; 'Cairo', sans-serif;font-weight: 500;line-height: 0.3;color: #002733">هاتف:02 2224070 |جوال:0599 369944</p>

            </div>
        </div>
        <div class="content1">

        </div>
        <div class="contentimg"></div>
        <div class="content2"></div>
        <div class="contentfooter"></div>


        </div>
    </div>

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
