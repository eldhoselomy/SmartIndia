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
    
    dynamic var name = "Manu"
    
    required convenience init?(map: Map) {
        self.init()
    }
}

extension User : Mappable{
    
    func mapping(map: Map) {
        
    }
}
