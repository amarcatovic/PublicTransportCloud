<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Stanica.php';

  $database = new Database();
  $db = $database->connect();

  $station = new Stanica($db);

  $station->id_stanica = isset($_GET['id']) ? $_GET['id'] : die();

  $station->read_single();

  $category_arr = array(
    'id' =>  $station->id_stanica,
    'naziv' =>  $station->naziv,
    'lat' =>  $station->lat,
    'lng' =>  $station->lng,
    'adresa' =>  $station->adresa,
    'grad_id' =>  $station->grad_id,
    'tip' => $station->tip
  );

  print_r(json_encode($category_arr));
