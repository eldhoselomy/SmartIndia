//
//  SaveTeamViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class SaveTeamViewController: BaseViewController {

    @IBOutlet weak var topicTextField:Textfield!
    @IBOutlet weak var topicPlaceHolder:UIView!
    @IBOutlet weak var nameTextField:Textfield!
    @IBOutlet weak var passwordTextField:Textfield!
    
    var team:Team?
    var topics:[Topic] = []
    var data:[String] = []
    var swiftPicker:SwiftPicker!
    var selectedTopic:Topic?

    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func setup() {
        super.setup()
        self.title = "Save Team"
        Utils.showProgress()
        NetworkManager.sharedManager.listTopics { (topics) in
            if let topics = topics{
                self.topics = topics
                for topic in topics{
                    self.data.append(topic.name)
                }
            }
            Utils.hideProgress()
        }
        
        let tap  = UITapGestureRecognizer(target: self, action: #selector(selectTopic))
        topicPlaceHolder.isUserInteractionEnabled = true
        topicPlaceHolder.addGestureRecognizer(tap)
        swiftPicker = Constants.kStoryboard.instantiateViewController(withIdentifier: "SwiftPicker") as? SwiftPicker
        swiftPicker.swiftPickerDelegate = self
        
    }
    
    func selectTopic(){
        swiftPicker.items = data
        self.present(swiftPicker, animated: true, completion: nil)
    }
    
    func getRequest()->[String:String]{
        let param = [
                    "team_id" : team?.id ?? "",
                     "team_name" : nameTextField.text!.lowercased(),
                     "team_token" : passwordTextField.text!,
                     "topic_id" : selectedTopic?.id ?? ""
        ]
        
        return param
    }
    
    @IBAction func saveTeam(_ sender:UIButton){
        if isValid(){
            Utils.showProgress()
            NetworkManager.sharedManager.saveTeam(request: getRequest(), completion: { (team) in
                if let _ = team{
                    Utils.showMessage("Team Details saved")
                    self.performSegue(withIdentifier: "BackToTeams", sender: self)
                }
                Utils.hideProgress()
            })
        }
    }
    
    
    
    
    override func isValid() -> Bool {
        if selectedTopic == nil{
            Utils.showMessage("Please choose a topic")
            return false
        }
        if nameTextField.text!.isEmpty{
            Utils.showMessage("Please provide a team name")
            return false
        }else{
            if !nameTextField.text!.lowercased().hasPrefix("team"){
                Utils.showMessage("team name shound start with 'team' prefix")
                return false
            }
        }
        if passwordTextField.text!.characters.count < 6{
            Utils.showMessage("Password strength is weak")
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

extension SaveTeamViewController : SwiftPickerDelegate{
    func selectedItemAtIndex(_ swiftPicker: SwiftPicker, item: String, index: Int) {
        if index < topics.count{
            topicTextField.text = item
            selectedTopic = topics[index]
        }
        
    }
}
