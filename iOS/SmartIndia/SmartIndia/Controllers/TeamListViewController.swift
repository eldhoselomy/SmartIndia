//
//  TeamListViewController.swift
//  SmartIndia
//
//  Created by Eldhose Lomy on 24/03/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

class TeamListViewController: BaseViewController {
    
    @IBOutlet weak var tableView:UITableView!
    @IBOutlet weak var noDataView:UIView!
    
    var teams:[Team] = []
    var selectedTeam:Team?
    
    override func viewDidLoad() {
        super.viewDidLoad()

    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        let request = [
            "user_id" : Utils.getDefaultUserID(),
            "team_id" : Utils.getDefaultTeamID()
        ]
        Utils.showProgress()
        NetworkManager.sharedManager.listTeam(request: request) { (teams) in
            if let teams = teams{
                self.teams = teams
                if self.teams.count > 2 || (!Utils.isAdmin()){
                    self.navigationItem.rightBarButtonItem = nil
                }
                self.tableView.reloadData()
            }
            Utils.hideProgress()
        }
    }
    
    
    override func setup() {
        super.setup()
        setupAddButton()
        self.title = "Teams"
        
        
    }
    
    private func setupAddButton(){
        let button = UIButton(frame: CGRect(x: 0, y: 0, width: 32, height: 32))
        button.addTarget(self, action: #selector(addTeam), for: .touchUpInside)
        button.tintColor = UIColor.white
        button.setImage(#imageLiteral(resourceName: "add"), for: .normal)
        let barButtonItem = UIBarButtonItem(customView: button)
        self.navigationItem.rightBarButtonItem = barButtonItem
    }
    
    func addTeam(){
        print("add team")
        self.performSegue(withIdentifier: "addTeamVC", sender: self)
    }

    
    @IBAction func showTeamList(_ segue:UIStoryboardSegue) {
        
    }
    
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if let memberVC = segue.destination as? MemberListViewController{
            memberVC.team = selectedTeam
            selectedTeam = nil
        }
    }
    

}

extension TeamListViewController : UITableViewDataSource, UITableViewDelegate{
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        noDataView.isHidden = teams.count > 0
        return teams.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "teamCell") as! TeamTableViewCell
        cell.team = teams[indexPath.row]
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        selectedTeam = teams[indexPath.row]
        self.performSegue(withIdentifier: "memberVC", sender: self)
    }
}
