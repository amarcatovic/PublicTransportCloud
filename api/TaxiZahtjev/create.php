<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiZahtjev.php';

  $database = new Database();
  $db = $database->connect();

  $taxi = new TaxiZahtjev($db);

  $data = json_decode(file_get_contents("php://input"));

  $taxi->lokacija = $data->lokacija;
  $taxi->opis = $data->opis;
  $taxi->korisnik_id = $data->id;

  if($taxi->lokacija == '')
    die;
    
  if($taxi->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
