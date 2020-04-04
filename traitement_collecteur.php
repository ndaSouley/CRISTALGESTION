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
				// Variables Utilisateur
				$nom = htmlspecialchars($_POST['nom']);
				// echo"     je suis matricule_collecteur ".$matricule_collecteur ;
				$prenom = htmlspecialchars($_POST['prenom']);
				$tel = htmlspecialchars($_POST['tel']);
				$email = htmlspecialchars($_POST['email']);
				$Vid_profil = htmlspecialchars($_POST['profil']);
				$mot_passe = htmlspecialchars($_POST['mot_passe']);
				$login = htmlspecialchars($_POST['login']);
				$statut = htmlspecialchars($_POST['statut']);
				
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
				//echo"11111";
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
				$insquery = "INSERT INTO user(id_profil,
												Nom_user,
												prenoms_user,
												login,
												mot_passe,
												contact,
												e_mail,
												Id_statut
												)							
										VALUES(:id_profil,
												:Nom_user,
												:prenoms_user,
												:login,
												:mot_passe,
												:contact,
												:e_mail,
												:Id_statut
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_profil" => $Vid_profil,
											":Nom_user" => $nom,
											":prenoms_user" => $prenom,
											":login" => $login,
											":mot_passe" => $mot_passe,
											":contact" => $tel,
											":e_mail" => $email,
											":Id_statut" => $statut
										));
										
					$stmt->closeCursor();				
								
				$msgexecute	= "UTILISATEUR AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	


			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$V_id_ser = htmlspecialchars($_POST['V_id_ser']);
					
			$insquery = "UPDATE  user SET id_profil =:id_profil,
												Nom_user =:Nom_user,
												prenoms_user =:prenoms_user,
												login =:login,
												mot_passe =:mot_passe,
												contact =:contact,
												e_mail =:e_mail,
												Id_statut =:Id_statut
												WHERE id_user =:id_user";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_profil" => $Vid_profil,
											":Nom_user" => $nom,
											":prenoms_user" => $prenom,
											":login" => $login,
											":mot_passe" => $mot_passe,
											":contact" => $tel,
											":e_mail" => $email,
											":Id_statut" => $statut,
											":id_user" => $V_id_ser
										));
					// echo"     je suis  UPDATE matricule_collecteur ".$matricule_collecteur ;
									$stmt->closeCursor();
									//$msgexecute	= " .$Id_user.";			
					$msgexecute	= "UTILISATEUR MODIFIE AVEC SUCCES !";
			$DBcon->commit();
			$DBcon = null;
				
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
				/////////////////////////////////////////////////////////////////////
		
			if(($_POST['action'])== "SELECT") {
				$Id_user = $_POST['Id_user'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
									`user`.id_user,
									`user`.id_profil,
									`user`.Nom_user,
									`user`.prenoms_user,
									`user`.login,
									`user`.mot_passe,
									`user`.contact,
									`user`.e_mail,
									`user`.date_enregistrement,
									`user`.Photo,
									`user`.Id_statut,
									profil.libelle,
									statut.libelle_statut,
									profil.id_profil,
									statut.Id_statut
									FROM
									`user`
									INNER JOIN profil ON `user`.id_profil = profil.id_profil
									INNER JOIN statut ON `user`.Id_statut = statut.Id_statut
									WHERE`user`.id_user='".$Id_user."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_user = utf8_decode($donnees['id_user']);
					$id_profil = utf8_decode($donnees['id_profil']);
					$Nom_user = utf8_decode($donnees['Nom_user']);
					$prenoms_user = utf8_decode($donnees['prenoms_user']);
					$login= utf8_encode($donnees['login']);
					$mot_passe = utf8_encode($donnees['mot_passe']);
					$contact = utf8_encode($donnees['contact']);
					$e_mail = utf8_encode($donnees['e_mail']);
					$Id_statut = utf8_encode($donnees['Id_statut']);
					$libelle_statut = utf8_encode($donnees['libelle_statut']);
					$libelle = utf8_encode($donnees['libelle']);
					
				}
				//echo "Affichage ";
					echo "{\"id_user\":\"$id_user\",
							\"id_profil\":\"$id_profil\",
							\"Nom_user\":\"$Nom_user\",
							\"prenoms_user\":\"$prenoms_user\",
							\"login\":\"$login\",
							\"mot_passe\":\"$mot_passe\",
							\"contact\":\"$contact\",
							\"e_mail\":\"$e_mail\",
							\"libelle_statut\":\"$libelle_statut\",
							\"libelle\":\"$libelle\",
							\"Id_statut\":\"$Id_statut\"
							}";
			}

			if(($_POST['action'])== "SELECTALL") {
				//$matricule = $_POST['matricule'];
				//echo "mat = ".$matricule;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
						quittance.code_quittance,
						contribuable.nom as nomContribuable,
						contribuable.prenom as prenomContribuable,
						service.quotite_paye,
						exercice.periode,
						collecteur.nom as nomCollecteur,
						collecteur.prenom as prenomCollecteur,
						service.date_doc,
						service.date_creation
						FROM
						service
						INNER JOIN exercice ON service.code_periode = exercice.code_periode
						INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
						INNER JOIN quittance ON service.id_quittance = quittance.id_quittance";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$code_quittance = utf8_decode($donnees['code_quittance']);
					$nomContribuable = utf8_encode($donnees['nomContribuable']);
					$prenomContribuable = utf8_encode($donnees['prenomContribuable']);
					$quotite_paye = utf8_encode($donnees['quotite_paye']);
					$periode = utf8_encode($donnees['periode']);
					$nomCollecteur = utf8_encode($donnees['nomCollecteur']);
					$prenomCollecteur = utf8_encode($donnees['prenomCollecteur']);
					$date_doc = utf8_encode($donnees['date_doc']);
					$date_creation = utf8_encode($donnees['date_creation']);									
				}
					echo "{\"code_quittance\":\"$code_quittance\",
							\"nomContribuable\":\"$nomContribuable\",
							\"prenomContribuable\":\"$prenomContribuable\",
							\"quotite_paye\":\"$quotite_paye\",
							\"periode\":\"$periode\",
							\"nomCollecteur\":\"$nomCollecteur\",
							\"prenomCollecteur\":\"$prenomCollecteur\",
							\"date_doc\":\"$date_doc\",
							\"date_creation\":\"$date_creation\"}";
					
			
			}
			
			
			if(($_POST['action'])== "SELECTAJAX") {
				//$matricule = $_POST['matricule'];
				//echo "mat = ".$matricule;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT					
						id_abonn_serv,
						code_categ,
						code_type_service,
						date_creation,
						montant_annuel,
						montant_carnet,
						montant_mensuel,
						droit_de_place,
						montant_macaron,
						montant_antenne	
						FROM
						abonnement_service 
						WHERE code_categ='1' AND code_type_service='95'";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_abonn_serv = utf8_decode($donnees['id_abonn_serv']);
					$montant_annuel = utf8_encode($donnees['montant_annuel']);
					$date_creation = utf8_encode($donnees['date_creation']);
					$montant_carnet = utf8_encode($donnees['montant_carnet']);
					$droit_de_place = utf8_encode($donnees['droit_de_place']);
					$montant_macaron = utf8_encode($donnees['montant_macaron']);
					$montant_antenne = utf8_encode($donnees['montant_antenne']);
					$montant_mensuel = utf8_encode($donnees['montant_mensuel']);
				}
					echo "{\"droit_de_place\":\"$droit_de_place\",
							\"montant_mensuel\":\"$montant_mensuel\"}";
					
			
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