//
//  Address.swift
//  Globedin
//
//  Created by Eldhose Lomy on 21/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import ObjectMapper
import GoogleMaps

class Address : BaseRequest{
    
    dynamic var name                    = ""
    dynamic var addressLine1            = ""
    dynamic var addressLine2            = ""
    dynamic var place                   = ""
    dynamic var landmark                = ""
    dynamic var country                 = ""
    dynamic var zip                     = ""
    dynamic var phone                   = ""
    dynamic var imageUrl                = ""
    dynamic var image:String            = ""
    dynamic var cvv                     = ""
    dynamic var keyword                 = ""
    dynamic var ginCode                 = ""
    
    var geoLocation                     = GeoLocation()
    
    
    required convenience init?(map: Map) {
        self.init()
    }
    
    convenience init(googleAddress:GMSAddress?) {
        self.init()
        if let address = googleAddress{
            self.addressLine2 = address.lines?.first ?? ""
            self.country = address.country ?? ""
            self.zip = address.postalCode ?? ""
            self.landmark = address.locality ?? ""
            self.place = address.administrativeArea ?? ""
            self.geoLocation.latitude = address.coordinate.latitude
            self.geoLocation.longitude = address.coordinate.longitude
        }
    }

    func mapping(map: Map) {
        
    }

}

