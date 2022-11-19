<?php

 class Navijac
 {
   private $navijacID;
   private $ime;
   private $prezime;
   private $kategorijaClanstvaID;

   public function __construct($ime, $prezime, $kategorijaClanstvaID)
   {
    $this->ime = $ime;
    $this->prezime = $prezime;
    if($kategorijaClanstvaID == 1 || $kategorijaClanstvaID == 2 || $kategorijaClanstvaID == 3)
      $this->kategorijaClanstvaID = $kategorijaClanstvaID;
    else
      die();
   } 

   //upisivanje navijaca u bazu
   function upisiUBazu($baza)
   {
      $sqlUpit = "INSERT INTO navijac(ime, prezime,kategorijaClanstvaID)
      VALUES('$this->ime', '$this->prezime', '$this->kategorijaClanstvaID')";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
         echo "Navijac je uspešno ubačen u bazu!".'<br>';
      else
         echo "Došlo je do greške prilikom ubacivanja navijaca!".'<br>'; 
   }

    //da li navijac postoji u bazi
    function postojiUBazi($baza)
    {
       $rez = self::vratiSveNavijace($baza);
       while($korisnik = mysqli_fetch_array($rez))
       {
         if($korisnik['ime'] == $this->ime &&  $korisnik['prezime'] == $this->prezime)
            return true;
       }
      
       return false;
     } 

    //vracam rezultat select * upita, jer ga imam na dosta mesta
     static function vratiSveNavijace($baza)
     {
       $sql = "SELECT * FROM navijac";
       $rez = mysqli_query($baza, $sql);
       return $rez;
     }

     //vracam ID navijaca na osnovu imena i prezimena
     static function vratiIDnavijaca($baza, $ime, $prezime)
     {
        $rez = self::vratiSveNavijace($baza);
        while($navijac = mysqli_fetch_array($rez))
        {
          if($navijac['ime'] == $ime && $navijac['prezime'] == $prezime)
              return $navijac['navijacID'];
        }

        return false;
     }

     //secem ime i prezime na osnovu spojenog imena i prezimena
     static function iseciImePrezime($string)
     {
       $niz = explode(" ", $string);
       $povratniNiz = ['ime' => $niz[0], 'prezime' => $niz[1]];
       return $povratniNiz;
     }

     //izbacivanje navijaca 
     static function izbaciNavijaca($baza, $navijacID)
     {
        $sqlUpit = "DELETE FROM navijac WHERE navijacID = $navijacID";
        $rez = mysqli_query($baza, $sqlUpit);
        if($rez)
          echo "Navijac je uspešno izbačen!".'<br>';
        else
          echo "Došlo je do greške prilikom izbacivanja!".'<br>';        
     }

 }

 class Tim
 {
    private $idTima;
    private $imeTima;
    private $vlasnikID;
    private $statusID;

    public function __construct($imeTima, $vlasnikID, $statusID)
    {
      $this->imeTima = $imeTima;
      $this->vlasnikID = $vlasnikID;
      $this->statusID = $statusID;
    }

    //pravim select * upit jer ce mi cesto trebati
    static function vratiSveTimove($baza)
    {
      $sqlUpit = "SELECT * FROM tim";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

    static function vratiIDTimaNaOsnovuImena($baza, $imeTima)
    {
      $rezultatUpita = self::vratiSveTimove($baza);
      while($tim = mysqli_fetch_array($rezultatUpita))
      {
        if($tim['imeTima'] == $imeTima)
          return $tim['idTima'];
      }

      return false;
    }

    //dodavanje tima u bazu
    function dodajTimUBazu($baza)
    {
      $sqlUpit = "INSERT INTO tim(imeTima, vlasnikID, statusID)
      VALUES('$this->imeTima', '$this->vlasnikID', '$this->statusID')";
      $rezultatUpita = mysqli_query($baza, $sqlUpit);
      if($rezultatUpita)
        echo "Tim je uspešno dodata u bazu!".'<br>';
      else
        echo "Došlo je do greške prilikom dodavanja tima!".'<br>';
    }

    //izbacivanje tima iz baze
    function izbaciTimIzBaze($baza)
    {
      $sqlUpit = "DELETE FROM tim WHERE imeTima = '$this->imeTima'
      AND vlasnikID = '$this->vlasnikID' AND statusID = '$this->statusID'";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
        echo "Tim je uspešno obrisana iz baze!".'<br>';
      else  
        echo "Došlo je do greške prilikom brisanja tima iz baze!".'<br>';
    }

    function postojiTim($baza)
    {
      $rez = self::vratiSveTimove($baza);
      while($tim = mysqli_fetch_array($rez))
      {
        if($tim['imeTima'] == $this->imeTima)
        {
            return true;
        }
      }
      return false;
    }

    static function vratiTimSpojenoSaStatusom($baza)
    {
      $sqlUpit = "SELECT * FROM tim JOIN status USING(statusID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

    static function vratiTimSpojenoSaStatusomSpojenoSaVlasnikom($baza)
    {
      $sqlUpit = "SELECT * FROM tim k JOIN status USING(statusID)
      JOIN vlasnik USING(vlasnikID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

 }

 class UzeoTim
 {
   private $navijacID;
   private  $idTima;

   public function __construct($navijacID, $idTima)
   {
     $this->navijacID = $navijacID;
     $this->idTima = $idTima;
   }

   //vracam rezultat select * upita jer mi se dosta puta ponavlja
   static function vratiSvaUzimanja($baza)
   {
     $sqlUpit = "SELECT * FROM navijaza";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   //vracam rezultat upita spajanja tabele navijaza sa tabelama Navijac i Tim (tabele na koje ona referise)
   static function vratiSpojenoNavijacTim($baza)
   {
      $sqlUpit = "SELECT * FROM navijaza u JOIN navijac c USING(navijacID)
      JOIN tim k USING(idTima)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }

   static function vratiSpojenoNavijacTimVlasnik($baza)
   {
     $sqlUpit = "SELECT * FROM navijaza u JOIN navijac c USING(navijacID)
     JOIN tim k USING(idTima) JOIN vlasnik p USING(vlasnikID)";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   static function postojiParNavijacTim($baza, $navijacID, $idTima)
   {
     $sqlUpit = "SELECT * FROM navijaza";
     $rez = mysqli_query($baza, $sqlUpit);
     while($korisnik = mysqli_fetch_array($rez))
     {
       if($korisnik['navijacID'] == $navijacID && $korisnik['idTima'] == $idTima)
       {
          return true;
       }
     }
     return false;
   }

   static function ubaciParNavijacTimUBazu($baza, $navijacID, $idTima)
   {
     $sqlUpit = "INSERT INTO navijaza(navijacID, idTima) VALUES('$navijacID', '$idTima')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Navijac je uspešno uzeo tim.".'<br>';
     else
       echo "Došlo je do greške prilikom uzimanja tima.".'<br>';
   }

   static function izbaciParNavijacTim($baza, $navijacID, $idTima)
   {
     $sqlUpit = "DELETE FROM navijaza WHERE navijacID = $navijacID AND idTima = $idTima";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Navijac je uspešno ostavio tim.".'<br>';
     else
       echo "Došlo je do greške prilikom ostavljanja tima.".'<br>';
   }

 }

 class Vlasnik 
 {
   private $vlasnikID;
   private $imeVlasnika;
   private $prezimeVlasnika;
   private $zemljaPorekla;

   public function __construct($imeVlasnika, $prezimeVlasnika, $zemljaPorekla)
   {
     $this->imeVlasnika = $imeVlasnika;
     $this->prezimeVlasnika = $prezimeVlasnika;
     $this->zemljaPorekla = $zemljaPorekla;
   }

   //funkcija koja vraca select * upit iz tabele vlasnik
   public static function vratiSveVlasnike($baza)
   {
      $sqlUpit = "SELECT * FROM vlasnik";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }

   public static function vratiIdVlasnika($baza, $ime, $prezime)
   {
     $rezultatUpita = self::vratiSveVlasnike($baza);
     while($vlasnik = mysqli_fetch_array($rezultatUpita))
     {
       if($vlasnik['imeVlasnika'] == $ime && $vlasnik['prezimeVlasnika'] == $prezime)
            return $vlasnik['vlasnikID'];
     }
     return false;
   }

   function unesiVlasnikaUBazu($baza)
   {
     $sqlUpit = "INSERT INTO vlasnik(imeVlasnika, prezimeVlasnika, zemljaPorekla)
     VALUE ('$this->imeVlasnika', '$this->prezimeVlasnika', '$this->zemljaPorekla')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Vlasnik je uspešno ubačen u bazu!".'<br>';
     else
       echo "Greška prilikom izvršavanja ubacivanja!".'<br>';
   }

   static function vratiSveZemljeRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT zemljaPorekla FROM vlasnik";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
 }

 class Status
 {
   private $statusID;
   private $imeStatusa;

   public function __construct($imeStatusa)
   {
     $this->imeStatusa = $imeStatusa;
   }

   public static function vratiSveStatuse($baza)
   {
     $sqlUpit = "SELECT * FROM status";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   public static function vratiSvaImenaStatusaRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT imeStatusa FROM status";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   public static function vratiIdStatusa($baza, $imeStatusa)
   {
     $rezultatUpita = self::vratiSveStatuse($baza);
     while($status = mysqli_fetch_array($rezultatUpita))
     {
       if($status['imeStatusa'] == $imeStatusa)
          return $status['statusID'];
     }
     return false;
   }

   function postojiStatus($baza)
   {
     $rez = self::vratiSveStatuse($baza);
     while($status = mysqli_fetch_array($rez))
     {
       if($status['imeStatusa'] == $this->imeStatusa)
          return true;
     }

     return false;
   }

   function unesiStatusUBazu($baza)
   {
     $sqlUpit = "INSERT INTO status(imeStatusa) VALUES('$this->imeStatusa')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Status je uspešno unet!".'<br>';
     else
       echo "Došlo je do greške prilikom unosa statusa!".'<br>';
   }
 }
?>


