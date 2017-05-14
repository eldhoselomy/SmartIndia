//
//  SettingsTableViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class SettingsTableViewController: UITableViewController {

    @IBOutlet weak var name:UILabel!
    @IBOutlet weak var email:UILabel!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        self.title = "Settings"
        let backButton = UIButton(frame: CGRect(x: 4, y: 4, width: 22, height: 22))
        backButton.setImage(#imageLiteral(resourceName: "back"), for: .normal)
        backButton.tintColor = UIColor.white
        backButton.addTarget(self, action: #selector(back), for:.touchUpInside)
        let barButtonItem = UIBarButtonItem(customView: backButton)
        self.navigationItem.leftBarButtonItem = barButtonItem
        let user = Utils.getUser()
        name.text = user.name
        email.text = user.email
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    func back(){
        if let navigationController = self.navigationController{
            navigationController.popViewController(animated: true)
        }else{
            self.dismiss(animated: true, completion: nil)
        }
    }


    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if indexPath.section == 0{
            return
        }
        switch(indexPath.row){
        case 0:
            print("about")
            Utils.openURL(url: "https://www.mygov.in/overview/", title: "About", controller: self)
        case 1:
            if let url = URL(string: "https://innovate.mygov.in/"){
                if UIApplication.shared.canOpenURL(url){
                    UIApplication.shared.openURL(url)
                }
            }
        default:
            break
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
