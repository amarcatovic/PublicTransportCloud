<?php
  // Headers
  if($_SERVER["REQUEST_METHOD"] != "POST")
    die;
    
    

  include_once '../../config/Database.php';
  include_once '../../models/LinijaPlacanje.php';
  include_once '../../models/Korisnik.php';
  include_once '../../models/Linija.php';
  include_once '../../models/Vozilo.php';
  include_once '../../models/Relacija.php';

  $database = new Database();
  $db = $database->connect();

  
  $pay = new LinijaPlacanje($db);
  $korisnik = new Korisnik($db);
  $linija = new Linija($db);
  $vozilo = new Vozilo($db);
  $relacija = new Relacija($db);
  
  $vozilo->id_vozilo = isset($_POST['reg']) ? $_POST['reg'] : die();
  $korisnik->brojKartice = isset($_POST['card']) ? $_POST['card'] : die();
 

  //Je li vozilo na aktivnoj linijji, te vrati ID linije na kojoj je vozilo
  $pay->linija_id = $vozilo->voziloAktivno();
  $linija->id_linija = $pay->linija_id;
  if($pay->linija_id == false)
    die;

 
  //Vrati ID korisnika
  $korisnik->id_korisnik = $korisnik->getIdFromKartica();
  $pay->korisnik_id = $korisnik->id_korisnik;

  //Je li korisnik platio već ovu liniju
  if($pay->LinijaPlacena() == true)
  {
    echo "Placeno";
    die;
  }

  //Sve provjere prošle, skini novac i zabilježi u bazu
  $relacija->id_relacija = $linija->getRelacijaId();
  $pay->kolicina = $relacija->getCijena();
  $korisnik->stanje = -1 * $pay->kolicina;

  if($korisnik->getStanje() < $pay->kolicina)
  {
      echo "Novac";
      die;
  }


  if($pay->kolicina <= 0 || $korisnik->brojKartice == '')
     die;
    
    $pay->korisnik_id = $korisnik->getIdFromKartica(); 

  if($pay->create() && $korisnik->update()) {
    echo "success";
  } else {
    echo "no";
  }
