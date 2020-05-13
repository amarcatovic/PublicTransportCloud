<?php
class Prevoznik{

private $conn;
private $table='Prevoznik';

public $id_prevoznik;
public $naziv;
public $email;
public $telefon;
public $passwordHash;
public $tip_id;
public $tip;
public $grad_id;
public $grad;


// METODE
public function __construct($db) {
  $this->conn = $db;
}

// GET
public function get() {
  $query = 'CALL GetPrevoznike()';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();

  return $stmt;
}

public function read_single(){
$query = 'CALL GetPrevoznik(?)';

  $stmt = $this->conn->prepare($query);
  $stmt->bindParam(1, $this->id_prevoznik);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $this->id_prevoznik = $row['id_prevoznik'];
  $this->naziv = $row['naziv'];
  $this->email = $row['email'];
  $this->telefon = $row['telefon'];
  $this->id_tip = $row['id_tip'];
  $this->tip = $row['tip'];
  $this->id_grad = $row['id_grad'];
  $this->grad = $row['grad'];
}

// POST
public function create() {
$query = 'INSERT INTO ' . $this->table . ' (naziv, email, telefon, passwordHash, tip_id, grad_id)  
VALUES(:name, :email, :telefon, :pw, :type, :city)';

$stmt = $this->conn->prepare($query);
$this->naziv = htmlspecialchars(strip_tags($this->naziv));
$this->email = htmlspecialchars(strip_tags($this->email));
$this->telefon = htmlspecialchars(strip_tags($this->telefon));
$this->tip_id = htmlspecialchars(strip_tags($this->tip_id));
$this->grad_id = htmlspecialchars(strip_tags($this->grad_id));

$stmt-> bindParam(':name', $this->naziv);
$stmt-> bindParam(':email', $this->email);
$stmt-> bindParam(':telefon', $this->telefon);
$stmt-> bindParam(':pw', password_hash($this->passwordHash, PASSWORD_DEFAULT));
$stmt-> bindParam(':type', $this->tip_id);
$stmt-> bindParam(':city', $this->grad_id);


if($stmt->execute()) {
return true;
}
printf("Greška: $s.\n", $stmt->error);

return false;
}
}
