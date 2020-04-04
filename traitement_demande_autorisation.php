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
	            
				 $collecteur = htmlspecialchars($_POST['collecteur']);
				 $date_visite = htmlspecialchars($_POST['date_visite']);
				 $place_assise = htmlspecialchars($_POST['place_assise']);
				 $datevisiste = htmlspecialchars($_POST['datevisiste']);
				$place_debout = htmlspecialchars($_POST['place_debout']);
				$numpatente = htmlspecialchars($_POST['numpatente']);
				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$datenaissance = htmlspecialchars($_POST['datenaissance']);
			    $lieunaissance = htmlspecialchars($_POST['lieunaissance']);
				$cnisejour = htmlspecialchars($_POST['cnisejour']);
				$telephone = htmlspecialchars($_POST['telephone']);
				$adresse = htmlspecialchars($_POST['adresse']);
		        $quartier = htmlspecialchars($_POST['quartier']);
			    $profession = htmlspecialchars($_POST['profession']);
				// Variables quittances
				$numquittance = htmlspecialchars($_POST['numquittance']);
				$numserie = htmlspecialchars($_POST['numserie']);
				$exercice = htmlspecialchars($_POST['exercice']);
				$activite = htmlspecialchars($_POST['activite']);
				$cbdaf = htmlspecialchars($_POST['cbdaf']);
				$categorie = htmlspecialchars($_POST['categorie']);
				$date_validite = htmlspecialchars($_POST['date_validite']);
				$TAXE_FORFAITAIRE = htmlspecialchars($_POST['TAXE_FORFAITAIRE']);
				$id_quittance = htmlspecialchars($_POST['id_quittance']);
				$numero_patente = htmlspecialchars($_POST['numero_patente']);
				$montant = htmlspecialchars($_POST['montant']);
				$droitplace = htmlspecialchars($_POST['droitplace']);
				$immatriculation = htmlspecialchars($_POST['immatriculation']);
				$couleur = htmlspecialchars($_POST['couleur']);
				 $date_habilitation = htmlspecialchars($_POST['date_habilitation']);
				$marque_vehicule = htmlspecialchars($_POST['marque_vehicule']);
				$numserie = htmlspecialchars($_POST['numserie']);
				$nbrplace = htmlspecialchars($_POST['nbrplace']);
				$type_vehicule = htmlspecialchars($_POST['type_vehicule']);
				$patc = htmlspecialchars($_POST['patc']);
				$genre_vehicule = htmlspecialchars($_POST['genre_vehicule']);
				$numero_macaron = htmlspecialchars($_POST['numero_macaron']);
				$numero_antenne = htmlspecialchars($_POST['numero_antenne']);
				
				//Variables service
				$id_user = htmlspecialchars($_POST['id_user']);
				$numplaque = htmlspecialchars($_POST['num_plaque']);
				$acte = htmlspecialchars($_POST['acte']);
				$action = htmlspecialchars($_POST['action']); 
				$droit_de_place_reel = htmlspecialchars($_POST['droit_de_place_reel']); 
				$montant_mensuel_reel = htmlspecialchars($_POST['montant_mensuel_reel']); 
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				$insquery = "INSERT INTO contribuable(matricule_collecteur,
												nom,
												prenom,
												date_naissance,
												lieu_naissance,
												cni,
												quartier,
												profession,
												adresse,
												telephone,
												date_enreg)							
										VALUES(:matricule_collecteur,
												:nom,
												:prenom,
												:date_naissance,
												:lieu_naissance,
												:cni,
												:quartier,
												:profession,
												:adresse,
												:telephone,
												:date_enreg)";
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
											":date_enreg" => $date_enreg
										));
									//$id_contri = mysql_insert_id($DBcon);
									$id_contri = $DBcon->lastInsertId();
				$insquery = "INSERT INTO quittance(code_quittance,
				                                  immatriculation,
				                                date_habilitation,
												place_assise,
												date_visite,
												place_debout,
												numero_patente,
				                                marque_vehicule,
												numero_serie,
												nombre_place,
												type_vehicule,
												PTAC,
												genre_vehicule,
												Id_Type_quit,
												code_periode,
												date_validite,
												num_plaque,
												CB_DAF)							
										VALUES(:code_quittance,
										        :immatriculation,
										        :date_habilitation,
												:place_assise,
												:date_visite,
												:place_debout,
												:numero_patente,
										        :marque_vehicule,
												:numero_serie,
												:nombre_place,
												:type_vehicule,
												:PTAC,
												:genre_vehicule,
												:Id_Type_quit,
												:code_periode,
												:date_validite,
												:num_plaque,
												:CB_DAF)";
					$stmt = $DBcon->prepare($insquery);
					
					$stmt->execute(array(":code_quittance" => $numquittance,
					                       ":immatriculation" => $immatriculation,
										":date_habilitation" => $date_habilitation,
									    ":place_assise" => $place_assise,
										":date_visite" => $date_visite,
										":place_debout" => $place_debout,
										":numero_patente" => $numero_patente,
									   ":marque_vehicule" => $marque_vehicule,
									    ":numero_serie" => $numserie,
										":nombre_place" => $nbrplace,
										":type_vehicule" => $type_vehicule,
										":PTAC" => $patc,
										":genre_vehicule" => $genre_vehicule,
										":Id_Type_quit" => $TAXE_FORFAITAIRE,
										":code_periode" => $exercice,
										":date_validite" => $date_validite,
										":num_plaque" => $numplaque,
										":CB_DAF" => $cbdaf
										));
					//$id_quit = mysql_insert_id($DBcon);
					//Recupere l'identifiant du dernier enregistrement
					$id_quit = $DBcon->lastInsertId();
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
						abonnement_service a 
						WHERE code_categ=(SELECT min(b.code_categ) 
															FROM abonnement_service b 
															WHERE a.code_type_service = b.code_type_service)
						AND code_type_service='".$activite."'";

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
				$insquery = "INSERT INTO service(id_abonn_serv,
												id_user,
												id_contribuable,
												id_quittance,
												date_creation,
												date_doc,
												quotite_officiel,
												quotite_paye,
												montant_taxe,
												montant_droit_place	,
												montant_macaron,
												montant_antenne,
												montant_carnet,
												code_periode
												)							
										VALUES(:id_abonn_serv,
												:id_user,
												:id_contribuable,
												:id_quittance,
												:date_creation,
												:date_doc,
												:quotite_officiel,
												:quotite_paye,
												:montant_taxe,
												:montant_droit_place,
												:montant_macaron,
												:montant_antenne,
												:montant_carnet,
												:code_periode
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_abonn_serv" => $id_abonn_serv,
											":id_user" => $id_user,
											":id_contribuable" => $id_contri,
											":id_quittance" => $id_quit,
											":date_creation" => $date_creation ,
											":date_doc" => $date_validite,
											":quotite_officiel" => $droit_de_place + $montant_mensuel,
											":quotite_paye" =>$droitplace + $montant, 
											":montant_taxe" => $montant,
											":montant_droit_place" => $droitplace,
											":montant_macaron" => $montant_macaron,
											":montant_antenne" => $montant_antenne,
											":montant_carnet" => $montant_antenne,
											":code_periode" => $exercice
										));  
						$stmt->closeCursor();				
				$msgexecute	= "DEMANDE AUTORISATION  AJOUTE AVEC SUCCES! VOULLEZ-VOUS CONTINUER LA SAISE?";
				
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
				                                    immatriculation=:immatriculation,
				                                date_habilitation=:date_habilitation,
												marque_vehicule=:marque_vehicule,
												type_vehicule=:type_vehicule,
												numero_patente=:numero_patente,
												genre_vehicule=:genre_vehicule,
												place_debout=:place_debout,
												place_assise=:place_assise,
												date_visite=:date_visite,
												Id_Type_quit =:Id_Type_quit,
												code_periode =:code_periode,
												numero_serie =:numero_serie,
												date_validite =:date_validite,
												num_plaque =:num_plaque,
												CB_DAF =:CB_DAF
												WHERE id_quittance = :id_quittance";															
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":code_quittance" => $numquittance,
					                        ":immatriculation" => $immatriculation,
					                       ":date_habilitation" => $date_habilitation,
										    ":marque_vehicule" => $marque_vehicule,
										    ":type_vehicule" => $type_vehicule,
										   ":numero_patente" => $numero_patente,
										    ":genre_vehicule" => $genre_vehicule,
										     ":place_debout" => $place_debout,
											 ":place_assise" => $place_assise,
										   ":date_visite" => $date_visite,
											":Id_Type_quit" => $TAXE_FORFAITAIRE,
											":code_periode" => $exercice,
											":numero_serie" => $numserie,
											":date_validite" => $date_validite,
											":num_plaque" => $numplaque,
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
											":quotite_officiel" => $droit_de_place_reel + $montant_mensuel_reel,
											":quotite_paye" => $droitplace + $montant, 
											":montant_taxe" => $montant,
											":montant_droit_place" => $droitplace,
											":code_periode" => $exercice,
											":id_service" => $id_service)); 
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "DEMANDE AUTORISATION MODIFEE AVEC SUCCES !";
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
								exercice.periode,
								exercice.code_periode,
								quittance.id_quittance,
								quittance.code_quittance,
								quittance.Id_Type_quit,
								quittance.PTAC,
								quittance.num_plaque,
								quittance.numero_serie,
								service.date_doc,
								service.montant_taxe,
								type_service.lib_type_service,
								type_service.IdType_quit,
								categorie_abonnement.lib_categ,
								type_service.code_type_service,
								quittance.date_validite,
                                quittance.CB_DAF,
								abonnement_service.id_abonn_serv,
								abonnement_service.montant_mensuel AS montant_mensuel_reel,
                                abonnement_service.droit_de_place AS droit_de_place_reel,
								categorie_abonnement.code_categ,
								categorie_abonnement.code_categ,
								quittance.immatriculation,
								quittance.code_periode,
								quittance.numero_macaron,
								quittance.couleur,
								quittance.numero_antenne,
								quittance.genre_vehicule,
								quittance.type_vehicule,
								quittance.marque_vehicule,
								quittance.nombre_place,
								quittance.region,
								quittance.departement,
								quittance.place_assise,
								quittance.place_debout,
								quittance.itineraire,
								quittance.numero_patente,
								quittance.date_visite,
								quittance.date_habilitation
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
					
					 
					   $immatriculation = utf8_encode($donnees['immatriculation']);
					 $code_periode = utf8_encode($donnees['code_periode']);
                    $numero_macaron = utf8_encode($donnees['numero_macaron']);
					 $couleur = utf8_encode($donnees['couleur']);
					$numero_antenne = utf8_encode($donnees['numero_antenne']);
					$genre_vehicule = utf8_encode($donnees['genre_vehicule']);
					$type_vehicule = utf8_encode($donnees['type_vehicule']);
					$marque_vehicule = utf8_encode($donnees['marque_vehicule']);
					$nombre_place = utf8_encode($donnees['nombre_place']);
					$place_assise = utf8_encode($donnees['place_assise']);
					$departement = utf8_encode($donnees['departement']);
					$place_debout = utf8_encode($donnees['place_debout']);
					$itineraire = utf8_encode($donnees['itineraire']);
					$numero_patente = utf8_encode($donnees['numero_patente']);
					$date_visite = utf8_encode($donnees['date_visite']);
					$code_categ = utf8_encode($donnees['code_categ']);
					
					$date_habilitation = utf8_encode($donnees['date_habilitation']);			
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
						
						\"numquittance\":\"$numquittance\",
						\"place_assise\":\"$place_assise\",
						\"date_habilitation\":\"$date_habilitation\",
							\"PTAC\":\"$PTAC\",
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
						 \"numero_macaron\":\"$numero_macaron\",
						 \"couleur\":\"$couleur\",
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
							\"immatriculation\":\"$immatriculation\",
							\"code_periode\":\"$code_periode\",
							\"numero_antenne\":\"$numero_antenne\",
							\"genre_vehicule\":\"$genre_vehicule\",
							\"type_vehicule\":\"$type_vehicule\",
							\"marque_vehicule\":\"$marque_vehicule\",
							\"nombre_place\":\"$nombre_place\",
							\"departement\":\"$departement\",
							\"place_debout\":\"$place_debout\",
							\"itineraire\":\"$itineraire\",
							\"numero_patente\":\"$numero_patente\",
							\"date_visite\":\"$date_visite\",
							\"code_categ\":\"$code_categ\"}";
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
					$requete = $requete = "SELECT					
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
						abonnement_service a 
						WHERE code_categ=(SELECT min(b.code_categ) 
															FROM abonnement_service b 
															WHERE a.code_type_service = b.code_type_service)
						AND code_type_service='".$activite."'";
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