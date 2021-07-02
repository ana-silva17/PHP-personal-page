<?php 
	function sanitizeFields($input) {
		$text = "";
		$text = trim($_POST[$input]); 
		$text = stripslashes($text); 
		$text = htmlspecialchars($text); 
		return $text;
	}
?>

