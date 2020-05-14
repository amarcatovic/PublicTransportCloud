<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiZahtjev.php';

  $database = new Database();
  $db = $database->connect();

  $taxi = new TaxiZahtjev($db);

  $data = json_decode(file_get_contents("php://input"));

  $taxi->id_zahtjev = $data->id;
  $taxi->vrijemeDolaska = $data->dolazak;
  $taxi->vozac_id = $data->vozac_id;
  $taxi->status = 'Prihvaćen';

  if($taxi->update()) {
    echo json_encode(
      array('message' => 'Phihvaćeno')
    );
  } else {
    echo json_encode(
      array('message' => 'Greška')
    );
  }

