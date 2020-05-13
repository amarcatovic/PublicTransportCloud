<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozilo.php';

  $database = new Database();
  $db = $database->connect();

  $vehicle = new Vozilo($db);

  $vehicle->id_vozilo = isset($_GET['reg']) ? $_GET['reg'] : die();

  $vehicle->read_single();

  $category_arr = array(
    'registracija' => $vehicle->id_vozilo,
    'kapacitet' => $vehicle->kapacitet,
    'naziv' => $vehicle->naziv,
    'tip_id' => $vehicle->tip_id,
    'tip' => $vehicle->tip,
    'prevoznik_id' => $vehicle->prevoznik_id,
    'prevoznik' => $vehicle->prevoznik
  );

  print_r(json_encode($category_arr));
