<?php
namespace App\Http\Utils;

class ResponseBuilder{

    public static function response($status, $message)
    {
        $json['status'] = $status;
        $json['message'] = $message;

        return response()->json($json,$status);
    }

}

?>