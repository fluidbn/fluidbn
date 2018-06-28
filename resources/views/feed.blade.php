@extends('layouts.main')
@section('title')
{{ucfirst(Auth::user()->fname)}}'s feed | fluidbN
@endsection

'
@section('content')


<main role="main">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
              <div class="container">
                <div class="carousel-caption text-left">
                  <h1>Example headline.</h1>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                  <p><button class="btn btn-outline-primary" onclick="location.href='{{route('feed')}}'" >Sign up today</button></p>
                </div>
              </div>
            </div>
            
           
          </div>
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
         
  
        <!-- Marketing messaging and featurettes and writing articles
        ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->
  
        <div class="container"  >
            <div class="row">
                <div class="col-lg-4">   
            <!-- Button to write -->
  <div class="lower-margin">
    <button  class="btn btn-outline-success btn-feed"  onclick="location.href='{{route('write')}}'">
      Create an article or a story
    </button>
  </div>
 
</div> 



            </div>
</div>



<div class="container">
           
        
                             
    @if(count($user_genre)>0)
   <div class="lower-margin box">
    <h2 class="featurette-heading-title">Based on your interest</h2>
   </div>
    <hr>
  
    <div class="row box">
   
        @foreach ($user_genre as $g)
      
            <div class="col-lg-3">
                <a href="{{route('stories-genre',['genre'=>$g])}}">
        
                  <div class="card-genre lower-margin">
                  <img class="featurette-image img-fluid mx-auto img-card" src="/storage/genere/{{$g->image}}" alt="">
                  <div class="container-genre">
                {{--  <h2 class="writer" style="text-align:center;">{{ucfirst($g->name)}}</h2>--}}
              </div>
                </div>
             
                </a>
            </div>
        @endforeach
        
          </div>


@endif
</div>


<div class="container">

@foreach( $user_genre as $g)

@foreach($g->hasArticles()->orderBy('id','desc')->limit(2)->get() as $a)

     <div class="box">
        <div class="row  featurette">
        <div class="col-lg-8">
            @php
            if($a->views==1)
            $v = '  '.$a->views.' view';
            else if($a->views>1)
            $v = '  '.$a->views.' views';
            else if($a->views==0)
            $v = '';
            $wows = $a->likedBy()->wherePivot('article_id',$a->id)->count();
            if($wows==0)
            $w = '';
            else if($wows==1)
            $w = '  '.$wows.' wow';
            else
            $w = '  '.$wows.' wows';
            @endphp
            <a href="{{route('stories-genre',['genre'=>$a->ofGenre])}}" <small class="genre-feed">{{ucfirst($a->ofGenre->name)}}</small></a>
              <a  href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}"> <h2 class="featurette-heading-feed">{{ucfirst($a->title)}}</h2></a>
              <small class="views">{{$v}}</small> <small class="views right-wow">{{$w}}</small>
              <br/>
              <img class="featurette-image img-fluid mx-auto  propic-small" src="/storage/profile_images/{{$a->writtenBy->hasProfile->profile_image}}" alt=""> <small class="writer-small"><a href="{{route('profile',['user'=>$a->writtenBy,'slug'=>str_slug($a->writtenBy->fname." ".$a->writtenBy->lname)])}}">{{ucfirst($a->writtenBy->fname).' '. ucfirst($a->writtenBy->lname)}}</a></small><div class=""><small class="margin writer-small">{{$a->writtenBy->hasProfile->about }}</small></div>
            
              <p class="lead">{!!wordwrap(str_limit($a->content,200),150,"<br>\n",TRUE)!!}</p>  
          </div>

          <div class="col-lg-3">
         <div class="polaroid lower-margin upper">
        <a href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}"><img class="featurette-image img-fluid mx-auto" src="/storage/article_images/{{$a->title_image}}" alt=""></a>
           </div>
          </div>
  
  </div> 
</div>

@endforeach

@endforeach  

