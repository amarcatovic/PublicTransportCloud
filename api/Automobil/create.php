<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Automobil.php';

  $database = new Database();
  $db = $database->connect();

  $car = new Automobil($db);

  $data = json_decode(file_get_contents("php://input"));

  $car->id_automobil = $data->registracija;
  $car->marka = $data->marka;
  $car->model = $data->model;
  $car->boja = $data->boja;

  if(strlen($car->id_automobil) < 3)
    die;
    
  if($car->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
