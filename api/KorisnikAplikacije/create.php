<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/KorisnikAplikacije.php';

  $database = new Database();
  $db = $database->connect();

  $user = new KorisnikAplikacije($db);

  $data = json_decode(file_get_contents("php://input"));

  $user->ime = $data->ime;
  $user->prezime = $data->prezime;
  $user->email = $data->email;
  $user->passwordHash = $data->password;
  $user->datumRodjenja = $data->datumRodjenja;
  $user->grad_id = $data->grad_id;
  $user->uloga_id = $data->uloga_id;

  if($user->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
