<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthControllers extends Controller
{


    // user register
    public function registerUser(Request $request)
    {
        $validator = validator::make($request->all(), [
            'role' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'user_name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'password' => 'required|string|min:4|max:12'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $user = new User();
            $user->role = $request->role;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $result = $user->save();
            return response()->json([
                'status' => 200,
                'message' => "user register successfully",
                'result' => $result,
            ], 201);
        }
    }


    // user login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|max:12'
        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Bad credits'], 401);
        }
        error_log("here");

        $token = $user->createToken('token')->plainTextToken;
        error_log($token);
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }


    //update user details
    public function userUpdate(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'role' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'user_name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'password' => 'required|min:4|max:12'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!",
                'errors' => $validator->errors(),
            ], 500);
        } else {
            $user = User::find($id);
            $user->role = $request->role;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $result = $user->save();
            return response()->json([
                'status' => 200,
                'message' => "user update successfully",
                'result' => $result,
            ], 201);
        }
    }


    // user logout
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "message" => "Logout Successful",
        ], 201);
    }


    //get all user details
    public function getAllUser()
    {
        $usersDetails = User::select('user_id', 'role', 'first_name', 'last_name', 'user_name', 'email')->get();
        return response()->json($usersDetails, 200);
    }


    //get user details
    public function userDetails()
    {
        $userId = Auth::id();
        $usersDetails = User::select('id', 'type', 'user_role', 'first_name', 'last_name', 'userName', 'email')
            ->where('user_id', '=', $userId)
            ->get();

        return response()->json($usersDetails, 200);
    }


    //delete user details
    public function userDelete(int $id)
    {
        $user = User::where('user_id', $id);
        $user->delete();
        return response()->json($user, 201);
    }
}
