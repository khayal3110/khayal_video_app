<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function register()
    {
   
        return view('frontend.register');
    }

    public function login()
    {
        return view('frontend.login');
    }


    public function index(){ 
        $result['videos']= Video::orderBy('id','DESC')->latest()->get();
        return view('home')->with($result);    }

    public function dashboard(){ 
        $result['videos']= Video::orderBy('id','DESC')->latest()->get();
        return view('dashboard')->with($result);
    }

    public function view(Request $request){ 
        $user_id=auth()->user()->id;
       $result['user_video']= Video::where('user_id',$user_id)->orderby('videos.id','desc')->join('users','users.id','=','videos.user_id')
     ->select('videos.id','videos.user_id','videos.title','videos.image','videos.video','videos.description','videos.created_at','users.username')->get();
        return view('view-post')->with($result);
    }

    public function upload(){ 
        return view('upload-video');
    }
}
