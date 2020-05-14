<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Relacija.php';
  include_once '../../models/PrevoznikRelacija.php';

  $database = new Database();
  $db = $database->connect();

  $relacija = new Relacija($db);
  $prevoznikRelacija = new PrevoznikRelacija($db);

  $data = json_decode(file_get_contents("php://input"));

  $relacija->cijena = $data->cijena;
  if($relacija->cijena <= 0)
    die;
  $relacija->polaziste_id = $data->polaziste_id;
  $relacija->odrediste_id = $data->odrediste_id;
  $relacija->interval_id = $data->interval_id;
  $relacija->tipVozila_id = $data->tipVozila_id;

  $prevoznikRelacija->prevoznik_id = $data->prevoznik_id;
  $prevoznikRelacija->relacija_id = $relacija->create();
    
  if($prevoznikRelacija->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
