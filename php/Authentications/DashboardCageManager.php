<?php
require_once '../Config/database.php';

class DashboardCageManager {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    /**
     * Get the top 4 cages with their animal counts for a specific user
     * @param int $userId The ID of the user whose cages to fetch
     * @return array Array of cage data with animal counts
     */
    public function getTopCagesWithAnimals($userId) {
        try {
            $query = "SELECT c.cage_id, c.cage_name, COUNT(a.animal_id) as animal_count 
                     FROM cages c 
                     LEFT JOIN animals a ON c.cage_id = a.cage_id 
                     WHERE c.user_id = :user_id
                     GROUP BY c.cage_id, c.cage_name 
                     ORDER BY animal_count DESC 
                     LIMIT 4";  
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching cage statistics: " . $e->getMessage());
            return [];
        }
    }
} 