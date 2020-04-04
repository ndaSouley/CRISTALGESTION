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
	            // Variables contribuable	

				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$usrPwd = htmlspecialchars($_POST['usrPwd']);
				$usrLogin = htmlspecialchars($_POST['usrLogin']);
				$IdProfil = htmlspecialchars($_POST['IdProfil']);
				$action = htmlspecialchars($_POST['action']);
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
				
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				$insquery = "INSERT INTO utilisateur(IdProfil,
													nom,
													prenom,
													usrLogin,
													usrPwd
												     )							
										VALUES(:IdProfil,
												:nom,
												:prenom,
												:usrLogin,
												:usrPwd
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":IdProfil" =>	$IdProfil,
											":nom" => $nom,
											":prenom" => $prenom,
											":usrLogin" => $usrLogin,
											":usrPwd" => $usrPwd
										));
									//$id_contri = mysql_insert_id($DBcon);
									$id_contri = $DBcon->lastInsertId();
			
						$stmt->closeCursor();				
				$msgexecute	= "UTULISATEUR AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER LA SAISIE?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}
			
			
			
			
			if(($_POST['action'])== "SELECT") {// Debut de la Requête de selection
				$id_quit = $_POST['id_quit'];
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
									utilisateur.id_user,
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
									      utilisateur.IdProfil = profil.IdProfil
									AND   utilisateur.id_user='".$id_quit."'";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_user = utf8_decode($donnees['id_user']);
					$IdProfil = utf8_decode($donnees['IdProfil']);
					$usrLogin = utf8_encode($donnees['usrLogin']);
					$usrPwd = utf8_encode($donnees['usrPwd']);
					$prenom = utf8_encode($donnees['prenom']);
					$LibProfil = utf8_encode($donnees['LibProfil']);
					$nom = utf8_encode($donnees['nom']);	
				}
				//echo "Affichage ";
					echo "{
							\"lib_type_service\":\"$id_user\",
							\"IdProfil\":\"$IdProfil\",
							\"usrLogin\":\"$usrLogin\",
							\"usrPwd\":\"$usrPwd\",
							\"prenom\":\"$prenom\",
							\"nom\":\"$nom\",
							\"LibProfil\":\"$LibProfil\"}";
			
			}//Fin reqête de selection	
			
			//echo"Je suis au debut de l'update";
			if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$numquit = htmlspecialchars($_POST['numquit']);
					//echo"   Je suis le user".$id_quit;
			$insquery = "UPDATE  utilisateur SET  IdProfil=:IdProfil,
													nom=:nom,
													prenom=:prenom,
													usrLogin=:usrLogin,
													usrPwd=:usrPwd
												WHERE id_user =:id_user";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":IdProfil" => $IdProfil,
											":nom" => $nom,
											":prenom" => $prenom,
											":usrLogin" => $usrLogin,
											":usrPwd" => $usrPwd,
											":id_user" => $numquit
										));
				
									$stmt->closeCursor();				
					$msgexecute	= "UTILISATEUR MODIFIEE AVEC SUCCES !";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	//Fin du traitement UPDATE
			   					
		}	
	catch(PDOException $pe)
	{
		$DBcon->rollBack();
		$DBcon = null;

		$msg = $pe->getMessage();
		//echo "{\"Etat\":\"0\",\"Motif\":\"$msg\"}";

		//echo "[{\"Etat\":\"0\",\"Motif\":\"$msg. DESOLE, ECHEC D'ENREGISTREMENT. OPERATION ANNULEE !\"}]";
		exit();
	}
?>