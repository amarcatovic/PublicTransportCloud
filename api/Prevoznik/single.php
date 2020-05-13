<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Prevoznik.php';

  $database = new Database();
  $db = $database->connect();

  $prevoznik = new Prevoznik($db);

  $prevoznik->id_prevoznik = isset($_GET['id']) ? $_GET['id'] : die();

  $prevoznik->read_single();

  $category_arr = array(
    'id' => $prevoznik->id_prevoznik,
    'naziv' => $prevoznik->naziv,
    'email' => $prevoznik->email,
    'telefon' => $prevoznik->telefon,
    'tip_id' => $prevoznik->id_tip,
    'tip' => $prevoznik->tip,
    'grad_id' => $prevoznik->id_grad,
    'grad' => $prevoznik->grad
  );

  print_r(json_encode($category_arr));
