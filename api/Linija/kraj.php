<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);

  $data = json_decode(file_get_contents("php://input"));

  $linija->id_linija = $data->id;

  // Update post
  if($linija->zavrsiLiniju()) {
    echo json_encode(
      array('message' => 'Linija Završena')
    );
  } else {
    echo json_encode(
      array('message' => 'Error')
    );
  }

