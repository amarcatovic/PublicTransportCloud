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

  $user->email = $data->email;
  $passwordRaw = $data->password;

  $user->login();

  if(password_verify($passwordRaw, $user->passwordHash)) {
    echo json_encode(
      array('login' => 'Success')
    );
  } else {
    echo json_encode(
      array('login' => 'Error')
    );
  }
