<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Enciklopedija navijanja by Nikola</title>
<style>
 a{
    color: black;
    text-decoration: none;
  }
// prvi commit posle initial commit
// drugi commit posle prvog commit-a.
  body {

  font-weight: 10px;
  background-color: lightblue; 
 



  background-repeat: no-repeat;
  background-position:center;
  
  }
  h1{
    text-align: center;
    align-items: center;
    border: yellowgreen solid 2px;
    opacity: 1;
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
    width: 30%;
    align-items: center;
    text-align: center;
    
  }
 
 
.dugmad{
     line-height: 12px;
     width: 10%;
     height: 10%;

     font-size: 8pt;
     font-family: tahoma;
     margin-top: 1px;
     margin-right: 2px;
     position:absolute;
     top:0;
     right:0;
 }


 
  a{
    list-style-type: none;
    margin: 0;
    padding: 0;
  }
  ul{
    display: inline;
  }
  li{
    display: inline;
    border: #ffb266 solid 5px;
    
  }
  div{
    display: flex;
  flex-direction: row;
  justify-content: space-around;
  }
  .button{
    border-radius: 50%;
    border: none;
    width: 100px;
    height: 40px;
    cursor: pointer;
    margin: 3px;
    background-color: #555555;
  }
  .center {
    display: flex;
  justify-content: center;
  align-items: center;
  border: 3px solid green; 
  }
</style>
  </head>
  <body>
  <h1>Online enciklopedija o navijanju by NIkola</h1>
  <div>
   <button type="submit" name="vise" id="vise">Saznajte više o fudbalu</button>
   <br/>
   <button type="submit" name="skloni" id="skloni" onclick="skloniDiv('textFudbal')">Refreshuj interface</button>
   <br><br>
   <button type="submit" name="najboljiDugme" id="najboljiDugme">Učitaj listu najboljih vlasnika</button>
   <br/>
   <button type="submit" name="skloniNajbolje" id="skloniNajbolje" onclick="skloniDiv('najboljiVlasnici')">Ukloni najbolje vlasnike</button>
   </div>
    <br/>
    
   <div>
    <button class="button center"><a href="navijac.php" target="_blank">Navijaci</a></button>
        <br/>
        <button class="button center"><a href="timovi.php" target="_blank">Timovi</a></button>
        </div>
    <br><br><br><br>
    <div id="textFudbal" style="background-color: white"></div>
    <div id="najboljiVlasnici"></div>
    <br/>
    <button onclick="odbrojavanje()" class="dugmad">Odbrojavanje</button>
    <script>

    // AJAXA 1
    // tekst iz fajla se ucitava pritiskom na dugme
     document.getElementById("vise").addEventListener("click", ucitajTekst);

    //funkcija za ucitavanje teksta
    function ucitajTekst() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "tekst.txt", true);

      xhr.onload = function () {
        if (this.status == 200) {
          document.getElementById("textFudbal").innerHTML = this.responseText; //ispisi taj tekst na stranici
        }
      };

      xhr.send();
    }

    function skloniDiv(div) {
      document.getElementById(div).innerHTML = "";
    }

    // AJAXA 2
    //niz vlasnika iz json fajla se ucita pritiskom na dugme
    document.getElementById("najboljiDugme").addEventListener("click", ucitajVlasnike);
    
    //funkcija za ucitavanje vlasnika
    function ucitajVlasnike() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "najbolji.json", true);

        xhr.onload = function () {
          if (this.status == 200) {
            var vlasnici = JSON.parse(this.responseText); //funkcija koja je potrebna kad radis sa JSON objektom,
            //da bi mogao da ga parsiras niz objekata u ovom slucaju, pa da pristupas poljima dot operatorom

            var output = "";

            //prolazim kroz niz objekata 
            for (var i in vlasnici) {
              output +=
                "<ul>" +
                "<li>ID: " +
                vlasnici[i].vlasnikID +
                " </li>" +
                "<li>name: " +
                vlasnici[i].ime +
                " </li>" +
                "<li>prezime: " +
                vlasnici[i].prezime +
                " </li>" +
                "</ul>";
            }

            document.getElementById("najboljiVlasnici").innerHTML = output;
          }
        };

        xhr.send();
      }

       function odbrojavanje() {

        setTimeout(()=>{
         
          location.reload();



        },10000)





      }

    </script>
  </body>
</html>
