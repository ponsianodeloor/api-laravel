<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    public function store(Request $request){
        $validate_data = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed'
        ]);

        if ($validate_data->fails()){
            return response($validate_data->errors(), 401);
        }else{
            $user = new User();

            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return json_decode($user, 200);
        }
    }

    public function show($username){
        $user = User::where('username', $username)->get();
        return json_decode($user, 200);
    }

    public function edit($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
