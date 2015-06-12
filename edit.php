<?php
// Verbindungsaufbau und Auswahl der Datenbank

$dbconn = pg_connect("host=localhost dbname=postgres user=wlehner password=earoophojaej port=10000")
//$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=uxnd3no port=5432")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());

//echo "Verbindung geöffnet";
//$ssn = "1010100272";

$ssn = $_GET['ssn'];

$ssnq = "'" . $ssn ."';";

// Read Information about Person
$query = 'SELECT case when pa.personssn is not null then true else false end as ispatient,' .
'case when d.staffssn is not null then true else false end as isdoctor,'.
'case when n.staffssn is not null then true else false end as isnurse,'.
'pe.*,pa.condition,d.areaofexpertise '.
'FROM (("Person" pe left outer join "Patient" pa on pe.ssn = pa.personssn) '.
'	left outer join "Doctor" d on pe.ssn = d.staffssn) left outer join "Nurse" n on pe.ssn = n.staffssn '.
'WHERE ssn = ' . $ssnq;

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
        
        $ispatient = $line["ispatient"];
        
        $isdoctor = $line["isdoctor"];
        
        $isnurse = $line["isnurse"];
        
        $condition = $line["condition"];
        
        $areaofexpertise = $line["areaofexpertise"];

}
// Speicher freigeben
pg_free_result($result);


$query="select title,firstname,familyname,ssn from \"Person\" p,\"Doctor\" d where p.ssn = d.staffssn";

$result = pg_query($dbconn, $query);
$doctors_opts = '<option value="" selecteds></option>';
while($line = pg_fetch_array($result)) {
    $docname = $line['title'] . ' ' . $line['firstname'] . ' ' . $line['familyname'];
    $docssn = $line['ssn'];
    $doctors_opts .= '<option value="' . $docssn . '">' . $docname . '</option>';
}

$patientcheck = "false";
if($ispatient=='t')
{
    $patientcheck = "true";
}
// Verbindung schließen
pg_close($dbconn);

// Erstellen der Liste für die Länderauswahl
$countryList = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Antarctic Territory","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Canton and Enderbury Islands","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos [Keeling] Islands","Colombia","Comoros","Congo - Brazzaville","Congo - Kinshasa","Cook Islands","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Côte d’Ivoire","Denmark","Djibouti","Dominica","Dominican Republic","Dronning Maud Land","East Germany","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","French Southern and Antarctic Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Islands","Honduras","Hong Kong SAR China","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Johnston Island","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau SAR China","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Metropolitan France","Mexico","Micronesia","Midway Islands","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar [Burma]","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","Neutral Zone","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","North Korea","North Vietnam","Northern Mariana Islands","Norway","Oman","Pacific Islands Trust Territory","Pakistan","Palau","Palestinian Territories","Panama","Panama Canal Zone","Papua New Guinea","Paraguay","People's Democratic Republic of Yemen","Peru","Philippines","Pitcairn Islands","Poland","Portugal","Puerto Rico","Qatar","Romania","Russia","Rwanda","Réunion","Saint Barthélemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Saudi Arabia","Senegal","Serbia","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Korea","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","São Tomé and Príncipe","Taiwan","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Minor Outlying Islands","U.S. Miscellaneous Pacific Islands","U.S. Virgin Islands","Uganda","Ukraine","Union of Soviet Socialist Republics","United Arab Emirates","United Kingdom","United States","Unknown or Invalid Region","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Wake Island","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe","Åland Islands");

$countryOptions = "";

// Länderoptionen zusammenbauen
foreach($countryList as $cvalue)
{
    $sel = '';
    if($cvalue==$nation)
        $sel='selected';
    $countryOptions .= '<option value="' . $cvalue . '" ' . $sel . '>' . $cvalue . '</option>';
}

$birthy = substr($birthday, 0,4);
$birthm = substr($birthday,5,2);
$birthd = substr($birthday,8,2);



?>


