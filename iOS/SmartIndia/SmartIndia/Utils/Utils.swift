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
    
    
    
    //Perform Network Tasks
    //Support Retry
    static func FetchSeverData(_ method : String,url:String, param:  [String : AnyObject]?,isWebURL:Bool = false,completion: @escaping ((_ isComplete: Bool, _ jsonObj: JSON?) -> Void))-> NetworkRequest {
        let requestType:HTTPMethod =  (method == "GET") ? HTTPMethod.get : HTTPMethod.post
        let networkRequest = NetworkRequest()
        let URL = isWebURL ? NetwokManager.sharedInstance.webURL+url : NetwokManager.sharedInstance.baseURL+url
        networkRequest.performNetwork(requestType, url: URL, param: param, completion: completion)
        
        return networkRequest
        
    }
    
    //Displays  a message
    //Actions can be performed
    static func showMessage(_ message : GMessage,actionTitle:String = "Dismiss",action: @escaping ()->() = {} ){
        DispatchQueue.main.async{
            let duration:Double = message.action ? 12 : 4
            snack.text = message.message
            snack.duration = duration
            snack.actionTitle = actionTitle
            snack.actionTitleColor = message.type.messageColor
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
    
    static func showQR(data:String,controller:UIViewController){
        if let QRVc = Constants.kStoryboard.instantiateViewController(withIdentifier: "QRVc") as? QRViewController{
            QRVc.QRString = data
            controller.present(QRVc, animated: true, completion: nil)
        }
    }
    
    
    //Genrates QR code from string
    //Can change the quality by changeing 'InputCorrection Level'
    static func getQR(data: String,logo: UIImage? = nil)-> UIImage?{
        
        let bgColor = CIColor(red: 1, green: 1, blue: 1)
        let color = CIColor(red: 0.109375, green: 0.58203125, blue: 0.84765635)
        let qrFilter = CIFilter(name: "CIQRCodeGenerator")!
        qrFilter.setDefaults()
        qrFilter.setValue(data.data(using: String.Encoding.utf8, allowLossyConversion: false), forKey: "inputMessage")
        
        let ciImage = qrFilter.outputImage
        
        // scale qrcode image
        let colorFilter = CIFilter(name: "CIFalseColor")!
        colorFilter.setDefaults()
        colorFilter.setValue(ciImage, forKey: "inputImage")
        colorFilter.setValue(color, forKey: "inputColor0")
        colorFilter.setValue(bgColor, forKey: "inputColor1")
        
        let transform = CGAffineTransform(scaleX: 10, y: 10)
        let transformedImage = qrFilter.outputImage!.applying(transform)
        
        let image = UIImage(ciImage: transformedImage)
        
        if logo != nil {
            return insertAvatarImage(image, avatarImage: logo!)
        }
        
        return image
    }
    
    

    
    private static func insertAvatarImage(_ codeImage: UIImage, avatarImage: UIImage, scale: CGFloat = 0.25) -> UIImage {
        
        let rect = CGRect(x: 0, y: 0, width: codeImage.size.width, height: codeImage.size.height)
        UIGraphicsBeginImageContext(rect.size)
        
        codeImage.draw(in: rect)
        
        let avatarSize = CGSize(width: rect.size.width * scale, height: rect.size.height * scale)
        let x = (rect.width - avatarSize.width) * 0.5
        let y = (rect.height - avatarSize.height) * 0.5
        avatarImage.draw(in: CGRect(x: x, y: y, width: avatarSize.width, height: avatarSize.height))
        
        let result = UIGraphicsGetImageFromCurrentImageContext()
        
        UIGraphicsEndImageContext()
        
        return result!
    }
    
    static func QRScan(controller:UIViewController){
        if let QRVc = Constants.kStoryboard.instantiateViewController(withIdentifier: "QRScan") as? QRScannerViewController{
            QRVc.qrDelegate = controller
            controller.present(QRVc, animated: true, completion: nil)
        }
    }
    
    static func showAddress(address:Address,type: ApplicationType, controller: UIViewController){
        if let addressVC = Constants.kStoryboard.instantiateViewController(withIdentifier: "GINVC") as? AddressViewController{
            addressVC.address = address
            addressVC.type = type
            controller.present(addressVC, animated: true, completion: nil)
        }
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
    
    static func getUser()->User?{
        return User()
    }
    
    static func getUniqueFileName(baseName: String) -> String{
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = Constants.dateFormatForFileName
        var timeStamp = dateFormatter.string(from: Date())
        if let user = getUser(){
            timeStamp = baseName + "-" + user.id + "-" + timeStamp
        }
        
        return timeStamp
    }
    
    static func openInMap(location:GeoLocation){
        let url = "?center=\(location.latitude),\(location.longitude)&views=traffic"
        //open map
        if UIApplication.shared.canOpenURL(URL(string:"comgooglemaps://")!) {
            UIApplication.shared.openURL(URL(string:
                "comgooglemaps://\(url)")!)
        }
            //open map in chrome
        else if (UIApplication.shared.canOpenURL(URL(string:"googlechromes://")!)) {
            UIApplication.shared.openURL(URL(string:
                "googlechromes://\(url)")!)
        }
            //open map in apple map
        else{
            let url = "http://maps.apple.com/?ll=\(location.latitude),\(location.longitude)&t=m"
            UIApplication.shared.openURL(URL(string:url)!)
        }
    }
}
