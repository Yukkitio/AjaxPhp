<!DOCTYPE HTML>
<html>  
    <body>
        <form method="POST">
            <select name="operator" onchange="this.form.submit()">
                <option value="--">--</option>
                <option value="Nom">Nom</option>
                <option value="Prenom">Prenom</option>
                <option value="Age">Age</option>
            </select>
        </form>
    </body>
</html>

<?php
$host = 'localhost';
$dbname = 'phppdotest';
$username = 'root';
$password = '';

$con = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($con, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $selectOption = $_POST['operator'];
    if ($selectOption != "--") {

    }
    

    
    switch ($selectOption) {
    case "--":
        $sql = "SELECT * FROM users";
        break;
    case "Nom":
        $sql = "SELECT * FROM users";
        break;
    case "Prenom":
        $sql = "SELECT * FROM users";
        break;
    default:
        $sql = "SELECT * FROM users";
    }

    $stmt = $pdo->prepare($sql);// Préparation de la requête
    $stmt->execute();// Exécution de la requête


    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Prenom</th><th>Age</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>{$row['Nom']}</td><td>{$row['Prenom']}</td><td>{$row['Age']}</td></tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
