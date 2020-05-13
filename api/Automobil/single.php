<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Automobil.php';

  $database = new Database();
  $db = $database->connect();

  $car = new Automobil($db);

  $car->id_automobil = isset($_GET['id']) ? $_GET['id'] : die();

  $car->read_single();

  $category_arr = array(
    'registracija' => $car->id_automobil,
    'marka' => $car->marka,
    'model' => $car->model,
    'boja' => $car->boja,
  );

  print_r(json_encode($category_arr));
