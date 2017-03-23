//
//  Enumerators.swift
//  Globedin
//
//  Created by Eldhose Lomy on 05/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation

enum MessageType{
    case success
    case warning
    case error
    case none
    
    var messageColor: UIColor {
        switch self {
        case .success:
            return UIColor.green
        case .warning:
            return UIColor.orange
        case .error:
            return UIColor.red
        case .none:
            return UIColor.groupTableViewBackground
        }
        
    }
}

enum ValidationRule{
    
    case Mandatory
    case Number
}

enum FieldType{
    case Name
    case Address1
    case Address2
    case Place
    case Landmark
    case Country
    case Zip
    case Phone
    case Email
    case Website
    case Image
    case Date
    case Time
    case Description
    case Designation
    
    case Submit
}

enum ProfileTab{
    case Home
    case Bussiness
    case Event
}
