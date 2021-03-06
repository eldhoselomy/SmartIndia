//
//  TeamTableViewCell.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class TeamTableViewCell: UITableViewCell {

    
    @IBOutlet weak var nameLabel:UILabel!
    @IBOutlet weak var descriptionLabel:UILabel!
    @IBOutlet weak var letterButton:UIButton!
    
    var team:Team?{
        didSet{
            if let team = team{
                nameLabel.text = team.name
                descriptionLabel.text = team.status == "2" ? "Verfied | \(team.teamName)" : "Pending"
                letterButton.backgroundColor = team.status == "2" ? UIColor(red: 0, green: 0.5, blue: 0.25, alpha: 1) : letterButton.backgroundColor
                let letter = team.name.characters.first?.description ?? "T"
                letterButton.setTitle(letter, for: .normal)
            }
        }
    }
    
    override func awakeFromNib() {
        super.awakeFromNib()
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
