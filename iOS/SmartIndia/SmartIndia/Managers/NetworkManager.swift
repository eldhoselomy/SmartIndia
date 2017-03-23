//
//  NetworkManager.swift
//  Globedin
//
//  Created by Eldhose Lomy on 05/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation
import Alamofire
import SwiftyJSON

class NetwokManager{
    
    //Singleton instance of Network Manager
    //Default Debug mode
    static let sharedInstance = NetwokManager.getInstance()
    
    let baseURL:String!
    let webURL:String!
    
    fileprivate init(isRelease:Bool = false){
        if isRelease{
            //Release data
            baseURL         =   "http://dev.globedin.com/"
            webURL          =   "http://www.globedin.com/"

        }else{
            //Local data
            baseURL         =   "http://dev.globedin.com/"
            webURL          =   "http://www.globedin.com/"
            
            
        }
        
    }
    
    fileprivate static func getInstance()->NetwokManager{
        return NetwokManager(isRelease: true)
    }
    
}

class NetworkRequest{
    fileprivate let MAX_RETRY_COUNT = 3
    fileprivate let MAX_DELAY:UInt32 = 7
    fileprivate var retryCount = 0
    var request : Request!
    
    internal func performNetwork(_ requestType : HTTPMethod,url:String, param:  [String : AnyObject]?,completion: @escaping ((_ isComplete: Bool, _ jsonObj: JSON?) -> Void)){
        print("\(url) Request initiated")
        request = Alamofire.request(url, method: requestType, parameters: param , encoding: JSONEncoding.default)
            .responseJSON { response in
                if let json = response.result.value
                {
                    completion(true, JSON(json))
                }
                else{
                    //check retry available
                    if let error = response.result.error as? NSError, error.code != Constants.kRequestCancelledCode{
                        self.retryCount += 1
                        if self.retryCount <= self.MAX_RETRY_COUNT{
                            let delay = Double(arc4random_uniform(self.MAX_DELAY))
                            print("\(url) retry in \(delay) seconds")
                            Utils.delay(delay, closure: {
                                self.performNetwork(requestType, url: url, param: param, completion: completion)
                            })
                        }else{
                            completion(false, nil)
                            print("\(url) Request failed")
                        }
                        
                        
                    }
                    
                    
                }
                
        }
    }
}
