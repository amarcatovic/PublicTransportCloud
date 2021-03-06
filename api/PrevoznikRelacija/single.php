<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/KorisnikAplikacije.php';

  $database = new Database();
  $db = $database->connect();

  $user = new KorisnikAplikacije($db);

  $user->id_korisnik = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_single();

  $category_arr = array(
    'id' => $user->id_korisnik,
    'ime' => $user->ime,
    'prezime' => $user->prezime,
    'email' => $user->email,
    'passwordHash' => $user->passwordHash,
    'grad' => $user->Grad,
    'uloga' => $user->Uloga
  );

  print_r(json_encode($category_arr));
