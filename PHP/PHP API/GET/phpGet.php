<?php
	$n1 = $_GET['Num1GET'];
	$n2 = $_GET['Num2GET'];
	$selectOption = $_GET['operator'];

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
