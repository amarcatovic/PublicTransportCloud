<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiVozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new TaxiVozac($db);

  $user->id_vozac = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_single();

  if($user->ime == null)
    die;

  $category_arr = array(
    'id' => $user->id_vozac,
    'ime' => $user->ime,
    'prezime' => $user->prezime,
    'email' => $user->email,
    'datumRodjenja' => $user->datumRodjenja,
    'grad_id' => $user->grad_id,
    'grad' => $user->grad,
    'prevoznik_id' => $user->prevoznik_id,
    'registracija' => $user->automobil_id,
    'marka' => $user->marka,
    'model' => $user->model,
    'boja' => $user->boja,
    'brojTaxiDozvole' => $user->brojTaxiDozvole,
    'ocjena' => $user->ocjena
  );

  print_r(json_encode($category_arr));
