<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" /> <!-- Add CSRF token -->

    <title>{{ $pageTitle ?? 'Order Management' }}</title>
    <!-- CSS files -->
    <link href="{{ asset('css/tabler.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/tabler-flags.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/tabler-payments.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/tabler-vendors.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/demo.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/chat.css')}}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('static/sonic-icon.svg')}}" type="image/png">

    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
         rel='stylesheet'>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .select2-container .select2-selection--single {
            height: 40px;
            font-size: 16px;
        }
    </style>
</head>
