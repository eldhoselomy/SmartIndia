//
//  Notification.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class Notification : BaseRequest{
    
    dynamic var title                       = ""
    dynamic var details                     = ""
    dynamic var type                        = ""
    dynamic var url                         = ""
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    
    override func mapping(map: Map) {
        title           <- map["title"]
        details         <- map["description"]
        id              <- (map["id"],integerTransform)
        type            <- map["notification_type"]
        url             <- map["notification_url"]
    }
}
