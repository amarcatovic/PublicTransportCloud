<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/TaxiZahtjev.php';

  $database = new Database();
  $db = $database->connect();

  $taxi = new TaxiZahtjev($db);

  $taxi->korisnik_id = isset($_GET['id']) ? $_GET['id'] : die();
  $result =  $taxi->get();
  
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'lokacija' => $lokacija,
            'vrijeme' => $vrijeme,
            'ocjena' => $ocjena,
            'cijena' => $cijena,
            'vrijemeDolaska' => $vrijemeDolaska,
            'status' => $status
          );

          array_push($cat_arr['data'], $cat_item);
        }

        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Korisnik nema zahtjeva')
        );
  }
