<?php
class Vozilo{

    private $conn;
    private $table = 'Vozilo';

    public $id_vozilo;
    public $kapacitet;
    public $naziv;
    public $tip_id;
    public $prevoznik_id;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetVozila()';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function getVozilaPrevoznika() {
      $query = 'CALL GetVozilaPrevoznika(?, ?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->prevoznik_id);
      $stmt->bindParam(2, $this->tip_id);
      $stmt->execute();

      return $stmt;
    }

    public function slobodna() {
      $query = 'CALL DaLiJeVoziloSlobodno(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozilo);
      $stmt->execute();

      return $stmt;
    }


  public function read_single(){
    $query = 'CALL GetVozilo(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_vozilo, PDO::PARAM_STR);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->naziv = $row['naziv'];
      $this->kapacitet = $row['kapacitet'];
      $this->tip_id = $row['tip_id'];
      $this->tip = $row['tip'];
      $this->prevoznik_id = $row['prevoznik_id'];
      $this->prevoznik = $row['prevoznik'];
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (id_vozilo, kapacitet, naziv, tip_id, prevoznik_id)
    VALUES(:id, :cap, :name, :type, :company)';

  $stmt = $this->conn->prepare($query);
  $this->id_vozilo = htmlspecialchars(strip_tags($this->id_vozilo));
  $this->kapacitet = htmlspecialchars(strip_tags($this->kapacitet));
  $this->naziv = htmlspecialchars(strip_tags($this->naziv));
  $this->tip_id = htmlspecialchars(strip_tags($this->tip_id));
  $this->prevoznik_id = htmlspecialchars(strip_tags($this->prevoznik_id));

  $stmt-> bindParam(':id', $this->id_vozilo);
  $stmt-> bindParam(':cap', $this->kapacitet);
  $stmt-> bindParam(':name', $this->naziv);
  $stmt-> bindParam(':type', $this->tip_id);
  $stmt-> bindParam(':company', $this->prevoznik_id);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}