//
//  RegisterViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import ObjectMapper

class RegisterViewController: BaseViewController {

    @IBOutlet weak var usernameTextField:MaterialTextField!
    @IBOutlet weak var passwordTextField:MaterialTextField!
    @IBOutlet weak var nameTextField:MaterialTextField!
    @IBOutlet weak var phoneTextField:MaterialTextField!
    @IBOutlet weak var affiliateTextField:MaterialTextField!
    @IBOutlet weak var activationView:UIView!
    

    
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    

    @IBAction func login(_ sender:UIButton){
        back()
        
    }
    
    @IBAction func register(_ sender:UIButton){
        if isValid(){
            Utils.showProgress()
            NetworkManager.sharedManager.register(request: getRegisterRequest(), completion: { (user) in
                if let user = user{
                    self.registerNotifications(id: user.id)
                    self.showActionView()
                }
                Utils.hideProgress()
            })
        }
    }
    
    private func showActionView(){
        view.bringSubview(toFront: activationView)
    }
    
    override func isValid() -> Bool {
        var isValid = true
        if usernameTextField.text!.isEmail{
            usernameTextField.setError()
        }else{
            usernameTextField.setError("Please provide a valid email")
            isValid = false
        }
        if passwordTextField.text!.characters.count < 6{
            isValid = false
            passwordTextField.setError("Password strength is weak")
        }else{
            passwordTextField.setError()
        }
        if !nameTextField.text!.isEmpty{
            nameTextField.setError()
        }else{
            nameTextField.setError("Please provide a name")
            isValid = false
        }
        if !phoneTextField.text!.isEmpty{
            phoneTextField.setError()
        }else{
            phoneTextField.setError("Please provide a valid Phone")
            isValid = false
        }
        if !affiliateTextField.text!.isEmpty{
            affiliateTextField.setError()
        }else{
            affiliateTextField.setError("Please provide an affliate id")
            isValid = false
        }
        return isValid
    }
    
    private func getRegisterRequest()->[String:Any]{
        let user = User()
        user.name = nameTextField.text!
        user.email = usernameTextField.text!
        user.password = passwordTextField.text!
        user.mobile = phoneTextField.text!
        user.affiliateID = affiliateTextField.text!
        let result =  Mapper().toJSON(user)
        return result
    }
    
    func registerNotifications(id:String){
        if let token = Utils.getNotificationToken(){
            let request = [
                "user_id" : id,
                "firebase_token" : token
            ]
            NetworkManager.sharedManager.registerNotification(request: request, completion: { (isComplete) in
                Utils.showMessage("Registered for notifications")
            })
        }
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
