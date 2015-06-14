<!-- 
Todos:

 Bonus:
Felder dynamisch ein- und ausblenden
Label, wenn erfolgreich eingefügt wurde
 insert into permissions - multi value

Erledigt:
Undefined index error - Lösung: isset()
Sendemethode auf Post ändern
 Querys Anführungsstriche

-->

<!DOCTYPE html>

<html>
  <head>
    <title>Add a New Person </title>
    <meta content="">
    <link rel="stylesheet" href="dbproject.css" title="dbproject" />

    <script type="text/javascript">
      var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];


      function populatedropdown(dayfield, monthfield, yearfield){
      var today=new Date()
      var dayfield=document.getElementById(dayfield)
      var monthfield=document.getElementById(monthfield)
      var yearfield=document.getElementById(yearfield)
      for (var i=0; i<31; i++)
      dayfield.options[i]=new Option(i, i+1)
      dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
      for (var m=0; m<12; m++)
      monthfield.options[m]=new Option(monthtext[m], monthtext[m])
      monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
      var thisyear=today.getFullYear()
      for (var y=0; y<100; y++){
      yearfield.options[y]=new Option(thisyear, thisyear)
      thisyear-=1
      }
      yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
      }

      //hide elements
      function patientShow(){
        document.getElementById('patient').style.display = "block";
        document.getElementById('staff').style.display = "none";
        document.getElementById('doctor').style.display = "none";
        document.getElementById('nurse').style.display = "none";
      }


      function nurseShow(){
        document.getElementById('patient').style.display = "none";
        document.getElementById('staff').style.display = "block";
        document.getElementById('doctor').style.display = "none";
        document.getElementById('nurse').style.display = "block";
      }


      function doctorShow(){
        document.getElementById('patient').style.display = "none";
        document.getElementById('staff').style.display = "block";
        document.getElementById('doctor').style.display = "block";
        document.getElementById('nurse').style.display = "none";
      }

    </script>

  </head>

  <body onload=" patientShow(); populatedropdown('daydropdown', 'monthdropdown', 'yeardropdown');">
    <div style="text-align: center; margin-top:15px;">
      <a href ="index.html"> HOME </a> |
      <a href ="search.php"> SEARCH </a> |
      <a href ="new.php"> NEW </a> 
    </div>
  	<h1 style="text-align: center; margin-top:40px;"> Add a Person </h1>

     
  	<div id="container">
      <?php


          // Erstellen der Liste für die Länderauswahl
          $countryList = array("Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Antarctic Territory","British Indian Ocean Territory","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Canton and Enderbury Islands","Cape Verde","Cayman Islands","Central African Republic","Chad","Chile","China","Christmas Island","Cocos [Keeling] Islands","Colombia","Comoros","Congo - Brazzaville","Congo - Kinshasa","Cook Islands","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Côte d’Ivoire","Denmark","Djibouti","Dominica","Dominican Republic","Dronning Maud Land","East Germany","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories","French Southern and Antarctic Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Islands","Honduras","Hong Kong SAR China","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Johnston Island","Jordan","Kazakhstan","Kenya","Kiribati","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau SAR China","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Metropolitan France","Mexico","Micronesia","Midway Islands","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar [Burma]","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilles","Neutral Zone","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","North Korea","North Vietnam","Northern Mariana Islands","Norway","Oman","Pacific Islands Trust Territory","Pakistan","Palau","Palestinian Territories","Panama","Panama Canal Zone","Papua New Guinea","Paraguay","People's Democratic Republic of Yemen","Peru","Philippines","Pitcairn Islands","Poland","Portugal","Puerto Rico","Qatar","Romania","Russia","Rwanda","Réunion","Saint Barthélemy","Saint Helena","Saint Kitts and Nevis","Saint Lucia","Saint Martin","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Saudi Arabia","Senegal","Serbia","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Korea","Spain","Sri Lanka","Sudan","Suriname","Svalbard and Jan Mayen","Swaziland","Sweden","Switzerland","Syria","São Tomé and Príncipe","Taiwan","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands","Tuvalu","U.S. Minor Outlying Islands","U.S. Miscellaneous Pacific Islands","U.S. Virgin Islands","Uganda","Ukraine","Union of Soviet Socialist Republics","United Arab Emirates","United Kingdom","United States","Unknown or Invalid Region","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Wake Island","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe","Åland Islands");

          $countryOptions = "";

          // Länderoptionen zusammenbauen
          foreach($countryList as $cvalue)
          {
              $countryOptions .= '<option value="' . $cvalue . '" >' . $cvalue . '</option>';
          }

      ?>

      <div id = "border">
        Please fill all fields.  
      <form method="POST" action="new.php">

        <fieldset name = "person" >

          <input type="radio" onclick="javascript:patientShow()" id="person" name="person" value="patient" checked="checked"><label for="patient"> patient </label><br> 
          <input type="radio" onclick="javascript:nurseShow()" id="person" name="person" value="nurse"><label for="nurse">  nurse </label><br> 
          <input type="radio" onclick="javascript:doctorShow()" id="person" name="person" value="doctor"><label for="doctor"> doctor </label> 
        </fieldset>

        <p>
             <fieldset name="gender">
                <strong> Gender: </strong> <br>
                <input type="radio" id="female" name="gender" value="f" checked="checked"><label for="f"> female </label><br> 
                <input type="radio" id="male" name="gender" value="m"><label for="m">  male </label><br> 
                <!--
                <input type="radio" id="other" name="gender" value="o"><label for="o"> other </label> 
                -->
              </fieldset>
          </p>


        <p> Title:
          <select name ="title">
            <option value="none">none</option>
            <option value="Dr">Dr</option>
            <option value="Mag">Mag</option>
            <option value="BSc">BSc</option>
            <option value="MSc">MSc</option>
          </select>

        <p>Vorname:  
        <input name="vorname" type="text" size="30" maxlength="30"></p>

        <p>Nachname:
        <input name="nachname" type="text" size="30" maxlength="40"></p>
        
        <p> Birthday:                
          <select id="daydropdown" name="daydropdown"> </select> 
          <select id="monthdropdown" name="monthdropdown"> </select> 
          <select id="yeardropdown" name="yeardropdown"> </select> 

          <script type="text/javascript">
            //populatedropdown(id_of_day_select, id_of_month_select, id_of_year_select)
            window.onload=function(){
            populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
            }
          </script>
        </p>



        <p> Social Security Number:
        <input name="ssn" type="text" size="30" maxlength="40"></p>

        <hr>

        <p> 
          <strong>Address</strong> <br>
          Street Name: <input name="streetname" type="text" size="30" maxlength="40"> <br> <br>
          Street Number:  <input name="streetnumber" type="text" size="30" maxlength="40"> <br> <br>
          Town: <input name="town" type="text" size="30" maxlength="40"> <br> <br>
          Postalcode: <input name="postalcode" type="text" size="30" maxlength="40"> <br> <br>
          <!-- Nation: <input name="nation" type="text" size="30" maxlength="40"> <br> <br> -->
          Nation: <select id="country" name="nation" id="nation"><?php echo $countryOptions; ?></select>
        </p>

        <hr>


        <p id ="patient" style ="display: block;">
          Condition: <input name="condition" type="text" size="30" maxlength="40"> <br><br>
        </p>  


        <p id = "staff" name = "staffp" style ="display: none;">
          Working Hours (per week): <input name="hours" type="text" size="30" maxlength="40"> <br> <br>
          Department: 
          <select name ="department">
            <option value="1">Anaesthetics</option>
            <option value="2">Cardiology</option>
            <option value="3">Critical care</option>
            <option value="4">Ear nose and throat</option>
          </select>
        </p>

        <p id ="nurse" style ="display: none;">
          Permission to: <input name="permission" type="text" size="30" maxlength="40"> <br><br>
        </p>


        <p id ="doctor" style ="display: none;">
          Area of Expertise: <input name="expertise" type="text" size="30" maxlength="40"> <br><br>
        </p>



        <p><input name="submit" type="submit" value="submit"></p>

        

    </form>

	   </div>
   </div>

     <script type="text/javascript">
    //   if(document.getElementById("person").value == "patient") {document.getElementById("staff").style.visibility = "hidden";}
    //   //document.getElementById("staff").style.visibility = "hidden";
     </script>

    <?php
    
    if(isset($_POST["vorname"])){

      $person = isset($_POST["person"]) ? pg_escape_string($_POST["person"]) : null;
      $gender = isset($_POST["gender"]) ? pg_escape_string($_POST["gender"]) : null;
      $title = pg_escape_string($_POST["title"]);
      $vorname = pg_escape_string($_POST["vorname"]);
      $nachname = pg_escape_string($_POST["nachname"]);

      $yeardropdown = isset($_POST["yeardropdown"]) ? $_POST["yeardropdown"] : '';    
      $monthdropdown = isset($_POST["monthdropdown"]) ? $_POST["monthdropdown"] : '';    
      $daydropdown = isset($_POST["daydropdown"]) ? $_POST["daydropdown"] : '';    
      $monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
      $birthm = (array_search ( $_POST['monthdropdown'] , $monthtext ))+1;
      if($birthm < 10){$birthm = "0" . $birthm;}
      
      
      $birthday =  pg_escape_string($yeardropdown . "-" . $birthm . "-" . $daydropdown);

      $ssn = pg_escape_string($_POST["ssn"]);
      $streetname = pg_escape_string($_POST["streetname"]);
      $streetnumber = pg_escape_string($_POST["streetnumber"]);
      $town = pg_escape_string($_POST["town"]);
      $postalcode = pg_escape_string($_POST["postalcode"]);
      $nation = pg_escape_string($_POST["nation"]);

      //patient vallues
      $condition = $_POST["condition"];

      //staff values
      $hours = $_POST["hours"];  //currently 2 fields (for nurse and for doctor) with the same name
      $department = $_POST["department"];


      //nurse values
      $permission = $_POST["permission"];

      //docotor values
      $expertise = $_POST["expertise"];

      //tests
      // echo  $person;
      // echo $gender;
      // echo $title;
      // echo $vorname;
      // echo  $nachname;  
      // echo $birthday;
      // echo $ssn;
      // echo $streetname;
      // echo $streetnumber;
      // echo $town;
      // echo $postalcode;
      // echo $nation;
      // echo $condition;
      // echo $hours;
      // echo $permission;
      // echo $expertise;
    

    
    


      // Verbindungsaufbau und Auswahl der Datenbank
      //ss verbindung: ssh -L 10000:biber:5432 astadler@sshstud.cosy.sbg.ac.at

      $dbconn = pg_connect("host=localhost dbname=postgres user=astadler password=aecheeteihii port=10000")
          or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());

      //echo "Verbindung geöffnet";


      // $result = pg_query($dbconn, "INSERT INTO phonebook(phone, firstname, lastname) 
      //                   VALUES('+1 123 456 7890', 'John', 'Doe');");

      // Read Information about Person



      $query = ' BEGIN; INSERT INTO "Person" (ssn, birthday, firstname, familyname, nation, title, gender, streetname, streetnumber, town, postalcode) VALUES (' . 
            $ssn . ", ' " . $birthday . " ' ,'".$vorname . "','".$nachname."','".$nation."','".$title."','".$gender."','".$streetname."',".$streetnumber.",
            '".$town."',".$postalcode ."); ";

      
      

      if($_POST["person"] == "patient"){
        $query = $query . 'INSERT INTO "Patient" (personssn, condition) VALUES (' . $ssn . ",'".$condition . "');";
        //$patientResult = pg_query($patientQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error());  
      }
      elseif ($_POST["person"] == "nurse") {
        $query =  $query . 'INSERT INTO "Staff" (personssn, workinghoursperweek, workingindepartmentnr) VALUES (' . $ssn . "," . $hours . "," . $department . "); ";
        //$staffResult = pg_query($staffQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 

        $query = $query . 'INSERT INTO "Nurse" (staffssn) VALUES (' . $ssn . "); ";
        //$staffResult = pg_query($staffQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
        //$nurseResult = pg_query($nurseQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 

        $query = $query . 'INSERT INTO "Nursepermissionto" (nursessn, permissionto) VALUES (' . $ssn . ", ' " . $permission . "' ); ";
        //$permissionsResult = pg_query($permissionsQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
      }
      elseif ($_POST["person"] == "doctor") {
        $query = $query . 'INSERT INTO "Staff" (personssn, workinghoursperweek, workingindepartmentnr) VALUES (' . $ssn . ",  " . $hours . "," . $department . " ); ";
        //$staffResult = pg_query($staffQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 

        $query = $query . 'INSERT INTO "Doctor" (staffssn, areaofexpertise) VALUES (' . $ssn . ", ' " .  $expertise . "'); ";
        //$doctorResult = pg_query($doctorQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
      }

      $query = $query . "COMMIT;";
      //echo $query;
      $result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());

      // Verbindung schließen
      pg_close($dbconn);


      

      $vars = array_keys(get_defined_vars());
      for ($i = 0; $i < sizeOf($vars); $i++) {
        unset($$vars[$i]);
      }
      unset($vars,$i);

    }
    
    ?>
   




  </body>
</html>