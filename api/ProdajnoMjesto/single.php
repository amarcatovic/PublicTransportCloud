<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/ProdajnoMjesto.php';

  $database = new Database();
  $db = $database->connect();

  $shop = new ProdajnoMjesto($db);

  $shop->id_prodajnoMjesto = isset($_GET['id']) ? $_GET['id'] : die();

  $shop->read_single();

  $category_arr = array(
    'id' => $shop->id_prodajnoMjesto,
    'naziv' => $shop->naziv,
    'lat' => $shop->lat,
    'lng' => $shop->lng,
    'adresa' => $shop->adresa,
    'grad_id' => $shop->grad_id,
    'grad' => $shop->grad
  );

  print_r(json_encode($category_arr));
