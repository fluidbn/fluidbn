<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Article;
use App\User;
use App\Profile;
use App\Search;
use App\Genre;
use App\SavedArticle;
use Session;
use Hash;


class FeedController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

       $article = Article::latest()->where('finished',1)->paginate(6);
       $user = Auth::user();
       $user_genre = $user->hasGenre()->wherePivot('user_id',$user->id)->get();

       
        $followed_users = $user->follows()->wherePivot('follower_id',$user->id)->get();
       
       // to genre selection 
       $genres = Genre::all();
        $selectGenre=[];
        foreach($genres as $g){
            $selectGenre[$g->id] = $g->name;
        }
        
       $data = [
           'article'=>$article,
           'user_genre' =>  $user_genre,
           'user'=>$user
              
          
       ];
        
         return view('feed')->with($data)->with( 'selectGenre',$selectGenre);
       }

      
      

      
      
    }