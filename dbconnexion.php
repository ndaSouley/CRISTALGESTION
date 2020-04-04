<?php

// ================ Debut Connexion a la bd Mysql================
/*
$db_hostname = 'localhost';
$db_database = 'dbcommunal';
$db_username = 'root';
$db_password = 'Comme#2018';
*/
//PARAMETRES DE CONNEXION POUR LA BASE DE DONNEES LOCALE


$db_hostname = 'localhost';
$db_database = 'db_immo_cristal';
$db_username = 'root';
$db_password = '';

// cristalconstruction.ne
/*

$db_hostname = '91.216.107.164';
$db_database = 'crist1206480';
$db_username = 'crist1206480';
$db_password = 'qraedjx7dm';*/


// cristalconstruction.com
/*$db_hostname = '185.98.131.90';
$db_database = 'crist1216798_1nj38u';
$db_username = 'crist1216798_1nj38u';
$db_password = 'ewehpcfyn4';*/


$mysqli = new mysqli();
$mysqli->connect($db_hostname, $db_username, $db_password, $db_database);

?>