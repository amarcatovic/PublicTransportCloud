<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Revizor.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Revizor($db);

  $user->vozilo_id = isset($_GET['reg']) ? $_GET['reg'] : die();

  $result = $user->getLinijaID();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_linija
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nije na aktivnoj liniji')
        );
  }
