@extends('layouts.main')
@section('title')
{{ucfirst($user->fname)."'s Profile"}} | fluidbN

@endsection

@section('content')

      
<div class="container box">
            
        <div class="row featurette">
           
        
              <div class="col-lg-7 ">
                
             
                    
                 <h5 class="homewriter">{{ucfirst($user->fname)}}
                      {{ucfirst($user->lname)}}
                  </h5>
                  <p class="margin writer">{{$user->hasProfile->about }}</p>
         <p class="writer"> @if($user->hasProfile->designation != null){{$user->hasProfile->designation .' @ '. $user->hasProfile->company}} @else Not working yet...!@endif</p>
         @php
         if($followers>1)
         $f= 'followers';
         
         else
         $f = 'follower';
         @endphp
         @if($followers!=0)<small class="views">{{$followers.' '.$f.'  '}} </small>@endif
         
        {{--  @if($user->id != Auth::user()->id)  <button class="btn btn-outline-success" id ="fol" data-userid="{{$user->id}}"> {{ $follow ? "Following" : "Follow"}}</button> @endif --}}
                </div>
              
                
                  <div class="col-lg-5 homepic ">
                   <img class="featurette-image img-fluid mx-auto " src="/storage/profile_images/{{$user->hasProfile->profile_image}}" alt="">
                    </div>
                   
                    
             
                  
                 
                
                      
                      </div>
              </div> 
                  <hr class="featurette-divider">
                  <div class="container">
                  <footer>
                               <div class="row  featurette">
                                 
                                @if(count($article)>0)
                               
                                <div class="row featurette">
                                        @foreach ( $article as $ra )
                                           
                                                  
                                                    <div class="col-lg-4">
                                                        <a  href="{{route('show-article',['article'=>$ra,'slug'=>str_slug($ra->title)])}}"> <h2 class="featurette-heading-small">{{ucfirst($ra->title)}}</h2></a>
                                                        <div class="lower-margin"
                                                        <a href="{{route('stories-genre',['genre'=>$ra->ofGenre])}}" <small class="writer">{{$ra->ofGenre->name}}</small></a>  @if($ra->views>0)<small class="views"> {{ '   '.$ra->views.' views'}}</small>@endif
                                                        </div
                                                       
                                                        <p class="writer-small">{!!wordwrap(str_limit($ra->content,150),150,"<br>\n",TRUE)!!}</p>  
                                                    
                                                   <div class="related_polaroid lower-margin">
                                                  <a href="{{route('show-article',['article'=>$ra,'slug'=>str_slug($ra->title)])}}"><img class="featurette-image img-fluid mx-auto" src="/storage/article_images/{{$ra->title_image}}" alt=""></a>
                                                   </div>
                                                   
                                                     </div>  
                                                  
                                            
                                        @endforeach
                                      
                                        </div>
                   @elseif(Auth::user()->id == $user->id)
                
                        <h2 class="">{{ucfirst($user->fname).' looks like you haven\'t created any article or a story...'}} <a href="{{route('write')}}">Create one !</a></h2>
                   @else        
                   <h2 class="">{{'Sorry no articles from '.ucfirst($user->fname).' but sure to come till then...'}}<a href="{{route('feed')}}">Explore fluidbN !</a></h2>

                 
                     @endif
                         
        </div>
    </footer>
    </div>

<script>
      
 @include('includes.buttons')        
</script>
@endsection