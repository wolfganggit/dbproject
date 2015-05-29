<html>
  <head>
    <title>Edit Data</title>
    <meta content="">
    <style></style>
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
?>

	<h1>
	SSN: <?php echo $ssn ?>
	</h1>
	<table>
		<tr>
			<td>Title</td><td>Firstname</td><td>Familyname</td><td></td>
		</tr>
		<tr>
			<td><input type="input" value="<?php echo $title ?>"></td><td><input type="input" value="<?php echo $firstname ?>"></td><td><input type="input" value="<?php echo $familyname ?>"></td>
		</tr>
	</table>
  </body>
</html>