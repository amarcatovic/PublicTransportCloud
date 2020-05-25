<?php
class Linija{

    private $conn;
    private $table = 'Linija';

    public $id_linija;
    public $vozac_id;
    public $vozilo_id;
    public $relacija_id;
    public $sljedecaStanica_id;
    public $planiraniPolazak;
    public $planiraniDolazak;
    public $polaziste;
    public $odrediste;
    public $sljedecaStanica;
    public $cijena;
    public $status;
    
    public $grad;
    public $tip;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetAktivneLinije(?, ?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->grad);
      $stmt->bindParam(2, $this->tip);
      $stmt->execute();

      return $stmt;
    }

    // GET
    public function getStaniceRelacije() {
      $query = 'CALL GetStaniceRelacije(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->relacija_id);
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    $query = 'CALL GetAktivnaLinija(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_linija);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->polaziste = $row['polaziste'];
      $this->odrediste = $row['odrediste'];
      $this->planiraniPolazak = $row['planiraniPolazak'];
      $this->planiraniDolazak = $row['planiraniDolazak'];
      $this->sljedecaStanica = $row['sljedecaStanica'];
      $this->cijena = $row['cijena'];
      $this->tip = $row['tip'];
      $this->status = $row['status'];
  }

  public function getRelacijaId()
  {
    $query = 'SELECT relacija_id FROM Linija WHERE id_linija = ?';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id_linija);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['relacija_id'];
  }

  public function getStaniceLinije() {
    $query = 'CALL GetStaniceLinije(?)';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->relacija_id);
    $stmt->execute();

    return $stmt;
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (vozac_id, vozilo_id, relacija_id, sljedecaStanica_id, planiraniPolazak, planiraniDolazak)
    VALUES(:vozac, :vozilo, :rel, :next, :dep, :arr)';

  $stmt = $this->conn->prepare($query);
  
  $stmt-> bindParam(':vozac', $this->vozac_id);
  $stmt-> bindParam(':vozilo', $this->vozilo_id);
  $stmt-> bindParam(':rel', $this->relacija_id);
  $stmt-> bindParam(':next', $this->sljedecaStanica_id);
  $stmt-> bindParam(':dep', $this->planiraniPolazak);
  $stmt-> bindParam(':arr', $this->planiraniDolazak);

  if($stmt->execute()) {
    return $this->conn->lastInsertId();
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }

  public function zavrsiLiniju() {
    $query = 'UPDATE ' . $this->table . '
             SET status = \'Završen\'
             WHERE id_linija = :id';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $this->id_linija);

    if($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);

    return false;
}

public function updateStanicu() {
  $query = 'CALL UpdateStanicuLinije(?, ?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->sljedecaStanica_id);
  $stmt->bindParam(2, $this->id_linija);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: %s.\n", $stmt->error);

  return false;
}
}