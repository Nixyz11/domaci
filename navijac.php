
<?php include "konekcija.php"?>
<?php include "klase.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="./styles.css" />
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

  label{
    background-color: gray;
  }

  body {
  
  font-weight: 10px;
 
  background: url("slika.jpeg");
  font-size: larger;
  color: white;
  
  margin-left: auto;
  margin-right: auto;
  display: inline-block;
  }

  input{
     background-color: greenyellow;
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
     color: black;
  }

  td{
     background-color: azure;
     color: black;
  }
  p{
    margin: auto;
    padding: auto;
  }
  a{
    font-size: xx-large;
    color: darkorange;
  }
  tr{
    background-color: cornflowerblue;
  }
</style>
<script src="skripta.js"></script>

 <title>Navijac</title>
</head>
<body>

    <!-- div za prikaz svih blokova -->
    <div id="prikaziSveStoPostoji" style="display:none">
      <label for="nmp">Prikaži sve: </label>
      <a href="navijac.php"><input type="submit" value="Potvrdi" name="nmp"></a>
    </div>
    

    <!-- prikaz svih navijaca -->
    <div id="sviMojiNavijaci">
    <p>Ukoliko želite da vidite sve navijace, kliknite na
     <a href="svinavijaci.php" target="_blank">NAVIJACI</a>.
    </p>
    </div>

    <!-- forma za dodavananje navijaca -->
    <div id="unosimNavijaca">
    <fieldset>
      <form action="" name="unosNavijaca" method="post">
      <label for="">Dodajte novog navijaca: </label><br><br>
        
        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" id="ime" placeholder="Unesi ime"> <br><br>
        <label for="prezime">Prezime: </label><br>
        <input type="text" name="prezime" id="prezime" placeholder="Unesi prezime"> <br><br>
        <label for="kategorija">Kategorija: </label><br>
        <input type="text" name="kategorija" id="kategorija" placeholder="Unesi kategoriju"> <br>
        <br>
        <button type="submit" name="unesiNavijaca" onclick="proveriFormuZaUnosNavijaca()">Unesi u bazu</button>
        <br>
    </form>
    <br>
    <input type="submit" value="Rezultat" onclick="skloniBlokove(blok1, 'prikaziSveStoPostoji')">
    </fieldset>
    </div>
    <br>

    <div id="proveravamNavijaca">
      <!-- forma za proveru -->
      <fieldset>
      <form action="" name="proveravanje" method="post">
      <label for="">Proverite za koje timove navija konkretan navijac/obrišite navijaca: </label><br><br>
      
        <label for="prov">Navijac: </label>
        <select name="ponudaNavijaca" id="prov">
          <?php
            $rez = Navijac::vratiSveNavijace($link);
            while($navijac = mysqli_fetch_array($rez))
            {
              $imePrezime = $navijac['ime'].' '.$navijac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
        </select>
        <button type="submit" name="provera">Proveri</button>
        <button type="submit" name="brisanjeNavijaca" value="Obriši">Obriši</button>
      </form>
      <br>
     <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      </fieldset>
      </div>
      <br>

      <!--navijanje-nenavijanje -->
      <div id="navijanje-nenavijanje">
      <fieldset>
      <form action="" method="post" name="zaduzivanje-razduzivanje">
        <label for="">Unesite novo navijanje navijaca/ne-navijanje navijaca:</label><br><br>
        
          <label for="citic">Navijac: </label>
          <select name="ponudaNavijaca" id="citic">
          <?php
            $rez = Navijac::vratiSveNavijace($link);
            while($navijac = mysqli_fetch_array($rez))
            {
              $imePrezime = $navijac['ime'].' '.$navijac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
          </select>
          <label for="tim">Tim: </label> 
          <select name="ponudaTima" id="tim">
            <?php
              $rez = Tim::vratiSveTimove($link);
              while($Tim = mysqli_fetch_array($rez))
              {
                $imeTima = $Tim['imeTima'];
              ?>
                <option value="<?php echo $imeTima ?>"><?php echo $imeTima ?></option>      
            <?php
              }
            ?>
          </select>
          <button type="submit" name="Navijam">Navijam</button>
          <button type="submit" name="Ne-Navijam">Ne-Navijam</button>
      </form>
      <br>
      <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      </fieldset>
      </div>
    

      <script>
        var svi = ["sviMojiNavijaci" ,"unosimNavijaca", "proveravamNavijaca", "navijanje-nenavijanje"];
        var blok1 = ["sviMojiNavijaci", "proveravamNavijaca", "navijanje-nenavijanje"];
        var blok2 = ["sviMojiNavijaci", "unosimNavijaca", "navijanje-nenavijanje"];
        var blok3 = ["sviMojiNavijaci", "unosimNavijaca", "proveravamNavijaca"];

      </script>
</body>
</html>

<?php
  //  upisivanje novog navijaca u bazu 
  if(isset($_POST['unesiNavijaca']))
  {
    if($_POST['ime'] !== "" && $_POST['prezime'] !== "" && $_POST['kategorija'] !== "")
    {
        $navijac = new Navijac($_POST['ime'], $_POST['prezime'], $_POST['kategorija']);
        //provera da li postoji u bazi
        if(!$navijac->postojiUBazi($link))
          $navijac->upisiUBazu($link);
        else
           echo "Navijac vec postoji u bazi!";
    }

  }

  //provera koj tim je uzeo koji -navijac
  if(isset($_POST['provera']))
  {
    $vrednost = $_POST['ponudaNavijaca'];
    $povratniNiz = Navijac::iseciImePrezime($vrednost);
    $id = Navijac::vratiIDnavijaca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    $rezultatUpita = UzeoTim::vratiSpojenoNavijacTimVlasnik($link);

    echo '<table border="2">';
    echo '<tr>';
      echo '<th>'; echo 'Ime' ; echo '</th>';
      echo '<th>'; echo 'Prezime' ; echo '</th>';
      echo '<th>'; echo 'Tim' ; echo '</th>';
      echo '<th>'; echo 'Vlasnik' ; echo '</th>';
    echo '</tr>';
    while($navijac = mysqli_fetch_array($rezultatUpita))
    {
      if($navijac['navijacID'] == $id)
      {
        echo '<tr>';
          echo '<th>'; echo $navijac['ime'] ; echo '</th>';
          echo '<th>'; echo $navijac['prezime'] ; echo '</th>';
          echo '<th>'; echo $navijac['imeTima'] ; echo '</th>';
          echo '<th>'; echo $navijac['imeVlasnika'].' '.$navijac['prezimeVlasnika'] ; echo '</th>';
      echo '</tr>';
      }
    }
    echo '</table>'; 
  }

  //brisanje konkretnog navijaca
  if(isset($_POST['brisanjeNavijaca']))
  {
    $vrednost = $_POST['ponudaNavijaca'];
    $povratniNiz = Navijac::iseciImePrezime($vrednost);
    $id = Navijac::vratiIDnavijaca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    Navijac::izbaciNavijaca($link, $id);
  }



  //unos navijanja
  if(isset($_POST['navijanje']))
  {
    $imePrezime = $_POST['ponudaNavijaca'];
    $imeTima = $_POST['ponudaTima'];
    $idTima = Tim::vratiIDTimaNaOsnovuImena($link, $imeTima);
    $povratniNiz = Navijac::iseciImePrezime($imePrezime);
    $navijacID = Navijac::vratiIDnavijaca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(UzeoTim::postojiParNavijacTim($link, $navijacID, $idTima))
      die("Navijac $imePrezime je već navijac tima: $imeTima.");

      UzeoTim::ubaciParNavijacTimUBazu($link, $navijacID, $idTima);
    
  }
  //nenavijanje navijaca
  if(isset($_POST['ne-navijanje']))
  {
    $imePrezime = $_POST['ponudaNavijaca'];
    $imeTima = $_POST['ponudaTima'];
    $idTima = Tim::vratiIDTimaNaOsnovuImena($link, $imeTima);
    $povratniNiz = Navijac::iseciImePrezime($imePrezime);
    $navijacID = Navijac::vratiIDnavijaca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(!UzeoTim::postojiParNavijacTim($link, $navijacID, $idTima))
      die("Navijac $imePrezime nije uzeo tim $imeTima.");

      UzeoTim::izbaciParNavijacTim($link, $navijacID, $idTima);

  }



?>
