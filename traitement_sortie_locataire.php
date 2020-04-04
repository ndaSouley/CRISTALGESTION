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
	            // VARIABLES PROPRIETAIRE
			
				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$datenaissance = htmlspecialchars($_POST['datenaissance']);
				$lieunaissance = htmlspecialchars($_POST['lieunaissance']);
				$cnisejour = htmlspecialchars($_POST['cnisejour']);
				$telephone = htmlspecialchars($_POST['telephone']);
				//$quartier = htmlspecialchars($_POST['quartier']);
				$profession = htmlspecialchars($_POST['profession']);
				$e_mail = htmlspecialchars($_POST['e_mail']);
				
				// VARIABLES DE BIEN 
				$type_bien = htmlspecialchars($_POST['type_bien']);
				$prise_en_charge = htmlspecialchars($_POST['prise_en_charge']);
				$localite = htmlspecialchars($_POST['localite']);
				$loyer_agence = htmlspecialchars($_POST['loyer_agence']);
				$num_ncc = htmlspecialchars($_POST['num_ncc']);
				$nbre_piece = htmlspecialchars($_POST['nbre_piece']);
				$num_impot = htmlspecialchars($_POST['num_impot']);
				$commune = htmlspecialchars($_POST['commune']);
				$description = htmlspecialchars($_POST['description']);
				$commission = htmlspecialchars($_POST['V_commission']);
				$id_proprietaire = htmlspecialchars($_POST['nom_proprio']);
				$V_date_sortie = htmlspecialchars($_POST['date_sortie']);
				$frais_agence = htmlspecialchars($_POST['frais_agence']);
				$loyer_final = htmlspecialchars($_POST['loyer_final']);
			
				
				$date_enreg = date('Y-m-d H:i:s');
				$date_enreg_V1 = date('Y-m-d');
				$annee = date('Y');
				//echo"11111";
			

			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
						// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
					//matricule_collecteur = :matricule_collecteur,
					$V_id_bien = htmlspecialchars($_POST['Vid_bien']);
					$date_sortie = htmlspecialchars($_POST['date_sortie']);
					
					
					//INSERTION DU LA SORTIE DU LOCATAIRE
			$requete = "SELECT * FROM bien WHERE bien.id_bien ='".$V_id_bien."'";
			
			$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$V_id_locataire = utf8_decode($donnees['id_locataire']);
					$V_prix_bien = utf8_decode($donnees['prix_bien']);
					
				}
				
				//INSERTION DANS LA TABLE HISTORIQUE BIEN
				
				
					//INSERTION DU PROPRIETAIRE
					$insquery = "INSERT INTO historique_locataire(id_locataire,
																id_bien_locataire,
																ancien_loyer,
																date_sortie_locataire,
																date_insertion
															)							
										VALUES(:id_locataire,
												:id_bien_locataire,
												:ancien_loyer,
												:date_sortie_locataire,
												:date_insertion
												
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_locataire" => $V_id_locataire,
											":id_bien_locataire" => $V_id_bien,
											":ancien_loyer" => $V_prix_bien,
											":date_sortie_locataire" => $V_date_sortie,
											":date_insertion" => $date_enreg_V1
										));
										//$id_proprietaire = $DBcon->lastInsertId();
				
				// FIN D'INSERTION DANS LA TABLE HISTORIQUE BIEN 
										
				$disponibilite=0;
				$var_id_locataire=255;
				
				$insquery = "UPDATE  bien   SET disponiblite =:disponiblite,
												id_locataire =:id_locataire
												WHERE id_bien =:id_bien";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":disponiblite" => $disponibilite,
										  ":id_locataire" => $var_id_locataire,
											":id_bien" => $V_id_bien
											));
											
					$V_satut=0;
				$var_id_locataire=255;
				
											
					$insquery = "UPDATE  locataire   SET date_sortie =:date_sortie
														
												WHERE id_locataire =:id_locataire";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":date_sortie" => $V_date_sortie,
										  
											":id_locataire" => $V_id_locataire
											));
				
											
					// echo"     je suis  UPDATE matricule_collecteur ".$matricule_collecteur ;
					$stmt->closeCursor();
									//$msgexecute	= " .$Id_user.";			
					$msgexecute	= "LOCATAIRE SORTIE AVEC SUCCES !";
			$DBcon->commit();
			$DBcon = null;
				
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
				/////////////////////////////////////////////////////////////////////

												
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