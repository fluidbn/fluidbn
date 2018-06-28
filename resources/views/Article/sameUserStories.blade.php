@extends('layouts.main')
@section('title')
{{ucfirst($user->fname)."'s Stories"}} | fluidbN

@endsection

@section('content')

<div class="container">
                     <div class="lower-margin">
                     <h2 class="featurette-heading"> All stories from {{ucfirst($user->fname).' '.ucfirst($user->lname)}}</h2>
                     </div>
                  
                       
                      @if(count($stories)>0)
                     
                      <div class="box">

                        <div class="row featurette">
                            @foreach ( $stories as $ra )
                           
                              <div class="col-lg-4">
                              <a href="{{route('show-article',['article'=>$ra,'slug'=>str_slug($ra->title)])}}">
                                <div class="card-related">
                                  <img class="featurette-image img-fluid mx-auto img-card" src="/storage/article_images/{{$ra->title_image}}" alt="">
                                  <div class="container-related lower-margin">
                                    <h2  class="featurette-heading-small">{{ucfirst($ra->title)}}</h2>
                                   
                                    <p class="lead">{!!wordwrap(str_limit($ra->content,150),150,"<br>\n",TRUE)!!}</p> @if($ra->views>0)<small class="views"> {{ '   '.$ra->views.' views'}}</small>@endif
                                 
                                </div>
                                </div>
                                </a>
                               
                                  <br/>
                                  
                                  
                           </div>
                        
                        
                            @endforeach
                        
                            
                              </div>
         @elseif(Auth::user()->id == $user->id)
      
              <h2 class="">{{ucfirst($user->fname).' looks like you haven\'t created any article or a story...'}} <a href="{{route('write')}}">Create one !</a></h2>
         @else        
         <h2 class="">{{'Sorry no articles from '.ucfirst($user->fname).' but sure to come till then...'}}<a href="{{route('feed')}}">Explore fluidbN !</a></h2>

                      </div>
           @endif
               


</div>


@endsection