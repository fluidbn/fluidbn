<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Article;
use App\User;
use App\Genre;

use Auth;
use Session;
use App\ArticleImage;
use App\Comments;
use Image;
class ArticleController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=NULL)
    {
        $genres = Genre::all();
        $selectGenre=[];
        foreach($genres as $g){
            $selectGenre[$g->id] = $g->name;
        }
         Session::put('selectGenre',$selectGenre);
 
                $unfinished_articles = Article::where('user_id',Auth::user()->id)->where('finished',0)->orderBy('id','desc')->get();
                
                
                    return view('Article.write')->with('selectGenre',$selectGenre)->with('unfinished_articles',$unfinished_articles);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request,[
            'title'=>'required|max:80',
             'genre'=>'required',
             'title_image'=>'image|mimes:jpeg,png,jpg,gif,svg',
            'content'=>'required'
            ]);
  
           if($request->hasFile('title_image')){
            $originalImage= $request->file('title_image');
           $thumbnailImage = Image::make($originalImage);
            $Path = public_path('storage').'/article_images/';
           
            $thumbnailImage->resize(600,350);
            $thumbnailImage->save($Path.time().$originalImage->getClientOriginalName()); 
            $imageName = time().$originalImage->getClientOriginalName();
            
           }
           else{
            $imageName = 'defaultWindowpic.png';
           }
           
         
          /*  if($request->hasFile('title_image')){
           
                $image = $request->file('title_image');
                $filenameWithExt = $image->getClientOriginalName();
              
                $file = pathinfo( $filenameWithExt,PATHINFO_FILENAME);
               
                $extention = $image->getClientOriginalExtension();
                $imageName = $file.'_'.time().'.'.$extention;
        
                $image->storeAs('/public/article_images',$imageName);
        
              
               
            }
            else{
                $imageName = 'defaultWindowpic.png';
                
            }*/

            $user = Auth::user();
            $title = $request->input('title');
            $alreadyArticle = Article::where('user_id',$user->id)->where('title',$title)->where('finished',0)->first();
            if( $alreadyArticle){
                
                $alreadyArticle->title = $request->input('title');
                $alreadyArticle->content = $request->input('content');
                $alreadyArticle->title_image =  $imageName;
                $alreadyArticle->user_id = $user->id;
                $alreadyArticle->genre_id = $request->input('genre');
                $alreadyArticle->finished =1;
                $alreadyArticle->save();
                return redirect()->route('show-article',['article'=>$alreadyArticle,'slug'=>str_slug($alreadyArticle->title)])->with('success',ucfirst($user->fname).' your story is successfully posted !');
                
            }
            else{ 

                $article = New Article;
                $article->title = $request->input('title');
                $article->content = $request->input('content');
                $article->title_image =  $imageName;
                $article->user_id = $user->id;
                $article->genre_id = $request->input('genre');
                $article->finished =1;
                $article->save();
     
                 return redirect()->route('show-article',['article'=>$article,'slug'=>str_slug($article->title)])->with('success',ucfirst($user->fname).' your story is successfully posted !');
            }
        
        }
        public function save(Request $request){

            $user = Auth::user();   
            $article_already = Article::where('title',$request['title'])->where('user_id',$user->id)->where('finished',0)->first();
            
              
          
             if( $article_already){
                $article_already->title = $request['title'];
                $article_already->content = $request['content'];
                $article_already->genre_id = $request['genre'];
                $article_already->user_id = $user->id;
                $article_already->finished =0;
               // $article_already->title_image = $fileNameToStore; 
           
                $article_already->save();
               // $date_creation = $article_already->created_at->format('d F Y');
                $data = [
                    'article_title'=>ucfirst($article_already->title),
                    'article_date'=>'Unfinished from '.$article_already->created_at->format('d F Y'),
                    'article_id'=>$article_already->id,
                    'message'=>'Successfully saved !'
                ];
            }
            else{
                $article = New Article;
                $article->title = $request['title'];
                $article->content = $request['content'];
                $article->genre_id =$request['genre'];
                $article->user_id = $user->id;
                $article->finished =0;
               // $article->title_image = $fileNameToStore; 
    
                $article->save();
               // $date_creation = $article->created_at->format('d F Y');
                $data = [
                    'article_title'=>ucfirst($article->title),
                    'article_date'=>'Unfinished from '.$article->created_at->format('d F Y'),
                    'article_id'=>$article->id,
                    'message'=>'Successfully saved !'
                ];
            }
            return response()->json($data);
          }
         
    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article,$slug)
    {
      
       $user = Auth::user();
       $otheruserId = $article->writtenBy->id;
       $articleImages = $article->hasImages;
       $like = $user->likes()->wherePivot('user_id', $user->id)->wherePivot('article_id',$article->id)->first();
     
       $wows  = $article->likedBy()->wherePivot('article_id', $article->id)->count();
       $follow = $user->follows()->wherePivot('follower_id',$user->id)->wherePivot('following_id',$otheruserId)->first();
      
       $bookmark = $user->bookmarks()->wherePivot('user_id',$user->id)->wherePivot('article_id', $article->id)->first();
      
       $related_articles = Article::where('genre_id',$article->genre_id)->where('id','!=',$article->id)->limit(3)->get();
       $articles_of_samewriter = Article::where('user_id',$article->writtenBy->id)->where('id','!=',$article->id)->limit(3)->get();
        // again consider view table
         $user->views()->attach($article);

         $views = $article->viewedBy()->wherePivot('article_id',$article->id)->count();
         
         $a = Article::find($article->id);
         $a->views = $views;
         $a->save();
         // select genre dropdown
         $genres = Genre::all();
         $selectGenre=[];
          foreach($genres as $g){
             $selectGenre[$g->id] = $g->name;
         }
        
        $comments = Comments::where('article_id',$article->id)->latest()->paginate(5);
         $data = [
            'article'=>$article,
            'like'=>$like,
            'follow'=>$follow,
            'bookmark'=>$bookmark,
            'views'=>$views,
            'related_articles'=>$related_articles,
            'articles_of_samewriter'=>$articles_of_samewriter,
            'selectGenre'=>$selectGenre,
            'wows'=>$wows,
            'user'=>$user,
            'comments'=>$comments,
            'articleImages'=>$articleImages 
          
        ];
         
        return view('Article.show_article')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        
          // Handle file request
          if($request->hasFile('file')){
           
            $image = $request->file('file');
        $thumbnailImage = Image::make($image);
        $Path = public_path('storage').'/article_images/';
        $thumbnailImage->resize(600,350);
        $thumbnailImage->save($Path.time().$image->getClientOriginalName());
       
        $imageName = time().$image->getClientOriginalName();

          
           
        }
        else{
            $imageName = $article->title_image;
            
        }
        if($request->input('genre')==NULL){
            $g_id = $article->genre_id;
        }
        else{
          
            $g_id = $request->input('genre');
        }
        $article->title = $request->input('title');
        $article->title_image = $imageName;
        $article->content = $request->input('content');
        $article->user_id =Auth::user()->id;
        $article->genre_id = $g_id;
      
        $article->save();
 
       // return redirect()->route('show-article',['article'=>$article,'slug'=>str_slug($article->title)]);
       
       return redirect()->back()->with('success','Updated Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('feed')->with('success','Article successfully deleted !');
    }

   public function sameGenreStories(Genre $genre){

       
    $stories = Article::where('genre_id',$genre->id)->get();
    
    $data = [
        'stories'=>$stories,
        'genre'=>$genre
    ];
    return view('Article.sameGenreStories')->with($data);
   }
   public function sameUserStories(User $user){

    $stories =  Article::where('user_id',$user->id)->get();
    $data = [
        'stories'=>$stories,
        'user'=>$user
    ];
    return view('Article.sameUserStories')->with($data);
    }

    public function completeArticle(Request $request){
                     $articleId = $request['articleId'];
                     $article = Article::find($articleId);
                     $data = [
                         'article_title'=>$article->title,
                         'article_content'=>$article->content,
                         'article_genre'=>$article->genre_id
                     ];
                    return response()->json($data);
    }
    public function articleImage(Request $request,$id){
       
        $article = Article::find($id);
        $image = $request->file('file');
        $thumbnailImage = Image::make($image);
        $Path = public_path('storage').'/article_images/';
        $thumbnailImage->resize(600,350);
        $thumbnailImage->save($Path.time().$image->getClientOriginalName());
       
        $imageName = time().$image->getClientOriginalName();

       

        
        $imageUpload = new ArticleImage();
        $imageUpload->image = $imageName;
        $imageUpload->article_id = $article->id;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
     
  }
  /*public function editView(Request $request){
    $user = Auth::user();
  
     $article = Article::find($request['articleId']);
   
     $wows  = $article->likedBy()->wherePivot('article_id', $article->id)->count();
    
      
      $views = $article->viewedBy()->wherePivot('article_id',$article->id)->count();
      
      $a = Article::find($article->id);
      $a->views = $views;
      $a->save();
      // select genre dropdown
      $genres = Genre::all();
      $selectGenre=[];
       foreach($genres as $g){
          $selectGenre[$g->id] = $g->name;
      }
      $data = [
         
        'article'=>$article,
        'views'=>$views,
        'selectGenre'=>$selectGenre,
        'wows'=>$wows
    ];
     
      $editView = view('Article.editView')->with($data)->render();
      return response()->json(['editView'=> $editView]);
     
    }*/

 public function nonRealtimeEdit(Article $article){

    $user = Auth::user();
  
    $articleImages = $article->hasImages;
   $wows  = $article->likedBy()->wherePivot('article_id', $article->id)->count();
   
     
     $views = $article->viewedBy()->wherePivot('article_id',$article->id)->count();
     
     $a = Article::find($article->id);
     $a->views = $views;
     $a->save();
     // select genre dropdown
     $genres = Genre::all();
     $selectGenre=[];
      foreach($genres as $g){
         $selectGenre[$g->id] = $g->name;
     }
     $data = [
        
       'article'=>$article,
       'views'=>$views,
       'selectGenre'=>$selectGenre,
       'wows'=>$wows,
       'articleImages'=> $articleImages
   ];
    return view('Article.editView')->with($data);
 }
 public function comment(Request $request){

             $user = Auth::user();
             $comment =  New Comments;
             $comment->content = $request['comment'];
             $comment->user_id = $user->id;
             $comment->article_id =$request['articleId'];
             $comment->save();
             $data = [
                 'comment_content'=>$comment->content,
                 'commented_by'=>ucfirst($comment->commentedBy->fname).' '.ucfirst($comment->commentedBy->lname),
                 'profile_pic'=>'/storage/profile_images/'.$comment->commentedBy->hasProfile->profile_image,
                 'about'=>$comment->commentedBy->hasProfile->about,
                 
             ];
             return response()->json($data);
            }                           

}
