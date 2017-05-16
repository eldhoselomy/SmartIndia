//
//  SwiftPicker.swift
//  Globedin
//
//  Created by Eldhose Lomy on 22/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit

protocol SwiftPickerDelegate{
    func selectedItemAtIndex(_ swiftPicker:SwiftPicker, item:String,index: Int)
}

class SwiftPicker: BaseViewController {
    
    @IBOutlet weak var tableView: UITableView!
    @IBOutlet weak var bgView: UIView!
    @IBOutlet weak var searchBar: UITextField!
    @IBOutlet weak var searchView:UIImageView!
    
    @IBOutlet weak var titleLabel: UILabel!
    var swiftPickerDelegate:SwiftPickerDelegate!
    
    var searchable = true
    var filteredResults:[String] = []
    //var data:[String:String] = [:]
    var items:[String] = [] {
        didSet{
            filteredResults = items
            if let _ = tableView{
                tableView.reloadData()
            }
        }
    }
    
    var index = 0
    var selectedItem = ""

    
    override func setup(){
        
        tableView.register(UITableViewCell.self, forCellReuseIdentifier: "cell")
        if searchable{
            titleLabel.isHidden = true
            searchBar.isHidden = false
            searchView.isHidden = false
        }else{
            
            titleLabel.isHidden = false
            searchBar.isHidden = true
            searchView.isHidden = true
        }

        tableView.reloadData()
    }
    
    @IBAction func search(_ textField:UITextField){
        filteredResults.removeAll()
        if textField.text!.isEmpty{
            filteredResults = items
        }else{
            filteredResults = items.filter({(item: String) -> Bool in
                let stringMatch = item.lowercased().range(of: textField.text!.lowercased())
                return stringMatch != nil ? true : false
            })
        }
        tableView.reloadData()
    }
    
    @IBAction func dismiss(_ sender:UIButton){
        if searchBar != nil{
            searchBar.text = ""
        }
        self.dismiss(animated: true, completion: { () -> Void in
            self.swiftPickerDelegate?.selectedItemAtIndex(self, item: self.selectedItem, index: self.index)
        })
    }
    
}


extension SwiftPicker : UITableViewDataSource,UITableViewDelegate{
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return filteredResults.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "cell")!
        cell.textLabel?.text = self.filteredResults[indexPath.row]
        cell.textLabel?.font = UIFont.systemFont(ofSize: 11)//UIFont(name: "Open Sans", size: 11)
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let selectedItem = filteredResults[indexPath.row]
        for (index,item) in items.enumerated(){
            if selectedItem == item{
                if searchBar != nil{
                    searchBar.text = ""
                }
                self.selectedItem = selectedItem
                self.index = index
                
                return
            }
        }
    }
    
}



