<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/VozacVozilo.php';

  $database = new Database();
  $db = $database->connect();

  $zaduzenje = new VozacVozilo($db);

  $data = json_decode(file_get_contents("php://input"));

  $zaduzenje->vozac_id = $data->vozac_id;
  $zaduzenje->vozilo_id = $data->vozilo_id;
 
  if($zaduzenje->create()) {
    echo json_encode(
      array('status' => 'Zadužen')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
