
        <!DOCTYPE html>
        <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <meta name="description" content="">
    <meta name="author" content="">
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
           
             
        <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/bloodhound.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.2.1/typeahead.jquery.min.js"></script>  
    
       

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g=" crossorigin="anonymous" />

          
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">


<!-- Custom styles -->
<link href="{{asset('css/carousel.css')}}" rel="stylesheet">
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<link href="{{ asset('css/navbar-top.css') }}" rel="stylesheet">
            <title>@yield('title')</title>
        
            <!-- Scripts -->
            <script src="{{asset('js/app.js')}}"></script>
        

            <!-- Fonts -->
            <link rel="dns-prefetch" href=":https//fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
            <style>
                .twitter-typeahead,
                .tt-hint,
                .tt-input,
                .tt-menu{
                    width: auto ! important;
                    font-weight: normal;
                
                }
             </style>
        </head>
    <body class="main-body">
    @include('includes.nav')
    
    <div class="container">
        <div class="row featurette">
     <div class="col-lg-4 box">
     @include('includes.flashmsg')
     </div>
     </div>
    </div>
        @yield('content')
   
           

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js" integrity="sha256-Rnxk6lia2GZLfke2EKwKWPjy0q2wCW66SN1gKCXquK4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.jscroll.min.js') }}" defer></script>
        <script src="{{ asset('js/functions.js') }}" defer></script>
       
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
        
        {{-- Import typeahead.js --}}
       
       
         
        {{-- Initialize typeahead.js on the input --}}
        
        <script>
            $(document).ready(function() {
                var bloodhound = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        url: '/search-item?q=%QUERY%',
                        wildcard: '%QUERY%'
                    },
                });
                
              // init Typeahead
            $('#search').typeahead(
                {
                hint: true, 
                minLength: 3,
                highlight: true
                },
                {
                name: 'articles',
                source:bloodhound,   // suggestion engine is passed as the source
                display: function(data) {        // display: 'name' will also work
                return  data.title;
             
                },
              
                templates: {
                
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.title + '</div></div>'
              
            }
                }
                });
                });
                $(document).ready(function() {
                    var bloodhound = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        remote: {
                            url: '/search-user?q=%QUERY%',
                            wildcard: '%QUERY%'
                        },
                    });
                    
                    $('#search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 3
                    }, {
                        name: 'users',
                        source: bloodhound,
                        display: function(data) {
                            return data.fname +' '+ data.lname  //Input value to be set when you select a suggestion. 
                        },
                        templates: {
                         /*   empty: [
                                '<div class="list-group search-results-dropdown"><div class="list-group-item">No such data found, sorry !.</div></div>'
                            ],*/
                            header: [
                                '<div class="list-group search-results-dropdown">'
                            ],
                            suggestion: function(data) {
                            return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.fname +' '+ data.lname + '</div></div>'
                            }
                        }
                    });
                });

                $(document).ready(function() {
                    var bloodhound = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.whitespace,
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        remote: {
                            url: '/search-genre?q=%QUERY%',
                            wildcard: '%QUERY%'
                        },
                    });
                    
                    $('#search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 3
                    }, {
                        name: 'genre',
                        source: bloodhound,
                        display: function(data) {
                            return data.name  //Input value to be set when you select a suggestion. 
                        },
                        templates: {
                          
                            header: [
                                '<div class="list-group search-results-dropdown">'
                            ],
                            suggestion: function(data) {
                            return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.name +'</div></div>'
                            }
                        }
                    });
                });
        </script>
        <script>
                CKEDITOR.replace('content');
              //  CKEDITOR.inline( 'content' );
               // $('#content').ckeditor();
                // $('.textarea').ckeditor(); // if class is prefered.
                @include('includes.buttons')
                </script>
    </body>
</html>
