<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/TipPrevoznika.php';

  $database = new Database();
  $db = $database->connect();

  $type = new TipPrevoznika($db);

  $data = json_decode(file_get_contents("php://input"));

  $type->naziv = $data->naziv;

  if($type->naziv == '')
    die;
    
  if($type->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
