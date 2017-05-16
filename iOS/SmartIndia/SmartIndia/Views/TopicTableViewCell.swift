//
//  TopicTableViewCell.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class TopicTableViewCell: UITableViewCell {

    
    @IBOutlet weak var nameLabel:UILabel!
    @IBOutlet weak var detailsLabel:UILabel!
    
    var topic:Topic?{
        didSet{
            if let topic = topic{
                nameLabel.text = topic.name
                detailsLabel.text = (topic.details.htmlAttributedString?.string) ?? topic.details
                
            }
        }
    }
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
