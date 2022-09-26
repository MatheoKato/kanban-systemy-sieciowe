<?php
// dane do polaczenia bazy dancyh
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'php_login');
 
//Polaczenie z baza danych
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Sprawdzenie połączenia
if($link === false){
    die("ERROR: Nie mozna polaczyc. " . mysqli_connect_error());
}
?>