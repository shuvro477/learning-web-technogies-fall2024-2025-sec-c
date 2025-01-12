<?php
require_once 'config/database.php';

class EmployerModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM employers";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM employers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $query = "INSERT INTO employers (employer_name, company_name, contact_no, username, password) 
                  VALUES (:employer_name, :company_name, :contact_no, :username, :password)";
        $stmt = $this->conn->prepare($query);
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt->execute($data);
    }

    public function update($id, $data) {
        $query = "UPDATE employers 
                  SET employer_name = :employer_name, company_name = :company_name, contact_no = :contact_no, 
                      username = :username 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM employers WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function search($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM employers WHERE employer_name LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
