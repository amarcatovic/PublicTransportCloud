<?php
class TaxiZahtjev{

    private $conn;
    private $table = 'TaxiZahtjev';

    public $id_zahtjev;
    public $korisnik_id;
    public $lokacija;
    public $opis;
    public $vrijemeZahtjeva;
    public $vozac_id;
    public $vrijemeDolaska;
    public $ocjena;
    public $cijena;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetTaxiZahtjeviKorisnik(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->korisnik_id);
      $stmt->execute();

      return $stmt;
    }

    public function GetAktivni() {
      $query = 'CALL GetTaxiZahtjeviVozac()';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function update() {
      $query = 'CALL PrihvatiTaxiVoznju(?, ?, ?)';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id_zahtjev);
      $stmt->bindParam(3, $this->vrijemeDolaska);
      $stmt->bindParam(2, $this->vozac_id);

      if($stmt->execute()) {
        return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
}

public function cancel() {
  $query = 'CALL PonistiTaxiVoznju(?)';

  $stmt = $this->conn->prepare($query);

  $stmt->bindParam(1, $this->id_zahtjev);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function naplati() {
  $query = 'CALL NaplatiTaxiVoznju(?, ?)';

  $stmt = $this->conn->prepare($query);

  $stmt->bindParam(1, $this->id_zahtjev);
  $stmt->bindParam(2, $this->cijena);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function plati() {
  $query = 'CALL PlatiTaxiVoznju(?)';

  $stmt = $this->conn->prepare($query);

  $stmt->bindParam(1, $this->id_zahtjev);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function OcijeniTaxiVoznju() {
  $query = 'CALL OcijeniTaxiVoznju(?, ?)';

  $stmt = $this->conn->prepare($query);

  $stmt->bindParam(1, $this->id_zahtjev);
  $stmt->bindParam(2, $this->ocjena);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function GetCijenaVoznje(){
  $query = 'SELECT cijena FROM TaxiZahtjev WHERE id_zahtjev = ?';
  
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_zahtjev);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['cijena'];
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (korisnik_id, lokacija, opis, vrijemeZahtjeva)
    VALUES(:id, :loc, :opis, CURRENT_TIMESTAMP())';

  $stmt = $this->conn->prepare($query);
  $this->lokacija = htmlspecialchars(strip_tags($this->lokacija));
  $this->opis = htmlspecialchars(strip_tags($this->opis));

  $stmt-> bindParam(':id', $this->korisnik_id);
  $stmt-> bindParam(':loc', $this->lokacija);
  $stmt-> bindParam(':opis', $this->opis);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}