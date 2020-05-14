<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Linija.php';

  $database = new Database();
  $db = $database->connect();

  $linija = new Linija($db);
  $linija->id_linija = isset($_GET['id']) ? $_GET['id'] : die();
  $linija->relacija_id = $linija->getRelacijaId();

  $result = $linija->getStaniceLinije();
  $num = $result->rowCount();

  if($num > 0) {
        $cat_arr = array();
        $cat_arr['data'] = array();

        $names = array();
        $lat = array();
        $lng = array();

        $names['names'] = array();
        $lats['lats'] = array();
        $lngs['lngs'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          array_push($names['names'], $naziv);
          array_push($lats['lats'], $lat);
          array_push($lngs['lngs'], $lng);       
        }

        array_push($cat_arr['data'], $names['names'] );
        array_push($cat_arr['data'], $lats['lats']);
        array_push($cat_arr['data'], $lngs['lngs']);
        echo json_encode($cat_arr);

  } else {
        echo json_encode(
          array('message' => 'Nije pronađena ni jedna stanica za ovu liniju')
        );
  }