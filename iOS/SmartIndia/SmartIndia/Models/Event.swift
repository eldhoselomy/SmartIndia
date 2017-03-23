//
//  Event.swift
//  Globedin
//
//  Created by Eldhose Lomy on 22/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Event : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var details                 = ""
    dynamic var place                   = ""
    dynamic var date                    = ""
    dynamic var time                    = ""
    dynamic var imageUrl                = ""
    dynamic var image:String            = ""
    
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    
}

extension Event : Mappable{
    
    func mapping(map: Map) {
        
    }
}
