@extends('layouts.main')
@section('title')
{{ucfirst($genre->name). ' stories'}} | fluidbN

@endsection

@section('content')

<div class="container">
                     <div class="lower-margin">
                     <h2 class="featurette-heading"> All stories in {{ucfirst($genre->name)}}</h2>
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
                                    <div class="">
                                        <img class="featurette-image img-fluid mx-auto  propic-small" src="/storage/profile_images/{{$ra->writtenBy->hasProfile->profile_image}}" alt=""> <small class="writer-small"><a href="{{route('profile',['user'=>$ra->writtenBy,'slug'=>str_slug($ra->writtenBy->fname." ".$ra->writtenBy->lname)])}}">{{ucfirst($ra->writtenBy->fname).' '. ucfirst($ra->writtenBy->lname)}}</a></small><div class=""><small class="margin writer-small">{{$ra->writtenBy->hasProfile->about }}</small></div>
                                         </div>  
                                </div>
                                </div>
                                </a>
                               
                                  <br/>
                                  
                                  
                           </div>
                        
                        
                            @endforeach
                        
                          </div>
                        
                         @endif
               
</div>


</div>


@endsection