<?php

namespace App\Http\Controllers;
use File;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\PhoneRegister;
use App\Models\User;
use App\Models\Comment;
use App\Models\Video;
use App\Models\UserDetails;
use App\Models\UserVerify;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
    
    public function sendOtp(Request $request){
       
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'phone_no'=> 'required',
        ]);
        
        if ($validator->fails()) {           
            return response()->json(['sts' => false, 'errors' => $validator->errors()->all()]);
        }else{
            $user = PhoneRegister::where('phone', $request->phone)->first();
    
            if($user == null){
                return response()->json(['sts' => false, 'errors' => ['This email does not exist in the system']]);
            }
    
            $otp = $this->genrateOtp();
            
            $result['name'] = $user->first_name; 
            $result['otp'] = $otp; 
            
            $to = $user->phone;
            $subject = 'Verify phone';
            $message = view('email-templates.verifyemail')->with($result)->render();
            if(env('ENVIRONMENT') == 'live'){
                sendEmail($to,$subject,$message);
            }
            
            UserVerify::saveOtp($user->id,$otp,'phone-verify');
    
            return response()->json([ 'sts' => true, 'msg' => 'OTP has been sent.' ]);
        }
    }
    

    protected function loginProcess(Request $request)
    {
    $validater = Validator::make($request->all(), [                 
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if($validater->fails()){
            return response()->json(['sts' => false, 'msg' => $validater->messages()->all()]);
        }else{
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if(auth()->attempt(array($fieldType => $request->email, 'password' => $request->password)))
            {
                $url = '/dashboard';
                return response()->json(array('sts' => true, 'msg' => '', 'redirect_url' => $url)); 
            } else {
                return response()->json(array('sts' => false, 'msg' => 'Email/Password does not match.'));
            }
        }
    }

public function saveUser(Request $request){
    $validater = Validator::make($request->all(), [
        'username'=>'required',
        'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users',
        'password' => 'required|min:8',
        'confirm_password' => 'required_with:password|same:password|min:8'
    ]);
    if($validater->fails()){
        return response()->json(['sts' => false, 'msg' => $validater->messages()->all()]);
    }else{
        $data = $request->input();
        $res = User::where('username', $data['username'])->first();
        if($res != null){
            return response()->json([ 'sts' => false, 'msg' => ['username already taken.']]);
        }

        $data = $request->input();
        $res = User::where('email', $data['email'])->first();
        if($res != null){
            return response()->json([ 'sts' => false, 'msg' => ['email already taken.']]);
        }
       
        $user = User::create([
            'username' => $data['username'],
            'email' =>  $data['email'],
            'password' => $data['password'],
            'role' => 'customer',
        ]);
        if($user){
                 return response()->json([
                     'sts' => true, 
                     'msg' => 'Register successfully!'
                 ]);
            }else{
                 return response()->json([
                     'sts' => false, 
                     'msg' => 'unable to register!'
                 ]);
            }
        }
}
      

public function logout(Request $request){
    Auth::logout();
    return redirect('/login');
}


    public function videoUpload(Request $request)
    {
    $validater = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'video' => 'required',
    ]);
    if($validater->fails()){
        return response()->json(['sts' => false, 'msg' => $validater->messages()->all()]);
    }else{
        $user_id =Auth::user()->id;
        $image_name = "";
        $video_name = "";
        if ($image = $request->file('image')) {
           $name ="_".$image->getClientOriginalName();
           if(file_exists(public_path('uploads/image').$name)){
               return response()->json(['sts' => false, 'msg' =>['Image File already exists!']]);
            }
            $image->move(public_path('uploads/image'), $name);
            $image_name = $name;
        }
        if ($video = $request->file('video')) {
            $name ="_".$video->getClientOriginalName();
            if(file_exists(public_path('uploads/video').$name)){
                return response()->json(['sts' => false, 'msg' =>['Image File already exists!']]);
             }
             $video->move(public_path('uploads/video'), $name);
             $video_name = $name;
         }
        $id = Video::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'description' => $request->title,
            'image' => $image_name,
            'video' => $video_name,
        ]);

    if($id){
            return response()->json(array('sts' => true, 'msg' => 'Successfully created!'));
        }else{
            return response()->json(array('sts' => false, 'msg' => 'Some error occurred!'));
        }
    }
} 
   
public function comment(Request $request){
    $validator = Validator::make($request->all(),[
        'comment' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
           'sts' => false,
           'msg' => $validator->messages()->all()
        ]);
    }else{
    $user_id = Auth::user()->id;
    $cmt = Comment::create([
        'user_id' => $user_id,
        'video_id' => $request->video_id,
        'comment' => $request->comment,
    ]);

    if($cmt){
            return response()->json([
                'sts' => true,
                'msg' => 'comment success!'
            ]);
        }else{
            return response()->json([
                'sts' => false,
                'msg' => 'unable to comment!'
            ]);
        }
    }
}

}





