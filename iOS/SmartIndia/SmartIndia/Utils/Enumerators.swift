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
    case Register = "register"
    case ListTeams = "list_teams"
    case AddTeam = "add_team"
    case ListMembers = "list_members"
    case AddMember = "add_member"
    case AddFeedback = "add_feedback"
    case ListTopics = "list_topics"

    
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

enum ValidationRule{
    
    case Mandatory
    case Number
}

enum FieldType{
    case Name
    case Address1
    case Address2
    case Place
    case Landmark
    case Country
    case Zip
    case Phone
    case Email
    case Website
    case Image
    case Date
    case Time
    case Description
    case Designation
    
    case Submit
}

enum ProfileTab{
    case Home
    case Bussiness
    case Event
}
