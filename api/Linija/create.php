<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';
  include_once '../../models/Relacija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);
  $relacija = new Relacija($db);

  $data = json_decode(file_get_contents("php://input"));

  $linija->vozac_id = $data->vozac_id;
  $linija->vozilo_id = $data->vozilo_id;
  $linija->relacija_id = $data->relacija_id;
  $relacija->id_relacija = $data->relacija_id;
  $linija->sljedecaStanica_id = $relacija->getSljedecaStanica();
  $linija->planiraniPolazak = $data->polazak;
  $linija->planiraniDolazak = $data->dolazak;
 
  $newid = $linija->create();

  if($newid) {
    echo json_encode(
      array('status' => 'OK', 'id' => $newid)
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
