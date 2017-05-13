//
//  Team.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Team : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var teamName                = ""
    dynamic var topicID                 = ""
    dynamic var teamToken               = ""
    dynamic var status                  = ""
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    override func mapping(map: Map) {
        name            <- map["name"]
        teamName        <- map["team_name"]
        topicID         <- (map["topic_id"],integerTransform)
        teamToken       <- map["team_token"]
        id              <- (map["id"],integerTransform)
        status          <- (map["status"],integerTransform)
    }
    
}
