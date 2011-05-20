<?php

	require_once('Pto.php');
	
?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>pto demo</title>
	</head>
	<body>
		<?php
		echo $pto = pto("This is my string.")
						->str_replace(' is ', ' was ')
						->str_replace('string', '<b>string</b>')
						->explode(' ')
						->implode('_');
		
		var_dump($pto->explode('_')->data);
		
		var_dump(pto('some_text_here')->explode('_')->data);
		?>
	</body>
</html>
