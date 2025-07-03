<?php
if(!function_exists('sendAjaxResponse')){
    function sendAjaxResponse($status=null, $msg=null, $html=null, $extra_param=null, $url=null){
        $response = [];

        $response['status'] = $status;

        $response['msg'] = $msg;

        if(!empty($html)){
            $response['html'] = $html;
        }

        $response['extra_param'] = $extra_param;

        if(isset($url)){
            $response['url'] = $url;
        }

        echo json_encode($response);
    }
} 
?>