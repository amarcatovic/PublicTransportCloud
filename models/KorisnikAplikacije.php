<?php
class KorisnikAplikacije {

    private $conn;
    private $table = 'KorisnikAplikacije';

    public $id_korisnik;
    public $ime;
    public $prezime;
    public $email;
    public $datumRodjenja;
    public $passwordHash;
    public $grad_id;
    public $grad;
    public $uloga_id;
    public $uloga;
    public $drzava;

    // METODE
    public function __construct($db) {
      $this->conn = $db;
    }

    // GET
    public function get() {
      $query = 'CALL GetKorisnikeAplikacije()';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    // GET BY ID
  public function login(){  
    $query = 'CALL Login(?)';
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->email, PDO::PARAM_STR); 
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->id_korisnik = $row['id_korisnik'];
    $this->ime = $row['ime'];
    $this->prezime = $row['prezime'];
    $this->email = $row['email'];
    $this->datumRodjenja = $row['datumRodjenja'];
    $this->passwordHash = $row['passwordHash'];
    $this->grad_id = $row['grad_id'];
    $this->grad = $row['grad'];
    $this->drzava = $row['drzava'];
    $this->uloga = $row['uloga'];
      
  }

  public function read_single(){
    $query = 'CALL GetKorisnikAplikacije(?)';

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id_korisnik);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_korisnik = $row['id_korisnik'];
      $this->ime = $row['ime'];
      $this->prezime = $row['prezime'];
      $this->email = $row['email'];
      $this->datumRodjenja = $row['datumRodjenja'];
      $this->passwordHash = $row['passwordHash'];
      $this->Grad = $row['Grad'];
      $this->Uloga = $row['Uloga'];
  }

  // POST
  public function create() {
    $query = 'INSERT INTO ' . $this->table . '
    (ime, prezime, email, passwordHash, datumRodjenja, grad_id, uloga_id)
    VALUES(:name, :lname, :email, :pw, :date, :city, :role)';

  $stmt = $this->conn->prepare($query);
  $this->ime = htmlspecialchars(strip_tags($this->ime));
  $this->prezime = htmlspecialchars(strip_tags($this->prezime));
  $this->email = htmlspecialchars(strip_tags($this->email));
  $this->passwordHash = password_hash($this->passwordHash, PASSWORD_DEFAULT);
  $this->datumRodjenja = htmlspecialchars(strip_tags($this->datumRodjenja));
  $this->grad_id = htmlspecialchars(strip_tags($this->grad_id));
  $this->uloga_id = htmlspecialchars(strip_tags($this->uloga_id));

  $stmt-> bindParam(':name', $this->ime);
  $stmt-> bindParam(':lname', $this->prezime);
  $stmt-> bindParam(':email', $this->email);
  $stmt-> bindParam(':pw', $this->passwordHash);
  $stmt-> bindParam(':date', $this->datumRodjenja);
  $stmt-> bindParam(':city', $this->grad_id);
  $stmt-> bindParam(':role', $this->uloga_id);

  if($stmt->execute()) {
    return $this->conn->lastInsertId();
  }
  printf("Greška: $s.\n", $stmt->error);

  return false;
  }
}