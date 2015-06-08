<html>
  <head>
    <title>Edit Data</title>
    <meta content="">
    <link rel="stylesheet" href="dbproject.css" title="dbproject" />
    <style>
        body { 
            background-color: green; 
            background-image:url(images/upfeathers.png); 
            background-repeat: repeat;
        }
    </style>
    <script>
        function setGender(inid)
        {
            if(inid=='genderm')
            {
                document.getElementById('genderm').value='true';
                document.getElementById('genderm').checked = true;
                document.getElementById('genderf').value='false';
                document.getElementById('genderf').checked = false;
            }
            else
            {
                document.getElementById('genderm').value='false';
                document.getElementById('genderm').checked = false;
                document.getElementById('genderf').value='true';
                document.getElementById('genderf').checked = true;
            }
        }
    </script>
  </head>
  <body>


<?php
// Verbindungsaufbau und Auswahl der Datenbank

$dbconn = pg_connect("host=localhost dbname=postgres user=wlehner password=earoophojaej port=10000")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());

//echo "Verbindung geöffnet";
$ssn = "1010100272";

$ssnq = "'" . $ssn ."';";

// Read Information about Person
$query = 'SELECT * FROM "Person" WHERE ssn = ' . $ssnq;

$result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());

$rows = pg_num_rows($result);

if ($rows == "0")
{
	echo "<h1>Fehler im System: Die Angegebene Person wurde nicht gefunden!!!</h1>";
}
else{

	// echo $rows;
	// Ergebnisse in HTML ausgeben
	//echo "<table>\n";
	$line = pg_fetch_array($result, NULL, PGSQL_ASSOC);
	

	$title = $line["title"];
	
  	$birthday = $line["birthday"];
  	
  	$gender = $line["gender"];
	
  	$firstname = $line["firstname"];
  	
  	$familyname = $line["familyname"];
  	
  	$streetnumber = $line["streetnumber"];
  	
  	$streetname = $line["streetname"];
  	
  	$town = $line["town"];
  	
  	$postalcode = $line["postalcode"];
  	
  	$nation = $line["nation"];

}
// Speicher freigeben
pg_free_result($result);

// Verbindung schließen
pg_close($dbconn);

