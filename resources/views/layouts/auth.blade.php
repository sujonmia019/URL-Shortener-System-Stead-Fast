<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        /* checkbox */
        .form-checkbox input {
            padding: 0;
            height: initial;
            width: initial;
            margin-bottom: 0;
            display: none;
            cursor: pointer;
        }

        .form-checkbox label {
            position: relative;
            cursor: pointer;
        }

        .form-checkbox label:before {
            content:'';
            -webkit-appearance: none;
            background-color: transparent;
            border: 1px solid #cbcbcb;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
            padding: 6px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
            cursor: pointer;
            margin-right: 5px;
        }

        .form-checkbox input:checked + label:after {
            content: '';
            display: block;
            position: absolute;
            top: 4px;
            left: 5px;
            width: 6px;
            height: 12px;
            border: solid #3c8dbc;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .pass-text{
            background: rgb(15 239 218 / 52%);
            display: block;
            padding: 2px 5px;
            font-size: 13px;
            color: rgb(5 106 97);
            font-weight: 500;
        }
        .text-danger {
            color: #ff1612 !important;
        }
        .login-logo{
            margin-bottom: 10px !important;
        }
    </style>
</head>

<body class="hold-transition login-page">

    @yield('content')

    <!-- jQuery 3 -->
    <script src="js/jquery.min.js"></script>
    {{-- Toastr --}}
    <script class="script" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="js/bootstrap.min.js"></script>

    <script>
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
        });
    </script>
</body>

</html>
