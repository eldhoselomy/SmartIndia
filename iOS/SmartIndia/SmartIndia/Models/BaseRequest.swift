//
//  BaseRequest.swift
//  Globedin
//
//  Created by Eldhose Lomy on 21/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper


class BaseRequest : Mappable{
    
    dynamic var id = ""
    
    let integerTransform = IntegerTransform()
    
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    func mapping(map: Map) {
        id <- map["id"]
    }
    
}


extension Mappable{
    internal func getDictionary()->[String:String]{
        return Mapper().toJSON(self) as! [String: String]
    }
}