// Erstellen der Liste für die Länderauswahl
$countryList = array(
"Afghanistan",
"Albania",
"Algeria",
"American Samoa",
"Andorra",
"Angola",
"Anguilla",
"Antarctica",
"Antigua and Barbuda",
"Argentina",
"Armenia",
"Aruba",
"Australia",
"Austria",
"Azerbaijan",
"Bahamas",
"Bahrain",
"Bangladesh",
"Barbados",
"Belarus",
"Belgium",
"Belize",
"Benin",
"Bermuda",
"Bhutan",
"Bolivia",
"Bosnia and Herzegovina",
"Botswana",
"Bouvet Island",
"Brazil",
"British Antarctic Territory",
"British Indian Ocean Territory",
"British Virgin Islands",
"Brunei",
"Bulgaria",
"Burkina Faso",
"Burundi",
"Cambodia",
"Cameroon",
"Canada",
"Canton and Enderbury Islands",
"Cape Verde",
"Cayman Islands",
"Central African Republic",
"Chad",
"Chile",
"China",
"Christmas Island",
"Cocos [Keeling] Islands",
"Colombia",
"Comoros",
"Congo - Brazzaville",
"Congo - Kinshasa",
"Cook Islands",
"Costa Rica",
"Croatia",
"Cuba",
"Cyprus",
"Czech Republic",
"Côte d’Ivoire",
"Denmark",
"Djibouti",
"Dominica",
"Dominican Republic",
"Dronning Maud Land",
"East Germany",
"Ecuador",
"Egypt",
"El Salvador",
"Equatorial Guinea",
"Eritrea",
"Estonia",
"Ethiopia",
"Falkland Islands",
"Faroe Islands",
"Fiji",
"Finland",
"France",
"French Guiana",
"French Polynesia",
"French Southern Territories",
"French Southern and Antarctic Territories",
"Gabon",
"Gambia",
"Georgia",
"Germany",
"Ghana",
"Gibraltar",
"Greece",
"Greenland",
"Grenada",
"Guadeloupe",
"Guam",
"Guatemala",
"Guernsey",
"Guinea",
"Guinea-Bissau",
"Guyana",
"Haiti",
"Heard Island and McDonald Islands",
"Honduras",
"Hong Kong SAR China",
"Hungary",
"Iceland",
"India",
"Indonesia",
"Iran",
"Iraq",
"Ireland",
"Isle of Man",
"Israel",
"Italy",
"Jamaica",
"Japan",
"Jersey",
"Johnston Island",
"Jordan",
"Kazakhstan",
"Kenya",
"Kiribati",
"Kuwait",
"Kyrgyzstan",
"Laos",
"Latvia",
"Lebanon",
"Lesotho",
"Liberia",
"Libya",
"Liechtenstein",
"Lithuania",
"Luxembourg",
"Macau SAR China",
"Macedonia",
"Madagascar",
"Malawi",
"Malaysia",
"Maldives",
"Mali",
"Malta",
"Marshall Islands",
"Martinique",
"Mauritania",
"Mauritius",
"Mayotte",
"Metropolitan France",
"Mexico",
"Micronesia",
"Midway Islands",
"Moldova",
"Monaco",
"Mongolia",
"Montenegro",
"Montserrat",
"Morocco",
"Mozambique",
"Myanmar [Burma]",
"Namibia",
"Nauru",
"Nepal",
"Netherlands",
"Netherlands Antilles",
"Neutral Zone",
"New Caledonia",
"New Zealand",
"Nicaragua",
"Niger",
"Nigeria",
"Niue",
"Norfolk Island",
"North Korea",
"North Vietnam",
"Northern Mariana Islands",
"Norway",
"Oman",
"Pacific Islands Trust Territory",
"Pakistan",
"Palau",
"Palestinian Territories",
"Panama",
"Panama Canal Zone",
"Papua New Guinea",
"Paraguay",
"People's Democratic Republic of Yemen",
"Peru",
"Philippines",
"Pitcairn Islands",
"Poland",
"Portugal",
"Puerto Rico",
"Qatar",
"Romania",
"Russia",
"Rwanda",
"Réunion",
"Saint Barthélemy",
"Saint Helena",
"Saint Kitts and Nevis",
"Saint Lucia",
"Saint Martin",
"Saint Pierre and Miquelon",
"Saint Vincent and the Grenadines",
"Samoa",
"San Marino",
"Saudi Arabia",
"Senegal",
"Serbia",
"Serbia and Montenegro",
"Seychelles",
"Sierra Leone",
"Singapore",
"Slovakia",
"Slovenia",
"Solomon Islands",
"Somalia",
"South Africa",
"South Georgia and the South Sandwich Islands",
"South Korea",
"Spain",
"Sri Lanka",
"Sudan",
"Suriname",
"Svalbard and Jan Mayen",
"Swaziland",
"Sweden",
"Switzerland",
"Syria",
"São Tomé and Príncipe",
"Taiwan",
"Tajikistan",
"Tanzania",
"Thailand",
"Timor-Leste",
"Togo",
"Tokelau",
"Tonga",
"Trinidad and Tobago",
"Tunisia",
"Turkey",
"Turkmenistan",
"Turks and Caicos Islands",
"Tuvalu",
"U.S. Minor Outlying Islands",
"U.S. Miscellaneous Pacific Islands",
"U.S. Virgin Islands",
"Uganda",
"Ukraine",
"Union of Soviet Socialist Republics",
"United Arab Emirates",
"United Kingdom",
"United States",
"Unknown or Invalid Region",
"Uruguay",
"Uzbekistan",
"Vanuatu",
"Vatican City",
"Venezuela",
"Vietnam",
"Wake Island",
"Wallis and Futuna",
"Western Sahara",
"Yemen",
"Zambia",
"Zimbabwe",
"Åland Islands",
);

$countryOptions = "";

// Länderoptionen zusammenbauen
foreach($countryList as $cvalue)
{
    $sel = '';
    if($cvalue==$nation)
        $sel='selected';
    $countryOptions .= '<option value="' . $cvalue . '" ' . $sel . '>' . $cvalue . '</option>';
}


?>

	<h1>
	SSN: <?php echo $ssn ?>
	</h1>
        <form action="change.php" method="post">
            <table>
                    <tr>
                        <td>Gender: 
                            m<input type="radio" id="genderm" name="genderm" onclick="setGender(this.id);" value="<?php if($gender == 'm'){echo 'true';}else{echo 'false';}?>" <?php if($gender == 'm'){echo 'checked';}?>/>
                            f<input type="radio" id="genderf" name="genderf" onclick="setGender(this.id);" value="<?php if($gender == 'f'){echo 'true';}else{echo 'false';} ?>" <?php if($gender == 'f'){echo 'checked';}?>/>
                        </td>
                    </tr>
                    <tr>
                            <td>Title</td><td>Firstname</td><td>Familyname</td><td></td>
                    </tr>
                    <tr>
                            <td><input type="input" value="<?php echo $title ?>"/></td>
                            <td><input type="input" value="<?php echo $firstname ?>"/></td>
                            <td><input type="input" value="<?php echo $familyname ?>"/></td>
                    </tr>
                    <tr>
                        <td>Nation</td>
                        <td>Postalcode</td>
                        <td>Street</td>
                        <td>Nr.</td>
                    </tr>
                    <tr>
                            <td><select name="country" id="country"><?php echo $countryOptions; ?></select></td>
                            <td><input type="input" value="<?php echo $postalcode ?>"/></td>
                            <td><input type="input" value="<?php echo $streetname ?>"/></td>
                            <td><input type="input" value="<?php echo $streetnumber ?>"/></td>
                    </tr>
            </table>
        </form>
  </body>
</html>