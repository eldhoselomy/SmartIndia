<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Log;


class NotificationController extends Controller{

//======================================================================
// SmartIndia
//======================================================================

//-----------------------------------------------------
// Created By Eldhose Lomy
//-----------------------------------------------------

/* Notification Helper */

// API access key from Google API's Console
const API_ACCESS_KEY = 'AAAAlPoaRKQ:APA91bF6tDr4DBycWplHA1fwnHDNWONH7ktrthdQT1n2NdziaeAHLyDisgYh16U-5ukXLo22r6yDoqNCukad-dViWRjOWX74b2S-HwFz48GkLzBNhKz8mz3asuAJ6dppaEN3fTJQCYmL';

const Topics = array
        (
	       'ADMIN' 	=> '/topics/admin',
	       'MEMBER'		=> '/topics/member',
            'ALL' => "'admin' in topics || 'member' in topics"
        );
//======================================================================
// Send Notification to user Segments
//======================================================================


public function sendNotificationsToUserSegment($type,$title,$message){
    $msg = array
        (
	       'body' 	=> $message,
	       'title'		=> $title
        );
    $sender = ($type == 'ALL') ? "condition" : "to";
    $fields = array
        (
            $sender 	              => self::Topics[$type],
	        'notification'			  => $msg
        );  
    $this->sendMessage($fields);
}


//======================================================================
// Send Notification to list of users
//======================================================================


public function sendNotificationsToRegisteredUsers($registrationIds,$title,$message){
    $msg = array
        (
	       'body' 	    => $message,
	       'title'		=> $title,
           'icon'       => "myicon"

        );
    $fields = array
        (
            'registration_ids' 	      => $registrationIds,
	        'notification'			  => $msg
        );  
    $this->sendMessage($fields);
}



//======================================================================
// Communication With Notification Server
//======================================================================


 public function sendMessage($fields){
     $headers = array(
	'Authorization: key=' . self::API_ACCESS_KEY,
	'Content-Type: application/json'
     );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    echo $result;
}

}