<?php
class Modele {
    private $db;

    public function __construct($dbname, $username, $password) {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
            // Log pour confirmer la connexion à la base de données
            error_log("Connexion à la base de données réussie", 0);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
            // Log l'erreur de connexion
            error_log("Erreur de connexion à la base de données : " . $e->getMessage(), 0);
        }
    }

    public function getUtilisateurs() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Log le nombre d'utilisateurs récupérés
        error_log("Nombre d'utilisateurs récupérés : " . count($result), 0);

        return $result;
    }

    public function getInscriptionsParMois() {
        $stmt = $this->db->prepare("SELECT MONTH(registration_date) as mois, COUNT(*) as total FROM users GROUP BY mois ORDER BY mois");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
