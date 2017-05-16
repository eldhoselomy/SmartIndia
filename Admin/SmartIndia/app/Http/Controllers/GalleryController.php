<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;
use App\Models\Media;
use Log;
use Session;
use Auth;

class GalleryController extends Controller
{
    public function getImages($team){
        
        $teamList   =   $this->getTeams();
        
        if($team    ==  "all"){
            
            $imageList  =   $this->getAllImages();
            
        }else{
            
            $imageList  =   $this->getImagesByTeam($team);
            
        }
        
        return View('gallery')
              ->with('imageList',$imageList)
              ->with('teams',$teamList);
    }
    
    private function getAllImages(){
        
        $imageList  =   array();
        
        $images     =   Media::where('status',1)
                         ->get();
        if(!empty($images)){
            
            foreach($images as $image){
        
                array_push($imageList,
                            array("team"    =>  $image["team_id"],
                                  "image"   =>  $image["file_name"]
                               ));
            }
            
        }
        
        return $imageList;
    }
    
    private function getImagesByTeam($teamId){
        
        $imageList  =   array();
        
        $images     =   Media::where('status',1)
                             ->where('team_id',$teamId)
                             ->get();
        if(!empty($images)){
            
            foreach($images as $image){
                
                array_push($imageList,
                            array("team"    =>  $image["team_id"],
                                  "image"   =>  $image["file_name"]
                               ));
            }
            
        }
        
        return $imageList;
    }
    
    private function getTeams(){
        
        $teams      =   Team::LeftJoin('media','media.team_id','=','teams.id')
                        ->select('teams.id','teams.name')
                        ->get()
                        ->toArray();
        
//        $teamList   =   array();
//        
//        foreach($teams as $team){
//            if(!in_array(array("teamId"    =>  $team["id"],
//                            "teamName"  =>  $team["team_name"]),$teamList)){
//                array_push($teamList,
//                      array("teamId"    =>  $team["id"],
//                            "teamName"  =>  $team["team_name"]));    
//            }
//            
//        }
        Log::info(json_encode($teams));
        return $teams;
    }
    
}