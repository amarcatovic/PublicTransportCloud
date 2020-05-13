<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Korisnik.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Korisnik($db);

  $data = json_decode(file_get_contents("php://input"));

  $user->brojKartice = $data->brojKartice;
  $user->stanje = $data->vrijednost;


  if($user->update()) {
    echo json_encode(
      array('message' => 'OK')
    );
  } else {
    echo json_encode(
      array('message' => 'Error')
    );
  }

