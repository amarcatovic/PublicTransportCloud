<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/KorisnikAplikacije.php';

  include_once '../../models/Korisnik.php';
  include_once '../../models/Vozac.php';
  include_once '../../models/TaxiVozac.php';

  $database = new Database();
  $db = $database->connect();

  $user = new KorisnikAplikacije($db);

  $data = json_decode(file_get_contents("php://input"));

  $user->email = $data->email;
  $passwordRaw = $data->password;

  $user->login();

  if(password_verify($passwordRaw, $user->passwordHash)) {

    if($user->uloga == "Korisnik")
    {
      $korisnik = new Korisnik($db);
      $korisnik->id_korisnik = $user->id_korisnik;
      $korisnik->read_single();

      echo json_encode(
        array('login' => 'OK',
        'id' => $user->id_korisnik,
        'ime' => $user->ime,
        'prezime' => $user->prezime,
        'emai' => $user->email,
        'datumRodjenja' => $user->datumRodjenja,
        'grad_id' => $user->grad_id,
        'grad' => $user->grad,
        'drzava' => $user->drzava,
        'uloga' => $user->uloga,
        'brojKartice' => $korisnik->brojKartice,
        'stanje' => $korisnik->stanje
        )
      );
    }
    else if($user->uloga == "Vozač")
    {
      $vozac = new Vozac($db);
      $vozac->id_vozac = $user->id_korisnik;
      $vozac->read_single();

      echo json_encode(
        array('login' => 'OK',
        'id' => $user->id_korisnik,
        'ime' => $user->ime,
        'prezime' => $user->prezime,
        'emai' => $user->email,
        'datumRodjenja' => $user->datumRodjenja,
        'grad_id' => $user->grad_id,
        'grad' => $user->grad,
        'uloga' => $user->uloga,
        'prevoznik_id' => $vozac->prevoznik_id,
        'prevoznik' => $vozac->prevoznik
        )
      );
    }
    else if($user->uloga == "Taxi")
    {
      $taxi = new TaxiVozac($db);
      $taxi->id_vozac = $user->id_korisnik;
      $taxi->read_single();

      echo json_encode(
        array('login' => 'OK',
        'id' => $user->id_korisnik,
        'ime' => $user->ime,
        'prezime' => $user->prezime,
        'emai' => $user->email,
        'datumRodjenja' => $user->datumRodjenja,
        'grad_id' => $user->grad_id,
        'grad' => $user->grad,
        'uloga' => $user->uloga,
        'prevoznik_id' => $taxi->prevoznik_id,
        'registracija' => $taxi->automobil_id,
        'marka' => $taxi->marka,
        'model' => $taxi->model,
        'boja' => $taxi->boja,
        'brojTaxiDozvole' => $taxi->brojTaxiDozvole,
        'ocjena' => $taxi->ocjena
        )
      );
    }
    else if($user->uloga == "Biletar")
    {
      echo json_encode(
        array('login' => 'OK',
          'id' => $user->id_korisnik,
          'ime' => $user->ime,
          'prezime' => $user->prezime,
          'emai' => $user->email,
          'datumRodjenja' => $user->datumRodjenja,
          'grad_id' => $user->grad_id,
          'grad' => $user->grad,
          'uloga' => $user->uloga
          )
      );
    }

    /*echo json_encode(
      array('login' => 'OK',
      'id' => $user->id_korisnik,
      'ime' => $user->ime,
      'prezime' => $user->prezime,
      'emai' => $user->email,
      'datumRodjenja' => $user->datumRodjenja,
      'grad_id' => $user->grad_id,
      'grad' => $user->grad,
      'uloga' => $user->uloga
      )
    );*/
  } else {
    echo json_encode(
      array('login' => 'Error')
    );
  }
