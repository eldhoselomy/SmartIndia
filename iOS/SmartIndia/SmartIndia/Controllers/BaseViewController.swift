//
//  BaseViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class BaseViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        setup()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    

    func setup(){
        if hasMenu(){
            
        }else{
            let backButton = UIButton(frame: CGRect(x: 4, y: 4, width: 22, height: 22))
            backButton.setImage(#imageLiteral(resourceName: "back"), for: .normal)
            backButton.tintColor = UIColor.white
            backButton.addTarget(self, action: #selector(back), for:.touchUpInside)
            let barButtonItem = UIBarButtonItem(customView: backButton)
            self.navigationItem.leftBarButtonItem = barButtonItem
        }
        
    }
    
    func isValid()->Bool{
        return true
    }
    
    func back(){
        if let navigationController = self.navigationController{
            navigationController.popViewController(animated: true)
        }else{
            self.dismiss(animated: true, completion: nil)
        }
    }
    
    func toggleMenu(){
        
    }
    
    func hasMenu()->Bool{
        return false
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
