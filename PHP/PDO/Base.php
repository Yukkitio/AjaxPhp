<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Php</title>
	</head>
	
	<body>
		<form method="POST">
			<select name="operator">
				<option value="Nom">Nom</option>
				<option value="Prenom">Prenom</option>
				<option value="Age">Age</option>
			</select>
			<input type="submit">
		</form>
	</body>
</html>

<?php
try {
	$pdo = new PDO("mysql:host=localhost;dbname=phppdotest", 'root', '');

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour la gestion d'erreur, utilisez le mode d'erreur exception
	$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

	$selectOption = $_POST['operator'] ?? 'Nom'; // Si null une valeur par défaut (Nom)

	$unbufferedResult = $pdo->query("SELECT $selectOption FROM users");

	echo "<table>";
	foreach ($unbufferedResult as $row) {
		echo "<tr><td>".$row[$selectOption]."</td></tr>";
	}
	echo "</table>";

} catch (PDOException $e) {
	die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
