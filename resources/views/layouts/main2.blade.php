
        <!DOCTYPE html>
        <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<!-- Styles -->

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Custom styles -->
<link href="{{asset('css/carousel.css')}}" rel="stylesheet">
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<link href="{{ asset('css/navbar-top.css') }}" rel="stylesheet">
            <title>@yield('title')</title>
        
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            <script src="{{ asset('js/functions.js') }}" defer></script>
        

            <!-- Fonts -->
            <link rel="dns-prefetch" href=":https//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

      
        </head>
    <body>

    
    <div class="container">
        <div class="row featurette">
     <div class="col-lg-4">
     @include('includes.flashmsg')
     </div>
     </div>
    </div>
        @yield('content')
         
           

    
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
      

         <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.jscroll.min.js') }}" defer></script>
        <script src="{{ asset('js/functions.js') }}" defer></script>
       
        <script>
        
                CKEDITOR.replace('content');
              //  CKEDITOR.inline( 'content' );
               // $('#content').ckeditor();
                // $('.textarea').ckeditor(); // if class is prefered.
                @include('includes.buttons')
                </script>
        
    </body>
</html>
