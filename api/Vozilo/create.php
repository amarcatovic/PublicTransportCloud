<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Vozilo.php';

  $database = new Database();
  $db = $database->connect();

  $vehicle = new Vozilo($db);

  $data = json_decode(file_get_contents("php://input"));

  $vehicle->id_vozilo = $data->registracija;
  $vehicle->kapacitet = $data->kapacitet;
  $vehicle->naziv = $data->naziv;
  $vehicle->tip_id = $data->tip_id;
  $vehicle->prevoznik_id = $data->prevoznik_id;

  if($vehicle->naziv == '')
    die;
    
  if($vehicle->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
