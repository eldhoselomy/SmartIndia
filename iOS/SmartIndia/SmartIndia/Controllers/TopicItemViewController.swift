//
//  TopicItemViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class TopicItemViewController: BaseViewController {

    @IBOutlet weak var titleLabel:UILabel!
    @IBOutlet weak var textView:UITextView!
    
    var topic:Topic?
    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func setup() {
        super.setup()
        if let topic = topic{
            titleLabel.text = topic.name
            textView.text = topic.details
            self.title = topic.subject
        }
    }
    
    @IBAction func shareAction(_ sender : UIButton){
        var textToShare = ""
        if let topic = topic{
            textToShare =  topic.name + "   " + topic.details
        }
        let website = "https://innovate.mygov.in/"
        let img = #imageLiteral(resourceName: "logo")
        
        var objectsToShare = [textToShare,img] as [Any]
        if let myWebsite = URL(string: website.addingPercentEncoding(withAllowedCharacters: .urlQueryAllowed)!) {
            objectsToShare.append(myWebsite)
        }
        let activityVC = UIActivityViewController(activityItems: objectsToShare, applicationActivities: nil)
        
        activityVC.popoverPresentationController?.sourceView = self.view
        self.present(activityVC, animated: true, completion: nil)
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
