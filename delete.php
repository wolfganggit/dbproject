<?php
$ssn = $_GET['ssn'];
$sql = "BEGIN; delete from \"Doctortreatingpatient\" where doctorssn = '$ssn';";
$sql .= "delete from \"Doctortreatingpatient\" where patientssn = '$ssn';";
$sql .= "delete from \"Patient\" where personssn = '$ssn';";
$sql .= "delete from \"Doctor\" where staffssn = '$ssn';";
$sql .= "delete from \"Nursepermissionto\" where nursessn = '$ssn';";
$sql .= "delete from \"Nurse\" where staffssn = '$ssn';";
$sql .= "delete from \"Staff\" where personssn = '$ssn';";
$sql .= "delete from \"Person\" where ssn = '$ssn'; COMMIT;";

    $dbconn = pg_connect("host=localhost dbname=postgres user=wlehner password=earoophojaej port=10000")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());
    
    $result = pg_query($sql) or die('Abfrage fehlgeschlagen: ' . pg_last_error());
    // Verbindung schließen
    pg_close($dbconn);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body onload="document.location='search.php';">
    </body>
</html>