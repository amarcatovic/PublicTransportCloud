<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Drzava.php';

  $database = new Database();
  $db = $database->connect();

  $country = new Drzava($db);

  $data = json_decode(file_get_contents("php://input"));

  $country->naziv = $data->naziv;

  if($country->naziv == '')
    die;
    
  if($country->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
