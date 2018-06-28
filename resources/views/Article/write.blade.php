@extends('layouts.main')

@section('title')
Write article | fluidbN
@endsection

@section('content')
<div class="container box">
    
       
<h2 >{{'Come on '.ucfirst(Auth::user()->fname) }}... write an article or a story right here and inspire !</h2>

<div class="row">

    <div class="col-lg-9">
       
        {!! Form::open(['action'=>'Article\ArticleController@store','method'=>'POST','files'=>true,'enctype'=>'multipart/form-data']) !!}  

        <div class="form-group">
               
                 {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title...','id'=>'title','data-emojiable'=>true])}}
                </div>

      
                <div class="form-group">
                                
                                {{Form::select('genre',$selectGenre , null, ['placeholder' => 'Pick a genre...','id'=>'genre'])}}                              
                                
                                    </div>
        
             
                <div class="form-group">

        {{Form::textarea('content','',['id'=>'content','class'=>'form-control','placeholder'=>'Write and show your creativity...'])}}
        </div>
        <div class="form-group">
  
            {{Form::label('title_image','Choose title image',['class'=>'btn btn-outline-success'])}}
            {{Form::file('title_image')}}
           </div> 
           
           
          {{-- <button class="btn btn-outline-success" id="save">Save and continue later !</button> --}} {{Form::submit('Done',['class'=>'btn btn-outline-success right'])}}
           
       
        
            
                
          
       
       
    
         
             
               {!! Form::close() !!}
          
          
          </div>
          
          <div class="col-lg-3 lower-margin">
            <button class="btn btn-outline-success"  onclick="window.open('https://www.canva.com')">Design using Canva</button> 
  
   </div>
          
          <div class="col-lg-2 box">
          <button class="btn btn-outline-success" id="save">Save and continue later !</button>
          </div>
          
        

        </div>
        <div class="row">
            @if(count($unfinished_articles)>0)
            @php
            if(count($unfinished_articles)==1){
               
                    $a = ' an ';
                    $art = ' article';
            }
                else{
                    $a = ' ';
                    $art = ' articles';
                }
               
                @endphp
    
            <div class=" box lower-margin">
            <h2 class="">{{ucfirst(Auth::user()->fname).' looks like you\'ve'.$a.'unfinished'.$art.'.. it\'s great time to finish them !'}}</h2>
            </div>
           
                  
            <div class="col-lg-4" id="unfinished">
                <h2 class="featurette-heading-small title_unfinished"></h2>
                 
               <small class="writer-small date_unfinished"></small> 
               <div class="lower-margin">
                <button  class="btn btn-outline-success complete" id="btn_unfinished" data-articleId =""> Complete me </button>
                        
                    </div>  
       </div>
      
                    @foreach ($unfinished_articles as $ua )
                 <div class="col-lg-4">
                     <h2 class="featurette-heading-small">{{ucfirst($ua->title)}}</h2>
                      
                    <small class="writer-small">Unfinished from {{$ua->created_at->format('d F Y')}}</small> 
                    <div class="lower-margin">
        <button  class="btn btn-outline-success complete" data-articleId ="{{$ua->id}}"> Complete me </button>
                
            </div>  
            </div>
             @endforeach
             
    
    
    
             @endif
            
        </div>
      
      
</div>
<script>
        var token = "{{Session::token()}}";
        var urlSave = "{{route('save')}}";
       
</script>
@endsection

