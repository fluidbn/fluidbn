@extends('layouts.main')
@section('title')
 Searched for {{$search}}
@endsection

@section('content')




   <div class="container ">
      
    <div class="row featurette">
             
 
        @if(count($search_article)>0 ||count($search_user)>0 || count($search_genre)>0) 
       
        @foreach($search_user as $u)
        <div class="col-lg-4 ">
        <div class="box">
            <a href="{{route('profile',['user'=>$u])}}"  <h5 class="writer">{{ucfirst($u->fname)}}
                  {{ucfirst($u->lname)}}</a>
              </h5>
             
               <img class="featurette-image img-fluid mx-auto  propic" src="/storage/profile_images/{{$u->hasProfile->profile_image}}" alt="">
               
              <div class="lower-margin">
              <h6 class="margin writer">{{ucfirst($u->hasProfile->about) }}</h6>
              </div>
          </div>
          </div>
   
    @endforeach
        </div>

        
        
             <div class="row featurette">
       
                   @foreach($search_article as $a)
                   <div class="col-lg-4">
                   <div class="box">
       <a  href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}'"> <h2 class="featurette-heading-small">{{$a->title}}</h2></a>
        <p class="writer-small">{!!wordwrap(str_limit($a->content,200),150,"<br>\n",TRUE)!!}</p>
                   </div>
     
          <div class="polaroid-small lower-margin">
              
              <a href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}"><img class="featurette-image img-fluid mx-auto" src="/storage/article_images/{{$a->title_image}}" alt=""></a>
      </div>
      
        </div>
                   
    
      @endforeach
    </div>
     
    <div class="row featurette">
    @foreach($search_genre as $g)
      <div class="col-lg-4">
      
      @foreach($g->hasArticles as $a)
         
      <div class="box">
       <a  href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}'"> <h2 class="featurette-heading-small">{{$a->title}}</h2></a>
        <p class="writer-small">{!!wordwrap(str_limit($a->content,200),150,"<br>\n",TRUE)!!}</p>
      </div> 
     
          <div class="polaroid-small lower-margin">
              
              <a href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}"><img class="featurette-image img-fluid mx-auto" src="/storage/article_images/{{$a->title_image}}" alt=""></a>
      </div>
      
   
    
    
      @endforeach
      </div>
      @endforeach 
    </div> 
      @else
      <h2 class="featurette-heading">Sorry <strong>{{$search}}</strong> not found</h2> 
      @endif
       </div>
   
 
  

@endsection