</div>
<div class="container">

    <!-- START THE FEATURETTES -->

  

  
        <div class="box lower-margin">
          <h2 class="featurette-heading-title">Featured articles</h2>  
         </div>
      
      
                    
            <div class="infinite-scroll">
              <div class="row featurette">
               @foreach($article as $a)

               @php
               if($a->views==1)
               $v = '  '.$a->views.' view';
               else if($a->views>1)
               $v = '  '.$a->views.' views';
                else if($a->views==0)
                $v = '';
           @endphp
                
                  <div class="col-lg-4">
                    <a href="{{route('stories-genre',['genre'=>$a->ofGenre])}}" <small class="genre-feed">{{ucfirst($a->ofGenre->name)}}</small></a>
                    <div class="card-related lower-margin">
                        <a href="{{route('show-article',['article'=>$a,'slug'=>str_slug($a->title)])}}">
                      <img class="featurette-image img-fluid mx-auto img-card" src="/storage/article_images/{{$a->title_image}}" alt="">
                    </a>
                      <div class="container-related">
                        <h2 class="featurette-heading-feed">{{ucfirst($a->title)}}</h2>
                         @php
                          $wows = $a->likedBy()->wherePivot('article_id',$a->id)->count();
                          if($wows==0)
                          $w = '';
                          else if($wows==1)
                          $w = '  '.$wows.' wow';
                          else
                          $w = '  '.$wows.' wows';
                          
                          $bookmark = Auth::user()->bookmarks()->wherePivot('user_id',Auth::user()->id)->wherePivot('article_id', $a->id)->first();
                       @endphp
                        <p class="lead">{!!wordwrap(str_limit($a->content,200),150,"<br>\n",TRUE)!!}</p>
                        <div class="" style="margin-botton:5px;">
                       <img class="featurette-image img-fluid mx-auto  propic-small" src="/storage/profile_images/{{$a->writtenBy->hasProfile->profile_image}}" alt=""> <small class="writer-small"><a href="{{route('profile',['user'=>$a->writtenBy,'slug'=>str_slug($a->writtenBy->fname." ".$a->writtenBy->lname)])}}">{{ucfirst($a->writtenBy->fname).' '. ucfirst($a->writtenBy->lname)}}</a></small><div class=""><small class="margin writer-small">{{$a->writtenBy->hasProfile->about }}</small></div>
                       <button class="btn btn-outline-success feed" id="{{$a->id}}" data-articleId="{{$a->id}}">{{$bookmark ? "Bookmarked !" : "Bookmark"}}</button>
                      </div>
                       
                        
                        
                        @if($a->views>0)<small class="views right"> {{$v}}</small>@endif  <small class="views right-wow">{{$w}}</small>

                     {{--  @php  $like = $user->likes()->wherePivot('user_id', $user->id)->wherePivot('article_id',$a->id)->first();
                       @endphp
                       <button class="btn btn-outline-success margin like"  data-articleid="{{$a->id}}" type="submit">{{$like ? "Thanks for appreciating !" : "Wow !"}}</button>
                       --}}
                      </div>
                    
                    </div>
                    
                       
                </div>
       
    
             
         
  @endforeach
                   
                       
</div>
  {{$article->links()}}

</div>
</div>
 {{-- <div class="noData">
    <h1></h1>
  </div>
</div>--}}


{{--<hr class="featurette-divider">--}}


<!-- /END THE FEATURETTES -->







       <!-- Feed from authors user follow-->


            



               <!--End of followed author feed-->


             

      </main>
  <script>
      $('ul.pagination').hide();
      $(function() {
          $('.infinite-scroll').jscroll({
              autoTrigger: true,
              loadingHtml: '<img class="center-block" src="/loader_images/image_1212462.gif" alt="Loading..." />',
              padding: 0,
              nextSelector: '.pagination li.active + li a',
              contentSelector: 'div.infinite-scroll',
              callback: function() {
                  $('ul.pagination').remove();
              }
          });
      });
      var token = "{{Session::token()}}";
      var urlBookmark = "{{route('bookmark')}}";
      var urlUnmark = "{{route('unmark')}}";
  </script> 

@endsection
