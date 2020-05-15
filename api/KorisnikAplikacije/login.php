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
      array('login' => 'OK',
      'id' => $user->id_korisnik,
      'ime' => $user->ime,
      'prezime' => $user->prezime,
      'emai' => $user->email,
      'datumRodjenja' => $user->datumRodjenja,
      'grad_id' => $user->grad_id,
      'grad' => $user->grad,
      'uloga' => $user->uloga
      )
    );
  } else {
    echo json_encode(
      array('login' => 'Error')
    );
  }
