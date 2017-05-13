//
//  LoginRequest.swift
//  Globedin
//
//  Created by Eldhose Lomy on 26/03/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class LoginRequest : BaseRequest{
    
    dynamic var email                    = ""
    dynamic var password                 = ""
    

    
    init(username:String,password:String){
        super.init()
        self.email = username
        self.password = password
    }
    
    internal func getParameters()->[String:Any]{
        return Mapper().toJSON(self)
    }
    
    required init?(map: Map) {
        fatalError("init has not been implemented")
    }
    
    override func mapping(map: Map) {
        super.mapping(map: map)
        email <- map["email"]
        password <- map["password"]
    }
    
}

