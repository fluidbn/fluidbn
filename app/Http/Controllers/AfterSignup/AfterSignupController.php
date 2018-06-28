<?php


namespace App\Http\Controllers\AfterSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Genre;
use App\Profile;
use App\Article;
use Illuminate\Support\Facades\Storage;
class AfterSignupController extends Controller
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






   public function chooseGenre(){
      
    $genre = Genre::orderBy('id')->get();

    $data =[
        'genre'=>$genre
    ];

   return view('AfterSignup.genre')->with($data);
    
   }
   public function storeGenre(Request $request){
      
    
      $genreId = $request['genreId'];
     $user= Auth::user();
     $genre = Genre::find($genreId);
     $exists = $user->hasGenre()->wherePivot('user_id',$user->id)->wherePivot('genre_id',$genreId)->first();
     if($exists){
         return null;
     }else{
       
        $user->hasGenre()->attach($genre);
        return response()->json(['id'=>$genre->id]);
       }
        
      
     
     
    /* foreach($request->input('genre') as $g){
        $gen = Genre::where('name',$g)->get();
        $user->hasGenre()->attach($gen); }*/
       // return view('AfterSignup.createprofile');
     
   }
    public function remGenre(Request $request){

        $genreId = $request['genreId'];
        $user= Auth::user();
        $genre = Genre::find($genreId);
        $user->hasGenre()->detach($genre);  
    }
    

     public function createProfile(Request $request){
       
        $this->validate($request,[
            'about'=>'required|max:80',
         
            'image'=>'image|nullable|max:1999', // onlyimage and not compulsory to upload and max file size less than 2mb
            
            ]);

             // Handle file request
             if($request->hasFile('image')){
                // get file name with extension
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                // get just file name
                $file = pathinfo( $filenameWithExt,PATHINFO_FILENAME);

                //get just extension
                $ext =  $request->file('image')->getClientOriginalExtension();
                // file to store
                $fileNameToStore = $file.'_'.time().'.'.$ext ;
                //upload file 
                $path = $request->file('image')->storeAs('public/profile_images',$fileNameToStore);
                
            }
            elseif($request->input('gender')=='Male'){
                $fileNameToStore = 'img_avatar2.png';
            }
            elseif($request->input('gender')=='Female'){
                $fileNameToStore = 'FemaleAvatar-1.png';
            }

            $profile = New Profile;
            $profile->user_id = Auth::user()->id;
            $profile->profile_image =  $fileNameToStore;
            $profile->gender = $request->input('gender'); 
            $profile->about = $request->input('about');
            
            if($request->input('not_working')!=NULL){
                $profile->not_working =1; 
            }
            else{
                $profile->designation = $request->input('designation');
                $profile->company = $request->input('company');   
                
            }
            $profile->save();

               
       $article = Article::orderBy('id','desc')->get();
       $useri = Auth::user();
       $user_genre = $useri->hasGenre()->wherePivot('user_id',$useri->id)->get();
       
           
              $user =   Profile::where('user_id',Auth::user()->id)->get();
            $data = [
               'user'=>$user,
               'article'=>$article,
               'user_genre' =>  $user_genre,
               
            ];

            return redirect()->route('feed')->with($data);
      
       
       
     }
}
