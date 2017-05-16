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
//            Utils.showMessage("No internet")
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
                    Utils.showMessage("Oops something went wrong")
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
    
    // MARK: - Login
    internal func login(request: LoginRequest,completion: @escaping ((User?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.Login.URL, parameters: request.getParameters(), headers: nil) { dataJSON in
            if let parentUserID = dataJSON?["parent_id"].int{
                Utils.saveParentID(id: parentUserID.description)
            }
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 401:
                    Utils.showMessage("Invalid Credentials")
                case 404:
                    Utils.showMessage("User not found")
                default:
                    break
                }
            }
            if let json = dataJSON?["user"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
            
        }
    }
    
    // MARK: - Member Login
    internal func memberLogin(request: LoginRequest,completion: @escaping ((Team?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.MemberLogin.URL, parameters: request.getParameters(), headers: nil) { dataJSON in
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 401:
                    Utils.showMessage("Invalid Credentials")
                case 404:
                    Utils.showMessage("User not found")
                default:
                    break
                }
            }
            if let json = dataJSON?["team"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
            
        }
    }

    
    // MARK: - Register
    internal func register(request: [String:Any],completion: @escaping ((User?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.Register.URL, parameters: request, headers: nil) { dataJSON in
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 401:
                    Utils.showMessage("User already registered")
                default:
                    break
                }
            }
            if let json = dataJSON?["user"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
            
        }
    }
    
    // MARK: - List Teams
    internal func listTeam(request: [String:String],completion: @escaping (([Team]?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.ListTeams.URL, parameters: request, headers: nil) { dataJSON in
            if let json = dataJSON?["teams"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }
    
    // MARK: - Add Team
    internal func addTeam(request: [String:String],completion: @escaping ((Team?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.AddTeam.URL, parameters: request, headers: nil) { dataJSON in
            
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 401:
                    Utils.showMessage("You have already created maximum number of teams")
                default:
                    break
                }
            }
            if let json = dataJSON?["team"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }

    // MARK: - List Members
    internal func listMembers(request: [String:String],completion: @escaping (([Member]?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.ListMembers.URL, parameters: request, headers: nil) { dataJSON in
            if let json = dataJSON?["members"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }
    
    // MARK: - Add Member
    internal func addMember(request: [String:Any],completion: @escaping ((Member?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.AddMember.URL, parameters: request, headers: nil) { dataJSON in
            
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 401:
                    Utils.showMessage("You have already exceeds the member limit in team")
                default:
                    break
                }
            }
            if let json = dataJSON?["member"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }
    
    // MARK: - Add Feedback
    internal func addFeedback(request: [String:Any],completion: @escaping ((Feedback?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.AddFeedback.URL, parameters: request, headers: nil) { dataJSON in
            
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                default:
                    break
                }
            }
            if let json = dataJSON?["feedback"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }

    
    // MARK: - List Topics
    internal func listTopics(completion: @escaping (([Topic]?) -> Void)) {
        fetchDataFromServer(requestType: .get, url: ServiceURL.ListTopics.URL, parameters: nil, headers: nil) { dataJSON in
            if let json = dataJSON?["topics"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }

    
    // MARK: - List Notifications
    internal func listNotifications(completion: @escaping (([Notification]?) -> Void)) {
        fetchDataFromServer(requestType: .get, url: ServiceURL.ListNotification.URL, parameters: nil, headers: nil) { dataJSON in
            if let json = dataJSON?["notifications"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }

    // MARK: - Save Team
    internal func saveTeam(request: [String:Any],completion: @escaping ((Team?) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.SaveTeam.URL, parameters: request, headers: nil) { dataJSON in
            
            if let status = dataJSON?["status"].int{
                switch status{
                case 400:
                    Utils.showMessage("Oops something went wrong")
                case 405:
                    Utils.showMessage("Team name not available")
                default:
                    break
                }
            }
            if let json = dataJSON?["team"]{
                self.responseSerializer(dataJSON: json  , completion: completion)
                return
            }
            completion(nil)
            
        }
    }

    // MARK: - Push Images
    internal func pushImage(image:String,teamID:String,completion: @escaping ((Bool) -> Void)) {
        let param = [
            "image" : image,
            "team_id" : teamID
        ]
        fetchDataFromServer(requestType: .post, url: ServiceURL.PushImages.URL, parameters: param, headers: nil) { (dataJSON) in
            if let status = dataJSON?["status"].int, status == 200{
                completion(true)
                return
            }
            completion(false)
        }
    }
    
    
    // MARK: - Register Notification
    internal func registerNotification(request:[String:Any],completion: @escaping ((Bool) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.RegisterNotification.URL, parameters: request, headers: nil) { (dataJSON) in
            if let status = dataJSON?["status"].int, status == 200{
                completion(true)
                return
            }
            completion(false)
        }
    }
    
    // MARK: - UNregister Notification
    internal func unRegisterNotification(request:[String:Any],completion: @escaping ((Bool) -> Void)) {
        fetchDataFromServer(requestType: .post, url: ServiceURL.UnregisterNotification.URL, parameters: request, headers: nil) { (dataJSON) in
            if let status = dataJSON?["status"].int, status == 200{
                completion(true)
                return
            }
            completion(false)
        }
    }


    
}




