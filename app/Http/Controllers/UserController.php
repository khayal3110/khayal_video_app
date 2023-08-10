<?php

namespace App\Http\Controllers;
use App\Models\NotificationPermission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetails;
use Session;
use Auth;
class UserController extends Controller
{
    public function verifyEmail()
    {
        return view('auth.verify-email');
    }
   

    public function userDashboard()
    {
        return view('user.dashboard');
    }

    
    public function loginProcess(Request $request){
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth()->attempt(array($fieldType => $request->email, 'password' => $request->password)))
        {
            $user = Auth::user();
           
            $userDetails = UserDetails::where('user_id', $user->id)->first();
          
            if($userDetails == null ){
                Auth::logout();
                return redirect()->route('login')->with('error','Details not found.');
            }
 
        }else{
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function forgotPassword(){
        return view('auth.passwords.email');
    }

    public function resetPassword(){
        return view('auth.passwords.reset');
    }
   
    public function saveUser(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email'=> 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required_with:password|same:password|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
               'sts' => false,
               'msg' => $validator->messages()->all()
            ]);
        }else{
        $user = User::where('email',$request->email)->first();
  
        if($user != null){
           return redirect()->back()->withErrors(['msg' => 'email number already taken.']);
        }

        $username = User::where('username', $request->username)->first();
  
        if($username != null){
           return redirect()->back()->withErrors(['msg' => 'username number already taken.']);
        }

        $user = User::create([
            'email' => $request->email,
            'role' =>'customer',
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if($user){
            return response()->json([
                'sts' => true,
                'msg' => 'register success!'
            ]);
        }else{
            return response()->json([
                'sts' => false,
                'msg' => 'unable to register!'
            ]);
        }
    }
}
 
    public function dislikesDescription(Request $request){
        if(!Auth::check()){
            return response()->json([
                'sts' => true,
                'msg' => 'Unauthorization Error !'
            ]);
        }
        
        $disliked = DislikeDescription::saveDislike($request->all());
        if($disliked){
            if(isset($request->id)){
                return response()->json([
                    'sts' => true, 
                    'last_insert_id' => $disliked,
                    'msg' => 'Data updated successfully !'
                ]);
            }else{
                return response()->json(['sts' => true, 'msg' => 'Data Insert successfully !']);
            }
        }{
            return response()->json(['sts' => false, 'msg' => ['Unable to process,  please try again!']]);
        }
        if($request->status == 'like'){
            $status = 1;
           
        }else{
            $status = 0;
        }

        $liked = DislikeDescription::updateOrCreate(
            ['status' => $status]
        );
    }
    public function dislikeshow(Request $request, $id=null){
        if($id==null){
            $dislike = DislikeDescription::dislikeList();
            if($dislike){
                return response()->json(['sts' => true, 'data' => $dislike]);
            }else{
                return response()->json(['sts' => true, 'msg' => 'DislikeDescription list empty found!']);
            }
        }else{
            $dislike = DislikeDescription::singledislikeInfo($id);
            if($dislike){
                return response()->json(['sts' => true, 'data' => $dislike]);
            }else{
                return response()->json(['sts' => true, 'msg' => 'No DislikeDescription found!']);
            }
        }
    } 

    public function showPaymentDetails(Request $request){
        $dateInput=$request->input(dateselect);
         $data['users']=DB::table('user_table')
        ->leftjoin('payment_table','user_table.role','=','payment_table.user_table_role')
        ->orderby('user_table.role','desc')
        ->where('payment_table.paymentamount','=',$dateInput)
        ->get();
        return view('user.index',$data);
    }

    public function assignAffiliate(Request $request){
        $user = UserDetails::where('user_id', $request->user_id)->first();
        if($user){
            $updated = UserDetails::where('user_id', $request->user_id)->update([
                'affiliate_percentage' => $request->affiliate,
            ]);

            if($updated){
                return response()->json([
                    'sts' => true,
                    'msg' => 'Affiliate assign successfully !'
                ]);
            }else{
                return response()->json([
                    'sts' => false,
                    'msg' => 'Unable to process please try again !'
                ]);
            }
        }else{
            return response()->json([
                'sts' => false,
                'msg' => 'User dones not exist !'
            ]);
        }
    }
}

