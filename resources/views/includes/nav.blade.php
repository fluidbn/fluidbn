

  <header>

    <nav class="navbar navbar-expand-md navbar-light bg-transparent mb-0" id="mynavbar">
           
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarCollapse">
               <ul class="navbar-nav mr-auto">
                 <li class="nav-item active">
                   <a class="nav-link" href="/feed">Feed <span class="sr-only">(current)</span></a>
                 </li>
                
                   <li class="nav-item">
                       <a class="nav-link" href="#">fluidbN Studio</a>
                     </li>
                     <li class="nav-item">
                           <a class="nav-link" href="#">OriginPage</a>
                         </li>
                         <li class="nav-item">
                           <a class="nav-link" href="#">Life Lab</a>
                         </li>
                         <li class="nav-item">
                               <a class="nav-link" href="#">fluidbN Awesome</a>
                             </li>
               </ul>
              
               <div class="col-lg-3">
               <a class="navbar-brand company" href="/feed">fluidbN</a>
               </div>
               <div class="row">
               <div class="col-lg-9 left">
               <form class="form-inline mt-3 mt-lg-2" action="{{route('search')}}">
                       <input class="form-control mr-lg-1" type="text" id ="search" placeholder="Search fluidbN..." aria-label="Search" name= "search" autocomplete="off"><button class="btn btn-outline-success" type="submit" id="searchbtn"><i class="fa fa-search" style="font-size:18px;"></i></button>
                    
                     </form>
               </div>
              
               </div>
            
               <!-- Right Side Of Navbar -->  {{-- responsive tab not working when browser shrinks see for that--}}
               
           
               <div class="row">
                   <div class="col-lg-10 left">
                   <ul class="nav navbar-nav">
   
                       <!-- Authentication Links -->
                      
                       @auth
                       
                       
                         <li class="dropdown">
                          
                              <button class="dropbtn"><i class="fa fa-user " style="color:black"></i>{{' '.ucfirst(Auth::user()->fname)}}
                                     <i class="fa fa-caret-down"></i>
                                   </button>
                                   <div class="dropdown-content">
                                       <a href="{{route('profile',['user'=>Auth::user(),'slug'=>str_slug(Auth::user()->fname.' '.Auth::user()->lname)])}}">Profile</a>
                                      
                                       <a href="{{route('show-bookmark')}}" id="show-bookmark"> My Bookmarks</a>
                                       <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                       Logout
                                   </a>
   
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                       {{ csrf_field() }}
                                       @csrf
                                   </form>
                                   </div>
                          
                           </li>
                           </div>
                     
                       @endauth
                   </ul>
                 </div>
               </div>
             </div>
           
           </nav>
         
       </header>
     
   
   
   
   
                
   
         
     
   
   
   
                