<?php
	$n1 = $_POST['Num1GET'];
	$n2 = $_POST['Num2GET'];
	$selectOption = $_POST['operator'];

	switch ($selectOption) {
		case '+':
			echo $n1 + $n2;
			break;
		case '-':
			echo $n1 - $n2;
			break;
		case '*':
			echo $n1 * $n2;
			break;
		case '/':
			if ($n2 == 0) {
				echo "Erreur : Division par zéro !";
			} else {
				echo $n1 / $n2;
			}
			break;
		default:
			echo "Opérateur inconnu.";
			break;
	}
?>
