

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap Link:https://getbootstrap.com/docs/5.2/getting-started/introduction/ --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- Ajax Datatable link:https://cdn.datatables.net/ , https://datatables.net/examples/non_jquery/dt_events.html --}}
    {{-- Tampilan Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    {{--  --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
    {{-- Pencet Yang Example Terus Data Source klik html (DOM) --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    {{-- Bootsratp Icon Link:https://icons.getbootstrap.com/ --}}
    {{-- Nampilin Logo --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Dependent Dropdown</title>
</head>

<body>

    @yield('content')

    {{-- sweetalert2 Link:https://sweetalert2.github.io/ --}}
    {{-- Nampilin SweetAlert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Bootstrap Link:https://getbootstrap.com/docs/5.2/getting-started/introduction/ --}}
    {{-- Tampilan Modal --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    {{-- Ajax Datatable CDN Link:https://cdn.datatables.net/ --}}
    {{-- Pencet Yang Example Terus Data Source klik html (DOM) --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    @stack('javascript-internal')

</body>

</html>

