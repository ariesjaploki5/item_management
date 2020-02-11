
<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../img/bghmc.png" type="image/png">
        <title>PMIS (MMO) | BGHMC</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css?1') }}">
        
    </head>
    <body class="hold-transition sidebar-mini">
        <div id="app">
            <master></master>
        </div>
        <script src="{{ asset('js/app.js?1')}}"></script>
    </body>
</html>
 