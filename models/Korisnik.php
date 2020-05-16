<?php
include_once '../../models/KorisnikAplikacije.php';

class Korisnik extends KorisnikAplikacije{
private $conn;
private $table='Korisnik';

public $id_korisnik;
public $brojKartice;
public $stanje;


// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetKorisnici()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL GetKorisnik(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_korisnik);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_korisnik = $row['id_korisnik'];
  $this->ime = $row['ime'];
  $this->prezime = $row['prezime'];
  $this->email = $row['email'];
  $this->datumRodjenja = $row['datumRodjenja'];
  $this->grad_id = $row['grad_id'];
  $this->grad = $row['grad'];
  $this->brojKartice = $row['brojKartice'];
  $this->stanje = $row['stanje'];
}

public function getIdFromKartica(){
  $query = 'CALL GetKorisnikByCard(?)';
  
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->brojKartice, PDO::PARAM_STR);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row['id_korisnik'];
}

public function getStanje(){
  $query = 'CALL GetStanjeById(?)';
  
  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_korisnik);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row['stanje'];
}

public function read_single_kartica(){
  $query = 'CALL GetKorisnikByCard(?)';
  
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->brojKartice, PDO::PARAM_STR);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->id_korisnik = $row['id_korisnik'];
    $this->ime = $row['ime'];
    $this->prezime = $row['prezime'];
    $this->email = $row['email'];
    $this->datumRodjenja = $row['datumRodjenja'];
    $this->grad_id = $row['grad_id'];
    $this->grad = $row['grad'];
    $this->brojKartice = $row['brojKartice'];
    $this->stanje = $row['stanje'];
  }


// Update Stanje
public function update() {
  $query = 'CALL UpdateStanjeByCard(?, ?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->brojKartice, PDO::PARAM_STR);
  $stmt->bindParam(2, $this->stanje);

  $this->brojKartice = htmlspecialchars(strip_tags($this->brojKartice));
  $this->stanje = htmlspecialchars(strip_tags($this->stanje));

  if($stmt->execute()) {
    return true;
  }
  printf("Error: %s.\n", $stmt->error);

  return false;
}


// POST
public function create() {
$query = 'INSERT INTO ' . $this->table . ' (id_korisnik, brojKartice, stanje)
VALUES(:id, :card, :stanje)';

$stmt = $this->conn->prepare($query);
$this->naziv = htmlspecialchars(strip_tags($this->brojKartice));
$this->naziv = htmlspecialchars(strip_tags($this->stanje));

$stmt-> bindParam(':id', $this->id_korisnik);
$stmt-> bindParam(':card', $this->brojKartice);
$stmt-> bindParam(':stanje', $this->stanje);

if($stmt->execute()) {
return true;
}
printf("Greška: $s.\n", $stmt->error);

return false;
}
}
