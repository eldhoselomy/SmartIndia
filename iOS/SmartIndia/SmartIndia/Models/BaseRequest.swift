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
    
    internal static func getGIN(value:String)->String{
        let str : NSMutableString = NSMutableString(string: value)
        let index = value.characters.count/2
        str.insert(" ", at: index)
        return str as String
    }
    
}


extension Mappable{
    internal func getDictionary()->[String:String]{
        return Mapper().toJSON(self) as! [String: String]
    }
}
