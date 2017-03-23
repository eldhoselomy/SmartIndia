//
//  CountryManager.swift
//  Globedin
//
//  Created by Eldhose Lomy on 22/02/17.
//  Copyright © 2017 Eldhose Lomy. All rights reserved.
//

import Foundation

class CountryManager{
    
    static let sharedInstance = getInstance()
    
    fileprivate init(){
        
    }
    fileprivate static func getInstance()->CountryManager{
        return CountryManager()
    }
    
    internal  func getCountryNames()->[String]{
        var data:[String] = []
        for country in countryList{
            data.append(country.key)
        }
        return data
    }
    
    //Check for country name
    //if not found returns nilß
    internal func getCountryCode(name:String)->String?{
        return countryList[name]
    }
    
    
    // Country code
    fileprivate let countryList = [
        
        "Afghanistan":"+93",
        "Aland Islands":"+358",
        "Albania":"+355",
        "Algeria":"+213",
        "American Samoa":"+1",
        "Andorra":"+376",
        "Angola":"+244",
        "Anguilla":"+1",
        "Antarctica":"+672",
        "Antigua and Barbuda":"+1",
        "Argentina":"+54",
        "Armenia":"+374",
        "Aruba":"+297",
        "Australia":"+61",
        "Austria":"+43",
        "Azerbaijan":"+994",
        "Bahamas":"+1",
        "Bahrain":"+973",
        "Bangladesh":"+880",
        "Barbados":"+1",
        "Belarus":"+375",
        "Belgium":"+32",
        "Belize":"+501",
        "Benin":"+229",
        "Bermuda":"+1",
        "Bhutan":"+975",
        "Bolivia":"+591",
        "Bosnia and Herzegovina":"+387",
        "Botswana":"+267",
        "Bouvet Island":"+47",
        "BQ":"+599",
        "Brazil":"+55",
        "British Indian Ocean Territory":"+246",
        "British Virgin Islands":"+1",
        "Brunei Darussalam":"+673",
        "Bulgaria":"+359",
        "Burkina Faso":"+226",
        "Burundi":"+257",
        "Cambodia":"+855",
        "Cameroon":"+237",
        "Canada":"+1",
        "Cape Verde":"+238",
        "Cayman Islands":"+345",
        "Central African Republic":"+236",
        "Chad":"+235",
        "Chile":"+56",
        "China":"+86",
        "Christmas Island":"+61",
        "Cocos (Keeling) Islands":"+61",
        "Colombia":"+57",
        "Comoros":"+269",
        "Congo (Brazzaville)":"+242",
        "Congo: Democratic Republic of the":"+243",
        "Cook Islands":"+682",
        "Costa Rica":"+506",
        "Côte d'Ivoire":"+225",
        "Croatia":"+385",
        "Cuba":"+53",
        "Curacao":"+599",
        "Cyprus":"+537",
        "Czech Republic":"+420",
        "Denmark":"+45",
        "Djibouti":"+253",
        "Dominica":"+1",
        "Dominican Republic":"+1",
        "Ecuador":"+593",
        "Egypt":"+20",
        "El Salvador":"+503",
        "Equatorial Guinea":"+240",
        "Eritrea":"+291",
        "Estonia":"+372",
        "Ethiopia":"+251",
        "Falkland Islands (Malvinas)":"+500",
        "Faroe Islands":"+298",
        "Fiji":"+679",
        "Finland":"+358",
        "France":"+33",
        "French Guiana":"+594",
        "French Polynesia":"+689",
        "French Southern Territories":"+689",
        "Gabon":"+241",
        "Gambia":"+220",
        "Georgia":"+995",
        "Germany":"+49",
        "Ghana":"+233",
        "Gibraltar":"+350",
        "Greece":"+30",
        "Greenland":"+299",
        "Grenada":"+1",
        "Guadeloupe":"+590",
        "Guam":"+1",
        "Guatemala":"+502",
        "Guernsey":"+44",
        "Guinea":"+224",
        "Guinea-Bissau":"+245",
        "Guyana":"+595",
        "Haiti":"+509",
        "Holy See (Vatican City State)":"+379",
        "Honduras":"+504",
        "Hong Kong: Special Administrative Region of China":"+852",
        "Hungary":"+36",
        "Iceland":"+354",
        "India":"+91",
        "Indonesia":"+62",
        "Iran: Islamic Republic of":"+98",
        "Iraq":"+964",
        "Ireland":"+353",
        "Isle of Man":"+44",
        "Israel":"+972",
        "Italy":"+39",
        "Jamaica":"+1",
        "Japan":"+81",
        "Jersey":"+44",
        "Jordan":"+962",
        "Kazakhstan":"+77",
        "Kenya":"+254",
        "Kiribati":"+686",
        "Korea: Democratic People's Republic of":"+850",
        "Korea: Republic of":"+82",
        "Kuwait":"+965",
        "Kyrgyzstan":"+996",
        "Lao PDR":"+856",
        "Latvia":"+371",
        "Lebanon":"+961",
        "Lesotho":"+266",
        "Liberia":"+231",
        "Libya":"+218",
        "Liechtenstein":"+423",
        "Lithuania":"+370",
        "Luxembourg":"+352",
        "Macao: Special Administrative Region of China":"+853",
        "Macedonia: Republic of":"+389",
        "Madagascar":"+261",
        "Malawi":"+265",
        "Malaysia":"+60",
        "Maldives":"+960",
        "Mali":"+223",
        "Malta":"+356",
        "Marshall Islands":"+692",
        "Martinique":"+596",
        "Mauritania":"+222",
        "Mauritius":"+230",
        "Mayotte":"+262",
        "Mexico":"+52",
        "Micronesia: Federated States of":"+691",
        "Moldova":"+373",
        "Monaco":"+377",
        "Mongolia":"+976",
        "Montenegro":"+382",
        "Montserrat":"+1",
        "Morocco":"+212",
        "Mozambique":"+258",
        "Myanmar":"+95",
        "Namibia":"+264",
        "Nauru":"+674",
        "Nepal":"+977",
        "Netherlands":"+31",
        "Netherlands Antilles":"+599",
        "New Caledonia":"+687",
        "New Zealand":"+64",
        "Nicaragua":"+505",
        "Niger":"+227",
        "Nigeria":"+234",
        "Niue":"+683",
        "Norfolk Island":"+672",
        "Northern Mariana Islands":"+1",
        "Norway":"+47",
        "Oman":"+968",
        "Pakistan":"+92",
        "Palau":"+680",
        "Palestinian Territory: Occupied":"+970",
        "Panama":"+507",
        "Papua New Guinea":"+675",
        "Paraguay":"+595",
        "Peru":"+51",
        "Philippines":"+63",
        "Pitcairn":"+872",
        "Poland":"+48",
        "Portugal":"+351",
        "Puerto Rico":"+1",
        "Qatar":"+974",
        "Réunion":"+262",
        "Romania":"+40",
        "Russian Federation":"+7",
        "Rwanda":"+250",
        "Saint Helena":"+290",
        "Saint Kitts and Nevis":"+1",
        "Saint Lucia":"+1",
        "Saint Pierre and Miquelon":"+508",
        "Saint Vincent and Grenadines":"+1",
        "Saint-Barthélemy":"+590",
        "Saint-Martin (French part)":"+590",
        "Samoa":"+685",
        "San Marino":"+378",
        "Sao Tome and Principe":"+239",
        "Saudi Arabia":"+966",
        "Senegal":"+221",
        "Serbia":"+381",
        "Seychelles":"+248",
        "Sierra Leone":"+232",
        "Singapore":"+65",
        "Sint Maarten":"+1",
        "Slovakia":"+421",
        "Slovenia":"+386",
        "Solomon Islands":"+677",
        "Somalia":"+252",
        "South Africa":"+27",
        "South Georgia and the South Sandwich Islands":"+500",
        "South Sudan":"+211",
        "Spain":"+34",
        "Sri Lanka":"+94",
        "Sudan":"+249",
        "Suriname":"+597",
        "Svalbard and Jan Mayen Islands":"+47",
        "Swaziland":"+268",
        "Sweden":"+46",
        "Switzerland":"+41",
        "Syrian Arab Republic (Syria)":"+963",
        "Taiwan: Republic of China":"+886",
        "Tajikistan":"+992",
        "Tanzania: United Republic of":"+255",
        "Thailand":"+66",
        "Timor-Leste":"+670",
        "Togo":"+228",
        "Tokelau":"+690",
        "Tonga":"+676",
        "Trinidad and Tobago":"+1",
        "Tunisia":"+216",
        "Turkey":"+90",
        "Turkmenistan":"+993",
        "Turks and Caicos Islands":"+1",
        "Tuvalu":"+688",
        "Uganda":"+256",
        "Ukraine":"+380",
        "United Arab Emirates":"+971",
        "United Kingdom":"+44",
        "United States of America":"+1",
        "Uruguay":"+598",
        "Uzbekistan":"+998",
        "Vanuatu":"+678",
        "Venezuela (Bolivarian Republic of)":"+58",
        "Viet Nam":"+84",
        "Virgin Islands: US":"+1",
        "Wallis and Futuna Islands":"+681",
        "Western Sahara":"+212",
        "Yemen":"+967",
        "Zambia":"+260",
        "Zimbabwe":"+263"
    ]

}
