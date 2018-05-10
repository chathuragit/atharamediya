<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($Page) && ($Page->page_title != '')) ? $Page->page_title : config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->

    <!-- Daterange picker -->

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    @if(Request::segment(1) == 'banners')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @endif

    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jscolor.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    @yield('page_CSS')

    @if(Request::segment(1) == 'banners')
    <script>
        $( function() {
            $(".datepickerAtharamediya").datepicker({dateFormat: 'yy-mm-dd'});
        } );
    </script>
    @endif
    <!-- Google Font -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('includes.main_header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('includes.main_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('includes.main_footer')

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->


<!-- datepicker -->

<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

@yield('page_JS')
<script>

    $(document).ready(function() {
        $('.selectpicker').select2();


    });

    function setTextColor(picker) {
        document.getElementsByTagName('body')[0].style.color = '#' + picker.toString()
    }
    $(function() {
        if($('.box-tools:first form').attr('action') == undefined){
            $('.sidebar-form input[name=search]').attr('disabled','disabled');
            $('.sidebar-form button.search_btn').attr('disabled','disabled');
        }
        else{
            $('.sidebar-form').attr('action', $('.box-tools:first form').attr('action'));
        }

        $('.toggle-event').change(function() {
            var record_id = $(this).attr('data-id');
            var state = $(this).prop('checked');

            $.ajax({
                url : "{{url('/'.Request::segment(1).'/')}}/change_status",
                type: 'POST',
                data : { id : record_id, '_token': $('meta[name="csrf-token"]').attr('content'), active : state},
                success: function(data)
                {
                    //window.location.reload();
                },
                beforeSend : function(){
                }
            });
        })
    })

    $('.trash').click(function(e){
        var id = $(this).attr('data-id');

        $('.proceed-delete').click(function(e){
            $.ajax({
                url : "{{url('/'.Request::segment(1).'/')}}/"+ id,
                type: 'DELETE',
                data : { id : id, '_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(data)
                {
                    window.location.reload();
                },
                beforeSend : function(){
                    $('#modalDelete').modal('hide');
                }
            });
        });

    });

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready( function() {
        $(':file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        });

        $('#select_all_cards').on('ifChanged', function(event) {
            $('input.batch_merchants').iCheck('toggle');
            $('#unselect_all_cards').iCheck('uncheck');
        });

        $('#unselect_all_cards').on('ifChanged', function(event) {
            $('input.batch_merchants').iCheck('uncheck');
            $('#select_all_cards').iCheck('uncheck');
        });
    });
</script>
</body>
</html>
