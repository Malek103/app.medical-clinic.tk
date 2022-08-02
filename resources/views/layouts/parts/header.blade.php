    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{config('app.name')}}</title>
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico"/>
    <link href="/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="/assets/js/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="/plugins/table/datatable/dt-global_style.css">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/css/plugins.css" rel="stylesheet" type="text/css" />
 
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="/assets/css/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/forms/switches.css">
    <link href="/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0-2/css/all.min.css" integrity="sha512-uNOFYDWi8Y7/BN/9S2QDx/BVTEvSwdrZ53NHLgt+fDTdyQeOwmBpHrLrxOT3TQn78H0QKJWLvD7hsDOZ9Gk45A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css" />
    @if(app()->getLocale() == "en")
    <link href="/assets/css/ltr.css" rel="stylesheet" type="text/css" />

    @endif

    @if(\Cookie::get('darkmode'))
    <link href="/assets/css/dark.css" rel="stylesheet" type="text/css" />
    @endif

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    