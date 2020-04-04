<?php
/*
$DBhost = 'localhost';
$DBname = 'dbcommunal';
$DBuser = 'root';
$DBpass = 'Comme#2018';*/



// Connexion Local
$DBhost = 'localhost';
$DBname = 'db_immo_cristal';
$DBuser = 'root';
$DBpass = '';

// cristalconstruction.net


/*
$DBhost = '91.216.107.164';
$DBname = 'crist1206480';
$DBuser = 'crist1206480';
$DBpass = 'qraedjx7dm';*/
/*

// cristalconstruction.com
$DBhost = '185.98.131.90';
$DBname = 'crist1216798_1nj38u';
$DBuser = 'crist1216798_1nj38u';
$DBpass = 'ewehpcfyn4';  */ 




 try {
  $DBcon = null; 
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $DBcon->beginTransaction();
 } catch(PDOException $ex){
  die($ex->getMessage());
 }
 
?>