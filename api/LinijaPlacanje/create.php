<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

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

  $data = json_decode(file_get_contents("php://input"));

  $vozilo->id_vozilo = $data->registracija;
  $korisnik->brojKartice = $data->kartica;

  //Je li vozilo na aktivnoj linijji, te vrati ID linije na kojoj je vozilo
  $pay->linija_id = $vozilo->voziloAktivno();
  $linija->id_linija = $pay->linija_id;
  if($pay->linija_id == false)
    die;
  
  //Vrati ID korisnika
  $korisnik->id_korisnik = $korisnik->getIdFromKartica();

  //Je li korisnik platio već ovu liniju
  if($pay->LinijaPlacena() == true)
    die;

  //Sve provjere prošle, skini novac i zabilježi u bazu
  $relacija->id_relacija = $linija->getRelacijaId();
  $pay->kolicina = $relacija->getCijena();
  $korisnik->stanje = -1 * $pay->kolicina;

  /* -------------------------------------------------------- */
  /* TODO: PROVJERA DA LI KORISNIK IMA NOVAC DA PLATI LINIJU */
  /* -------------------------------------------------------- */


  if($pay->kolicina <= 0 || $korisnik->brojKartice == '')
     die;
    
    $pay->korisnik_id = $korisnik->getIdFromKartica(); 

  if($pay->create() && $korisnik->update()) {
    echo json_encode(
      array('status' => 'Placeno')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
