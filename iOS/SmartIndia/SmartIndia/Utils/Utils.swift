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
import ReachabilitySwift
import NBMaterialDialogIOS


class Utils{
    
    static let snack = MDSnackbar(text: "", actionTitle: "Dismiss",duration: 5)
    static let defaults = UserDefaults.standard
    static let reachablity = Reachability()
    private static var dialogs : [NBMaterialLoadingDialog] = []
    
    

    //Displays  a message
    //Actions can be performed
    static func showMessage(_ message : String,actionTitle:String = "Dismiss",action: @escaping ()->() = {} ){
        DispatchQueue.main.async{
            snack.text = message
            snack.actionTitle = actionTitle
            snack.actionTitleColor = UIColor.white
            snack.multiline = true
            snack.swipeable = true
            snack.show()
            snack.addActionHandler(action)
        }
        
    }
    
    internal static func showProgress(message : String = "Loading ...", animated : Bool = true, dissmissable:Bool = false){
        DispatchQueue.main.async {
            if let window = UIApplication.shared.windows.first{
                let dialogue = NBMaterialLoadingDialog.showLoadingDialogWithText(window, message: message)
                dialogue.dismissOnBgTap = dissmissable
                dialogs.append(dialogue)
            }
        }
        
    }

    internal static func hideProgress(){
        DispatchQueue.main.async {
            for dialog in dialogs{
                dialog.hideDialog()
            }
            
        }
    }

    
    //Apply delay for a block of codes
    static func delay(_ delay:Double, closure:@escaping ()->()) {
        
        DispatchQueue.main.asyncAfter(deadline: DispatchTime.now() + delay) {
            closure()
        }
    }
    
    internal static func isNetworkReachable()->Bool{
        return reachablity?.isReachable ?? false
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
    
    //Save default userID
    static func saveUserID(id:String){
        defaults.set(id, forKey: Constants.kUserId)
        defaults.synchronize()
    }
    
    static func getDefaultUserID()->String{
        return defaults.object(forKey: Constants.kUserId) as? String ?? "0"
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
    
    static func getConfirmation(on controller:UIViewController,text: String, completion: @escaping (_ isCancelled: Bool) -> Void) -> Void{
        let confirmVC = Constants.kStoryboard.instantiateViewController(withIdentifier: "ConfirmPicker") as! ConfimationViewController
        confirmVC.titleString = "Confirmation"
        confirmVC.message = text
        confirmVC.completion = completion
        controller.present(confirmVC, animated: true, completion: nil)
    }
    
    static func getGreetingString()->String{
        let hour = NSCalendar.current.component(.hour, from: Date())
        var string = ""
        switch hour {
        case 6..<12 :
            string = "Great attitude is like a perfect cup of coffee – don’t start you day without it. Good morning."
        case 12..<17 :
            string = "Good better best, never let it rest, till the good is better, better is best. Good Afternoon!"
        case 17..<22 :
            string = "Evening is a time of real experimentation, you never want to look the same way. Good Evening."
        default:
            string = "Early sleep and early wake up gives health and makes you grow. Good Night!"
        }
        return string
    }
    
}
