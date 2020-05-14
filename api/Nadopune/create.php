<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Nadopune.php';
  include_once '../../models/Korisnik.php';

  $database = new Database();
  $db = $database->connect();

  $nadopuna = new Nadopune($db);
  $korisnik = new Korisnik($db);

  $data = json_decode(file_get_contents("php://input"));

  $korisnik->brojKartice = $data->brojKartice;
  $nadopuna->kolicina = $data->kolicina;
  $korisnik->stanje = $data->kolicina;
  $nadopuna->prodajnoMjesto_id = $data->prodajnoMjesto_id;

  if($nadopuna->kolicina <= 0 || $korisnik->brojKartice == '')
    die;
    
  $nadopuna->korisnik_id = $korisnik->getIdFromKartica(); 

  if($nadopuna->create() && $korisnik->update()) {
    echo json_encode(
      array('status' => 'Nadopunjeno')
    );
  } else {
    echo json_encode(
      array('status' => 'Error')
    );
  }
