//
//  HomeViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 24/03/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import FirebaseMessaging

class HomeViewController: BaseViewController {
    
    @IBOutlet weak var topicView:UIView!
    @IBOutlet weak var ideaView:UIView!
    @IBOutlet weak var notificationView:UIView!
    @IBOutlet weak var feedbackView:UIView!
    @IBOutlet weak var settingsView:UIView!
    @IBOutlet weak var logoutView:UIView!
    @IBOutlet weak var greetingLabel:UILabel!

    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    override func hasMenu() -> Bool {
        return true
    }

    override func setup() {
        super.setup()
        self.navigationItem.titleView = UIImageView(image: #imageLiteral(resourceName: "logo_name"))
        let views = [topicView,ideaView,notificationView,feedbackView,settingsView,logoutView]

        for view in views{
            let tap = UITapGestureRecognizer(target: self, action: #selector(self.handleTap(_:)))
            for subview in view!.subviews{
                subview.isUserInteractionEnabled = false
            }
            view?.isUserInteractionEnabled = true
            view?.addGestureRecognizer(tap)
        }
    }
    
    func handleTap(_ sender:UITapGestureRecognizer){
        if let view  = sender.view{
            switch view.tag {
            case 0:
                self.performSegue(withIdentifier: "TopicVC", sender: self)
            case 1:
                self.performSegue(withIdentifier: "teamVC", sender: self)
                break
            case 2:
                self.performSegue(withIdentifier: "NotificationVC", sender: self)
            case 3:
                self.performSegue(withIdentifier: "feedbackVC", sender: self)
            case 4:
                self.performSegue(withIdentifier: "SettingsVC", sender: self)
            case 5:
                logout()
            default:
                break
            }
        }
    }
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewDidAppear(animated)
        greetingLabel.text = Utils.getGreetingString()
    }
    func logout(){
        Utils.getConfirmation(on: self, text: "Are you sure? you want to logout.") { (isCancelled) in
            if !isCancelled{
                if let appDelegate = UIApplication.shared.delegate as? AppDelegate{
                    //clear data
                    let defaults = UserDefaults.standard
                    defaults.removeObject(forKey: Constants.kUserId)
                    defaults.removeObject(forKey: Constants.kUsername)
                    defaults.removeObject(forKey: Constants.kEmail)
                    defaults.removeObject(forKey: Constants.kTeamID)
                    defaults.removeObject(forKey: Constants.kParentID)
                    defaults.synchronize()
                    let topic = Utils.isAdmin() ? "/topics/admin" : "/topics/team"
                    FIRMessaging.messaging().unsubscribe(fromTopic: topic)
                    if let token = Utils.getNotificationToken(){
                        let userID = Utils.getDefaultUserID().isEmpty ? Utils.getParrentID() : Utils.getDefaultUserID()
                        let request = [
                            "user_id" : userID,
                            "firebase_token" : token
                        ]
                        NetworkManager.sharedManager.registerNotification(request: request, completion: { (isComplete) in
                            //
                        })
                    }                            
                    appDelegate.showLogin()
                }
            }
        }
        
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
