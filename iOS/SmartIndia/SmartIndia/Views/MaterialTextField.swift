//
//  MaterialTextField.swift
//  Globedin
//
//  Created by Eldhose Lomy on 27/01/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import MaterialKit


class MaterialTextField: MKTextField {
    
    var paddingLeft : CGFloat = 4
    
    @IBInspectable internal var hasLeftDrawable:Bool = false
    @IBInspectable internal var leftDrawable:UIImage!{
        didSet{
            if let leftImageView = imageView{
                leftImageView.image = leftDrawable
            }
        }
    }
    
    
    
    var errorLabel:UILabel!
    fileprivate var imageView:UIImageView!
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        setup()
        //self.placeHolderColor = UIColor.lightGray
        //self.selectedPlaceHolderColor = self.tintColor
        self.floatingPlaceholderEnabled = true
        self.floatingLabelFont = UIFont.systemFont(ofSize: 9)
        self.rippleEnabled = false
        self.layer.borderColor = UIColor.clear.cgColor
        self.borderStyle = .none
        self.bottomBorderColor = UIColor.white
        
        let str = NSAttributedString(string: self.placeholder ?? "", attributes: [NSForegroundColorAttributeName:UIColor.white])
        self.attributedPlaceholder = str
        
    }
    
    fileprivate func setup(){
        if hasLeftDrawable{
            self.paddingLeft = 30
            let left:CGFloat = hasLeftDrawable ?  25 : -5
            let frame = CGRect(x: 5,y: (self.frame.height-left)/2, width: left, height: left)
            imageView = UIImageView(frame: frame)
            self.leftView = imageView
            leftViewMode = UITextFieldViewMode.always
            //image color
            imageView.tintColor = UIColor.groupTableViewBackground
            imageView.image = leftDrawable
            imageView.contentMode = .scaleAspectFit
            
        }
        
        let view = self.superview ?? self
        errorLabel = UILabel()
        errorLabel.text = ""
        view.addSubview(errorLabel)
        errorLabel.translatesAutoresizingMaskIntoConstraints = false
        errorLabel.textAlignment = .left
        errorLabel.font =  UIFont.systemFont(ofSize: 9)//UIFont(name: "Open Sans", size: 9)
        errorLabel.textColor = UIColor.red
        var constraints:[NSLayoutConstraint] = []
        //Bottom space to searchView
        
        constraints.append(NSLayoutConstraint(item: errorLabel, attribute: NSLayoutAttribute.top, relatedBy: NSLayoutRelation.equal, toItem: self, attribute: NSLayoutAttribute.bottom, multiplier: 1, constant: 2))
        
        // leading space
        constraints.append(NSLayoutConstraint(item: errorLabel, attribute: NSLayoutAttribute.leading, relatedBy: NSLayoutRelation.equal, toItem: self, attribute: NSLayoutAttribute.leading, multiplier: 1, constant: 2))
        // trailing space
        constraints.append(NSLayoutConstraint(item: errorLabel!, attribute: NSLayoutAttribute.trailing, relatedBy: NSLayoutRelation.equal, toItem: self, attribute: NSLayoutAttribute.trailing, multiplier: 1, constant: 2))
        view.addConstraints(constraints)
    }
    
    internal func setError(_ message:String = ""){
        errorLabel.text = message
    }
    
    
    
    
}
