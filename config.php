<?php 

function connection() { 
    // serwer 
    $mysql_server = "sql112.000a.biz"; 
    // admin 
    $mysql_admin = "a000b_16095898"; 
    // hasło 
    $mysql_pass = "gamesamongus"; 
    // nazwa baza 
    $mysql_db = "a000b_16095898_tgas"; 
    // nawiązujemy połączenie z serwerem MySQL 
    @mysql_connect($mysql_server, $mysql_admin, $mysql_pass) 
    or die('Brak połączenia z serwerem MySQL.'); 
    // łączymy się z bazą danych 
    @mysql_select_db($mysql_db) 
    or die('Błąd wyboru bazy danych.'); 
} 
date_default_timezone_set('Europe/Warsaw');


function baza(){
    $connection = @mysql_connect('sql112.000a.biz', 'a000b_16095898', 'gamesamongus') 
    or die('Brak połączenia z serwerem MySQL'); 
  
    $db = @mysql_select_db('a000b_16095898_tgas', $connection) 
    or die('Nie mogę połączyć się z bazą danych'); 
}
?>
