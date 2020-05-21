<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Korisnik.php';

  $database = new Database();
  $db = $database->connect();

  $user = new Korisnik($db);

  $user->id_korisnik = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_single();

  $category_arr = array(
    'id' => $user->id_korisnik,
    'ime' => $user->ime,
    'prezime' => $user->prezime,
    'email' => $user->email,
    'datumRodjenja' => $user->datumRodjenja,
    'grad_id' => $user->grad_id,
    'grad' => $user->grad,
    'brojKartice' => $user->brojKartice,
    'stanje' => $user->stanje,
    'drzava' => $user->drzava
  );

  print_r(json_encode($category_arr));
