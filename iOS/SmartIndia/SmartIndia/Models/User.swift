//
//  User.swift
//  Globedin
//
//  Created by Eldhose Lomy on 21/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class User : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var email                   = ""
    dynamic var password                = ""
    dynamic var mobile                  = ""
    dynamic var affiliateID             = ""
    dynamic var status                  = 0
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    override func mapping(map: Map) {
        name            <- map["name"]
        email           <- map["email"]
        mobile          <- map["phone"]
        affiliateID     <- map["affiliate_id"]
        id              <- (map["id"],integerTransform)
        status          <- map["status"]
    }
}


