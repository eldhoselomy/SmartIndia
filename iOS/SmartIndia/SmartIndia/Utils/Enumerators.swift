//
//  Enumerators.swift
//  Globedin
//
//  Created by Eldhose Lomy on 05/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation


enum ServiceURL: String{
    case Login = "login"
    case MemberLogin = "member_login"
    case Register = "register"
    case ListTeams = "list_teams"
    case AddTeam = "add_team"
    case ListMembers = "list_members"
    case AddMember = "add_member"
    case AddFeedback = "add_feedback"
    case ListTopics = "list_topics"
    case ListNotification = "list_notifications"
    case SaveTeam = "select_team_topic"
    case PushImages = "push_image"
    case RegisterNotification = "register_notifications"
    case UnregisterNotification = "unregister_notifications"

    
    var URL:String{
        return Constants.baseURL + self.rawValue
    }
    
}
enum MessageType{
    case success
    case warning
    case error
    case none
}


