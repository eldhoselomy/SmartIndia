//
//  FeedbackViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import ObjectMapper

class FeedbackViewController: BaseViewController {
    
    @IBOutlet weak var titleTextview:UITextField!
    @IBOutlet weak var commentTextView:UITextView!
    

    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func setup() {
        super.setup()
        self.title = "Feedback"
        titleTextview.layer.borderWidth = 1.0
        titleTextview.layer.borderColor = UIColor.lightGray.cgColor
        commentTextView.layer.borderColor = UIColor.lightGray.cgColor
    }
    
    @IBAction func submitFeedback(_ sender: UIButton){
        if isValid(){
            Utils.showProgress()
            NetworkManager.sharedManager.addFeedback(request: getFeedbackRequest(), completion: { (feedback) in
                if let _ = feedback{
                    Utils.showMessage("Feedback submitted")
                    self.back()
                }
                Utils.hideProgress()
            })
        }
    }
    
    private func getFeedbackRequest()->[String:Any]{
        let feedback = Feedback()
        feedback.title = titleTextview.text!
        feedback.comment = commentTextView.text!
        feedback.type = Utils.isAdmin() ? "admin" : "team"
        feedback.userID = Utils.getDefaultUserID()
        feedback.teamID = Utils.getDefaultTeamID()
        return Mapper().toJSON(feedback)
    }
    
    override func isValid() -> Bool {
        if titleTextview.text!.isEmpty || commentTextView.text!.isEmpty{
            Utils.showMessage("All fields are mandatory")
            return false
        }
        return true
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
