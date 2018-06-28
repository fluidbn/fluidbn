<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use Session;
use Auth;
use App\Notifications\UserFollowed;

class FollowController extends Controller
{
    public function follow(Request $request){
         
            
        $user = Auth::user();
        $otheruser = User::find($request['userId']);
       
        $follow = $user->follows()->wherePivot('follower_id',$user->id)->wherePivot('following_id',$otheruser->id)->first();
       if($follow){
       
           return null;
       }
       else{
           $user->follows()->attach($otheruser);
           $user->notify(new UserFollowed($otheruser));
       }
    }


    public function unfollow(Request $request){
        $user = Auth::user();
        $otheruser = User::find($request['userId']);
       
           $user->follows()->detach($otheruser);
       
    }


    public function like(Request $request){

           $article_id = $request['articleId'];
           $writer_id =  $request['userId'];
           $article = Article::find($article_id);
           $writer = User::find($writer_id);
           $user = Auth::user();
          $like = $user->likes()->wherePivot('user_id',$user->id)->wherePivot('article_id', $article_id)->first();

           if($like){
               return null;
           }
           else{
            $user->likes()->attach( $article);
             $wows  = $article->likedBy()->wherePivot('article_id', $article_id)->count();
             if($wows>1)
             $w = ' wows';
             else
             $w = ' wow'; 
             $data = [
               'wows'=>'  '.$wows.$w
             ];

            
           return response()->json($data);
            
           }
          
        }
        public function unlike(Request $request){

            $article_id = $request['articleId'];
            $article = Article::find($article_id);
            $user = Auth::user();
          
             $user->likes()->detach( $article);
             $wows  = $article->likedBy()->wherePivot('article_id', $article_id)->count();
             if($wows>1)
             $w = ' wows';
             else
             $w = ' wow'; 
             $data = [
               'wows'=>'  '.$wows.$w
             ];
           return response()->json($data);
              
 
            
         }
         public function bookmark(Request $request){
            $article_id = $request['articleId'];
            $article = Article::find($article_id);
            $user = Auth::user();
            $bookmark = $user->bookmarks()->wherePivot('user_id',$user->id)->wherePivot('article_id', $article_id)->first();
           
            if($bookmark){
                return null;
            }
            else{
             $user->bookmarks()->attach( $article);
 
            }
         }
       
         public function unmark(Request $request){
            $article_id = $request['articleId'];
            $article = Article::find($article_id);
            $user = Auth::user();
            $user->bookmarks()->detach($article);
          
         }
         public function showBookmark(){
             
            $user = Auth::user();
            $user_bookmarks = $user->bookmarks()->wherePivot('user_id',$user->id)->latest()->get();
            $bookmark_view = view('User.bookmarks')->with('user_bookmarks',$user_bookmarks);
            return   $bookmark_view ;
         }
}

