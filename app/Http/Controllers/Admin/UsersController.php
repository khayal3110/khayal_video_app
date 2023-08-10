<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\DislikeDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    { 
      $keyword= '';
        if(isset($_GET['keyword']) && $_GET['keyword']){
            $keyword= $_GET['keyword'];
        }
        $where = "";
    
        $keywordArr = explode(' ', $keyword);
        $i = 1;
        if(!empty($keywordArr)){
            foreach($keywordArr as $key => $keywordVal){
                if($i == 1){
                    $where .= "first_name LIKE '%".$keywordVal."%' OR last_name LIKE '%".$keywordVal."%' OR email LIKE '%".$keywordVal."%'";
                }
                else{
                    $where .= " AND first_name LIKE '%".$keywordVal."%' OR last_name LIKE '%".$keywordVal."%' OR email LIKE '%".$keywordVal."%'";
                }
                $i++;
            }
        }
        else{
            $where .= "first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%'";
        }

        $result['keyword'] = $keyword;
        $result['users'] = User::orderBy('users.id', 'DESC')
            ->join('user_details', 'user_details.user_id', 'users.id', 'LEFT')
            ->select('users.id','users.first_name', 'users.last_name',  'users.username', 'users.email', 'users.phone', 'users.role','users.created_at', 'user_details.profile_icon', 'user_details.is_email_verified', 'user_details.is_phone_verified', 'user_details.phone_code','user_details.credit')
           
            ->whereRaw($where)->paginate(10);
        return view('admin.users.index')->with($result);
    }

    public function editUser($id){
        $user = User::where('users.id', $id)
            ->join('user_details', 'user_details.user_id', 'users.id', 'LEFT')
            ->select('users.id','users.first_name', 'users.last_name', 'users.username', 'users.email', 'users.phone', 'user_details.profile_icon', 'user_details.is_email_verified', 'user_details.is_phone_verified', 'user_details.phone_code')
            ->first();
        if($user == null){
            return view('errors/404');
        }
        $result['user'] = $user;

        return view('admin.users.edit')->with($result);
    }

    public function updateUser(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required',],
            'phone' => ['required', 'numeric'],
        ]);
        $user_id = (int)$request->user_id;
        $user = User::where('id', $user_id)->first();
        if($user == null){
            return response()->json(array('sts' => false, 'msg' => 'User not found.'));
        }else{
            $updateData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];
            if($request->password != ''){
                $updateData['password'] = $request->password;
            }
            User::where('id', $user_id)->update($updateData);
            $data = array(
                'user_id' => $user_id,
                'phone_code' => $request->phone_code, 
            );
            UserDetails::saveUserDetails($data);
            return response()->json(array('sts' => true, 'msg' => 'Successfully updated.'));
        }  
    }

    public function deleteUser(Request $request){

        $user_id = (int)$request->id;
        $user = User::where('id', $user_id)->first();
        if($user == null){
            return response()->json(array('sts' => false, 'msg' => 'User not found.'));
        }

        if($user->delete()){
            DB::table('ads')->where('user_id', $user_id)->delete();
            DB::table('campaigns')->where('user_id', $user_id)->delete();
            return response()->json(array('sts' => true, 'msg' => ''));
        }else{
            return response()->json(array('sts' => false, 'msg' => 'Some error occurred.'));
        }

    }

    public function addUser(){
        return view('admin.users.add');
    }

    public function addUserProcess(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('phone', $request->phone)->first();
  
        if($user != null){
           return redirect()->back()->withErrors(['msg' => 'Phone number already taken.']);
        }else{
            $username = uniqid(6);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $username,
                'phone' => $request->phone,
                'role' => $request->role,
                'password' => $request->password,
            ]);
            if($user){
                $data = array(
                    'user_id' => $user->id,
                    'profile_icon' => '', 
                    'phone_code' => $request->phone_code, 
                    'is_email_verified' => 0, 
                    'is_phone_verified' => 0, 
                );
    
                UserDetails::saveUserDetails($data);
                return response()->json(['sts' => true ,'msg' => 'User inserted successfully!']);
            }else{
                return response()->json(['sts' => false ,'msg' => 'Sorry! User not inserted try again!']);
            }
        }

    }

    public function userProfile(){
        if(Auth::check()){
            $user = User::currentUserInfo(Auth::user()->id);
            $result['user_data'] = $user;
            return view('admin.users.profile')->with($result);
        }else{
            return response()->json(['sts' => false ,'msg' => 'Authntication Error!']);
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
            return response()->json([
                'sts' => true,
                'msg' => 'Disliked successfully !'
            ]);
        }else{
            return response()->json([
                'sts' => false,
                'msg' => 'Unable to process please try again !'
            ]);
        }
    }

    public function assignCredit(Request $request){
        $user = UserDetails::where('user_id', $request->id)->first();
        if(!is_null($user)){
            $credit = $user->credit + $request->credit;
            $updated = UserDetails::where('user_id', $request->id)->update([
                'credit' => $credit
            ]);

            if($updated){
                return response()->json(['sts' => true ,'msg' => 'Credit assign successfully!']);
            }else{
                return response()->json(['sts' => false ,'msg' => 'Unable to process!']);
            }
        }else{
            return response()->json(['sts' => false ,'msg' => 'User does not exist!']);
        }
    }

}
