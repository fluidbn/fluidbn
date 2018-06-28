@extends('layouts.main')

@section('title')
{{ucfirst($article->title)}} - {{ucfirst($article->writtenBy->fname)}} {{ucfirst($article->writtenBy->lname)}}  | fluidbN
@endsection

@section('content')
<div class="ViewEdit">

</div>

<div class="container">
<div class="row featurette">
   

      <div class="col-lg-7 ">
        
        <div class="box" id="mainView" data-articleid="{{$article->id}}" >
            
        <a href="{{route('profile',['user'=>$article->writtenBy,'slug'=>str_slug($article->writtenBy->fname." ".$article->writtenBy->lname)])}}" <h5 class="writer">{{ucfirst($article->writtenBy->fname)}}
              {{ucfirst($article->writtenBy->lname)}}</a>
          </h5>
          <p id="msg"> </p>
          <div class="col-lg-5 ">
           <img class="featurette-image img-fluid mx-auto  propic" src="/storage/profile_images/{{$article->writtenBy->hasProfile->profile_image}}" alt="">
            </div>

           <button class="btn btn-outline-success margin" id ="fol" data-userid="{{$article->writtenBy->id}}">{{$follow ? "Following" : "Follow"}}</button> <button class="btn btn-outline-success margin like"  data-articleid="{{$article->id}}" type="submit">{{$like ? "Thanks for appreciating !" : "Wow !"}}</button>
          @if (Auth::user()->id==$article->writtenBy->id) 
          
          <button  class="btn btn-outline-success margin"  onclick="location.href='{{route('view-edit',['article'=>$article])}}'">Open in edit view</button> 
    
         @endif
          <h6 class="margin writer">{{$article->writtenBy->hasProfile->about }}</h6>
               <!-- date("d F Y",strtotime($article->created_at)) can also be used-->
           
             
              </div>
      
    </div>
    
</div>

      <div class="row featurette">
         <div class="col-lg-7">
       
        <h2 class="featurette-heading">{{ucfirst($article->title)}}</h2>
        @php
        if($views>1)
        $v = 'views';
        else
        $v = 'view';
        if($wows==0)
        $w = '';
        else if($wows==1)
        $w = '  '.$wows.' wow';
        else
        $w = '  '.$wows.' wows';
        @endphp
        <small class="writer">{{$article->created_at->format('d F Y')}}</small> <small class="views right-wow"> {{ '   '.$views.' '.$v}}</small> <small class="views right-wow" id="wow"> {{$w}}</small>
        <hr class="featurette-divider">
        <blockquote class="blockquote">
        <p>{!!$article->content!!}</p>
       
         
      </blockquote>   
      </div>
        <div class="col-lg-5">
                <div class="lower-margin" style="text-align:center;">
                  <button class="btn btn-outline-success" onclick="location.href='{{route('write')}}'">Write</button>
                </div>
                <div class="frame">
                  
                <img class="featurette-image img-fluid mx-auto img-card-featured" src="/storage/article_images/{{$article->title_image}}" alt="">
                </div>
          
        </div>
        

        
      </div>
   

      <footer>
          <div class="box lower-margin">
          <button class="btn btn-outline-success bookmark"   data-articleId="{{$article->id}}">{{$bookmark ? "You bookmarked it !" : "Bookmark"}}</button>
          </div>
       
         
          @if(count($related_articles)>0)
          <div class="lower-margin">
          <h2 class="featurette-heading">More wonderful stories in {{ucfirst($article->ofGenre->name)}}...!   @if(count($related_articles)==3) <a href="{{route('stories-genre',['genre'=>$article->ofGenre])}}">See all</a>@endif</h2>
          </div>
          <div class="row featurette">
            @foreach ( $related_articles as $ra )
           
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
         
            @if(Auth::user()->id != $article->writtenBy->id)
          @if(count($articles_of_samewriter)>0)
          <div class="lower-margin">
          <h2 class="featurette-heading">More cool stories from {{ucfirst($article->writtenBy->fname)}}...!  @if(count($articles_of_samewriter)==3)<a href="{{route('stories-user',['user'=>$article->writtenBy])}}">See all</a>@endif</h2>
          </div>
          <div class="row featurette">
            @foreach ( $articles_of_samewriter as $ra )
               
            <div class="col-lg-4">
       
              <div class="">
                <a href="{{route('stories-genre',['genre'=>$ra->ofGenre])}}" <small class="genre-feed">{{ucfirst($ra->ofGenre->name)}}</small></a>
              </div>
               
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
          
          @endif
         @endif 

         <div class="">

            {{--comment modal--}}

            {{-- Button to Open the comment modal --}}
            <button  class="btn btn-outline-success"  id="comment"  data-toggle="modal" data-target="#commenton">
           Write a word of appreciation
            </button>
          
            <!-- The Modal -->
            <div class="modal fade" id="commenton">
              <div class="modal-dialog">
                <div class="modal-content">
                
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title writer">{{ucfirst(Auth::user()->fname).' express your words of appreciation to '.ucfirst($article->writtenBy->fname) }} !</h4>
                   
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <!-- Modal body -->
                  <div class="modal-body">
                   
                  {!! Form::open(['route'=>['comment',$article->id],'method'=>'POST']) !!} 
                     
          
                          
                       
                          <div class="form-group">
               
                  {{Form::textarea('comment','',['class'=>'form-control','placeholder'=>'Share your words of appreciation...','id'=>'commentarea'])}}
                  </div>
                 
                  {{Form::submit('Done',['class'=>'btn btn-outline-success','id'=>'commentSubmit'])}}
                  
                         
                       
                         {!! Form::close() !!}
                  </div>
                  
            
                  
                </div>
              </div>
            </div>
            
             {{--comment modal end--}}
       </div>

       {{-- show comments--}}

       <div class="box lower-margin">
        @if(count($comments)>0)
       
        <div class="card-comment">
               <div class="row">
                   <div class="col-lg-5">
                       <div class="container-comment">
                        <img class="featurette-image img-fluid mx-auto  propic-small" src="" alt="" id="user_pic"> <small class="writer-small" id="user"><a href="" id="user_route"></a></small><div class=""><small class="margin writer-small" id="user_abt"></small></div>
                        <p class="writer" id="words"></p>
                           </div> 
                   </div>
                 </div>
                 <div class="infinite">
                 @foreach ($comments as $c)
           <div class="row">
              <div class="col-lg-5">
         
                <div class="container-comment">
                  <img class="featurette-image img-fluid mx-auto  propic-small" src="/storage/profile_images/{{$c->commentedBy->hasProfile->profile_image}}" alt=""> <small class="writer-small"><a href="{{route('profile',['user'=>$c->commentedBy,'slug'=>str_slug($c->commentedBy->fname." ".$c->commentedBy->lname)])}}">{{ucfirst($c->commentedBy->fname).' '. ucfirst($c->commentedBy->lname)}}</a></small><div class=""><small class="margin writer-small">{{$c->commentedBy->hasProfile->about }}</small></div>
            
                  <p class="writer">{{$c->content}}</p>
                  </div> 
               
           
            </div>  
           </div>
           @endforeach
           {{$comments->links()}}
         </div>
         
       </div> 
          @endif
       </div>
        </footer>
    </div>
  

    <script>
        $('ul.pagination').hide();
        $(function() {
            $('.infinite').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/loader_images/image_1212462.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite',
                callback: function() {
                    $('ul.pagination').remove();
                   }
                 });
              });
        @include('includes.buttons') 
      </script> 
  






@endsection


