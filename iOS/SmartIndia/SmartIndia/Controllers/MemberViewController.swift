//
//  MemberViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import ObjectMapper

class MemberViewController: BaseViewController {
    
    @IBOutlet weak var nameTextField:Textfield!
    @IBOutlet weak var emailTextField:Textfield!
    @IBOutlet weak var phoneTextField:Textfield!
    @IBOutlet weak var dobTextField:Textfield!
    @IBOutlet weak var genderTextField:Textfield!
    @IBOutlet weak var departmentTextField:Textfield!
    @IBOutlet weak var semesterTextField:Textfield!
    @IBOutlet weak var registerNumberTextField:Textfield!
    @IBOutlet weak var teamNameLabel:UILabel!
    @IBOutlet weak var saveButton:UIButton!
    @IBOutlet weak var profileImage:UIImageView!
    @IBOutlet weak var profileBackground:UIImageView!
    
    var team:Team?
    var member:Member?
    var isEdit = false
    var textFields:[Textfield] =  []

    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func setup() {
        super.setup()
        self.title = "Profile"
        textFields =  [nameTextField,emailTextField,phoneTextField,dobTextField,genderTextField,departmentTextField,semesterTextField,registerNumberTextField]
        if let team = team{
            teamNameLabel.text = team.name
        }
        if let member = member{
            nameTextField.text = member.name
            emailTextField.text = member.email
            phoneTextField.text = member.phone
            dobTextField.text = member.dob
            genderTextField.text = member.getGender
            departmentTextField.text = member.department
            semesterTextField.text = member.semester
            registerNumberTextField.text = member.registerNumber
            enableEdit(editable: false)
            saveButton.isHidden = true
        }
    }
    
    func enableEdit(editable:Bool){
        let title = editable ? "Save" : "Edit"
        saveButton.setTitle(title, for: .normal)
        for view in textFields{
            view.isEnabled = editable
        }
    }
    
    @IBAction func saveAction(_ sender: UIButton){
        if isValid(){
            Utils.showProgress()
            NetworkManager.sharedManager.addMember(request: getMemberRequest(), completion: { (member) in
                if let _ = member{
                    Utils.showMessage("Member saved")
                    self.back()
                }
                Utils.hideProgress()
            })
        }
    }
    
    override func isValid() -> Bool {
        for view in textFields{
            if view.text!.isEmpty{
                Utils.showMessage("All fields are mandatory...")
                return false
            }
        }
        return true
    }
    
    private func getMemberRequest()->[String:Any]{
        let member = Member()
        member.teamID = team?.id ?? ""
        member.name = nameTextField.text!
        member.email = emailTextField.text!
        member.phone = phoneTextField.text!
        member.dob = dobTextField.text!
        member.sex = genderTextField.text!.uppercased() == "MALE" ? "1" : "0"
        member.department = departmentTextField.text!
        member.semester = semesterTextField.text!
        member.registerNumber = registerNumberTextField.text!
        let result =  Mapper().toJSON(member)
        return result
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
