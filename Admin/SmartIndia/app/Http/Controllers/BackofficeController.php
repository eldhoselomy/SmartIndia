<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Team;
use App\Models\Member;
use App\Models\Topic;
use App\Models\Feedback;
use App\Models\Notification;
use Log;
use Session;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Validator;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

class BackofficeController extends Controller
{


    public function __construct(Guard $auth, User $user)
    {
        $this -> middleware('auth');
    }

   

     public function getIndex() {
        $id = Auth::user()->id;
        return View('index');
    }


     public function listUsers()
    {
        Log::info("inside user list");
        $user = User::find(Auth::id()); 
        return View('userlist')->with('user',$user);
    }

    public function getData()
    {
        
        Log::info("-----------------------user iif -----------------------------");
         $user = User::where('status','!=',2)
         ->select(array('users.id','users.email','users.name','users.status'))
         ->get() ;
   
        return Datatables::of($user)->make(true);  
      
    }

    public function deleteUser($id)
    {
        if($id != Auth::user()->id){
            $user = User::find($id);
            $user -> status = "2";
            $user -> save();        
            return 1;
            
        }else{
            return 0;
        }  
    }
    public function activateUser($id)
    {
        if($id != Auth::user()->id){
            $user = User::find($id);
            $user -> status = "1";
            $user -> save();        
            return 1;
            
        }else{
            return 0;
        }  
    }

    public function listTeamDetails($id)
    {
         $team = Team::where('user_id',$id)
         ->where('status','!=',0)
         ->select(array('teams.id','teams.name','teams.team_name'))
         ->get() ;
   
        return Datatables::of($team)->make(true);
    }


     public function listmembers($id)
    {
         $member = Member::where('team_id',$id)
         ->where('status','!=',0)
         ->select(array('members.id','members.name','members.email','members.department'))
         ->get() ;
   
        return Datatables::of($member)->make(true);
    }



























    public function listTopics()
    {
        Log::info("inside user list");
        $user = User::find(Auth::id()); 
        return View('topiclist')->with('user',$user);
    }

    public function topicsData()
    {
        
        Log::info("-----------------------user iif -----------------------------");
         $topics = Topic::where('status',1)
         ->select(array('topics.id','topics.name','topics.subject','topics.status'))
         ->get() ;
   
        return Datatables::of($topics)->make(true);  
      
    }

    public function add_topic()
    {
        Log::info("inside user list");
        $user = User::find(Auth::id()); 
        return View('addTopic')->with('user',$user);
    }

    public function save_topic(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->subject=$request->subject;
        $topic->description =$request->description;
        $topic->user_id = '0';
        $topic->status = '1';
        $topic->save ();
        return 1;
    }

    public function edit_topic($id)
    {
        $topic = Topic::find($id);
        return View('editTopic')->with('topic',$topic);
    }

    public function update_topic(Request $request)
    {
        $topic = Topic::find($request->id);
        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->subject=$request->subject;
        $topic->save();
        return redirect('topics/list');
    }


    public function delete_topic($id)
    {
            $topic = Topic::find($id);
            $topic -> status = "0";
            $topic -> save();        
            return 1;
    
    }


    public function userFeedbacklist()
    {
        Log::info("inside user list");
        $user = User::find(Auth::id()); 
        return View('userfeedbacklist')->with('user',$user);
    }

    public function userFeedbackData()
    {
        
        Log::info("-----------------------user iif -----------------------------");
         $userfeedback = Feedback::LeftJoin('users','feedback.user_id','users.id')
         ->where('user_id','!=',null)
         ->where('feedback.status',1)
         ->select(array('feedback.id','feedback.title','users.name','users.email'))
         ->get() ;
   
        return Datatables::of($userfeedback)->make(true);  
      
    }

    public function teamFeedbacklist()
    {
        Log::info("inside user list");
        $user = User::find(Auth::id()); 
        return View('teamfeedbacklist')->with('user',$user);
    }

    public function teamFeedbackData()
    {
        
        Log::info("-----------------------user iif -----------------------------");
         $teamsfeedback = Feedback::LeftJoin('teams','feedback.team_id','teams.id')
         ->where('team_id','!=',null)
         ->where('feedback.status',1)
         ->select(array('feedback.id','feedback.title','teams.name'))
         ->get() ;
   
        return Datatables::of($teamsfeedback)->make(true);  
      
    }

    public function delete_feedback($id)
    {

        $feedback = Feedback::find($id);
        $feedback -> status = "0";
        $feedback -> save();        
        return 1;
        
    }

    public function view_feedback($id)
    {
        $feedbackData = Feedback::find($id);
        if($feedbackData->user_id!=null)
        {
        $feedback = Feedback::LeftJoin('users','feedback.user_id','users.id')
         ->where('feedback.id',$feedbackData->id)
         ->where('feedback.status',1)
         ->select('feedback.*','users.name','users.email')
         ->first() ;
        }
        else if($feedbackData->team_id!=null)
        {
        $feedback = Feedback::LeftJoin('teams','feedback.team_id','teams.id')
         ->where('feedback.id',$feedbackData->id)
         ->where('feedback.status',1)
         ->select('feedback.*','teams.name','teams.team_name')
         ->first() ;
        }
        Log::info($feedback);
        return View('viewFeedback')->with('feedback',$feedback);
    }


    
}
