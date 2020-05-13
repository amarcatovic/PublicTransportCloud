<?php
include_once '../../models/KorisnikAplikacije.php';
class Vozac extends KorisnikAplikacije{
private $conn;
private $table='Vozac';


public $id_vozac;
public $prevoznik_id;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetVozace()';

  $stmt = $this->conn->prepare($query);
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
  $query = 'INSERT INTO ' . $this->table . ' (id_vozac, prevoznik_id)
  VALUES(:id, :company)';
  
  $stmt = $this->conn->prepare($query);
  $this->naziv = htmlspecialchars(strip_tags($this->prevoznik_id));
  
  $stmt-> bindParam(':id', $this->id_vozac);
  $stmt-> bindParam(':company', $this->prevoznik_id);

  if($stmt->execute()) {
  return true;
  }
  printf("Greška: $s.\n", $stmt->error);
  
  return false;
  }
}
