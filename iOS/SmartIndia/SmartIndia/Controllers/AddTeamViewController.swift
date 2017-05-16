//
//  AddTeamViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class AddTeamViewController: BaseViewController {
    
    
    @IBOutlet weak var teamNameTextField:Textfield!
    

    override func viewDidLoad() {
        super.viewDidLoad()
        self.title = "Add Team"
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    @IBAction func addTeam(_ sender:UIButton){
        if isValid(){
            let request = ["user_id": Utils.getDefaultUserID(),
                           "name": teamNameTextField.text!,
                           "team_name" : "default team name"]
            Utils.showProgress()
            NetworkManager.sharedManager.addTeam(request: request, completion: { (team) in
                Utils.hideProgress()
                if let _ = team{
                    Utils.showMessage("Team created")
                }
                self.back()
            })
        }
    }
    
    override func isValid() -> Bool {
        var isValid = true
        if teamNameTextField.text!.isEmpty{
            Utils.showMessage("Please provide a team name")
            isValid = false
        }
        return isValid
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
