<?php
include_once '../../models/KorisnikAplikacije.php';
class Vozac extends KorisnikAplikacije{
private $conn;
private $table='Vozac';


public $id_vozac;
public $prevoznik_id;
public $prevoznik;

public $id_linija;
public $vozilo_id;
public $relacija_id;

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
  $query = 'CALL GetVozac(?)';
  
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_vozac);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->prevoznik_id = $row['prevoznik_id'];
    $this->prevoznik = $row['prevoznik'];
  }

  public function read_zaduzena(){
    $query = 'CALL GetZaduzenaVozila(?)';
    
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozac);
      $stmt->execute();
    
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
      $this->vozilo_id = $row['vozilo_id'];
    }

  public function read_aktivna(){
    $query = 'CALL GetTrenutnaLinija(?)';
    
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozac);
      $stmt->execute();
    
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
      $this->id_linija = $row['id_linija'];
      $this->vozilo_id = $row['vozilo_id'];
      $this->relacija_id = $row['relacija_id'];
      $this->id_vozac = $row['vozac_id'];
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
