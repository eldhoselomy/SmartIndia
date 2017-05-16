//
//  WebViewController.swift
//  Globedin
//
//  Created by Eldhose Lomy on 01/05/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import UIKit
import WebKit

class WebViewController: BaseViewController {
    
    var webView:WKWebView!
    var urlString = ""
    var titleString = "About us"
    @IBOutlet weak var errorView:UIView!
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        self.title = titleString
        setupView()
    }

    override func loadView() {
        super.loadView()
        let config = WKWebViewConfiguration()
        webView = WKWebView(
            frame: CGRect(x: 0, y: 0, width: self.view.frame.width, height: self.view.frame.height),
            configuration: config
        )
        self.view.addSubview(webView!)
    }
    
    private func setupView(){
        guard !urlString.isEmpty else{
            view.bringSubview(toFront: errorView)
            errorView.isHidden = false
            return
        }
        Utils.showProgress()
        webView.navigationDelegate = self
        
        urlString = urlString.addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed) ?? urlString
        print(urlString)
        if let url = URL(string: urlString){
            let request = URLRequest(url: url)
            guard Utils.isNetworkReachable() else {
                view.bringSubview(toFront: errorView)
                errorView.isHidden = false
                Utils.showMessage("No internet")
                Utils.hideProgress()
                return
            }
            webView.load(request)
        }else{
            view.bringSubview(toFront: errorView)
            errorView.isHidden = false
            Utils.hideProgress()
        }
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
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

extension WebViewController : WKNavigationDelegate{
    func webView(_ webView: WKWebView, didFinish navigation: WKNavigation!){
        Utils.hideProgress()
    }
    
    func webView(_ webView: WKWebView, decidePolicyFor navigationResponse: WKNavigationResponse, decisionHandler: @escaping (WKNavigationResponsePolicy) -> Swift.Void){
        if navigationResponse.response.isKind(of: HTTPURLResponse.self){
            if let response = navigationResponse.response as? HTTPURLResponse, (response.statusCode >= 300){
                view.bringSubview(toFront: errorView)
                errorView.isHidden = false
                Utils.hideProgress()
            }
            
        }
        decisionHandler(WKNavigationResponsePolicy.allow)
    }
    
}
