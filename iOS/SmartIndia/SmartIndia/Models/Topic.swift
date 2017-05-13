//
//  Topic.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Topic : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var subject                 = ""
    dynamic var details                 = ""
    dynamic var status                  = ""
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    override func mapping(map: Map) {
        name            <- map["name"]
        subject         <- map["subject"]
        details         <- map["description"]
        id              <- (map["id"],integerTransform)
    }
}

