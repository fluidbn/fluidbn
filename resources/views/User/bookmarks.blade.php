@extends('layouts.main')
@section('title')
{{ucfirst(Auth::user()->fname).'\'s bookmarks | fluidbN'}}
@endsection

@section('content')
@if(count($user_bookmarks)>0)
<div class="box">
@php
$c = Auth::user()->bookmarks()->wherePivot('user_id',Auth::user()->id)->count();
@endphp

<div class="nobook">
  <h2 class="featurette-heading-title" id="nobookmark"></h2>
  <h4 class="writer"><a href="{{route('feed')}}" id="readnow"></a></h4>
</div>

<div class="row featurette" id="bookmark-row" data-count="{{$c}}">
    
  @foreach ( $user_bookmarks as $ra )
 
   <div class="col-lg-4 bookmarked">
       
        <a href="{{route('stories-genre',['genre'=>$ra->ofGenre])}}" <small class="genre-feed">{{ucfirst($ra->ofGenre->name)}}</small></a>
                  
        <a href="{{route('show-article',['article'=>$ra,'slug'=>str_slug($ra->title)])}}">
        <div class="card-related">
          <img class="featurette-image img-fluid mx-auto img-card" src="/storage/article_images/{{$ra->title_image}}" alt="">
          <div class="container-related lower-margin">
            <h2  class="featurette-heading-small">{{ucfirst($ra->title)}}</h2>
           
            <p class="lead">{!!wordwrap(str_limit($ra->content,150),150,"<br>\n",TRUE)!!}</p> @if($ra->views>0)<small class="views"> {{ '   '.$ra->views.' views'}}</small>@endif
            <div class="" style="margin-bottom:5px;">
                <img class="featurette-image img-fluid mx-auto  propic-small" src="/storage/profile_images/{{$ra->writtenBy->hasProfile->profile_image}}" alt=""> <small class="writer-small"><a href="{{route('profile',['user'=>$ra->writtenBy,'slug'=>str_slug($ra->writtenBy->fname." ".$ra->writtenBy->lname)])}}">{{ucfirst($ra->writtenBy->fname).' '. ucfirst($ra->writtenBy->lname)}}</a></small><div class=""><small class="margin writer-small">{{$ra->writtenBy->hasProfile->about }}</small></div>
                
              </div>
             <div class="" style="margin-bottom:5px;">
              <button class="btn btn-outline-success userbookmark" id="{{$ra->id}}" data-articleId="{{$ra->id}}">Remove from bookmarks</button>
             </div>
            </div>
        </div>
        </a>
       
          <br/>
          
          
   </div>

    @endforeach

  </div>

@else
<div class="box" style="margin-top:22%;">
    <h2 class="featurette-heading-title">{{'You haven\'t bookmarked anything '.ucfirst(Auth::user()->fname).' !'}}</h2>
    <i class="material-icons" style="font-size:48px;color:red;">cloud</i>
    <i class="fa fa-cloud"></i>
    
</div>
<div class="box">
  <a href="{{route('feed')}}" class="writer">Read now ! <i class="fa fa-book" style="font-size:48px;color:#0c4c8a;"></i></a>

</div>
</div>
  @endif
 <script>
   @include('includes.buttons')
 </script>
@endsection