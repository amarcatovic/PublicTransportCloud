<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/TipPrevoznika.php';

  $database = new Database();
  $db = $database->connect();

  $type = new TipPrevoznika($db);

  $type->id_tip = isset($_GET['id']) ? $_GET['id'] : die();

  $type->read_single();

  $category_arr = array(
    'id' => $type->id_tip,
    'naziv' => $type->naziv,
  );

  print_r(json_encode($category_arr));
