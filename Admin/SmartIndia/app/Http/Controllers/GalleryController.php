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
        
        $teamList       =   $this->getTeams($team);
        
        if($team    ==  "all"){
            $selectedTeam   =   'All';
            $imageList      =   $this->getAllImages();
            
        }else{
            $selectedTeam   =   $this->getTeamName($team);
            $imageList  =   $this->getImagesByTeam($team);
            $teamList["all"]='All';
        }
        
        return View('gallery')
              ->with('selectedTeam',$selectedTeam)
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
    
    private function getTeams($teamSelected){
        
        $teams      =   Team::LeftJoin('media','media.team_id','=','teams.id')
                        ->select('teams.id','teams.name')
                        ->get()
                        ->toArray();
        
        $teamList   =   array();
        
        foreach($teams as $team){
            
            if(!array_key_exists($team["id"],$teamList) && $team["id"]!=$teamSelected){
                $teamList[$team["id"]]  =   $team["name"];
            }
            
        }
        Log::info(json_encode($teamList));
        return $teamList;
    }
    
    private function getTeamName($teamId){
        $teamSelected   =   Team::where("id",$teamId)                                    
                                 ->get();
        
        $teamName       =   $teamSelected[0]["name"];
        
        return $teamName;
    }
    
}