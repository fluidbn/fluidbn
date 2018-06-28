<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
use Session;
use App\Article;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function show(User $user,$slug)
    {
        $authUser = Auth::user();
        $article = Article::where('user_id',$user->id)->orderBy('id','desc')->get();
          //fix this later//$follow =  $authUser->follows()->wherePivot('follower_id', $authUser->id)->wherePivot('following_id',$user->id)->first();
        $followers = $user->followedBy()->wherePivot('following_id',$user->id)->count();
 
        $data = [
          'article'=>$article,
          'user'=>$user,
          //'follow'=>$follow,
          'followers'=>$followers
        ];
        
     return view('profile')->with($data);
    }

        

     /*public function ajaxshow(Request $request){
         
       
        $user_id = $request['userId'];
        $user = User::find( $user_id);
        $article = Article::where('user_id',$user_id)->orderBy('id','desc')->get();  

         $otheruserId = Session::get('otheruserId');
      
         $follow = $user->follows()->wherePivot('follower_id',$user->id)->wherePivot('following_id',$otheruserId)->first();
        
  
         $data = [
           'article'=>$article,
           'user'=>$user,
           'follow'=>$follow
         ];
         
      $profile = view('profile')->with($data)->render();
      return response()->json(['profile'=>$profile]);
     }*/

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
