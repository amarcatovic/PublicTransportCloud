<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/VozacVozilo.php';

  $database = new Database();
  $db = $database->connect();

  $razduzi = new VozacVozilo($db);

  $data = json_decode(file_get_contents("php://input"));

  $razduzi->vozilo_id = $data->registracija;

  if($razduzi->update()) {
    echo json_encode(
      array('message' => 'Vozilo Razduženo')
    );
  } else {
    echo json_encode(
      array('message' => 'Greška pri razduživanju vozila')
    );
  }

