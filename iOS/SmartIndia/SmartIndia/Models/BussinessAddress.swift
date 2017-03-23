//
//  BussinessAddress.swift
//  Globedin
//
//  Created by Eldhose Lomy on 23/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class BussinessAddress : Address{
    
    dynamic var email                   = ""
    dynamic var website                 = ""

    
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    override func mapping(map: Map) {
        
    }
}

