//
//  Member.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Member : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var email                   = ""
    dynamic var phone                   = ""
    dynamic var dob                     = ""
    dynamic var sex                     = ""
    dynamic var department              = ""
    dynamic var semester                = ""
    dynamic var registerNumber          = ""
    dynamic var teamID                  = ""
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    override func mapping(map: Map) {
        name            <- map["name"]
        email           <- map["email"]
        phone           <- map["phone"]
        dob             <- map["dob"]
        id              <- (map["id"],integerTransform)
        teamID          <- (map["team_id"],integerTransform)
        sex             <- (map["sex"],integerTransform)
        department      <- map["department"]
        semester        <- map["semester"]
        registerNumber  <- map["reg_no"]
    }
    
    var getGender:String{
        return sex == "1" ? "Male" : "Female"
    }

    
}

