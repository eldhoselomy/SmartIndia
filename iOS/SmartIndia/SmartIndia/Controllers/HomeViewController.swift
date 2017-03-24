//
//  HomeViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 24/03/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class HomeViewController: BaseViewController {
    
    @IBOutlet weak var topicView:UIView!
    @IBOutlet weak var ideaView:UIView!
    @IBOutlet weak var notificationView:UIView!
    @IBOutlet weak var feedbackView:UIView!
    @IBOutlet weak var settingsView:UIView!
    @IBOutlet weak var logoutView:UIView!

    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    override func setup() {
        super.setup()
        let views = [topicView,ideaView,notificationView,feedbackView,settingsView,logoutView]
        
        
        for view in views{
            let tap = UITapGestureRecognizer(target: self, action: #selector(self.handleTap(_:)))
            for subview in view!.subviews{
                subview.isUserInteractionEnabled = false
            }
            view?.isUserInteractionEnabled = true
            view?.addGestureRecognizer(tap)
        }
    }
    
    func handleTap(_ sender:UITapGestureRecognizer){
        if let view  = sender.view{
            switch view.tag {
            case 1:
                self.performSegue(withIdentifier: "teamVC", sender: self)
                break
            default:
                break
            }
        }
    }
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
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
