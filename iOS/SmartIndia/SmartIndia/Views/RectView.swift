//
//  RectView.swift
//  Globedin
//
//  Created by Eldhose Lomy on 28/01/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class RectButton: UIButton {
    
    /*
     // Only override drawRect: if you perform custom drawing.
     // An empty implementation adversely affects performance during animation.
     override func drawRect(rect: CGRect) {
     // Drawing code
     }
     */
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        layer.borderWidth = 1.0
        layer.borderColor = self.tintColor.cgColor
        clipsToBounds = true
        contentEdgeInsets = UIEdgeInsets(top: 4, left: 4, bottom: 4, right: 4)
        setTitleColor(self.tintColor!, for: UIControlState())
    }
    
}


class RectView : UIView{
    
    
    required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        layer.borderWidth = 1.0
        layer.borderColor = UIColor.lightGray.cgColor
        clipsToBounds = true
    }
    
}
