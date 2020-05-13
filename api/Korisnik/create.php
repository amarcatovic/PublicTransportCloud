<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Korisnik.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Korisnik($db);
  $appUser = new KorisnikAplikacije($db);

  $data = json_decode(file_get_contents("php://input"));

  $appUser->ime = $data->ime;
  $appUser->prezime = $data->prezime;
  $appUser->email = $data->email;
  $appUser->passwordHash = $data->password;
  $appUser->grad_id = $data->grad_id;
  $appUser->uloga_id = 5;
  $appUser->datumRodjenja = $data->datum;

  $user->brojKartice = $data->brojKartice;
  $user->stanje = $data->stanje;

  if($appUser->ime == '')
    die;
    
  $user->id_korisnik = $appUser->create();

  if($user->create()) {
    echo json_encode(
      array('status' => 'OK')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
