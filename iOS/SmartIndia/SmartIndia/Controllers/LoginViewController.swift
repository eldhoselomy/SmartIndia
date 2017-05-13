//
//  LoginViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class LoginViewController: BaseViewController {

    @IBOutlet weak var usernameTextField:MaterialTextField!
    @IBOutlet weak var passwordTextField:MaterialTextField!
    @IBOutlet weak var activationView:UIView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
    
    @IBAction func login(_ sender: UIButton){
        if isValid(){
            Utils.showProgress()
            let loginRequest = LoginRequest(username: usernameTextField.text!, password: passwordTextField.text!)
            NetworkManager.sharedManager.login(request: loginRequest, completion: { (user) in
                if let user = user{
                    if user.status == 0{
                        self.showActionView()
                    }else{
                        Utils.saveUserID(id: user.id)
                        self.performSegue(withIdentifier: "homeVC", sender: self)
                        Utils.showMessage("Logined as \(user.name)")
                    }
                }
                Utils.hideProgress()
            })
        }
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
        return isValid
    }
    
    private func showActionView(){
        view.bringSubview(toFront: activationView)
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
