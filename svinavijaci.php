<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Svi navijaci</title>
<style>
 a{
    color: black;
    text-decoration: none;
  }

  /* body {
  padding: 0;
  font-weight: 10px;
  background-color: rgb(65,105,225);
  color: #000;
  } */

  body {
  padding: 0;
  font-weight: 10px;
  background: url("slika.jpeg");
  color: #990000;
  }

  input{
     background-color: #FFCC99;
     color: black;
  }

  select{
   background-color: #FFCC99;
     color: black;
  }

  button{
    font-weight: bold;
    background-color: #ffb266;
    color: black;
  }

  th{
     background-color: azure;
  }

  td{
     background-color: azure;
  }
  h2{
   color: darkorange;
  }
  table{
   margin-left: auto;
  margin-right: auto;
  }
</style>
</head>
<body>
   
</body>
</html>


<?php
  include "konekcija.php";
  echo "<h2>Svi navijaci: </h2>";
  $sqlUpit = "SELECT * FROM navijac c JOIN kategorijaClanstva k USING(kategorijaClanstvaID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die("Upit nije uspešno izvršen.");
  echo "<table border=2>";
     echo "<tr>";  
        echo "<th>"; echo "Ime";  echo "</th>";
        echo "<th>"; echo "Prezime";  echo "</th>";
        echo "<th>"; echo "Kategorija clanstva";  echo "</th>";
     echo "</tr>";
  while($navij = mysqli_fetch_array($rez))
  {
      echo "<tr>";  
        echo "<td>"; echo $navij['ime'];  echo "</td>";
        echo "<td>"; echo $navij['prezime'];  echo "</td>";
        echo "<td>"; echo $navij['nazivKategorije'];  echo "</td>";
        echo '<br>';
     echo "</tr>";
  }
  echo "</table>";
?>
