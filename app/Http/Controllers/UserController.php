<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\Traits\ApiResponcer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponcer;
    public function register(Request $request)
    {
        $data =  Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required | unique:users',
            'password'=>'required | confirmed',
            'password_confirmation'=>'required',
        ]);
        if ($data->fails()) {
            return $this->error("", 400, $data->errors());
        }
        $user = $request->all();
        $user['password'] = Hash::make($request->password);
        $user = User::create($user);
        $token = $user->createToken('Monetoring')->accessToken;
        return $this->success($token, '', 201);
    }
    public function login(Request $request)
    {
        $data=Validator::make($request->all(), [
            'email'=>'required', 
            'password'=>'required',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }
     
        if(auth()->guard('client')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                $token=auth()->guard('client')->user()->createToken('Monitoring')->accessToken;
                return $this->success($token, "", 201);  
        }else{
            return $this->error("", 400, 'parol xato');
        }
    }
    public function show($id)
    {
        $user = User::find($id);
        return $this->success($user, '',200);
    }

    public function update(Request $request)
    {
        $data=Validator::make($request->all(), [
            'email'=>'required', 
            'name'=>'required',
        ]);
        
        if($data->fails()){
            return $this->error("", 400, $data->errors());
        }

        $client = auth()->guard('api')->user();
        $input =  $request->all();
        if(isset($request->password)){
            $input['password'] = Hash::make($request->password);

        }
        $client->update($input);
        return $this->success($client," o'zgartirildi", 201);
    }
    
}
