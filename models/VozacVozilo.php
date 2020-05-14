<?php
class VozacVozilo{

    private $conn;
    private $table = 'VozacVozilo';

    public $vozac_id;
    public $vozilo_id;
    public $datumZaduzenja;
    public $datumRazduzenja;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL ';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

  public function update() {
    $query = 'UPDATE ' . $this->table . '
                          SET datumRazduzenja = CURRENT_TIMESTAMP()
                          WHERE vozilo_id = :id AND datumRazduzenja IS NULL';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $this->vozilo_id);

    if($stmt->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt->error);
    return false;
}

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . ' (vozac_id, vozilo_id, datumZaduzenja, datumRazduzenja)
    VALUES(:driver, :vehicle, CURRENT_TIMESTAMP(), NULL)';

  $stmt = $this->conn->prepare($query);
 
  $stmt-> bindParam(':driver', $this->vozac_id);
  $stmt-> bindParam(':vehicle', $this->vozilo_id);

  if($stmt->execute()) {
    return true;
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}