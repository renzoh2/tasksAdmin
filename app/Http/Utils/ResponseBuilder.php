<?php
namespace App\Http\Utils;

class ResponseBuilder{

    public static function response($code, $status, $title = null, $message = null, $data = null)
    {
        $json['code'] = $code;
        $json['status'] = $status;
        if($data)
            $json['data'] = $data;
        if($message)
        {
            $json['title'] = $title;
            $json['message'] = $message;
        }
            

        return response()->json($json,$code);
    }

}

?>