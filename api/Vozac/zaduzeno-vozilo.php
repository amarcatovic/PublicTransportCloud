<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Vozac($db);

  $user->id_vozac = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_zaduzena();

  if(strlen($user->vozilo_id) > 2){
    $category_arr = array(
        'status' => 'YES',
        'vozilo_id' => $user->vozilo_id,
      );

      print_r(json_encode($category_arr));
  }
  else
  {
    echo json_encode(
        array('status' => 'NO')
      );
  }
