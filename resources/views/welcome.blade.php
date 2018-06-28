<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>fluidbN</title>

        <!-- Fonts -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{asset('css/welcome.css')}}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/feed') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
             
                <div class="title m-b-lg">
                    fluidbN
                </div>

                <div class="links">
                
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <!-- FOOTER -->
        <footer class="container">
          <p class="float-right"><a href="#">Back to top</a></p>
          <p>&copy; @php echo date('Y');@endphp fluidbN &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </body>
</html>
