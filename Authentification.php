<?php
   require_once 'dbconfig.php';
	$usrLogin=$_POST['usrLogin'];
	$usrPwd=md5($_POST['usrPwd']);
	$ps=$DBcon->prepare('SELECT * FROM utilisateur WHERE usrLogin=? AND usrPwd=?');
	$parametre=array($user,$pasword);
	$ps->execute($parametre);
	if($user=$ps->fetch()){
		session_start();
		$_SESSION['PROFIL']=$usrLogin;
		header("location:Accueil.php");
	}
	else{
		header("location:index.php");	
	}
?>