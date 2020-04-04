


<?PHP
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
	try
	{
	require_once 'dbconfig.php';
	$stmt = null;
	
	//echo" A = ".$data['usrLogin'];
	
		$usr_Login = htmlspecialchars($_POST['usrLogin']);
		$usr_Pwd = htmlspecialchars($_POST['usrPwd']);
			// if(($_POST['action'])== "CONNEXION") {
				// echo"   je suis au debut de select".$usr_Login;
				  if(($_POST['action'])== "CONNEXION") {
					  
					   ///echo"  SSSSSSSSSSSS";
				 $requete = "SELECT 
										utilisateur.id_user,
										utilisateur.id_service,
										utilisateur.IdProfil,
										utilisateur.usrLogin,
										utilisateur.usrPwd,
										utilisateur.nom,
										utilisateur.prenom,
										profil.LibProfil
										FROM
										utilisateur ,
										profil
										WHERE
					utilisateur.IdProfil = profil.IdProfil AND (utilisateur.usrLogin='".$usr_Login."'AND utilisateur.usrPwd='".$usr_Pwd."')";
				 

                              ///echo"   je suis au milieu de select".$usr_Login ;
				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					// echo"   KKKKKK";
					$id_user = utf8_decode($donnees['id_user']);
					$id_service = utf8_decode($donnees['id_service']);
					$usrLogin = utf8_decode($donnees['usrLogin']);
					$IdProfil = utf8_decode($donnees['IdProfil']);
					$nom = utf8_decode($donnees['nom']);
					$prenom = utf8_decode($donnees['prenom']);
					$usrPwd = utf8_decode($donnees['usrPwd']);
					$LibProfil = utf8_decode($donnees['LibProfil']);

					// echo"  BBBB";

					if($donnees['usrLogin']==($_POST['usrLogin'])  && $donnees['usrPwd']==$_POST['usrPwd']) {

						 //echo"   je suis";
						 session_start();
							  $_SESSION['IdProfil'] = $rs['IdProfil'];
							  $_SESSION['usrPwd'] = $rs['usrPwd'];
							  $_SESSION['id_user'] = $rs['id_user'];
							  $_SESSION['nom']= $rs['nom'];
							  $_SESSION['prenom']= $rs['prenom'];
							  $_SESSION['LibProfil']= $rs['LibProfil'];
							  $_SESSION['autorise']=true;
							  $autorise= $_SESSION['autorise'];
		         // echo"   je suis a la fin de select";
				       }
				   }
				
				 echo "{
						\"usrLogin\":\"$usrLogin\", 
						\"IdProfil\":\" $IdProfil\", 
						\"autorise\":\" $autorise\",  
						\"usrPwd\":\"$usrPwd\"}";
		  }
		
												
		 }	
	    catch(PDOException $pe)
	  {
		$DBcon->rollBack();
		$DBcon = null;

		$msg = $pe->getMessage();
		echo "{\"Etat\":\"0\",\"Motif\":\"$msg\"}";

		//echo "[{\"Etat\":\"0\",\"Motif\":\"$msg. DESOLE, ECHEC D'ENREGISTREMENT. OPERATION ANNULEE !\"}]";
		exit();
	}
	
	

?>