    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap/js/popper.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
        <script src="/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
        $('#table').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "sInfo": "عرض _PAGE_ من _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "ابحث...",
               "sLengthMenu": "نتائج  :  _MENU_",
            },
            "stripeClasses": [],
            "aaSorting": [],
            "lengthMenu": [ 10, 20, 50],
            "pageLength": 10 ,
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.12.0/i18n/ar.json"
            }
        } );
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

    @section('js')
    @show

    <!-- @if(app()->getLocale() == "ar")
        <script>
            var isOpen = false
            $(".sidebarCollapseCustom").click(function () {
                if(isOpen) {
                    $(".sidebar-wrapper").animate({"right" : "-100%"}, 500)
                    // $("#content").animate({"margin-right" : "0px"}, 500)
                    isOpen = false
                }else {
                    $(".sidebar-wrapper").animate({"right" : "16px"}, 500)
                    // $("#content").animate({"margin-right" : "212px"}, 500)
                    isOpen = true
                }
            })
        </script>
    @else

    @endif -->

</body>
</html>