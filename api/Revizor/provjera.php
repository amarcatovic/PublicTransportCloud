<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Revizor.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Revizor($db);

  $user->linija_id = isset($_GET['l']) ? $_GET['l'] : die();
  $user->korisnik_id = isset($_GET['k']) ? $_GET['k'] : die();

  $result = $user->provjera();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'broj' => $broj
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nije Platio')
        );
  }
