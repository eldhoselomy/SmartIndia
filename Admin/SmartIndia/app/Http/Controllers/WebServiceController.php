<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\Member;
use App\Models\Topic;
use App\Models\Feedback;
use App\Models\Notification;
use App\Models\Media;
use App\Models\DeviceNotification;

use Log;

class WebServiceController extends Controller
{
    public function __construct()
    {
    }
    
    /**
     * Login
     *
     */
    public function login(Request $request) {
        $status = 400;
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)
                ->first();
        
        if($user) {
            if(Hash::check($password, $user->password)) {
                $status = 200;
            }else{
                //Invalid Password
                $status = 401;
            }
        }else{
            //Not Found
            $status = 404;
        }
        $responseArray = $status == 200 ? array('status' => 200, 'user' => $user) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * Member Login
     *
     */
    public function member_login(Request $request) {
        $status = 400;
        $email = $request->get('email');
        $password = $request->get('password');
        $team = Team::where('team_name', $email)
                ->first();
        
        if($team) {
            if($team->team_token == $password) {
                $status = 200;
            }else{
                //Invalid Password
                $status = 401;
            }
        }else{
            //Not Found
            $status = 404;
        }
        $responseArray = $status == 200 ? array('status' => 200, 'team' => $team) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * Register
     *
     */
    public function register(Request $request) {
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();
        if ($user) {
            // User already exists
            $status = 401;
        } else {
            $user = new User();
            $user->fill($request->all());
            $user->status=0;
            $user->password=Hash::make($password);
            $status = $user->save() ? 200 : 400;
        }
        $responseArray = $status == 200 ? array('status' => 200, 'user' => $user) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * Add Team
     *
     */
    public function add_team(Request $request) {
        $status = 400;
        $user_id = $request->get('user_id');
        $teams = Team::where('user_id', $user_id)
            ->where('status',1)->get();
        if(count($teams) >= 3){
            //Exceeds Limit
            $status = 401;
        }else{
            $team = new Team();
            $team->fill($request->all());
            $team->status=1;
            $status = $team->save() ? 200 : 400;
        }
        
        $responseArray = $status == 200 ? array('status' => 200, 'team' => $team) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * List Team
     *
     */
    public function list_teams(Request $request){
        $user_id = $request->get('user_id');
        $team_id = $request->get('team_id');
        if($user_id){
            $teams = Team::where('user_id', $user_id)
            ->get();
        }else{
            $teams = Team::where('id', $team_id)->get();
        }
        
        $responseArray = array('status' => 200, 'teams' => $teams);
        return response()->json($responseArray);
    }
    
    /**
     * Add Member
     *
     */
    public function add_member(Request $request) {
        $status = 400;
        $team_id = $request->get('team_id');
        $members = Member::where('team_id', $team_id)
            ->where('status',1)->get();
        if(count($members) >= 5){
            //Exceeds Limit
            $status = 401;
        }else{
            
            $member = new Member();
            $member->fill($request->all());
            $member->status=1;
            $status = $member->save() ? 200 : 400;
        }
        
        $responseArray = $status == 200 ? array('status' => 200, 'member' => $member) : array('status' => $status);
        return response()->json($responseArray);
    }

    /**
     * List Members
     *
     */
    public function list_members(Request $request){
        $team_id = $request->get('team_id');
        $members = Member::where('team_id', $team_id)
            ->where('status',1)->get();
        $responseArray = array('status' => 200, 'members' => $members);
        return response()->json($responseArray);
    }


    /**
     * List Topics
     *
     */
    public function list_topics(Request $request){
        $topics = Topic::where('status', 1)
            ->get();
        $responseArray = array('status' => 200, 'topics' => $topics);
        return response()->json($responseArray);
    }
    
    /**
     * Add Topics
     *
     */
    public function add_topics(Request $request){
        $topic = new Topic();
        $topic->fill($request->all());
        $topic->status=0;
        $status = $topic->save() ? 200 : 400;
        $responseArray = $status == 200 ? array('status' => 200, 'topic' => $topic) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * Select Team Topics
     *
     */
    public function select_team_topic(Request $request){
        $status = 400;
        $topic_id = $request->get('topic_id');
        $team_id = $request->get('team_id');
        $team_name = $request->get('team_name');
        $team = Team::where('id', $team_id)->first();
        $team_list = Team::where('team_name',$team_name)->first();
        if(!$team){
            $status = 400;
        }
        else if($team_list){
            //Team name not available
            $status = 405;
        }else{
            $team = Team::where('id', $team_id)->first();
            if($team) {
                $team->topic_id = $topic_id;
                $team->team_name = $team_name;
                $team->team_token = $request->get('team_token');
                $team->status = 2;
                $status = $team->save() ? 200 : 400;
            }
        }
        
        $responseArray = $status == 200 ? array('status' => 200, 'team' => $team) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    


    /**
     * Add Feedback
     *
     */
    public function add_feedback(Request $request){
        $feedback = new Feedback();
        $feedback->fill($request->all());
        $status = $feedback->save() ? 200 : 400;
        $responseArray = $status == 200 ? array('status' => 200, 'feedback' => $feedback) : array('status' => $status);
        return response()->json($responseArray);
    }
    
    
    /**
     * List Notifications
     *
     */
    public function list_notifications(Request $request){
        $notifications = Notification::where('status', 1)
            ->get();
        $responseArray = array('status' => 200, 'notifications' => $notifications);
        return response()->json($responseArray);
    }
    
    /**
     * Push Image
     *
     */
    public function push_image(Request $request){
        $team_id = $request->get('team_id');
        $filename = uniqid('smartIN', true) . '.png';
        $image = $request->get('image');
        $ifp = fopen('Media/'.$filename, 'wb' ); 
        fwrite( $ifp, base64_decode( $image ) );
        fclose( $ifp ); 
        $responseArray =array('status' => 200, 'imageURL' => $filename);
        $media = new Media();
        $media->team_id = $team_id;
        $media->file_name = $filename;
        $media->status = 1;
        $media->save();
        return response()->json($responseArray);
    }


    /**
     * Register for Notifications
     *
     */
    public function register_notifications(Request $request){
        $token = $request->get('firebase_token');
        $device_notification = DeviceNotification::where('firebase_token',$token)->first();
        if($device_notification){
            $device_notification->status = 1;
            $status = $device_notification->save() ? 200 : 400;
        }else{
            $device_notification = new DeviceNotification();
            $device_notification->fill($request->all());
            $status = $device_notification->save() ? 200 : 400;
        }

        $responseArray = array('status' => $status);
        return response()->json($responseArray);
    }
    
    /**
     * Un Register for Notifications
     *
     */
    public function unregister_notifications(Request $request){
        $token = $request->get('firebase_token');
        $device_notification = DeviceNotification::where('firebase_token',$token)->first();
        if($device_notification){
            $device_notification->status = 0;
            $status = $device_notification->save() ? 200 : 400;
        }
        $responseArray = array('status' => $status);
        return response()->json($responseArray);
    }

}