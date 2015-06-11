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
  	<h1 style="text-align: center; margin-top:70px;"> Add a Person </h1>

     
  	<div id="container">
      <?php
        $erfolgreichEingefuegt = ""; 
        echo $erfolgreichEingefuegt;

      ?>

      <div id = "border">
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
                <input type="radio" id="other" name="gender" value="o"><label for="o"> other </label> 
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
          Nation: <input name="nation" type="text" size="30" maxlength="40"> <br> <br>
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

      $person = isset($_POST["person"]) ? $_POST["person"] : null;
      $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
      $title = $_POST["title"];
      $vorname = $_POST["vorname"];
      $nachname = $_POST["nachname"];

      $yeardropdown = isset($_POST["yeardropdown"]) ? $_POST["yeardropdown"] : '';    
      $monthdropdown = isset($_POST["monthdropdown"]) ? $_POST["monthdropdown"] : '';    
      $daydropdown = isset($_POST["daydropdown"]) ? $_POST["daydropdown"] : '';    
      $monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
      $birthm = (array_search ( $_POST['monthdropdown'] , $monthtext ))+1;
      if($birthm < 10){$birthm = "0" . $birthm;}
      
      
      $birthday =  $yeardropdown . "-" . $birthm . "-" . $daydropdown;

      $ssn = $_POST["ssn"];
      $streetname = $_POST["streetname"];
      $streetnumber = $_POST["streetnumber"];
      $town = $_POST["town"];
      $postalcode = $_POST["postalcode"];
      $nation = $_POST["nation"];

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



      $query = 'INSERT INTO "Person" (ssn, birthday, firstname, familyname, nation, title, gender, streetname, streetnumber, town, postalcode) VALUES (' . 
            $ssn . ", ' " . $birthday . " ' ,'".$vorname . "','".$nachname."','".$nation."','".$title."','".$gender."','".$streetname."',".$streetnumber.",
            '".$town."',".$postalcode ."); ";

      
      

      if($_POST["person"] == "patient"){
        $query = $query . 'INSERT INTO "Patient" (personssn, condition) VALUES (' . $ssn . ",'".$condition . "')";
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

      //echo $query;
      $result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());

      // Verbindung schließen
      pg_close($dbconn);


      

      $vars = array_keys(get_defined_vars());
      for ($i = 0; $i < sizeOf($vars); $i++) {
        unset($$vars[$i]);
      }
      unset($vars,$i);

      $erfolgreichEingefuegt = "Erfolgreich eingefuegt";

    }
    
    ?>
   




  </body>
</html>