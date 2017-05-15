<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Log;

class NotificationController extends Controller

//======================================================================
// SmartIndia
//======================================================================

//-----------------------------------------------------
// Created By Eldhose Lomy
//-----------------------------------------------------

/* Notification Helper */

// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAAlPoaRKQ:APA91bF6tDr4DBycWplHA1fwnHDNWONH7ktrthdQT1n2NdziaeAHLyDisgYh16U-5ukXLo22r6yDoqNCukad-dViWRjOWX74b2S-HwFz48GkLzBNhKz8mz3asuAJ6dppaEN3fTJQCYmL' );

 
//Define topics
define( 'ADMIN', '/topics/admin' );
define( 'MEMBER', '/topics/member' );
define( 'ALL', "'admin' in topics || 'member' in topics" );


//======================================================================
// Send Notification to user Segments
//======================================================================


public function sendNotificationsToUserSegment($type,$title,$message,$notificationData){
    $msg = array
        (
	       'body' 	=> $message,
	       'title'		=> $title
        );
    $sender = ($type == IOS || $type == ANDROID) ? "to" : "condition";
    $fields = array
        (
            $sender 	              => $type,
	        'notification'			  => $msg,
            'data'                    => $notificationData
        );  
    sendMessage($fields);
}


//======================================================================
// Send Notification to list of users
//======================================================================


public function sendNotificationsToRegisteredUsers($registrationIds,$title,$message,$notificationData){
    $msg = array
        (
	       'body' 	    => $message,
	       'title'		=> $title,
           'icon'       => "myicon"

        );
    $fields = array
        (
            'registration_ids' 	      => $registrationIds,
	        'notification'			  => $msg,
            'data'                    => $notificationData
        );  
    sendMessage($fields);
}



//======================================================================
// Communication With Notification Server
//======================================================================


 function sendMessage($fields){
     $headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
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


//======================================================================
// Examples
//======================================================================

$data = array
    (
	       'id' 	            => 11,
           'type'               => "Friend Request",
           'actionValue'        => 56
    );

//======================================================================
// Send Notifications to a group of users
//======================================================================

//sendNotificationsToUserSegment(ALL,"GlobedIN","Please update App Version",$data);


//======================================================================
// Send notifications to selected users
//======================================================================

//$registrationIds = ['f3hp0UQVMdI:APA91bFRitVW-jsWgvh66FCZiryvg1hRWykcxsvI5988CIQ4HX3VkC8mMtGjjygiU3xrdieFaMZ-rd7x2s60onteHDUh9AJhFxgl7GZ-mNtA8nCRya2tpa_BgQ87gtYqwxD9OT7PEYYV'];

//sendNotificationsToRegisteredUsers($registrationIds,"Manu123","hello manu 123",$data);