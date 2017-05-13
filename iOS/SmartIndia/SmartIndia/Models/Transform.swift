//
//  Transform.swift
//  wanderfirst

//
//  Created by Eldhose Lomy on 31/05/16.
//  Copyright © 2016 Techions. All rights reserved.
//

import UIKit
import SwiftyJSON
import ObjectMapper

class DoubleTransform : TransformType{
    typealias Object = String
    typealias JSON = NSNumber
    
    init() {}
    
    func transformFromJSON(_ value: Any?) -> String? {
        if let stringDouble = value as? Double {
            return stringDouble.description
        }else if let stringValue = value as? String{
            return stringValue
        }
        return nil
    }
    
    func transformToJSON(_ value: String?) -> NSNumber? {
        if let string = value {
            return Double(string) as NSNumber?
        }
        return nil
    }
}


class IntegerTransform : TransformType{
    typealias Object = String
    typealias JSON = AnyObject
    
    init() {}
    
    func transformFromJSON(_ value: Any?) -> String? {
        if let stringDouble = value as? Int {
            return stringDouble.description
        }else if let stringValue = value as? String{
            return stringValue
        }
        return nil
    }
    
    func transformToJSON(_ value: String?) -> AnyObject? {
        if let string = value {
            if let id = Int(string){
                return id as AnyObject?
            }else{
                return string as AnyObject?
            }
        }
        return nil
    }
}


