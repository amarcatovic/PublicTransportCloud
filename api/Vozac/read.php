<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Vozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Vozac($db);

  $result = $user->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id_korisnik,
            'ime' => $ime,
            'prezime' => $prezime,
            'email' => $email,
            'datumRodjenja' => $datumRodjenja,
            'grad_id' => $grad_id,
            'grad' => $grad,
            'prevoznik_id' => $prevoznik_id,
            'prevoznik' => $prevoznik 
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
