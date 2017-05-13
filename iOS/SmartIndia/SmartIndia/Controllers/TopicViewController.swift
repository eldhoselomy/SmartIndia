//
//  TopicViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 14/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class TopicViewController: BaseViewController {
    
    @IBOutlet weak var tableView:UITableView!
    @IBOutlet weak var noDataView:UIView!
    
    var topics:[Topic] = []
    var selectedTopic:Topic?

    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.title = "Topics"
        Utils.showProgress()
        NetworkManager.sharedManager.listTopics { (topics) in
            if let topics = topics{
                self.topics = topics
                self.tableView.reloadData()
            }
            Utils.hideProgress()
        }
    }


    
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if let topicDetailVC = segue.destination as? TopicItemViewController{
            topicDetailVC.topic = selectedTopic
            selectedTopic = nil
        }
    }
    

}

extension TopicViewController: UITableViewDataSource,UITableViewDelegate{
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        noDataView.isHidden = topics.count > 0
        return topics.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "topicCell") as! TopicTableViewCell
        cell.topic = topics[indexPath.row]
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        selectedTopic = topics[indexPath.row]
        self.performSegue(withIdentifier: "topicVC", sender: self)
    }
}
