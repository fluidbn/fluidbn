@extends('layouts.main')

@section('title')
Business genre | fluidbN
@endsection
 
@section('content')
<div class="container">
   
  <div class="row box">
   
@foreach ($genre as $g)
@php
$gn = str_replace(" ","-",$g->name);
if(Auth::user())
$exists = Auth::user()->hasGenre()->wherePivot('user_id',Auth::user()->id)->wherePivot('genre_id',$g->id)->first();
if($exists!=NULL){
  $c="card-genre lower-margin genre-selected";
  $v = "newval".$g->id;
}

else{
  $c="card-genre lower-margin";
  $v = "someval";
}

@endphp
    <div class="col-lg-3"  data-genreId="{{$g->id}}">
        <a href="/{{$g->name}}" class="chooseGenre" data-genreId="{{$g->id}}" data-name="{{$gn}}">

          <div class="{{$c}}" id="{{$gn}}" data-val="{{$v}}">
          <img class="featurette-image img-fluid mx-auto img-card" src="/storage/genere/{{$g->image}}" alt="">
          <div class="container-genre">
          <h2 class="writer" style="text-align:center;">{{ucfirst($g->name)}}</h2>
      </div>
        </div>
     
        </a>
    </div>
@endforeach

  </div>
<div class="">
  <button class="btn btn-outline-success" id="nextPage">Save and continue</button>
</div>
</div>
<script>
    var token = "{{Session::token()}}";
   
    var urlGenre = "{{route('store-genre')}}";
    var urlCreateProfile = "{{route('NewProfile')}}";
    var urlGenreRem = "{{route('rem-genre')}}";
</script>
@endsection