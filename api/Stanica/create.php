<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Stanica.php';

  $database = new Database();
  $db = $database->connect();

  $station = new Stanica($db);

  $data = json_decode(file_get_contents("php://input"));

  $station->naziv = $data->naziv;
  $station->lat = $data->lat;
  $station->lng = $data->lng;
  $station->adresa = $data->adresa;
  $station->grad_id = $data->grad_id;

  if($station->naziv == '')
    die;
    
  if($station->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
