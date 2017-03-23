//
//  GeoLocation.swift
//  Globedin
//
//  Created by Eldhose Lomy on 25/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper

class GeoLocation{
    
    dynamic var latitude      :Double   = 10.026989
    dynamic var longitude     :Double   = 76.308471

    
    required convenience init?(map: Map) {
        self.init()
    }
    
    
}

extension GeoLocation : Mappable{
    
    func mapping(map: Map) {
        
    }
}
