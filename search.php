<html>
<head>
<title>Search</title>
<meta content="">
<link rel="stylesheet" href="dbproject.css" title="dbproject" />
<style>
    table{border-spacing:0px;}
    td{
        border:1px solid;
        padding-left:2px;
        padding-right:2px;
    }

    #border {width: auto;}
    #container {width: auto; margin-left: 50px; margin-right: 50px; }


</style>
</head>
<body>
    <div style="text-align: center; margin-top:15px;">
      <a href ="index.html"> HOME </a> |
      <a href ="search.php"> SEARCH </a> |
      <a href ="new.php"> NEW </a> 
    </div>
<h1 style="text-align: center; margin-top:70px;"> Search Person </h1>

<div id="container">
<div id = "border">

<div style=" width: 250px; margin-left: auto; margin-right: auto; margin-bottom:20px;">
<form action="search.php" method= "post" style="margin-left: auto; margin-right: auto;">
<input type="text" name="suchfeld">
<input type="submit" name="suche_enter" value="Suchen">
<!--<input type="VORNAME" name="key_Vname">
<input type="NNAME" name="key_Nname">
<input type="SSVN" name="key_ssvn">
<input type="ORT" name="key_ort">-->
</form>
</div>

<?php
// Check ob Suche Button gedrückt, wenn ja dann DB Connect und Suche
    if (isset($_POST['suchfeld']))
    {
    $dbconn = pg_connect("host=localhost dbname=postgres user=rmajewski password=eecighoixehu port=10000")
    or die('Verbindungsaufbau fehlgeschlagen: ' . pg_last_error());
    
    $suchbegriff= addslashes($_POST["suchfeld"]);
        
        //to do: sql injection vermeiden
        $sql = "SELECT title, birthday, gender, firstname, familyname,town, postalcode, streetname, streetnumber, nation,ssn FROM \"Person\" WHERE title ILIKE '%$suchbegriff%' OR birthday::varchar LIKE '%$suchbegriff%'" .
                "OR gender = '$suchbegriff' OR firstname ILIKE '%$suchbegriff%' OR familyname ILIKE '%$suchbegriff%' OR streetnumber ILIKE '%$suchbegriff%' OR streetname ILIKE '%$suchbegriff%' OR town ILIKE '%$suchbegriff%' OR postalcode::varchar LIKE '%$suchbegriff%'";
        
        $result = pg_query($dbconn, $sql);
        
        //Ausgabe
    echo "<div style=\" padding-left: 20px; padding-right: 20px;\">";

        echo "<table style=\"border:1px solid; margin-left: auto; margin-right: auto;\">";
        echo "<tr>";
        echo "<td>Title</td><td>Familyname</td><td>Firstname</td><td>Birthday</td><td>Gender</td><td>Nation</td><td>Postalcode</td><td>Town</td><td>Streetname</td><td>Streetnumber</td><td>SSN</td>";
        echo "</tr>";
        while($line = pg_fetch_array($result)) {
            
            $ssn = $line["ssn"];

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
            
            
            echo "<tr>";
            echo "<td>$title</td><td>$familyname</td><td>$firstname</td><td>$birthday</td><td>$gender</td>";
//            echo "</tr>";
//            echo "<tr>";
            echo "<td>$nation</td><td>$postalcode</td><td>$town</td><td>$streetname</td><td>$streetnumber</td><td>$ssn</td>";
            echo "<td><input type=\"button\" value=\"edit\" onclick=\"document.location='edit.php?ssn=" . $ssn . "';\"></td>";
            echo "<td><input type=\"button\" value=\"delete\" onclick=\"document.location='delete.php?ssn=" . $ssn . "';\"></td></tr>";
            echo "</tr>";
        }
        echo "</table>";
 echo "</div>";
        
        // Speicher freigeben
        pg_free_result($result);
        
        // Verbindung schließen
        pg_close($dbconn);
 
        
    }
    ?>
          </div>
        </div>
</body>
</html>