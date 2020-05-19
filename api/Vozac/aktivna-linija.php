<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Vozac($db);

  $user->id_vozac = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_aktivna();

  if($user->id_linija > 0){
    $category_arr = array(
        'status' => 'YES',
        'linija_id' => $user->id_linija,
        'vozilo_id' => $user->vozilo_id,
        'relacija_id' => $user->relacija_id,
        'vozac_id' => $user->id_vozac
      );

      print_r(json_encode($category_arr));
  }
  else
  {
    echo json_encode(
        array('status' => 'NO')
      );
  }
