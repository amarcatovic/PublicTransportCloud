<?php 
  class Database {
    private $host = 'localhost';
    private $db_name = 'PublicTransportCloud';
    private $username = 'root';
    private $password = 'admin';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Greška tokom spajanja na server: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }