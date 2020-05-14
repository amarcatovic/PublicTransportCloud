<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiZahtjev.php';
  include_once '../../models/Korisnik.php';

  $database = new Database();
  $db = $database->connect();

  $taxi = new TaxiZahtjev($db);
  $korisnik = new Korisnik($db);

  $data = json_decode(file_get_contents("php://input"));

  $taxi->id_zahtjev = $data->id;
  $taxi->cijena = $taxi->GetCijenaVoznje();
  $korisnik->stanje = -1 * $taxi->cijena;
  $korisnik->brojKartice = $data->kartica;

  if($taxi->plati() && $korisnik->update()) {
    echo json_encode(
      array('message' => 'Vožnja plaćena')
    );
  } else {
    echo json_encode(
      array('message' => 'Greška')
    );
  }

