<!DOCTYPE html>

<html>
  <head>
    <title>Add a New Person </title>
    <meta content="">
    <link rel="stylesheet" href="dbproject.css" title="dbproject" />

    <script type="text/javascript">
      /***********************************************
      * Drop Down Date select script- by JavaScriptKit.com
      * This notice MUST stay intact for use
      * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
      ***********************************************/

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
    </script>

  </head>

  <body>
  	<h1 style="text-align: center; margin-top:70px;"> Add a Person </h1>

     
  	<div id="container">
      <div id = "border">
      <form method="GET" action="new.php">

        <fieldset>
          <input type="radio" id="patient" name="person" value="patient"><label for="patient"> patient </label><br> 
          <input type="radio" id="nurse" name="person" value="nurse"><label for="nurse">  nurse </label><br> 
          <input type="radio" id="doctor" name="person" value="doctor"><label for="doctor"> doctor </label> 
        </fieldset>

        <p>
             <fieldset>
                <strong> Gender: </strong> <br>
                <input type="radio" id="female" name="gender" value="f"><label for="mc"> female </label><br> 
                <input type="radio" id="male" name="gender" value="m"><label for="vi">  male </label><br> 
                <input type="radio" id="other" name="gender" value="o"><label for="ae"> other </label> 
              </fieldset>
          </p>


        <p> Title:
          <input name="title" type="text" size="30" maxlength="30"></p>

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


        <p>
          <strong> For Patients: </strong> <br>
          Conditiion: <input name="condition" type="text" size="30" maxlength="40"> <br><br>
          treated by? <br>
        </p>  

        <hr>

        <p>
          <strong> Nurse: </strong> <br>
          Permission to: <input name="permission" type="text" size="30" maxlength="40"> <br><br>
          Working Hours (per week): <input name="hours" type="text" size="30" maxlength="40"> <br>
        </p>

        <hr>

        <p>
          <strong> Doctor: </strong> <br>
          Area of Expertise: <input name="expertise" type="text" size="30" maxlength="40"> <br><br>
          Working Hours (per week): <input name="hours" type="text" size="30" maxlength="40"> <br>
        </p>



        <p><input name="submit" type="submit" value="submit"></p>

        

    </form>

	   </div>
   </div>


    <?php
    // Verbindungsaufbau und Auswahl der Datenbank
    //ss verbindung: ssh -L 10000:biber:5432 astadler@sshstud.cosy.sbg.ac.at

    $dbconn = pg_connect("host=localhost dbname=postgres user=astadler password=aecheeteihii port=10000")
        or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());

    //echo "Verbindung geöffnet";


// $result = pg_query($dbconn, "INSERT INTO phonebook(phone, firstname, lastname) 
//                   VALUES('+1 123 456 7890', 'John', 'Doe');");

    // Read Information about Person

    $patient = $_GET["patient"];
    $gender = $_GET["vorname"];
    $title = $_GET["title"];
    $vorname = $_GET["vorname"];
    $nachname = $_GET["nachname"];
    $birthday =  $_GET["yeardropdown"] . "-" . $_GET["monthdropdown"] . "-" . $_GET["daydropdown"];
    $ssn = $_GET["ssn"];
    $streetname = $_GET["streetname"];
    $streetnumber = $_GET["streetnumber"];
    $town = $_GET["town"];
    $postalcode = $_GET["postalcode"];
    $nation = $_GET["nation"];

    //patient vallues
    $condition = $_GET["condition"];

    //staff values
    $hours = $_GET["hours"];  //currently 2 fields (for nurse and for doctor) with the same name

    //nurse values
    $permission = $_GET["permission"];

    //docotor values
    $expertise = $_GET["expertise"];

    echo $name;

    $SSN = "1010100299";
    

    $query = 'INSERT INTO "Person" VALUES ( . $SSN . )';

    // , Dr., "1972-02-10", "m",
     // "Hias", "Huber", "13 A", "Haunspergstraße", "Salzburg"

    $result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());
    

    if($_GET["person"] == "patient"){
      $patientQuery = 'INSERT INTO "Patient" VALUES ()';
      $patientResult = pg_query($patientQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error());  
    }
    elseif ($_GET["person"] == "nurse") {
      $staffQuery = 'INSERT INTO "Staff" VALUES ()';
      $staffResult = pg_query($staffQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 

      $nurseQuery = 'INSERT INTO "Nurse" VALUES ()';
      $nurseResult = pg_query($nurseQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 

      $permissionsQuery = 'INSERT INTO "Nursepermissionsto" VALUES ()';
      $permissionsResult = pg_query($permissionsQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
    }
    elseif ($_GET["person"] == "doctor") {
      $staffQuery = 'INSERT INTO "Staff" VALUES ()';
      $staffResult = pg_query($staffQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
      
      $doctorQuery = 'INSERT INTO "Doctor" VALUES ()';
      $doctorResult = pg_query($doctorQuery) or die('Abfrage fehlgeschlagen: ' . pg_last_error()); 
    }

    // Verbindung schließen
    pg_close($dbconn);
    ?>
   




  </body>
</html>