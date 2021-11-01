<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="axios-url" content="{{ url('/') }}" />
    <title>Nano Incub</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="{{ asset('js/priceformat.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
</head>

<body id="app" class="blue-grey lighten-5">

    @include('templates.header')

    <main id="container">
        @yield('conteudo')
    </main>

    @include('templates.footer')

    @if (session('sucesso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.toast({
                    html: "{{ session('sucesso') }}",
                    classes: 'rounded green accent-4',
                    displayLength: 10000
                });
            });
        </script>
    @endif

    @if (session('erro'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.toast({
                    html: "{{ session('erro') }}",
                    classes: 'rounded red accent-4',
                    displayLength: 10000
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                M.toast({
                    html: 'Ocorreu um erro ao realizar esta operação!',
                    classes: 'rounded red accent-4',
                    displayLength: 10000
                });
            });
        </script>
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('select').formSelect();
            $('.tooltip').tooltip();
            $('.sidenav').sidenav();
        });
    </script>

    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
