<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);

  $linija->id_linija = isset($_GET['id']) ? $_GET['id'] : die();

  $linija->read_single();

  $category_arr = array(
    'id' => $linija->id_linija,
    'polaziste' => $linija->polaziste,
    'odrediste' => $linija->odrediste,
    'planiraniPolazak' => $linija->planiraniPolazak,
    'planiraniDolazak' => $linija->planiraniDolazak,
    'sljedecaStanica' => $linija->sljedecaStanica,
    'cijena' => $linija->cijena,
    'tip' => $linija->tip,
    'status' => $linija->status
  );

  print_r(json_encode($category_arr));
