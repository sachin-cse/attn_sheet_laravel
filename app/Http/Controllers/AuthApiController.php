<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends BaseController
{
    //register api
    public function UserRegisterApi(Request $request){

      
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $importUserModel = new User();

        try{
          $importUserModel->fill($request->all());
          

          if($importUserModel->save()){
            $token = JWTAuth::fromUser($importUserModel);
            return $this->sendResponse(['token'=>$token], 'User Registered Successfully',201);

          }

        }
        catch(Exception $e){
            return $this->sendError('Error.', $e->getMessage(), 500);
        }
}

}
