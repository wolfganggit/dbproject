<html>
<head>
<title>Search</title>
<meta content="">
<link rel="stylesheet" href="dbproject.css" title="dbproject" />
<style></style>
</head>
<body>

<form action="search.php" method=post>
<input type="text" name="suchfeld">
<input type="submit" name="suche_enter" value="Suchen">
/*<input type="VORNAME" name="key_Vname">
<input type="NNAME" name="key_Nname">
<input type="SSVN" name="key_ssvn">
<input type="ORT" name="key_ort">
*/
</form>



<?php

    if (isset($post['suche_enter']))
    
    {
    $dbconn = pg_connect("host=localhost dbname=postgres user=rmajewski password=eecighoixehu port=10000")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());
    
        $suchbegriff= $_post("suchfeld");
        //to do: sql injection vermeiden
    
        $sql = "SELECT title, birthday, gender, firstname, familyname, streetnumber, streetname, town, postalcode, nation FROM Person WHERE title LIKE '%&suchbegriff%' OR birthday LIKE '%&suchbegriff%' OR gender LIKE '%&suchbegriff%' OR firstname LIKE '%&suchbegriff%' OR familyname LIKE '%&suchbegriff%' OR streetnumber LIKE '%&suchbegriff%' OR streetname LIKE '%&suchbegriff%' OR town LIKE '%&suchbegriff%' OR postalcode LIKE '%&suchbegriff%'";
        
        $result = pg_query($dbconn, $sql);
        
        echo "<table>";
        while($row = pg_fetch_row($result)) {
            echo "<tr>";
            foreach($row as $cell)
            echo "<td>{$cell}</td>";
            echo "</tr>";
        }
        echo "</table>";
 
    ?>





</body>
</html>

/*
 
 if ($rows == "0")
 {
 echo "<h1>Fehler im System: nicht gefunden!!!</h1>";
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
 
 
 <table>
 <tr>
 <th>ID</th>
 <th>Text</th>
 </tr>
 <?php foreach($array = pg_fetch_all_columns($result) as $value): ?>
 <tr>
 <td><?php echo $value[0]; ?></td>
 <td><?php echo $value[1]; ?></td>
 </tr>
 <?php endforeach; ?>
 </table>
 
 
 
 
 // Speicher freigeben
 pg_free_result($result);
 
 // Verbindung schließen
 pg_close($dbconn);
 

 
 */