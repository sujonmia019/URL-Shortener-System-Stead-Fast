<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('site_title') | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/') }}css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('/') }}css/_all-skins.min.css">
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- Datatable --}}
    <link href="{{ asset('/') }}css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css">
    {{-- daterangepicker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('/') }}css/custom.css">
    <style>
        .alert-success {
            color: #0f5132 !important;
            background-color: #d1e7dd !important;
            border-color: #badbcc !important;
        }
        .alert-warning {
            color: #664d03 !important;
            background-color: #fff3cd !important;
            border-color: #ffecb5 !important;
        }
    </style>
    @stack('style')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        {{-- header start --}}
        @include('include.header')
        {{-- header end --}}

        <!-- Left side column. contains the sidebar -->
        @include('include.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>{{ $title }}</h1>
                <ol class="breadcrumb">
                    @isset($breadcrumb)
                        @foreach ($breadcrumb as $title=>$url)
                            <li class="{{ $loop->last ? 'active' : '' }}">@if($loop->last){{ $title }}@else <a href="{{ $url }}">{{ $title }}</a>@endif</li>
                        @endforeach
                    @endisset
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                @if (session('success'))
                <div class="alert alert-success py-3"><strong>Success:</strong> {{ session('success') }}</div>
                @elseif (session('warning'))
                <div class="alert alert-warning py-3"><strong>Success:</strong> {{ session('warning') }}</div>
                @endif

                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        {{-- footer start --}}
        @include('include.footer')
        {{-- footer end --}}

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('/') }}js/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('/') }}js/fastclick.js"></script>
    <script class="script" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Select-2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Toastr --}}
    <script class="script" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    {{-- Daterange --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script class="script" type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    {{-- Datatables --}}
    <script class="script" src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script class="script" src="{{ asset('/') }}js/dataTables.bootstrap.min.js"></script>
    <script class="script" src="https://cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.min.js"></script>
    <script class="script" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}js/demo.js"></script>
    <script>
        // ajax header setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // token
        var _token = "{{ csrf_token() }}";
        var table;

        // toastr alert message
        function notification(status, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            switch (status) {
                case 'success':
                    toastr.success(message);
                    break;

                case 'error':
                    toastr.error(message);
                    break;

                case 'warning':
                    toastr.warning(message);
                    break;

                case 'info':
                    toastr.info(message);
                    break;
            }
        }

        // select2
        $('.multi-select2').select2({
            placeholder: 'Select an option'
        });

        $('.select2').select2()
        $('.select2-hide').select2({
            minimumResultsForSearch: -1
        });

        // tooltip
        $(function () {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        });

        // reset filter
        $(document).on('click','.reset-btn',function(){
            $('#filter-row input').val('');
            $('.select2-hide').val(null).trigger('change');
            $('.select2').val(null).trigger('change');
            table.ajax.reload();
        });

        $(document).ready(function () {
            // session flash message
            @if(Session::get('success'))
            notification('success', "{{ Session::get('success') }}")
            @elseif(Session::get('error'))
            notification('error', "{{ Session::get('error') }}")
            @elseif(Session::get('info'))
            notification('info', "{{ Session::get('info') }}")
            @elseif(Session::get('warning'))
            notification('warning', "{{ Session::get('warning') }}")
            @endif

            // datatable reload
            $(document).on('click', 'button.table-reload', function () {
                table.ajax.reload();
            });

            // reset btn
            $(document).on('click', '.reset_btn', function () {
                $('form#store_or_update_form').find('.schedule-error').remove();
                $('#store_or_update_form select').selectpicker('val', '');
                $('form#store_or_update_form')[0].reset();
            });

            // search table
            $(document).on('keyup keypress', 'input[name="search_here"]', function () {
                table.ajax.reload();
            });
        });

        $(document).on('click','.already-assign',function(){
            notification('error','This appointment assigned');
        });
    </script>

    @stack('scripts')
</body>

</html>
