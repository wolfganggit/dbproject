<!DOCTYPE html>

<?php
    $gender = 'f';
    if(isset($_POST["genderm"])){
        $gender = 'm';
    }
    
    $birthd = $_POST['daydropdown'];
    
    $monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
    $birthm = (array_search ( $_POST['monthdropdown'] , $monthtext ))+1;
    
    $birthy = $_POST['yeardropdown'];
    
    $birthday = $birthy . '-' . $birthm . '-' . $birthd;
    $firstname = pg_escape_string($_POST['firstname']);
    $familyname = pg_escape_string($_POST['familyname']);
    $ssn = pg_escape_string($_POST['ssn']);
    $title = pg_escape_string($_POST["title"]);
    $streetnumber = pg_escape_string($_POST["streetnumber"]);
    $streetname = pg_escape_string($_POST["streetname"]);
    $town = pg_escape_string($_POST["town"]);
    $postalcode = pg_escape_string($_POST["postalcode"]);
    $nation = pg_escape_string($_POST["nation"]);
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body onload="document.location='edit.php?ssn=<?php echo $ssn ?>';">
        <?php
        $query = 'UPDATE "Person" set';
        $query .= " birthday='" . $birthday . "'";
        $query .= ", gender='" . $gender . "'";
        $query .= ", firstname='" . $firstname . "'";
        $query .= ", familyname='" . $familyname . "'";
        $query .= ", title='" . $title . "'";
        $query .= ", streetnumber='" . $streetnumber . "'";
        $query .= ", streetname='" . $streetname . "'";
        $query .= ", town='" . $town . "'";
        $query .= ", postalcode='" . $postalcode . "'";
        $query .= ", nation='" . $nation . "'";
        $query .= " WHERE ssn='" . $ssn . "';";
        ?>
    </body>
</html>
<?php
    $dbconn = pg_connect("host=localhost dbname=postgres user=wlehner password=earoophojaej port=10000")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());
    
    $result = pg_query($query) or die('Abfrage fehlgeschlagen: ' . pg_last_error());
    // Verbindung schließen
    pg_close($dbconn);
?>