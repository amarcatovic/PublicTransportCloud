<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Grad.php';

  $database = new Database();
  $db = $database->connect();

  $city = new Grad($db);

  $data = json_decode(file_get_contents("php://input"));

  $city->naziv = $data->naziv;
  $city->drzava_id = $data->drzava_id;
  $city->lat = $data->lat;
  $city->lng = $data->lng;

  if($city->naziv == '')
    die;
    
  if($city->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
