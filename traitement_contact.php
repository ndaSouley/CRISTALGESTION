<?PHP
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
	try
	{
	require_once 'bd_connexion.php';

	$stmt = null;
	            // Variables Personne Contact
				
				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$telephone1 = htmlspecialchars($_POST['telephone1']);
			    $telephone2 = htmlspecialchars($_POST['telephone2']);
				$email = htmlspecialchars($_POST['email']);
				$fonction = htmlspecialchars($_POST['fonction']);
				$societe = htmlspecialchars($_POST['societe']);
				
		       
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				
				$insquery = "INSERT INTO contact(nom,
												prenom,
												telephone1,
												telephone2,
												email,
												fonction,
												societe
												)							
										VALUES(
												:nom,
												:prenom,
												:telephone1,
												:telephone2,
												:email,
												:fonction,
												:societe
												)";
					$stmt = $DBcon->prepare($insquery);
					
					$stmt->execute(array(":nom" => $nom,
											":prenom" => $prenom,
											":telephone1" => $telephone1,
											":telephone2" => $telephone2,
											":email" => $email,
											":fonction" => $fonction,
											":societe" => $societe,
											":adresse" => $adresse
											
										));
									//$id_contri = mysql_insert_id($DBcon);
									$id_contri = $DBcon->lastInsertId();
						$stmt->closeCursor();				
				$msgexecute	= "CONTACT AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER LA SAISIE?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			   
			    	if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$id_quit = htmlspecialchars($_POST['id_quit']);
				 
				 // Requête pur selectionner l'identifant du contribuable
				$select = "SELECT id_contribuable from service WHERE id_quittance = '".$id_quit."'";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_contribuable = utf8_decode($donnees['id_contribuable']);
				}
			$insquery = "UPDATE  contribuable SET
				                                matricule_collecteur = :matricule_collecteur,
												nom = :nom,
												prenom = :prenom,
												date_naissance = :date_naissance,
												lieu_naissance = :lieu_naissance,
												cni = :cni,
												quartier = :quartier,
												profession = :profession,
												adresse = :adresse,
												telephone = :telephone
												WHERE id_contribuable = :id_contribuable";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":matricule_collecteur" =>	$collecteur,
											":nom" => $nom,
											":prenom" => $prenom,
											":date_naissance" => $datenaissance,
											":lieu_naissance" => $lieunaissance,
											":cni" => $cnisejour,
											":quartier" => $quartier,
											":profession" => $profession,
											":adresse" => $adresse,
											":telephone" => $telephone,
											"id_contribuable"=>$id_contribuable));
											$stmt->closeCursor();
	
						//echo"type quittance=".$TAXE_FORFAITAIRE;
				$insquery = "UPDATE  quittance SET code_quittance =:code_quittance,
												Id_Type_quit =:Id_Type_quit,
												code_periode =:code_periode,
												numero_serie =:numero_serie,
												date_validite =:date_validite,
												num_plaque =:num_plaque,
												CB_DAF =:CB_DAF
												WHERE id_quittance = :id_quittance";															
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":code_quittance" => $numquittance,
											":Id_Type_quit" => $TAXE_FORFAITAIRE,
											":code_periode" => $exercice,
											":numero_serie" => $numserie,
											":date_validite" => $datequittance,
											":num_plaque" => $num_plaque,
											":CB_DAF" => $cbdaf,
											":id_quittance" => $id_quit
										));
										
							// Requête pour selectionner l'identifiant due l'abonnement service 			
				$select = "SELECT id_abonn_serv,id_service,id_user from service WHERE id_quittance = '".$id_quit."'";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_user = utf8_decode($donnees['id_user']);
					$id_abonn_serv = utf8_decode($donnees['id_abonn_serv']);
					$id_service = utf8_decode($donnees['id_service']);
					//quotite_officiel =:quotite_officiel,
					//quotite_paye=:quotite_paye,
					
				}
				/*echo "id abonnement".$id_abonn_serv;
				echo "id service".$id_service;
				echo "id quittance".$id_contribuable;
				echo "id contribuable".$id_contribuable;*/
				
				$insquery = "UPDATE service SET id_abonn_serv = :id_abonn_serv,
												id_user = :id_user,
												id_contribuable = :id_contribuable,
												id_quittance = :id_quittance,
												montant_taxe = :montant_taxe,
												quotite_officiel = :quotite_officiel,
												quotite_paye = :quotite_paye,
												montant_droit_place = :montant_droit_place,
												code_periode = :code_periode
												WHERE id_service = :id_service";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_abonn_serv" => $id_abonn_serv,
											":id_user" => $id_user,
											":id_contribuable" => $id_contribuable,
											":id_quittance" => $id_quit,
											":montant_taxe" => $montant,
											":quotite_officiel" => $droit_de_place_reel + $montant_mensuel_reel,
											":quotite_paye" => $montant_droit_place + $montant, 
											":montant_droit_place" => $montant_droit_place,
											":code_periode" => $exercice,
											":id_service" => $id_service)); 
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "TAXE FORFAITAIRE MODIFIEE AVEC SUCCES!";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
				/////////////////////////////////////////////////////////////////////
		
			if(($_POST['action'])== "SELECT") {
				$id_quit = $_POST['id_quit'];
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
								collecteur.matricule_collecteur AS mat,
								CONCAT(collecteur.nom,' ',collecteur.prenom) AS nomcollecteur,
								contribuable.nom AS nomContribuable,
								contribuable.prenom AS prenomContribuable,
								contribuable.date_naissance AS datenais,
								contribuable.lieu_naissance AS lieunais,
								contribuable.cni AS cni,
								contribuable.quartier AS quartier,
								contribuable.profession AS profession,
								contribuable.adresse AS adresse,
								contribuable.telephone AS telephone,
								service.quotite_paye,
								service.quotite_officiel,
								service.montant_droit_place,
								service.montant_macaron,
								service.montant_antenne,
								service.montant_carnet,
								service.date_doc,
								service.montant_taxe,
								exercice.periode,
								exercice.code_periode,
								quittance.id_quittance,
								quittance.code_quittance,
								quittance.Id_Type_quit,
								quittance.PTAC,
								quittance.num_plaque,
								quittance.numero_serie,
								quittance.date_validite,
                                quittance.CB_DAF,
								type_service.lib_type_service,
								type_service.IdType_quit,
								categorie_abonnement.lib_categ,
								type_service.code_type_service,								
								abonnement_service.id_abonn_serv,
								abonnement_service.montant_mensuel AS montant_mensuel_reel,
                                abonnement_service.droit_de_place AS droit_de_place_reel,
								categorie_abonnement.code_categ
								FROM
								service
								INNER JOIN exercice ON service.code_periode = exercice.code_periode
								INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
								INNER JOIN quittance ON service.id_quittance = quittance.id_quittance
								INNER JOIN collecteur ON contribuable.matricule_collecteur = collecteur.matricule_collecteur
								INNER JOIN abonnement_service ON service.id_abonn_serv = abonnement_service.id_abonn_serv
								INNER JOIN type_service ON abonnement_service.code_type_service = type_service.code_type_service
								INNER JOIN categorie_abonnement ON abonnement_service.code_categ = categorie_abonnement.code_categ
								WHERE quittance.id_quittance='".$id_quit."'";


				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$CB_DAF = utf8_decode($donnees['CB_DAF']);
					$date_validite = utf8_decode($donnees['date_validite']);
					$mat = utf8_decode($donnees['mat']);
					$nomCollecteur = utf8_encode($donnees['nomcollecteur']);
					$montant_mensuel_reel = utf8_encode($donnees['montant_mensuel_reel']);
					$droit_de_place_reel = utf8_encode($donnees['droit_de_place_reel']);
					$montant_droit_place = utf8_encode($donnees['montant_droit_place']);
					$montant_macaron = utf8_encode($donnees['montant_macaron']);
					$code_periode = utf8_encode($donnees['code_periode']);
					$montant_antenne = utf8_encode($donnees['montant_antenne']);
					$montant_carnet = utf8_encode($donnees['montant_carnet']);
                     $quotite_officiel = utf8_encode($donnees['quotite_officiel']);
					$nomContribuable = utf8_encode($donnees['nomContribuable']);
					$prenomContribuable = utf8_encode($donnees['prenomContribuable']);
					$datenais = utf8_encode($donnees['datenais']);
					$lieunais = utf8_encode($donnees['lieunais']);
					$cni = utf8_encode($donnees['cni']);
					$quartier = utf8_encode($donnees['quartier']);
					$profession = utf8_encode($donnees['profession']);	
					$adresse = utf8_encode($donnees['adresse']);
					$id_abonn_serv = utf8_encode($donnees['id_abonn_serv']);
					$telephone = utf8_encode($donnees['telephone']);
					$quotite_paye = utf8_encode($donnees['quotite_paye']);
					$periode = utf8_encode($donnees['periode']);
					$IdType_quit = utf8_encode($donnees['IdType_quit']);
					$code_quittance = utf8_encode($donnees['code_quittance']);
					$PTAC = utf8_encode($donnees['PTAC']);	
					$num_plaque = utf8_encode($donnees['num_plaque']);	
					$numero_serie = utf8_encode($donnees['numero_serie']);	
					$date_doc = utf8_encode($donnees['date_doc']);	
					$montant_taxe = utf8_encode($donnees['montant_taxe']);
					$lib_type_service = utf8_encode($donnees['lib_type_service']);
					$lib_categ = utf8_encode($donnees['lib_categ']);
					$code_type_service = utf8_encode($donnees['code_type_service']);
					$code_categ = utf8_encode($donnees['code_categ']);	
				}
				//echo "Affichage ";
					echo "{
						\"code_categ\":\"$code_categ\",
						\"montant_droit_place\":\"$montant_droit_place\",
						\"id_abonn_serv\":\"$id_abonn_serv\",
						\"droit_de_place_reel\":\"$droit_de_place_reel\",
						\"montant_mensuel_reel\":\"$montant_mensuel_reel\",
						\"mat\":\"$mat\",
						\"montant_macaron\":\"$montant_macaron\",
							\"code_periode\":\"$code_periode\",
						\"montant_antenne\":\"$montant_antenne\",
						\"montant_carnet\":\"$montant_carnet\",
						\"quotite_officiel\":\"$quotite_officiel\",
					       \"CB_DAF\":\"$CB_DAF\",
						    \"date_validite\":\"$date_validite\",
						    \"nomCollecteur\":\"$nomCollecteur\",
						   \"IdType_quit\":\"$IdType_quit\",
						    \"nomContribuable\":\"$nomContribuable\",
							\"prenomContribuable\":\"$prenomContribuable\",
							\"datenais\":\"$datenais\",
							\"lieunais\":\"$lieunais\",
							\"cni\":\"$cni\",
							\"telephone\":\"$telephone\",
							\"adresse\":\"$adresse\",
							\"quartier\":\"$quartier\",
							\"profession\":\"$profession\",
							\"code_quittance\":\"$code_quittance\",
							\"periode\":\"$periode\",
							\"lib_categ\":\"$lib_categ\",
							\"lib_type_service\":\"$lib_type_service\",
							\"code_type_service\":\"$code_type_service\",
							\"num_plaque\":\"$num_plaque\",
							\"numero_serie\":\"$numero_serie\",
							\"montant_taxe\":\"$montant_taxe\"}";
					
				/*	
				//Return result
				$Result = array();
				$Result = $rows;

				// envoi du résultat au success
				//print json_encode($Result);
				echo json_encode($Result);
				*/
		
			}
			if(($_POST['action'])== "SELECTALL") {
				
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
					
				/*	
				//Return result
				$Result = array();
				$Result = $rows;

				// envoi du résultat au success
				//print json_encode($Result);
				echo json_encode($Result);
				*/
		
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
						WHERE code_categ='".$categorie."' AND code_type_service='".$activite."'";

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
					
				/*	
				//Return result
				$Result = array();
				$Result = $rows;

				// envoi du résultat au success
				//print json_encode($Result);
				echo json_encode($Result);
				*/
		
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