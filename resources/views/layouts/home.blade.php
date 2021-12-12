<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Telford Dashboard</title>
    <meta name="description" content="Track the spread of the Coronavirus Covid-19 outbreak">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon-96x96.png">

    <link rel="stylesheet" href="assets/css/tachyons.min.css">
    <link rel="stylesheet" href="assets/css/site.css?v=1">
    <link rel="stylesheet" href="/css/app.css?v=1">

    <meta name="theme-color" content="#ffffff">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">

    <!-- Vendor JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
{{--    <script src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />--}}
{{--    <!-- Chart.js -->--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" />--}}
{{--    <!-- Select2 -->--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>--}}

</head>
<body>

    <main id="main">
        @yield('content')
    </main>

    <script src="/js/app.js?timestamp={{time()}}"></script>
</body>
</html>
