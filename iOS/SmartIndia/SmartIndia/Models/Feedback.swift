//
//  Feedback.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Feedback : BaseRequest{
    
    dynamic var title                       = ""
    dynamic var comment                     = ""
    dynamic var type                        = ""
    dynamic var userID                      = ""
    dynamic var teamID                    = ""
    dynamic var status                      = ""
    
    required convenience init?(map: Map) {
        self.init()
    }

    
    override func mapping(map: Map) {
        title           <- map["title"]
        comment         <- map["comments"]
        type            <- map["user_type"]
        id              <- (map["id"],integerTransform)
        teamID        <- (map["member_id"],integerTransform)
        userID          <- (map["user_id"],integerTransform)
    }
}
