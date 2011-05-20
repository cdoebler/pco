<?php

	require_once('Pco.php');
	
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>pco demo</title>
	</head>
	<body>
		<?php
		echo $pco = pco("This is my string.")
						->str_replace(' is ', ' was ')
						->str_replace('string', '<b>string</b>')
						->explode(' ')
						->implode('_');
		
		var_dump($pco->explode('_')->data);
		
		var_dump(pco('some_text_here')->explode('_')->data);
		?>
	</body>
</html>
