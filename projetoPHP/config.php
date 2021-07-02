<?php
	$server="localhost";
	$user="root"; 
	$password=""; 
	$databaseName="personal_page"; 

	$conn = mysqli_connect($server, $user, $password, $databaseName); //estou a ligar ao meu servidor de base de dados e à base de dados que eu criei

	if(!$conn){
	    die("A ligação falhou: " . mysqli_connect_error());
	}
?>