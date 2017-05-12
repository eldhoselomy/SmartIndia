//
//  NetworkManager.swift
//  Globedin
//
//  Created by Eldhose Lomy on 22/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.

import Foundation
import Alamofire
import ObjectMapper
import SwiftyJSON

class NetworkManager{
    
    static let sharedManager = NetworkManager()
    //Blocking the initializer to outside of class
    private init(){
        
    }
    
    
    private func fetchDataFromServer(requestType: HTTPMethod,url: String,parameters:[String:Any]?,headers: [String:String]? ,completion: @escaping ((JSON?)-> Void)) {
        //Network Availablity Check
//        guard Utils.isNetworkReachable() else{
//            if !ServiceURL.offline.contains(url){
//                Utils.showMessage(Message.noInternet)
//            }
//            completion(nil)
//            return
//        }
        //Custom manager
        let manager = Alamofire.SessionManager.default
        
        // Proceeds if network available
        //Alamofire Request
        manager.request(url, method: requestType, parameters: parameters, encoding: JSONEncoding.default, headers: headers)
            .responseJSON { response in
                
                //Invalid Response
                guard let status = response.response?.statusCode, status < 300 else {
                   // self.showErrors(errorcode: response.response?.statusCode ?? 500)
                    completion(nil)
                    return
                }
                
                //Success
                if let value = response.result.value{
                    completion(JSON(value))
                }else{
                    completion(nil)
                }
        }
    }
    
    //serialize json data to models
    private func responseSerializer<T>(dataJSON: JSON?, completion:((T?) ->Void)) where T:Mappable{
        if let json = dataJSON?.description{
            if let object = Mapper<T>().map(JSONString : json){
                completion(object)
            }else{
                completion(nil)
            }
        }else{
            completion(nil)
        }
    }
    
    //serialize json data to array of objects
    private func responseSerializer<T>(dataJSON: JSON?, completion:(([T]?) ->Void)) where T:Mappable{
        if let json = dataJSON{
            var result:[T] = []
            for data in json{
                if let object = Mapper<T>().map(JSONString : data.1.description){
                    result.append(object)
                }
            }
            completion(result)
        }else{
            completion(nil)
        }
    }
    
    

    
}




