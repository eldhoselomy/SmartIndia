//
//  CircularImageview.swift
//  Globedin
//
//  Created by Eldhose Lomy on 02/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class CircularImageview: UIImageView {
    
    @IBInspectable  var circleColor : UIColor = Color.themeColor
    
    override func layoutSubviews() {
        super.layoutSubviews()
        layer.cornerRadius = self.frame.width/2
        layer.borderWidth = 2.0
        layer.borderColor = circleColor.cgColor
        layer.masksToBounds = true
        clipsToBounds = true
    }
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
    }
    
}


class CircularButton : UIButton{
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        layer.cornerRadius = self.frame.width/2
    }
    
    override func layoutSubviews() {
        super.layoutSubviews()
        layer.cornerRadius = self.frame.width/2
    }
}
