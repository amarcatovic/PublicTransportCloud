<?php
include_once '../../models/KorisnikAplikacije.php';
class TaxiVozac extends KorisnikAplikacije{

    private $conn;
    private $table = 'TaxiVozac';

    public $id_vozac;
    public $prevoznik_id;
    public $automobil_id;
    public $brojTaxiDozvole;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetTaxiVozace()';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    $query = 'CALL GetTaxiVozac(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozac);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->ime = $row['ime'];
      $this->prezime = $row['prezime'];
      $this->email = $row['email'];
      $this->datumRodjenja = $row['datumRodjenja'];
      $this->grad_id = $row['grad_id'];
      $this->grad = $row['grad'];
      $this->prevoznik_id = $row['registracija'];
      $this->marka = $row['marka'];
      $this->model = $row['model'];
      $this->boja = $row['boja'];
      $this->brojTaxiDozvole = $row['brojTaxiDozvole'];
  }

  public function read_single_registracija(){
    $query = 'CALL GetTaxiVozacaByRegistracija(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozac);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_vozac = $row['id_korisnik'];
      $this->ime = $row['ime'];
      $this->prezime = $row['prezime'];
      $this->email = $row['email'];
      $this->datumRodjenja = $row['datumRodjenja'];
      $this->grad_id = $row['grad_id'];
      $this->grad = $row['grad'];
      $this->prevoznik_id = $row['prevoznik_id'];
      $this->automobil_id = $row['registracija'];
      $this->marka = $row['marka'];
      $this->model = $row['model'];
      $this->boja = $row['boja'];
      $this->brojTaxiDozvole = $row['brojTaxiDozvole'];
  }

  // POST
  public function create() {
  if($this->prevoznik_id == 0)
  {
    $query = 'INSERT INTO ' . $this->table . ' (id_vozac, prevoznik_id, automobil_id, brojTaxiDozvole)
    VALUES(:id, NULL, :car, :permit)';
  }
  else
  {
    $query = 'INSERT INTO ' . $this->table . ' (id_vozac, prevoznik_id, automobil_id, brojTaxiDozvole)
    VALUES(:id, :company, :car, :permit)';
  }
  
  $stmt = $this->conn->prepare($query);
  $this->automobil_id = htmlspecialchars(strip_tags($this->automobil_id));
  $this->prevoznik_id = htmlspecialchars(strip_tags($this->prevoznik_id));
  $this->brojTaxiDozvole = htmlspecialchars(strip_tags($this->brojTaxiDozvole));
  
  $stmt-> bindParam(':id', $this->id_vozac);
  if($this->prevoznik_id != 0)
    $stmt-> bindParam(':company', $this->prevoznik_id);
  $stmt-> bindParam(':car', $this->automobil_id);
  $stmt-> bindParam(':permit', $this->brojTaxiDozvole);

  if($stmt->execute()) {
  return true;
  }
  printf("Greška: $s.\n", $stmt->error);
  
  return false;
  }
}