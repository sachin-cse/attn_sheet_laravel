<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //  response messages
    public function sendResponse($result,$message, $code=200){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response,$code);
    }

    public function sendError($error, $errorMsg = [],$code = 404){
        
        $response = [
            'success' => false,
            'message' => $error
        ];

        if(!empty($errorMsg)){
            $response['data'] = $errorMsg;
        }

        return response()->json($response,$code);
    }
    
}
