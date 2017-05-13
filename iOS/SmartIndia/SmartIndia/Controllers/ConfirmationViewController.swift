//
//  ConfirmationViewController.swift
//  Globedin
//
//  Created by Eldhose Lomy on 23/04/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class ConfimationViewController: UIViewController {
    
    var titleString = ""
    var message = ""
    var submitTitle = "Ok"
    var cancelTitle = "Cancel"
    var completion: ((_ isCancelled: Bool) -> Void)?
    
    @IBOutlet weak var titleLabel:UILabel!
    @IBOutlet weak var contentText:UITextView!
    @IBOutlet weak var submit:UIButton!
    @IBOutlet weak var cancel:UIButton!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        titleLabel.text = titleString
        contentText.text = message
        submit.setTitle(submitTitle, for: UIControlState())
        cancel.setTitle(cancelTitle, for: UIControlState())
        
    }
    
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    
    @IBAction func submit(_ sender:UIButton){
        if let completionHandler = completion{
            self.dismiss(animated: true, completion: {
                completionHandler(false)
            })
        }
    }
    
    @IBAction func cancel(_ sender:UIButton){
        if let completionHandler = completion{
            self.dismiss(animated: true, completion: {
                completionHandler(true)
            })
        }
    }
    
    /*
     // MARK: - Navigation
     
     // In a storyboard-based application, you will often want to do a little preparation before navigation
     override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
     // Get the new view controller using segue.destinationViewController.
     // Pass the selected object to the new view controller.
     }
     */
    
}
