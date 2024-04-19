<?php
use App\Models\User;
use Illuminate\Support\Facades\Mail;


if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}


if (! function_exists('GenerateRandomString')) {
    function GenerateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (! function_exists('SendNotificationUser')) {
    function SendNotificationUser($token,$title,$message)
    {
            $url = 'https://fcm.googleapis.com/fcm/send';

            $fields = array (
                    'registration_ids' => array (
                        $token
                    ),
                    'data' => array (
                        'title' => $title,
                        'body' => $message,
                    ),
                    'notification'=>array(
                        'title'=>$title,
                        'body' => $message,
                    )
            );
            $fields = json_encode ( $fields );
        
            $headers = array (
                    'Authorization: key=' . "",
                    'Content-Type: application/json'
            );
        
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
            $result = curl_exec ( $ch );
            //  echo $result;
            curl_close ( $ch );
    }
}

if (! function_exists('devicetoken')) {
    function devicetoken($id)
    {
          return User::find($id)->device_id ?? "";
    }
}

if (! function_exists('error_processor')) {
    function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}
