<?php
class TipPrevoznika{

private $conn;
private $table='TipPrevoznika';

public $id_tip;
public $naziv;

// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetTipovePrevoznika()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL GetTipPrevoznika(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_tip);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_tip = $row['id_tip'];
  $this->naziv = $row['naziv'];
}

// POST
public function create() {
$query = 'INSERT INTO ' . $this->table . ' (naziv) VALUES(:name)';

$stmt = $this->conn->prepare($query);
$this->naziv = htmlspecialchars(strip_tags($this->naziv));

$stmt-> bindParam(':name', $this->naziv);

if($stmt->execute()) {
return true;
}
printf("Greška: $s.\n", $stmt->error);

return false;
}
}
