<?
/*
*
*	php function 
*
*/
//	$my_db = new mysqli("localhost", "root", "7alslqjxkdlwld@%*)1590", "miniver");
	$my_db = new mysqli("localhost", "miniver", "miniver_2016", "miniver");
	if (mysqli_connect_error()) {
		exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
?>
