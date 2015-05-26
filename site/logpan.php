<?php
if($_SESSION['logged']){

echo 'Witaj, ';
echo $_SESSION['LOGIN'];
echo ' | <a href="logout.php">Wyloguj</a>'; 

			} 
else {
echo '<a href="login.php">Zaloguj</a>';
echo '<a href="register.php">Zarejestruj Się</a>';
	}
?>
