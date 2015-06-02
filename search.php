<html>
<head>
<title></title>
<meta content="">
<style></style>
</head>
<body>

<form action="scuhen.php" method=post>
<input type="text" name="keyword">
<input type="submit" value="Suchen">
</form>



<?php
    
    $stichwort = mysql_real_ escape_string( $_GET['keyword']);
    
    MySQL_connect("hostname", "username", "password");
    MySQL_select_db("database", $db);
    
    $sql = " SELECT *, MATCH(title,body) AGAINST('$stichwort') AS score FROM articles WHERE MATCH(title, body)    AGAINST('$stichwort') ORDER BY score DESC";
    
    $res = MySQL_query($sql);
    ?>


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
    
    
    mysql_close($db);
    
    
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