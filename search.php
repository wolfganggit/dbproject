<html>
<head>
<title></title>
<meta content="">
<style></style>
</head>
<body>

<form action="search.php" method=post>
<input type="VORNAME" name="key_Vname">
<input type="NNAME" name="key_Nname">
<input type="SSVN" name="key_ssvn">
<input type="ORT" name="key_ort">
<input type="submit" value="Suchen">
</form>



<?php
    
<<<<<<< Updated upstream
    $stichwort = mysql_real_escape_string( $_GET['keyword']);
=======
    $stichwort = mysql_real_ escape_string( $_GET['keyword']);
 //  POST SQL CONNECT
>>>>>>> Stashed changes
    
    /*$sql = " SELECT *, MATCH(title,body) AGAINST('$stichwort') AS score FROM articles WHERE MATCH(title, body)    AGAINST('$stichwort') ORDER BY score DESC";
    
    $res = MySQL_query($sql);*/
    ?>



//TABLE
<table>
<tr><td>SCORE</td><td>TITLE</td><td>
ID#</td></tr>
<?php
    while($row =
          MySQL_fetch_array($rest)) {
        echo
        "<tr><td>{$sql2['score']}</td>";
        echo "<td>{$sql2['title']}</td>";
        echo "<td>{$sql2['id']}</td></tr>";}
    echo "</table>";
    }
    
    

    
    
    ?>



/*
 
 
 <?php
 
 $servername = "localhost";
 $username = "username";
 $password = "password";
 
 //Verbindung zur Datenbank herstellen
 
 $conn = new mysqli($servername, $username, $password);
 
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 // echo "Connected successfully";
 
 
 
 
 // Daten selektieren
 $result = mysql_query("SELECT * FROM tabellenname WHERE FilmID LIKE '%$suchbegriff%' OR Filmname LIKE '%$suchbegriff%' OR Filmtype LIKE '%$suchbegriff%' OR Filmmemo LIKE '%$suchbegriff%' OR Filmdauer LIKE '%$suchbegriff%'");
 
 //Ausgabe
 /*while($row = mysql_fetch_row($result))
 echo $row[0].' - '.$row[1].'<br />';*/
while ($row = mysql_fetch_array($res)){
    $FilmID = $row['FilmID'];
    $Filmname = $row['Filmname'];
    $Filmtype = $row['Filmtype'];
    $Filmmemo = $row['Filmmemo'];
    $Filmdauer = $row['Filmdauer'];
    
    echo ("$FilmID<br>$Filmname<br>$Filmtype<br>$Filmmemo<br>$Filmdauer<br><br>");
    
}

?> */


</body>
</html>