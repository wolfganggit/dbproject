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
      <form method="post" action="script.php">

        <fieldset>
          <input type="radio" id="patient" name="patient" value="patient"><label for="patient"> patient </label><br> 
          <input type="radio" id="nurse" name="patient" value="nurse"><label for="nurse">  nurse </label><br> 
          <input type="radio" id="doctor" name="patient" value="doctor"><label for="doctor"> doctor </label> 
        </fieldset>

        <p>
             <fieldset>
                <strong> Gender: </strong> <br>
                <input type="radio" id="female" name="gender" value="female"><label for="mc"> female </label><br> 
                <input type="radio" id="male" name="gender" value="male"><label for="vi">  male </label><br> 
                <input type="radio" id="other" name="gender" value="other"><label for="ae"> other </label> 
              </fieldset>
          </p>


        <p> Title:
          <input name="title" type="text" size="30" maxlength="30"></p>

        <p>Vorname:  
        <input name="vorname" type="text" size="30" maxlength="30"></p>

        <p>Nachname:
        <input name="nachname" type="text" size="30" maxlength="40"></p>
        
        <p> Birthday:                
          <select id="daydropdown"> </select> 
          <select id="monthdropdown"> </select> 
          <select id="yeardropdown"> </select> 

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
    $query = "INSERT INTO Person VALUES ('1010100299', 'Dr.', '1972-02-10', 'm',
      'Hias', 'Huber', '13 A', 'Haunspergstraße', 'Salzburg')";



    $result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());
    




    // Verbindung schließen
    pg_close($dbconn);
    ?>
   




  </body>
</html>