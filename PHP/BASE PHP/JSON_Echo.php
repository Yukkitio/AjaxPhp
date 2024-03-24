<!DOCTYPE html>
<html>
	<body>
		<?php
		$jsonobj = '{"Obj1":1,"Obj2":2,"Obj3":3}';
		$obj = json_decode($jsonobj);

		foreach($obj as $key => $value) {
			echo $key . " - " . $value . "<br>";
		}
		?>
	</body>
</html>