<html>
  <head>
    <title>Edit Data</title>
    <meta content="">
    <link rel="stylesheet" href="dbproject.css" title="dbproject" />
    <style>
        body { 
            background-color: green; 
            background-image: url(images/upfeathers.png); 
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
        
        
    
      /***********************************************
      * Drop Down Date select script- by JavaScriptKit.com
      * This notice MUST stay intact for use
      * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
      ***********************************************/

      var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
      var treatingdocs_listvals = new Array();
      
      function populatedropdown(dayfield, monthfield, yearfield){
          var today=new Date();
          var dayfield=document.getElementById(dayfield);
          var monthfield=document.getElementById(monthfield);
          var yearfield=document.getElementById(yearfield);
          for (var i=0; i<31; i++)
            dayfield.options[i]=new Option(i+1, i+1);
        
          dayfield.options[<?php echo ($birthd-1) ?>]=new Option(<?php echo $birthd ?>, <?php echo $birthd ?>, true, true); //select today's day
          for (var m=0; m<12; m++)
            monthfield.options[m]=new Option(monthtext[m], monthtext[m]);
        
          monthfield.options[<?php echo ($birthm-1) ?>]=new Option(monthtext[<?php echo ($birthm-1) ?>], monthtext[<?php echo ($birthm-1) ?>], true, true); //select today's month
          var thisyear=today.getFullYear();
          for (var y=0; y<100; y++){
              if(thisyear==<?php echo $birthy ?>)
                  yearfield.options[y]=new Option(thisyear, thisyear,true,true);
              else
                  yearfield.options[y]=new Option(thisyear, thisyear);
              thisyear-=1;
          }
          <?php echo 'document.getElementById("cb_patient").checked=' . $patientcheck . ';';?>
      }
      function addtreatingdoc(newdoctor)
      {
          var tdl = document.getElementById('treatingdocs_list');
          if(tdl.value == "" || tdl.value == null)
            tdl.value += newdoctor.value;
          else
              tdl.value += ";" + newdoctor.value;
              
          if(newdoctor.value!='' && newdoctor.value!=null)
          {
              var sel = document.getElementById('treatingdocs');
              sel.options[sel.options.length] = new Option(newdoctor.options[newdoctor.selectedIndex].text,newdoctor.value,false,true);
          }
      }
      
      function removeseldoc()
      {
          var tdl = document.getElementById('treatingdocs_list');
          var sel = document.getElementById('treatingdocs');
          tdl.value = tdl.value.replace(";" + sel.value,'');
          tdl.value = tdl.value.replace(sel.value + ";",'');
          tdl.value = tdl.value.replace(sel.value,'');
          
          
          sel.remove(sel.selectedIndex);
      }
    </script>
  </head>
    <body onload="populatedropdown('daydropdown', 'monthdropdown', 'yeardropdown');">

        <h1 style="text-align: center; margin-top:70px;"> Edit Person </h1>

        <div id="container">
            <div id = "border">
                <p>
                    <h1>
                    SSN: <?php echo $ssn ?>
                    </h1>
                </p>
                <form action="saveedit.php" method="post">
                    <p>Gender: 
                                m<input type="radio" id="genderm" name="genderm" onclick="setGender(this.id);" value="<?php if($gender == 'm'){echo 'true';}else{echo 'false';}?>" <?php if($gender == 'm'){echo 'checked';}?>/>
                                f<input type="radio" id="genderf" name="genderf" onclick="setGender(this.id);" value="<?php if($gender == 'f'){echo 'true';}else{echo 'false';} ?>" <?php if($gender == 'f'){echo 'checked';}?>/>
                    </p>

                    <p> Title:
                    <input name="title" type="text" size="30" maxlength="30" value="<?php echo $title ?>"></p>

                    <p>Vorname:  
                    <input name="firstname" id="firstname" type="text" size="30" maxlength="30" value="<?php echo $firstname ?>"></p>

                    <p>Nachname:
                        <input name="familyname" id="familyname" type="text" size="30" maxlength="40" value="<?php echo $familyname ?>"></p>

                    <hr>

                    <p> 
                      <strong>Address</strong> <br>
                      Street Name: <input name="streetname" type="text" size="30" maxlength="40" value="<?php echo $streetname ?>"> <br> <br>
                      Street Number:  <input name="streetnumber" type="text" size="30" maxlength="40" value="<?php echo $streetnumber ?>"> <br> <br>
                      Town: <input name="town" type="text" size="30" maxlength="40" value="<?php echo $town ?>"> <br> <br>
                      Postalcode: <input type="text" id="postalcode" name="postalcode" value="<?php echo $postalcode ?>"/> <br> <br>
                      Nation: <select name="nation" id="nation"><?php echo $countryOptions; ?></select> <br> <br>
                    </p>

                    <hr>


                    <p>
                      <strong> Is Patient  </strong> <input type="checkbox" id="cb_patient" name="cb_patient" ><br>
                      Conditiion: <input name="condition" type="text" size="30" maxlength="40" value="<?php echo $condition; ?>"> <br><br>
                      <div style="width:150px; float: left;">is treated By:</div> <select style="width:200px;" size="5" id="treatingdocs" name="treatingdocs"></select><input type="button" value="remove" onclick="removeseldoc();"><br>
                      <div style="width:150px; float: left;">add doctor</div><select style="width:200px;" id="treatingdoc" name="treatingdoc" onchange="addtreatingdoc(this);"><?php echo $doctors_opts;?></select>
                    </p>  


                    <hr>

                    <p><input type="submit" value="Senden"></p>s

                    <input type="hidden" id="ssn" name="ssn" value="<?php echo $ssn ?>"/>
                    <input type="hidden" id="treatingdocs_list" name="treatingdocs_list">
                </form>
            </div>
        </div>
    </body>
</html>