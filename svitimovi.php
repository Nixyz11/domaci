<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Svi timovi</title>
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
  background: url("stadium.jpg");
  background-size: 1700px 950px;
  color: #990000;
  }

  input{
     background-color: #FFCC99;
     color: black;
  }

  select{
    background-color: green;
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
  echo "<h2>Svi naši timovi: </h2>";
  $sqlUpit = "SELECT * FROM tim JOIN vlasnik USING(vlasnikID) JOIN status USING(statusID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die ("Upit nije uspešno izvršen.");
  echo "<table border=2>";
  echo "<tr>";
    echo "<th>"; echo "ime tima"; "</th>";
    echo "<th>"; echo "vlasnik tima"; "</th>";
    echo "<th>"; echo "status"; echo "</th>";
  echo "</tr>";  
    while($tim = mysqli_fetch_array($rez))
    {
      echo "<tr>";
         echo "<td>"; echo $tim['imeTima'];  echo "</td>";
         echo "<td>"; echo $tim['imeVlasnika'].' '.$tim['prezimeVlasnika'];
         echo "<td>"; echo $tim['imeStatusa'];  echo "</td>";
      echo "</tr>";
    }
  echo "</table>";

?>