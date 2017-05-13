//
//  MemberListViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 13/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class MemberListViewController: BaseViewController {

    @IBOutlet weak var tableView:UITableView!
    @IBOutlet weak var noDataView:UIView!
    @IBOutlet weak var proceedView:UIView!
    
    var team:Team?
    var members:[Member] = []
    var selectedMember:Member?
    
    override func viewDidLoad() {
        super.viewDidLoad()
  
    }

    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        Utils.showProgress()
        let request = ["team_id" : team?.id ?? ""]
        NetworkManager.sharedManager.listMembers(request: request) { (members) in
            if let members = members{
                self.members = members
                self.tableView.reloadData()
                if self.members.count > 4{
                    self.navigationItem.rightBarButtonItem = nil
                }
                if let team = self.team{
                    self.proceedView.isHidden = !(team.status == "0" && self.members.count == 5)
                }
            }
            Utils.hideProgress()
        }
        
    }
    
    override func setup() {
        super.setup()
        self.title = "Members"
        setupAddButton()
    }
    
    private func setupAddButton(){
        let button = UIButton(frame: CGRect(x: 0, y: 0, width: 32, height: 32))
        button.addTarget(self, action: #selector(addMember), for: .touchUpInside)
        button.tintColor = UIColor.white
        button.setImage(#imageLiteral(resourceName: "add"), for: .normal)
        let barButtonItem = UIBarButtonItem(customView: button)
        self.navigationItem.rightBarButtonItem = barButtonItem
    }
    
    func addMember(){
        print("add Member")
        self.performSegue(withIdentifier: "profileVC", sender: self)
    }

    
    @IBAction func proceed(_ sender : UIButton){
        
    }
    
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if let memberVC = segue.destination as? MemberViewController{
            memberVC.team = team
            memberVC.member = selectedMember
            selectedMember = nil
        }
    }
    

}

extension MemberListViewController :  UITableViewDataSource, UITableViewDelegate{
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        noDataView.isHidden = members.count > 0
        return members.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "memberCell") as! MemberTableViewCell
        cell.member = members[indexPath.row]
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        selectedMember = members[indexPath.row]
        self.performSegue(withIdentifier: "profileVC", sender: self)
    }
}
