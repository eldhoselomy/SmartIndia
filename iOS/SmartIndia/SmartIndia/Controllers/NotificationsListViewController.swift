//
//  NotificationsListViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class NotificationsListViewController: BaseViewController {

    @IBOutlet weak var tableView:UITableView!
    @IBOutlet weak var noDataView:UIView!
    
    var notifications:[Notification] = []
    var selectedNotification:Notification?
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        Utils.showProgress()
        NetworkManager.sharedManager.listNotifications { (notifications) in
            if let notifications = notifications{
                self.notifications = notifications
                self.tableView.reloadData()
            }
            Utils.hideProgress()
        }
    }
    
    override func setup() {
        super.setup()
        self.title = "Notifications"
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

extension NotificationsListViewController: UITableViewDataSource,UITableViewDelegate{
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        noDataView.isHidden = notifications.count > 0
        return notifications.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "notificationCell")
        return cell!
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        selectedNotification = notifications[indexPath.row]
        //self.performSegue(withIdentifier: "topicVC", sender: self)
    }
}
