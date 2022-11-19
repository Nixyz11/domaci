<?php include "konekcija.php"?>
<?php include "klase.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Timovi</title>
 
<style>
  
  a{
    color: black;
    text-decoration: none;
  }


  label{
    background-color: gray;
  }

  body {
    margin-left: auto;
  margin-right: auto;
  display: inline-block;
  font-weight: 20px;
  background: url("stadium.jpg");
  background-size: 1700px 1300px;
  color: wheat;
  }

  input{
     background-color: #FFCCAA;
     color: black;
  }

  select{
    background-color: greenyellow;
     color: black;
  }

  button{
    font-weight: bold;
    background-color: cornflowerblue;
    color: black;
  }

  th{
    background-color: azure;
     color: black;
  }

  td{
    background-color: azure;
     color: black;;
  }
  p{
    margin: auto;
    padding: auto;
    color: azure;
    font-size: larger;
  }
  a{
    font-size: xx-large;
    color: aqua;
  }
</style>
<script>
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
</script>
<script src="skripta.js"></script>

</head>
<body>
   <!-- tabela svih timova koji postoje  -->
   <div id="PrikazSvihTimova">
   <p>Ukoliko želite da vidite sve timove u posedu iz naše ponude, kliknite na
   <a href="svitimovi.php" target="_blank">naši timovi</a>.</p>
   </div>

    <!-- div za prikazSvih -->
   <div id="divZaPrikazSvih" style="display:none">
    <label for="rbPrikaz">Prikaži sve: </label>
    <a href="timovi.php"><input type="submit" value="Potvrdi" name="rbPrikaz" id="rbPrikaz"></a>
   </div>
   <br>

   <!-- forma za dodavanje novog tima -->
   <div id="FormaDodavanjeTima">
   <fieldset>
   <form action="" method="post">
   <label for="">Dodajte nov tim: </label><br><br>
   <!-- <p>Dodajte nov tim : </p> -->
     <label for="novTim">Tim: </label>
     <input type="text" name="novTim" id="novTim">
     <!-- padajuca lista svih vlasnika -->
     <label for="sviVlasnici">Vlasnik: </label>
     <select name="sviVlasnici" id="sviVlasnici">
       <?php 
          $rezultatUpita = Vlasnik::vratiSveVlasnike($link);
          while($vlasnik = mysqli_fetch_array($rezultatUpita))
          {
            $imePrezime = $vlasnik['imeVlasnika'].' '.$vlasnik['prezimeVlasnika'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <!-- padajuca lista svih statusa -->
     <label for="sviStatusi">Status: </label>
     <select name="sviStatusi" id="sviStatusi">
        <?php
          $rezultatUpita = Status::vratiSveStatuse($link);
          while($status = mysqli_fetch_array($rezultatUpita))
          {
            $imeStatusa = $status['imeStatusa'];
        ?>
            <option value="<?php echo $imeStatusa ?>"><?php echo $imeStatusa?></option>
        <?php
          }
        ?>
     </select>
     <!-- dugme za brisanje tima -->
     <!-- u slucaju da mora da se dodaju novi vlasnik ili status -->
     </label>
     <br><br>
     <label for="">Ukoliko vlasnik ne postoji u padajućoj listi, dodajte ga ovde: </label><br><br>
     <!-- <p>Ukoliko vlasnik ne postoji u padajućoj listi, dodajte ga ovde: </p> -->
     <label for="imeNovogVlasnika">Ime vlasnika: </label>
     <input type="text" name="imeNovogVlasnika" id="imeNovogVlasnika">
     <label for="prezimeNovogVlasnika">Prezime vlasnika: </label>
     <input type="text" name="prezimeNovogVlasnika" id="prezimeNovogVlasnika">
     <label for="zemljaVlasnika">Zemlja vlasnika: </label>
     <input type="text" name="zemljaVlasnika" id="zemljaVlasnika">
     <br><br>
     <label for="">Ukoliko status ne postoji u padajućoj listi, dodajte ga ovde: </label><br><br>
     <!-- <p>Ukoliko status ne postoji u padajućoj listi, dodajte ga ovde: </p> -->
     <label for="noviStatus">Status: </label>
     <input type="text" name="noviStatus" id="noviStatus">
     <br>
     <br>
     <!-- dugme za dodavanje tima -->
     <button type="submit" name="dodavanjeTima" onclick="proveriFormuZaTima()">Dodaj tim</button>
     <button type="submit" name="brisanje" onclick="proveriFormuZaBrisanjeTima()">Obriši tim</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi1, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>
   
   <div id="FormaListanjeTimovaPoVlasnicima">
   <!-- forma za proveru tima po vlasnicima -->
   <fieldset>
   <form action="" method="post">
   <label for="">Pogledajte koje timove imamo u ponudi od strane nekog vlasnika: </label><br><br>
   <!-- <p>Pogledajte koje timove imamo u ponudi od nekog vlasnika : </p> -->
     <label for="vlasnik">vlasnik: </label>
     <select name="vlasnik" id="vlasnik">
      <?php 
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $rezultatUpita = Vlasnik::vratiSveVlasnike($link);
          while($vlasnik = mysqli_fetch_array($rezultatUpita))
          {
            $imePrezime = $vlasnik['imeVlasnika'].' '.$vlasnik['prezimeVlasnika'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <button type="submit" name="proveriTimove">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi2, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>

   <div id="FormaListanjeVlasnikaPoZemljama">
   <!-- forma za proveru vlasnika po zemljama -->
   <fieldset>
   <form action="" method="post">
   <label for="">Proverite koji sve vlasnici dolaze iz konkretne zemlje: </label><br><br>
     <label for="zemlje">Zemlja: </label>
     <select name="zemlje" id="zemlje">
          <?php
            $rez = Vlasnik::vratiSveZemljeRazlicito($link);
            while($redTabele = mysqli_fetch_array($rez))
              {
                $zemlja = $redTabele['zemljaPorekla'];
          ?>
              <option value="<?php echo $zemlja ?>"><?php echo $zemlja ?></option>
          <?php      
              }
          ?>
     </select>
     <button type="submit" name="proveriZemlje">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi3, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>
   
   
   <div id="FormaListanjeTimovaPoStatusima">
   <!-- forma za proveru tima po statusima -->
   <fieldset>
   <form action="" method="post">
   <label for="">Proverite koji sve timovi spadaju u konkretni status: </label><br><br>
   <!-- <p>Proverite koje sve timovi spadaju u konkretni status: </p> -->
   <label for="statusi">Status: </label>
   <select name="statusi" id="statusi">
      <?php
        $rezupita = Status::vratiSvaImenaStatusaRazlicito($link);
        while($status = mysqli_fetch_array($rezupita))
        {
          $imeStatusa = $status['imeStatusa'];
      ?>
          <option value="<?php echo $imeStatusa ?>"><?php echo $imeStatusa ?></option>
      <?php
        }
      ?>
      
   </select>
   <button type="submit" name="proveriStatus">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi4, 'divZaPrikazSvih')">
    </fieldset>
   </div>


   <!-- javascript -->
   <script>
      var blokovi1 = ["PrikazSvihTimova", "FormaListanjeTimovaPoVlasnicima", 
      "FormaListanjeVlasnikaPoZemljama", "FormaListanjeTimovaPoStatusima"];
      
      var blokovi2 = ["PrikazSvihTimova", "FormaDodavanjeTima", 
      "FormaListanjeVlasnikaPoZemljama", "FormaListanjeTimovaPoStatusima"];

      var blokovi3 = ["PrikazSvihTimova", "FormaListanjeTimovaPoVlasnicima", 
      "FormaDodavanjeTima", "FormaListanjeTimovaPoStatusima"];

      var blokovi4 = ["PrikazSvihTimova", "FormaListanjeTimovaPoVlasnicima", 
      "FormaListanjeVlasnikaPoZemljama", "FormaDodavanjeTima"];
      
      var sviBlokovi = ["PrikazSvihTimova", "FormaDodavanjeTima", "FormaListanjeTimovaPoVlasnicima", 
      "FormaListanjeVlasnikaPoZemljama", "FormaListanjeTimovaPoStatusima"];

   </script>

</body>
</html>



<?php
   //dodavanje novog tima u bazu
   if(isset($_POST['dodavanjeTima']))
   {
      
      $imeVlasnika;
      $prezimeVlasnika;
      $zemljaVlasnika;
      $imeStatusa;

      $povratniNiz = Navijac::iseciImePrezime($_POST['sviVlasnici']);
      $imeVlasnika = $povratniNiz['ime'];
      $prezimeVlasnika = $povratniNiz['prezime'];
      $imeStatusa = $_POST['sviStatusi'];

      //izmeni imeVlasnika, prezimeVlasnika i zemljaVlasnika ako je u pitanju novi vlasnik
      //dodaj novog vlasnika u bazu sa tim podacima
      if($_POST['imeNovogVlasnika'] != '' && $_POST['prezimeNovogVlasnika'] != '' &&  $_POST['zemljaVlasnika'] != '')
      {
         $imeVlasnika = $_POST['imeNovogVlasnika'];
         $prezimeVlasnika = $_POST['prezimeNovogVlasnika'];
         $zemljaVlasnika = $_POST['zemljaVlasnika'];
         $vlasnik = new Vlasnik($imeVlasnika, $prezimeVlasnika, $zemljaVlasnika);
         $vlasnik->unesiVlasnikaUBazu($link);
      }
      
      //izmeni imeStatusa ako je u pitanju novi status
      //kreiraj novi status u bazi sa tim imenom
      if($_POST['noviStatus'] != "")
      {
         $imeStatusa = $_POST['noviStatus'];
         $status = new Status($imeStatusa);
         if(!$status->postojiStatus($link))
           $status->unesiStatusUBazu($link);
         else
           echo "Status postoji u bazi!".'<br>';
      }

      //uzmi ID vlasnika sa tim imenom i prezimenom
      $vlasnikID = Vlasnik::vratiIdVlasnika($link, $imeVlasnika, $prezimeVlasnika);
      //uzmi ID statusa sa tim imenom
      $statusID = Status::vratiIdStatusa($link, $imeStatusa);
      $imeTima = $_POST['novTim'];
      if($imeTima == "")
        die();

      //dodavanje tima
      $tim = new Tim($imeTima, $vlasnikID, $statusID);
      if(!$tim->postojiTim($link))
        $tim->dodajTimUBazu($link);
      else
        echo "Tim već postoji u bazi!";     

   }

   //brisanje tima
   if(isset($_POST['brisanje']))
   {
     $imeTima = $_POST['novTim'];
     $povratniNiz = Navijac::iseciImePrezime($_POST['sviVlasnici']);
     $imeVlasnika = $povratniNiz['ime'];
     $prezimeVlasnika = $povratniNiz['prezime'];
     $imeStatusa = $_POST['sviStatusi'];

     if($_POST['imeNovogVlasnika'] != "" || $_POST['prezimeNovogVlasnika'] != "" ||
     $_POST['zemljaVlasnika'] != "" || $_POST['noviStatus'] != "")
      {
        die();
      }

     $vlasnikID = Vlasnik::vratiIdVlasnika($link, $imeVlasnika, $prezimeVlasnika);
     $statusID = Status::vratiIdStatusa($link, $imeStatusa);
    
     $timZaBrisanje = new Tim($imeTima, $vlasnikID, $statusID);
     $timZaBrisanje->izbaciTimIzBaze($link);

     var_dump($_POST);

   }
   //ideje : izlistaj vlasnike po zemljama, izlistaj timove po vlasnicima, tim po statusima ...
   
   //izlistaj timive po vlasnicima
   if(isset($_POST['proveriTimove']))
   {
      $imePrezimeVlasnika = $_POST['vlasnik'];
      $niz = Navijac::iseciImePrezime($imePrezimeVlasnika);
      $idVlasnika = Vlasnik::vratiIdVlasnika($link, $niz['ime'], $niz['prezime']);

      echo "<table border=2>";
       echo "<tr>";
         echo "<th>"; echo "Vlasnik"; echo "</th>";
         echo "<th>"; echo "Tim"; echo "</th>";
         echo "<th>"; echo "Status"; echo "</th>";
       echo "</tr>";
         $rezUpita = Tim::vratiTimSpojenoSaStatusom($link);
         while($tim = mysqli_fetch_array($rezUpita))
         {
           if($tim['vlasnikID'] == $idVlasnika)
           {
              echo "<tr>";
                echo "<td>"; echo $niz['ime'].' '.$niz['prezime']; echo "</td>";
                echo "<td>"; echo $tim['imeTima']; echo "</td>";
                echo "<td>"; echo $tim['imeStatusa']; echo "</td>";
              echo "</tr>";
           }
         }

      echo "</table>";
   }

   //provera koji vlasnici dolaze iz koje zemlje
   if(isset($_POST['proveriZemlje']))
   {

      $zemlja = $_POST['zemlje'];
      $rezulUpita = Vlasnik::vratiSveVlasnike($link);

      echo "<table border=2>";
      echo "<tr>";
         echo "<th>"; echo "Vlasnik"; echo "</th>";
         echo "<th>"; echo "Zemlja"; echo "</th>";
       echo "</tr>";

      while($vlasnik = mysqli_fetch_array($rezulUpita))
      {
          if($vlasnik['zemljaPorekla'] == $zemlja)
          {
            echo "<tr>";
              echo "<td>"; echo $vlasnik['imeVlasnika'].' '.$vlasnik['prezimeVlasnika']; echo "</td>";
              echo "<td>"; echo $vlasnik['zemljaPorekla']; echo "</td>";
           echo "</tr>";
          }
      }

      echo "</table>";
   }

   //izlistaj timove po statusu
   if(isset($_POST['proveriStatus']))
   {
     echo "<br>";
     $imeStatusa = $_POST['statusi'];
     $tabela = Tim::vratiTimSpojenoSaStatusomSpojenoSaVlasnikom($link);

     echo "<table border=2>";
     echo "<tr>";
         echo "<th>"; echo "Tim"; echo "</th>";
         echo "<th>"; echo "Vlasnik"; echo "</th>";
         echo "<th>"; echo "Status"; echo "</th>";
     echo "</tr>";
     
     while($tim = mysqli_fetch_array($tabela))
     {
        if($tim['imeStatusa'] == $imeStatusa)
        {
          echo "<tr>";
           echo "<td>"; echo $tim['imeTima']; echo "</td>";
           echo "<td>"; echo $tim['imeVlasnika'].' '.$tim['prezimeVlasnika']; echo "</td>";
           echo "<td>"; echo $tim['imeStatusa']; echo "</td>";
          echo "</tr>";
        }
     }

     echo "</table>";
   }
   

?>

