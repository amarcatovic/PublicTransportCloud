<?php
include_once '../../models/KorisnikAplikacije.php';
class Revizor extends KorisnikAplikacije{
private $conn;
private $table='Revizor';


public $id_revizor;
public $prevoznik_id;
public $brojDozvole;
public $vozilo_id;
public $linija_id;
public $korisnik_id;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetRevizore()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function getLinijaID() {
  $query = 'CALL GetLinijaVozila(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->vozilo_id);
  $stmt->execute();

  return $stmt;
}

public function provjera() {
  $query = 'CALL ProvjeraKarte(?, ?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->linija_id);
  $stmt->bindParam(2, $this->korisnik_id);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL ';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_korisnik);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_korisnik = $row['id_korisnik'];
  $this->ime = $row['ime'];
  $this->prezime = $row['prezime'];
  $this->email = $row['email'];
  $this->passwordHash = $row['passwordHash'];
  $this->Grad = $row['Grad'];
  $this->Uloga = $row['Uloga'];
}

// POST
public function create() {
  $query = 'INSERT INTO ' . $this->table . ' (id_revizor, prevoznik_id, brojDozvole)
  VALUES(:id, :company, :serial)';
  
  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->brojDozvole));
  
  $stmt-> bindParam(':id', $this->id_biletar);
  $stmt-> bindParam(':company', $this->prevoznik_id);
  $stmt-> bindParam(':serial', $this->brojDozvole);

  if($stmt->execute()) {
  return true;
  }
  printf("Greška: $s.\n", $stmt->error);
  
  return false;
  }
}
