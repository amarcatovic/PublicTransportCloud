<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiVozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new TaxiVozac($db);

  $user->automobil_id = isset($_GET['reg']) ? $_GET['reg'] : die();

  $user->read_single_registracija();

  

  $category_arr = array(
    'id' => $user->id_vozac,
    'ime' => $user->ime,
    'prezime' => $user->prezime,
    'email' => $user->email,
    'datumRodjenja' => $user->datumRodjenja,
    'grad_id' => $user->grad_id,
    'grad' => $user->grad,
    'prevoznik_id' => $user->prevoznik_id,
    'prevoznik' => $user->prevoznik,
    'registracija' => $user->automobil_id,
    'marka' => $user->marka,
    'model' => $user->model,
    'boja' => $user->boja,
    'brojTaxiDozvole' => $user->brojTaxiDozvole,
    'ocjena' => $user->ocjena
  );

  print_r(json_encode($category_arr));
