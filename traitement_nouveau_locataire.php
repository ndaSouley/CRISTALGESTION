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
	
	//VARIABLES REGLEMNTS DU LOYER LOCATAIRE
	
	
	
	            $nom_locataire = htmlspecialchars($_POST['nom_locataire']);
				$Loyer_locataire = htmlspecialchars($_POST['Loyer_locataire']);
				$_1er_mois_regele = htmlspecialchars($_POST['_1er_mois_regele']);
				$__2er_mois_regle = htmlspecialchars($_POST['__2er_mois_regle']);
				$frais_agence = htmlspecialchars($_POST['frais_agence']);
				$mode_reglement = htmlspecialchars($_POST['mode_reglement']);
				//$quartier = htmlspecialchars($_POST['quartier']);
				$montant_tva = htmlspecialchars($_POST['montant_tva']);
				$caution = htmlspecialchars($_POST['caution']);
				$Vid_bien = htmlspecialchars($_POST['Vid_bien']);
				$date_loyer = htmlspecialchars($_POST['date_loyer']);
				$id_user = htmlspecialchars($_POST['id_user']);
				
				$anne_regelement = htmlspecialchars($_POST['anne_regelement']);
				
				//$Mois_loyer = date("m", strtotime($date_loyer));
				
				$payer='1';
			
				
				
				//FIN DE CULCUL 
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
				//echo"11111";
				
				
				$requete = "SELECT
										bien.id_bien AS REQ_ID_BIEN,
										locataire.id_locataire AS REQ_id_locataire,
										proprietaire.id_proprietaire AS REQ_ID_PROPRIETAIRE,
										bien.loyer_proprietaire AS REQ_LOYER_PROPRIETAIRE
										FROM
											bien
											INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
											INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										WHERE
										bien.id_bien='".$Vid_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$REQ_id_locataire = utf8_decode($donnees['REQ_id_locataire']);
					$REQ_ID_BIEN = utf8_decode($donnees['REQ_ID_BIEN']);
					$REQ_ID_PROPRIETAIRE = utf8_decode($donnees['REQ_ID_PROPRIETAIRE']);
					$REQ_LOYER_PROPRIETAIRE = utf8_decode($donnees['REQ_LOYER_PROPRIETAIRE']);
					
				}
					
					
					
					$ps=$DBcon->prepare("SELECT
													calendrier_paie.id_calendrier_paie,
													calendrier_paie.id_locataire AS CALENDRIER_ID_LOCATAIRE,
													calendrier_paie.id_bien_locataire_calendrier,
													calendrier_paie.Janvier,
													calendrier_paie.Fevrier,
													calendrier_paie.Mars,
													calendrier_paie.Avril,
													calendrier_paie.Mai,
													calendrier_paie.Juin,
													calendrier_paie.Juillet,
													calendrier_paie.Aout,
													calendrier_paie.Septembre,
													calendrier_paie.Octobre,
													calendrier_paie.Novembre,
													calendrier_paie.id_annee,
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_bien_locataire_calendrier=?

													");
													$parametre=array($Vid_bien);
													$ps->execute($parametre);
													$Calendrier_paie=$ps->fetch();
			

			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
						// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
				
				$message='je suis la';
				
				//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_bien,
													loyer_locataire,
													montant_tva,
													montant_caution,
													Id_mode_paiement,
													date_reglement,
													id_mois_1,
													id_mois_2,
													id_annee,
													frais_agence,
													id_user
												)							
										VALUES(:id_locataire,
												:id_bien,
												:loyer_locataire,
												:montant_tva,
												:montant_caution,
												:Id_mode_paiement,
												:date_reglement,
												:id_mois_1,
												:id_mois_2,
												:id_annee,
												:frais_agence,
												:id_user
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien" => $REQ_ID_BIEN,
											":loyer_locataire" => $Loyer_locataire,
											":montant_tva" => $montant_tva,
											":montant_caution" => $caution,
											":Id_mode_paiement" => $mode_reglement,
											":date_reglement" => $date_loyer,
											":id_mois_1" => $_1er_mois_regele,
											":id_mois_2" => $__2er_mois_regle,
											":id_annee" => $anne_regelement,
											":frais_agence" => $frais_agence,
											":id_user" => $id_user
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								if($_1er_mois_regele=="01"){
									
									$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									}elseif($_1er_mois_regele=="02"){
										$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Fevrier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
												:Fevrier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Fevrier" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="03"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Mars
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
												:Mars
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Mars" => $payer
											
										));
								
										
										
										}elseif($_1er_mois_regele=="04"){
											
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Avril
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Avril
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Avril" => $payer
											
										));
								
										
										
										}elseif($_1er_mois_regele=="05"){
											
											$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Mai
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Mai
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Mai" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="06"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Juin
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Juin
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Juin" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="07"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Juillet
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Juillet
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Juillet" => $payer
											
										));
								
										
										
										}elseif($_1er_mois_regele=="08"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Aout
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Aout
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Aout" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="09"){
											
											$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Septembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Septembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Septembre" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="10"){
											
											$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Octobre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Octobre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Octobre" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="11"){
											
											$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Novembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Novembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Novembre" => $payer
											
										));
										
										
										}elseif($_1er_mois_regele=="12"){
											
																				///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Decembre" => $payer
											
										));
										
										}// FIN DU 1ER MOIS 
										
										$ps=$DBcon->prepare("SELECT
													calendrier_paie.id_calendrier_paie,
													calendrier_paie.id_locataire AS CALENDRIER_ID_LOCATAIRE,
													calendrier_paie.id_bien_locataire_calendrier,
													calendrier_paie.Janvier,
													calendrier_paie.Fevrier,
													calendrier_paie.Mars,
													calendrier_paie.Avril,
													calendrier_paie.Mai,
													calendrier_paie.Juin,
													calendrier_paie.Juillet,
													calendrier_paie.Aout,
													calendrier_paie.Septembre,
													calendrier_paie.Octobre,
													calendrier_paie.Novembre,
													calendrier_paie.id_annee,
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_bien_locataire_calendrier=?

													");
													$parametre=array($Vid_bien);
													$ps->execute($parametre);
													$Calendrier_paie_ok=$ps->fetch();
			
										
									if($__2er_mois_regle=="01"){
									
								
										 $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
								//$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									}elseif($__2er_mois_regle=="02"){
										$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
										}elseif($__2er_mois_regle=="03"){
											
											 $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										
										
										}elseif($__2er_mois_regle=="04"){
											
											
											 $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
								
										
										
										}elseif($__2er_mois_regle=="05"){
											
											 $insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
										
										
										}elseif($__2er_mois_regle=="06"){
											
											$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										
										
										}elseif($__2er_mois_regle=="07"){
											
											$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
										
										
										}elseif($__2er_mois_regle=="08"){
											
											 $insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										
										
										}elseif($__2er_mois_regle=="09"){
											
											 $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
										
										
										}elseif($__2er_mois_regle=="10"){
											
											 $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										  
										
										
										}elseif($__2er_mois_regle=="11"){
											
											$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										
										
										}elseif($__2er_mois_regle=="12"){
						$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_ok['id_calendrier_paie']
											));
										}// FIN DU 1ER MOIS 
										
							
							$message="CAUTION REGLEE AVEC SUCES";
				
					$msgexecute	=$message ;
					
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
			
			if(($_POST['action'])=="REQUETE") {
				$id_bien = $_POST['id_bien'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete1 = "SELECT
								bien.id_bien,
								bien.id_type_bien,
								bien.id_commune,
								bien.prix_bien,
								bien.quartier_bien,
								bien.id_proprietaire,
								bien.impot_foncier,
								bien.loyer_percu,
								bien.id_nbre_piece,
								bien.description,
								bien.date_enregistrement,
								bien.num_ncc,
								bien.id_charge,
								bien.id_commission,
								commission.id_commission,
								commission.libelle_commission,
								commune.id_commune,
								commune.libelle_categorie_commune,
								nbre_piece.id_nbre_piece,
								nbre_piece.libelle_piece,
								proprietaire.id_proprietaire,
								proprietaire.nom_proprietaire,
								proprietaire.prenoms,
								proprietaire.contact,
								proprietaire.e_mail,
								proprietaire.fonction,
								proprietaire.localite,
								proprietaire.date_nais_proprietaire,
								proprietaire.lieu_nais_proprietaire,
								proprietaire.cni_proprietaire,
								type_bien.id_type_bien,
								type_bien.libelle_type_bien,
								charge_bien.id_charge,
								charge_bien.libelle_charge,
								bien.loyer_proprietaire,
								bien.frais_agence
								FROM
								bien
								INNER JOIN commission ON bien.id_commission = commission.id_commission
								INNER JOIN commune ON bien.id_commune = commune.id_commune
								INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
								INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
								INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
								INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
							WHERE bien.id_bien='".$id_bien."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_bien = utf8_decode($donnees['id_bien']);
					$id_type_bien = utf8_encode($donnees['id_type_bien']);
					$prix_bien = utf8_encode($donnees['prix_bien']);
					$quartier_bien = utf8_encode($donnees['quartier_bien']);
					$id_proprietaire = utf8_encode($donnees['id_proprietaire']);
					$impot_foncier = utf8_encode($donnees['impot_foncier']);
					$loyer_percu = utf8_encode($donnees['loyer_percu']);
					$Nbre_pieces = utf8_encode($donnees['Nbre_pieces']);
					$description = utf8_encode($donnees['description']);
					$nom_proprietaire = utf8_encode($donnees['nom_proprietaire']);
					$prenoms = utf8_encode($donnees['prenoms']);
					$contact = utf8_encode($donnees['contact']);
					$e_mail = utf8_encode($donnees['e_mail']);
					$fonction = utf8_encode($donnees['fonction']);
					$localite = utf8_encode($donnees['localite']);
					$date_nais_proprietaire = utf8_encode($donnees['date_nais_proprietaire']);
					$lieu_nais_proprietaire = utf8_encode($donnees['lieu_nais_proprietaire']);
					$cni_proprietaire = utf8_encode($donnees['cni_proprietaire']);
					$id_type_bien = utf8_encode($donnees['id_type_bien']);
					$libelle_type_bien = utf8_encode($donnees['libelle_type_bien']);
					$num_ncc = utf8_encode($donnees['num_ncc']);
					$libelle_charge = utf8_encode($donnees['libelle_charge']);
					$id_charge = utf8_encode($donnees['id_charge']);
					$id_nbre_piece = utf8_encode($donnees['id_nbre_piece']);
					$libelle_piece = utf8_encode($donnees['libelle_piece']);
					$id_commune = utf8_encode($donnees['id_commune']);
					$libelle_categorie_commune = utf8_encode($donnees['libelle_categorie_commune']);
					$id_commission = utf8_encode($donnees['id_commission']);
					$libelle_commission = utf8_encode($donnees['libelle_commission']);
					$loyer_proprietaire = utf8_encode($donnees['loyer_proprietaire']);
					$frais_agence = utf8_encode($donnees['frais_agence']);
					
				}
				//echo "Affichage ";
					echo "{\"id_bien\":\"$id_bien\",
							\"prix_bien\":\"$prix_bien\",
							\"quartier_bien\":\"$quartier_bien\",
							\"id_proprietaire\":\"$id_proprietaire\",
							\"impot_foncier\":\"$impot_foncier\",
							\"loyer_percu\":\"$loyer_percu\",
							\"Nbre_pieces\":\"$Nbre_pieces\",
							\"description\":\"$description\",
							\"nom_proprietaire\":\"$nom_proprietaire\",
							\"prenoms\":\"$prenoms\",
							\"contact\":\"$contact\",
							\"e_mail\":\"$e_mail\",
					         \"fonction\":\"$fonction\",
							 \"localite\":\"$localite\",
							 \"num_ncc\":\"$num_ncc\",
							 \"date_nais_proprietaire\":\"$date_nais_proprietaire\",
							 \"lieu_nais_proprietaire\":\"$lieu_nais_proprietaire\",
							 \"cni_proprietaire\":\"$cni_proprietaire\",
							 \"id_type_bien\":\"$id_type_bien\",
							 \"libelle_charge\":\"$libelle_charge\",
							 \"id_nbre_piece\":\"$id_nbre_piece\",
							 \"libelle_piece\":\"$libelle_piece\",
							 \"id_charge\":\"$id_charge\",
							 \"id_commune\":\"$id_commune\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							 \"libelle_type_bien\":\"$libelle_type_bien\"
							 
							}";
			}
			
			
			if(($_POST['action'])=="REQUETE_LOUER") {
				$V_id_bien = $_POST['V_id_bien'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
				
				
				
					$requete1 = "SELECT
										bien.id_bien,
										bien.id_type_bien,
										bien.id_commune,
										bien.prix_bien,
										bien.quartier_bien,
										bien.id_proprietaire,
										bien.impot_foncier,
										bien.loyer_percu,
										bien.id_nbre_piece,
										bien.description,
										bien.date_enregistrement,
										bien.num_ncc,
										bien.id_charge,
										bien.id_commission,
										bien.loyer_proprietaire,
										bien.frais_agence,
										bien.disponiblite,
										bien.loyer_agence,
										bien.id_locataire AS ID_locataire_bon,
										bien.id_charge_impot,
										bien.id_categorie_bien,
										bien.lot,
										bien.ilot,
										bien.num_appartement,
										bien.parcelle,
										bien.photo1,
										commission.id_commission,
										commission.libelle_commission,
										commune.id_commune,
										commune.libelle_categorie_commune,
										nbre_piece.id_nbre_piece,
										nbre_piece.libelle_piece,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										locataire.id_locataire,
										locataire.nom_locataire,
										locataire.prenoms_locataire,
										locataire.date_nais_locataire,
										locataire.lieu_nais_locataire,
										locataire.telephone_locataire,
										locataire.num_cni_sejour,
										locataire.fonction_locataire,
										locataire.e_maill_locataire,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
										WHERE bien.id_bien='".$V_id_bien."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_bien = utf8_decode($donnees['id_bien']);
					$id_type_bien = utf8_encode($donnees['id_type_bien']);
					$prix_bien = utf8_encode($donnees['prix_bien']);
					$quartier_bien = utf8_encode($donnees['quartier_bien']);
					$id_proprietaire = utf8_encode($donnees['id_proprietaire']);
					$impot_foncier = utf8_encode($donnees['impot_foncier']);
					$loyer_percu = utf8_encode($donnees['loyer_percu']);
					$Nbre_pieces = utf8_encode($donnees['Nbre_pieces']);
					$description = utf8_encode($donnees['description']);
					$nom_locataire = utf8_encode($donnees['nom_locataire']);
					$prenoms_locataire = utf8_encode($donnees['prenoms_locataire']);
					$contact = utf8_encode($donnees['contact']);
					$e_mail = utf8_encode($donnees['e_mail']);
					$fonction = utf8_encode($donnees['fonction']);
					$localite = utf8_encode($donnees['localite']);
					$date_nais_proprietaire = utf8_encode($donnees['date_nais_proprietaire']);
					$lieu_nais_proprietaire = utf8_encode($donnees['lieu_nais_proprietaire']);
					$cni_proprietaire = utf8_encode($donnees['cni_proprietaire']);
					$id_type_bien = utf8_encode($donnees['id_type_bien']);
					$libelle_type_bien = utf8_encode($donnees['libelle_type_bien']);
					$num_ncc = utf8_encode($donnees['num_ncc']);
					$libelle_charge = utf8_encode($donnees['libelle_charge']);
					$id_charge = utf8_encode($donnees['id_charge']);
					$id_nbre_piece = utf8_encode($donnees['id_nbre_piece']);
					$libelle_piece = utf8_encode($donnees['libelle_piece']);


					$id_commune = utf8_encode($donnees['id_commune']);
					$libelle_categorie_commune = utf8_encode($donnees['libelle_categorie_commune']);
					$id_commission = utf8_encode($donnees['id_commission']);
					$libelle_commission = utf8_encode($donnees['libelle_commission']);
					$loyer_proprietaire = utf8_encode($donnees['loyer_proprietaire']);
					$frais_agence = utf8_encode($donnees['frais_agence']);
					$ID_locataire_bon = utf8_encode($donnees['ID_locataire_bon']);
					
				}
				
				
				
				//echo "Affichage ";
					echo "{\"id_bien\":\"$id_bien\",
							\"prix_bien\":\"$prix_bien\",
							\"quartier_bien\":\"$quartier_bien\",
							\"id_proprietaire\":\"$id_proprietaire\",
							\"impot_foncier\":\"$impot_foncier\",
							\"loyer_percu\":\"$loyer_percu\",
							\"Nbre_pieces\":\"$Nbre_pieces\",
							\"nom_locataire\":\"$nom_locataire\",
							\"prenoms_locataire\":\"$prenoms_locataire\",
							\"description\":\"$description\",
							\"nom_proprietaire\":\"$nom_proprietaire\",
							\"prenoms\":\"$prenoms\",
							\"contact\":\"$contact\",
							\"Var_mt_total_travaux\":\"$prix_reparation\",
							\"e_mail\":\"$e_mail\",
					         \"fonction\":\"$fonction\",
							 \"localite\":\"$localite\",
							 \"num_ncc\":\"$num_ncc\",
							 \"date_nais_proprietaire\":\"$date_nais_proprietaire\",
							 \"lieu_nais_proprietaire\":\"$lieu_nais_proprietaire\",
							 \"cni_proprietaire\":\"$cni_proprietaire\",
							 \"id_type_bien\":\"$id_type_bien\",
							 \"libelle_charge\":\"$libelle_charge\",
							 \"id_nbre_piece\":\"$id_nbre_piece\",
							 \"libelle_piece\":\"$libelle_piece\",
							 \"id_charge\":\"$id_charge\",
							 \"id_commune\":\"$id_commune\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							 \"libelle_type_bien\":\"$libelle_type_bien\"
							 
							}";
			}
			
			
			
			if(($_POST['action'])=="REQUET_selecte_locataire") {
				$V_id_bien = $_POST['V_id_bien'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
				
				
				$ps=$DBcon->prepare("SELECT
											calendrier_paie.id_calendrier_paie,
											calendrier_paie.id_locataire,
											calendrier_paie.id_bien_locataire_calendrier,
											calendrier_paie.Janvier,
											calendrier_paie.Fevrier,
											calendrier_paie.Mars,
											calendrier_paie.Avril,
											calendrier_paie.Mai,
											calendrier_paie.Juin,
											calendrier_paie.Juillet,
											calendrier_paie.Aout,
											calendrier_paie.Septembre,
											calendrier_paie.Octobre,
											calendrier_paie.Novembre,
											calendrier_paie.Decembre
											FROM
											calendrier_paie
										WHERE
											calendrier_paie.id_bien_locataire_calendrier=?
											
													");
													$parametre=array($V_id_bien);
													$ps->execute($parametre);
													$DATA_Calendrier_paie=$ps->fetch();
													$Janvier=$DATA_Calendrier_paie['Janvier'];
													$Fevrier=$DATA_Calendrier_paie['Fevrier'];
													$Mars=$DATA_Calendrier_paie['Mars'];
													$Avril=$DATA_Calendrier_paie['Avril'];
													$Mai=$DATA_Calendrier_paie['Mai'];
													$Juin=$DATA_Calendrier_paie['Juin'];
													$Juillet=$DATA_Calendrier_paie['Juillet'];
													$Aout=$DATA_Calendrier_paie['Aout'];
													$Septembre=$DATA_Calendrier_paie['Septembre'];
													$Octobre=$DATA_Calendrier_paie['Octobre'];
													$Novembre=$DATA_Calendrier_paie['Novembre'];
													$Decembre=$DATA_Calendrier_paie['Decembre'];
													
				
				
				
				$ps=$DBcon->prepare("SELECT
											charge.id_charge,
											charge.id_bien,
											charge.id_proprietaire,
											charge.id_locataire AS ID_LOCATAIRE_Charge,
											charge.prix_reparation,
											charge.id_commission,
											charge.description_charge,
											charge.date_enregistrement,
											charge.date_travaux,
											charge.mt_total_travaux,
											charge.charge_regle,
											charge.id_responssabilite,
											responssabilite.id_responssabilite,
											responssabilite.libelle_responssabilite
											FROM
											charge
											INNER JOIN responssabilite ON charge.id_responssabilite = responssabilite.id_responssabilite
											WHERE
											charge.id_bien=?
											
													");
													$parametre=array($V_id_bien);
													$ps->execute($parametre);
													$DATA_Charge=$ps->fetch();
													$Var_mt_total_travaux=$DATA_Charge['mt_total_travaux'];
													$ID_LOCATAIRE_Charge=$DATA_Charge['ID_LOCATAIRE_Charge'];
													$charge_regle=$DATA_Charge['charge_regle'];
													$date_travaux=$DATA_Charge['date_travaux'];
													
											$mois_travaux = date("m", strtotime($date_travaux));
											
																			
													$requete1 = "SELECT
															bien.id_bien,
															bien.id_type_bien,
															bien.id_commune,
															bien.prix_bien,
															bien.quartier_bien,
															bien.id_proprietaire,
															bien.impot_foncier,
															bien.loyer_percu,
															bien.id_nbre_piece,
															bien.description,
															bien.date_enregistrement,
															bien.num_ncc,
															bien.id_charge,
															bien.id_commission,
															bien.loyer_proprietaire,
															bien.frais_agence,
															bien.disponiblite,
															bien.loyer_agence,
															bien.id_locataire,
															bien.id_charge_impot,
															bien.id_categorie_bien,
															bien.lot,
															bien.ilot,
															bien.num_appartement,
															bien.parcelle,
															bien.photo1,
															commission.id_commission,
															commission.libelle_commission,
															commune.id_commune,
															commune.libelle_categorie_commune,
															nbre_piece.id_nbre_piece,
															nbre_piece.libelle_piece,
															type_bien.id_type_bien,
															type_bien.libelle_type_bien,
															charge_bien.id_charge,
															charge_bien.libelle_charge,
															locataire.id_locataire,
															locataire.nom_locataire,
															locataire.prenoms_locataire,
															locataire.date_nais_locataire,
															locataire.lieu_nais_locataire,
															locataire.telephone_locataire,
															locataire.num_cni_sejour,
															locataire.fonction_locataire,
															locataire.e_maill_locataire,
															categorie_bien.id_categorie_bien,
															categorie_bien.libelle_categorie_bien,
															categorie_bien.id_type_bien
															FROM
															bien
															INNER JOIN commission ON bien.id_commission = commission.id_commission
															INNER JOIN commune ON bien.id_commune = commune.id_commune
															INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
															INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
															INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
															INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
															INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
																		WHERE bien.id_bien='".$V_id_bien."'";
								
												// exécution de la requête
												$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
												// résultats
												$donnees = array();
												while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
													// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
													//$rows[] = utf8_encode($donnees);
													
													$id_bien = utf8_decode($donnees['id_bien']);
													$id_type_bien = utf8_encode($donnees['id_type_bien']);
													$prix_bien = utf8_encode($donnees['prix_bien']);
													$quartier_bien = utf8_encode($donnees['quartier_bien']);
													$id_proprietaire = utf8_encode($donnees['id_proprietaire']);
													$impot_foncier = utf8_encode($donnees['impot_foncier']);
													$loyer_percu = utf8_encode($donnees['loyer_percu']);
													$Nbre_pieces = utf8_encode($donnees['Nbre_pieces']);
													$description = utf8_encode($donnees['description']);
													$nom_locataire = utf8_encode($donnees['nom_locataire']);
													$prenoms_locataire = utf8_encode($donnees['prenoms_locataire']);
													$contact = utf8_encode($donnees['contact']);
													$e_mail = utf8_encode($donnees['e_mail']);
													$fonction = utf8_encode($donnees['fonction']);
													$localite = utf8_encode($donnees['localite']);
													$date_nais_proprietaire = utf8_encode($donnees['date_nais_proprietaire']);
													$lieu_nais_proprietaire = utf8_encode($donnees['lieu_nais_proprietaire']);
													$cni_proprietaire = utf8_encode($donnees['cni_proprietaire']);
													$id_type_bien = utf8_encode($donnees['id_type_bien']);
													$libelle_type_bien = utf8_encode($donnees['libelle_type_bien']);
													$num_ncc = utf8_encode($donnees['num_ncc']);
													$libelle_charge = utf8_encode($donnees['libelle_charge']);
													$id_charge = utf8_encode($donnees['id_charge']);
													$id_nbre_piece = utf8_encode($donnees['id_nbre_piece']);
													$libelle_piece = utf8_encode($donnees['libelle_piece']);
													$id_commune = utf8_encode($donnees['id_commune']);
													$libelle_categorie_commune = utf8_encode($donnees['libelle_categorie_commune']);
													$id_commission = utf8_encode($donnees['id_commission']);
													$libelle_commission = utf8_encode($donnees['libelle_commission']);
													$loyer_proprietaire = utf8_encode($donnees['loyer_proprietaire']);
													$frais_agence = utf8_encode($donnees['frais_agence']);
													$ID_locataire_bon = utf8_encode($donnees['ID_locataire_bon']);
													
												}
												
				
				
				
				
				
				//echo "Affichage ";
					echo "{\"id_bien\":\"$id_bien\",
							\"Var_mt_total_travaux\":\"$Var_mt_total_travaux\",
							\"Vid_bien\":\"$V_id_bien\",
							\"mois_travaux\":\"$mois_travaux\",
							\"ID_LOCATAIRE_Charge\":\"$ID_LOCATAIRE_Charge\",
							\"charge_regle\":\"$charge_regle\",
							\"prix_bien\":\"$prix_bien\",
							\"quartier_bien\":\"$quartier_bien\",
							\"id_proprietaire\":\"$id_proprietaire\",
							\"impot_foncier\":\"$impot_foncier\",
							\"loyer_percu\":\"$loyer_percu\",
							\"Nbre_pieces\":\"$Nbre_pieces\",
							\"nom_locataire\":\"$nom_locataire\",
							\"prenoms_locataire\":\"$prenoms_locataire\",
							\"description\":\"$description\",
							\"nom_proprietaire\":\"$nom_proprietaire\",
							\"prenoms\":\"$prenoms\",
							\"contact\":\"$contact\",
							\"e_mail\":\"$e_mail\",
					         \"fonction\":\"$fonction\",
							 \"localite\":\"$localite\",
							 \"num_ncc\":\"$num_ncc\",
							 \"date_nais_proprietaire\":\"$date_nais_proprietaire\",
							 \"lieu_nais_proprietaire\":\"$lieu_nais_proprietaire\",
							 \"cni_proprietaire\":\"$cni_proprietaire\",
							 \"id_type_bien\":\"$id_type_bien\",
							 \"libelle_charge\":\"$libelle_charge\",
							 \"id_nbre_piece\":\"$id_nbre_piece\",
							 \"libelle_piece\":\"$libelle_piece\",
							 \"id_charge\":\"$id_charge\",
							 \"id_commune\":\"$id_commune\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"Janvier\":\"$Janvier\",
							  \"Fevrier\":\"$Fevrier\",
							   \"Mars\":\"$Mars\",
							    \"Avril\":\"$Avril\",
								 \"Mai\":\"$Mai\",
								  \"Juin\":\"$Juin\",
								   \"Juillet\":\"$Juillet\",
								    \"Aout\":\"$Aout\",
									 \"Septembre\":\"$Septembre\",
									  \"Octobre\":\"$Octobre\",
									   \"Novembre\":\"$Novembre\",
									    \"Decembre\":\"$Decembre\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							 \"libelle_type_bien\":\"$libelle_type_bien\"
							 
							}";
			}
			
			
			
			if(($_POST['action'])== "test") {
				$montant = $_POST['montant'];
				$V_commission = $_POST['V_commission'];
				
				
				
				if($V_commission==6){
					
					
					$frais_agence=($montant*8)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==7){
					
					
					$frais_agence=($montant*9)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==8){
					
					
					$frais_agence=($montant*10)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}
				
				echo "{\"loyer_final\":\"$loyer_final\",
				        \"frais_agence\":\"$frais_agence\"
				}";
				
					
					
			
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