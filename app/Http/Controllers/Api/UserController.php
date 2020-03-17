<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\User;
use JWTAuth;
use JWTAuthException;
use Hash;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        $user = User::where('email', $request->get('email'))->first();
        $status = 200;
        $message = 'User created successfully';
        $data = '';
        if ($user) {
            $status = 422;
            $message = 'Email exist';
        }
        else {
            $user = $this->user->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);
            $data = $user;
        }       

        return response()->json([
            'status'=> $status,
            'message'=> $message,
            'data'=>$data
        ]);
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        $status = 200;
        $message = 'Logged';
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                $status = 422;
                $message = 'Invalid email or password';
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' => null
                ]);
            }
        } catch (JWTAuthException $e) {
            $status = 500;
            $message = 'Failed to create token';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => null
            ]);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $token
        ]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json('You have successfully logged out.', Response::HTTP_OK);
        } catch (JWTException $e) {
            return response()->json('Failed to logout, please try again.', Response::HTTP_BAD_REQUEST);
        }
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        $userInfo = User::where('email', $user->email)->first();
        return response()->json([
            'status' => 200,
            'message' => "Get user successfully",
            'data' => $userInfo
        ]);
    }

    public function update_profile(Request $request) 
    {
        $user = User::where('email', $request->get('email'))->first();
        $user->name = $request->get('name') ? $request->get('name') : $user->name ;
        if($request->get('new_password')) {
            $user->password = Hash::make($request->get('new_password'));
        }

        $user->save();

        return response()->json([
            'status' => 200,
            'message' => "Update your profile successfully",
            'data' => $user
        ]);
    }

}
