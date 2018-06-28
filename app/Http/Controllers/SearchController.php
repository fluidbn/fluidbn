<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Article;
use App\User;
use App\Genre;
use Auth;



class SearchController extends Controller
{
    public function search(Request $request){
        
         $search = $request->input('search');  
        
        if($search==""){
            return redirect()->back();
        }
        
        $search_result = New Search;
        $search_result->search_keyword = $search;  
        $search_result->save();
        $searched_term = Search::find($search_result->id);
        $user = Auth::user();
        $user->searches()->attach($searched_term);   

       $search_article = Article::where('title','like','%'.$search.'%')->orWhere('content','like','%'.$search.'%')->get();

       $search_user = User::where('fname','like','%'.$search.'%')->orWhere('lname','like','%'.$search.'%')->get();

       $search_genre = Genre::where('name','like','%'.$search.'%')->get();
       
                     
       $data = [
           'search_article'=> $search_article,
           'search_user' =>$search_user,
           'search'=>$search,
           'search_genre'=> $search_genre
       ];
       if($search==""){
           return;
       }
       else{
          return view('search')->with($data);
        

       }
       // dd($search_article);
       
     }

  /*   public function searchLive(Request $request){
        
            $res = '';
            $user_res = '';
            $article_res = '';
            $genre_res = '';
            $search = $request['keyword'];  
            if($search !=""){
                
                $search_article = Article::where('title','like','%'.$search.'%')->orWhere('content','like','%'.$search.'%')->get();
              
                $search_user = User::selectRaw('*')->join('profiles','profiles.user_id','=','users.id')->where('fname','like','%'.$search.'%')->orWhere('lname','like','%'.$search.'%')->orWhere('designation','like','%'.$search.'%')->orWhere('company','like','%'.$search.'%')->get();

                $search_genre = Genre::where('name','like','%'.$search.'%')->get();
               
                $c1 =  $search_article->count();
                $c2 =  $search_user->count();
                $c3 =  $search_genre->count();

                if($c1>0 || $c2>0 || $c3>0){
                  
                    foreach($search_article as $value){
                       $article_res.='
                         <tr>
                         <td>'.$value->title.'</td>
                         </tr>
                         ';
                        } 
                        foreach($search_user as $value){
                            $user_res.="
                              <tr>
                              <td><img class='featurette-image img-fluid mx-auto propic'  src='/storage/profile_images/{{$value->profile_image}}' alt=''></td>
                              <td>'.$value->fname.' '.$value->lname.'</td>
                              <td>'.$value->designation.' @ '.$value->company.'</td>
                             </tr>
                              ";
                             }  
                             foreach($search_genre as $value){
                                $genre_res.='
                                  <tr>
                                  <td>'.$value->name.'</td>
                                  </tr>
                                  ';
                                 }   
                                $data = [

                                   'article_res'=>$article_res,
                                   'user_res'=>$user_res,
                                   'genre_res'=>$genre_res
                                ];
                                
                                return response()->json($data);
                                
                    

                   }

                   else{
                       $res.='
                       <tr>
                        <td align="center" colspan="4">No data found !</td>

                       </tr>
                       ';
                       return response($res); 
                   }
                    
            }
            else{

                 return null;
                }
  
           }*/
           public function searchSuggestion(Request $request){
            $query = $request->q;        

            $articles = Article::where('title','like','%'.$query.'%')->orWhere('content','like','%'.$query.'%')->get();
           
            return $articles;
           }
          public function searchUser(Request $request){
            $query = $request->q;   
            $users = User::where('fname','like','%'.$query.'%')->orWhere('lname','like','%'.$query.'%')->get();  
            return $users;   
          }
          public function searchGenre(){
            $query = $request->q;     
            $genre = Genre::where('name','like','%'.$query.'%')->get();
            return $genre;
          }
     }


