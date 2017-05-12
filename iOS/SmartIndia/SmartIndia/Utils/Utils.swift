//
//  Utils.swift
//  Globedin
//
//  Created by Eldhose Lomy on 02/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import Alamofire
import SwiftyJSON
import MaterialControls


class Utils{
    
    static let snack = MDSnackbar(text: "", actionTitle: "Dismiss",duration: 5)
    static let defaults = UserDefaults.standard
    
    
    

    //Displays  a message
    //Actions can be performed
    static func showMessage(_ message : GMessage,actionTitle:String = "Dismiss",action: @escaping ()->() = {} ){
        DispatchQueue.main.async{
            let duration:Double = message.action ? 12 : 4
            snack.text = message.message
            snack.duration = duration
            snack.actionTitle = actionTitle
            snack.actionTitleColor = UIColor.white
            snack.multiline = true
            snack.swipeable = true
            snack.show()
            snack.addActionHandler(action)
        }
        
    }

    //Apply delay for a block of codes
    static func delay(_ delay:Double, closure:@escaping ()->()) {
        
        DispatchQueue.main.asyncAfter(deadline: DispatchTime.now() + delay) {
            closure()
        }
    }
    
    //check device is in release mode
    internal static func isReleaseMode()->Bool{
        #if RELEASE
            return true
        #else
            return false
        #endif
    }
    
    
    //Checks the user is signin or not
    static func isLogin()->Bool{
        
        if let _ = defaults.object(forKey: Constants.kUserId) as? String{
            return true
        }
        return false
    }



    static func imageToBase64(image: UIImage) -> String {
        let data = UIImagePNGRepresentation(image)
        return data?.base64EncodedString() ?? ""
        
    }
    
    static func base64ToImage(base64String: String) -> UIImage? {
        let dataDecoded : Data = Data(base64Encoded: base64String, options: .ignoreUnknownCharacters)!
        return UIImage(data: dataDecoded)

    }
    
    static func dateToString(date:Date,format:String = Constants.displayDateFormat)->String{
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = format
        return dateFormatter.string(from: date)
    }

    static func stringToDate(dateString:String,format: String = Constants.displayDateFormat)->Date?{
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = format
        return dateFormatter.date(from: dateString)
    }
    
    }
