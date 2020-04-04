<?php
/*
$DBhost = 'localhost';
$DBname = 'dbcommunal';
$DBuser = 'root';
$DBpass = 'Comme#2018';
*/
$DBhost = '127.0.0.1';
$DBname = 'bdcontact-cristal';
$DBuser = 'root';
$DBpass = '';

 try {
  $DBcon = null; 
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $DBcon->beginTransaction();
 } catch(PDOException $ex){
  die($ex->getMessage());
 }
 
?>>