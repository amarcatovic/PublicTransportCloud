<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Grad.php';

  $database = new Database();
  $db = $database->connect();

  $city = new Grad($db);

  $city->id_grad = isset($_GET['id']) ? $_GET['id'] : die();

  $city->read_single();

  $category_arr = array(
    'id' => $city->id_grad,
    'naziv' => $city->naziv,
    'drzava_id' => $city->drzava_id
  );

  print_r(json_encode($category_arr));
