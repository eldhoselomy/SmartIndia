//
//  NotificationTableViewCell.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class NotificationTableViewCell: UITableViewCell {

    @IBOutlet weak var nameLabel:UILabel!
    @IBOutlet weak var detailsLabel:UILabel!
    var controller:UIViewController!
    
    var notification:Notification?{
        didSet{
            if let notification = notification{
                nameLabel.text = notification.title
                detailsLabel.text = notification.details
                
            }
        }
    }
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }
    
    @IBAction func openURL(_ sender:UIButton){
        if let notification = self.notification{
            if let _ = URL(string: notification.url){
                Utils.openURL(url: notification.url, title: notification.title, controller: controller)
            }
        }
    }
    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
