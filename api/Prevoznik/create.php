<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Prevoznik.php';

  $database = new Database();
  $db = $database->connect();

  $prevoznik = new Prevoznik($db);

  $data = json_decode(file_get_contents("php://input"));

  $prevoznik->naziv = $data->naziv;
  if($prevoznik->naziv == '')
    die;
  $prevoznik->email = $data->email;
  $prevoznik->telefon = $data->telefon;
  $prevoznik->passwordHash = $data->password;
  $prevoznik->tip_id = $data->tip_id;
  $prevoznik->grad_id = $data->grad_id;

    
  if($prevoznik->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
