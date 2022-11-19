var a = 1;

function skloniBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "none";
  }
  document.getElementById(div).style.display = "inline";
}

function prikaziBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "inline";
  }
  document.getElementById(div).style.display = "none";
}

function proveriFormuZaTima() {
  if (document.getElementById("novTim").value == "") {
    confirm("Morate uneti ime tima!");
    return;
  }

  if (
    (document.getElementById("imeNovogVlasnika").value != "" &&
      document.getElementById("prezimeNovogVlasnika").value == "" &&
      document.getElementById("zemljaVlasnika").value == "") ||
    (document.getElementById("imeNovogVlasnika").value == "" &&
      document.getElementById("prezimeNovogVlasnika").value != "" &&
      document.getElementById("zemljaVlasnika").value == "") ||
    (document.getElementById("imeNovogVlasnika").value == "" &&
      document.getElementById("prezimeNovogVlasnika").value == "" &&
      document.getElementById("zemljaVlasnika").value != "") ||
    (document.getElementById("imeNovogVlasnika").value != "" &&
      document.getElementById("prezimeNovogVlasnika").value != "" &&
      document.getElementById("zemljaVlasnika").value == "") ||
    (document.getElementById("imeNovogVlasnika").value != "" &&
      document.getElementById("prezimeNovogVlasnika").value == "" &&
      document.getElementById("zemljaVlasnika").value != "") ||
    (document.getElementById("imeNovogVlasnika").value == "" &&
      document.getElementById("prezimeNovogVlasnika").value != "" &&
      document.getElementById("zemljaVlasnika").value != "")
  ) {
    alert("Popunite ispravno podatke vlasnika!");
  }
}

function proveriFormuZaBrisanjeTima() {
  if (
    document.getElementById("imeNovogVlasnika").value != "" ||
    document.getElementById("prezimeNovogVlasnika").value != "" ||
    document.getElementById("zemljaVlasnika").value != "" ||
    document.getElementById("noviStatus").value != ""
  ) {
    alert(
      "Ne smete popunjavati podatke o vlasniku ili timu ukoliko brišete postojeći tim!"
    );
  }
}

function proveriFormuZaUnosNavijaca() {
  if (
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorijaClanstva").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorijaClanstva").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorijaClanstva").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorijaClanstva").value != "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorijaClanstva").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorijaClanstva").value != "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value !== "" &&
      document.getElementById("kategorijaClanstva").value != "")
  ) {
    alert("Morate popuniti sve podatke o navijacu!");
    return;
  }

  if (
    document.getElementById("kategorijaClanstva").value > 3 ||
    document.getElementById("kategorijaClanstva").value == 0
  ) {
    alert("Kategorija članstva mora biti u skupu vrednosti {1, 2, 3}!");
  }
}

function skloniDiv(div) {
  document.getElementById(div).innerHTML = "";
}

function loadText() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "tekst.txt", true);

  xhr.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      document.getElementById("textFudbal").innerHTML = this.responseText;
    }
  };

  xhr.send();
}
