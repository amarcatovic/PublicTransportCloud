<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/ProdajnoMjesto.php';

  $database = new Database();
  $db = $database->connect();

  $shop = new ProdajnoMjesto($db);

  $data = json_decode(file_get_contents("php://input"));

  $shop->naziv = $data->naziv;
  $shop->lat = $data->lat;
  $shop->lng = $data->lng;
  $shop->adresa = $data->adresa;
  $shop->grad_id = $data->grad_id;

  if($shop->naziv == '')
    die;
    
  if($shop->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
