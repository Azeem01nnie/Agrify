<?php
require_once '../Config/database.php';

class MarketplaceManager {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    /**
     * Get all animals with their owner information
     * @return array Array of animal data with owner details
     */
    public function getAllAnimalsWithOwners() {
        try {
            $query = "SELECT a.*, u.username as owner_name, c.cage_name 
                     FROM animals a 
                     LEFT JOIN cages c ON a.cage_id = c.cage_id 
                     LEFT JOIN users u ON c.user_id = u.user_id 
                     ORDER BY a.animal_id DESC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching marketplace animals: " . $e->getMessage());
            return [];
        }
    }

    public function getAnimalById($id) {
    try {
        $query = "SELECT a.*, c.cage_name, c.cage_desc, u.username as owner_name 
                  FROM animals a
                  LEFT JOIN cages c ON a.cage_id = c.cage_id
                  LEFT JOIN users u ON c.user_id = u.user_id
                  WHERE a.animal_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching animal details: " . $e->getMessage());
        return null;
    }
}

} 