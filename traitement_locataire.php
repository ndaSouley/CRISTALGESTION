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
				$delivre_carte = htmlspecialchars($_POST['delivre_carte']);
				$nature_carte = htmlspecialchars($_POST['nature_carte']);
				$expire_carte = htmlspecialchars($_POST['expire_carte']);
				$nom = htmlspecialchars($_POST['nom']);
				$prenom = htmlspecialchars($_POST['prenom']);
				$datenaissance = htmlspecialchars($_POST['datenaissance']);
				$lieunaissance = htmlspecialchars($_POST['lieunaissance']);
				$cnisejour = htmlspecialchars($_POST['cnisejour']);
				$telephone = htmlspecialchars($_POST['telephone']);
				$frais_de_gestion = htmlspecialchars($_POST['frais_de_gestion']);
				$caution = htmlspecialchars($_POST['caution']);
				
				$date_entree_locataire = htmlspecialchars($_POST['date_entree_locataire']);
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
				$id_user = htmlspecialchars($_POST['id_user']);
				$description = htmlspecialchars($_POST['description']);
				$commission = htmlspecialchars($_POST['V_commission']);
				$id_proprietaire = htmlspecialchars($_POST['nom_proprio']);
				$frais_agence = htmlspecialchars($_POST['frais_agence']);
				$loyer_final = htmlspecialchars($_POST['loyer_final']);
			
				//Calcul Impote du proprietaire
				
				$somme_impot=$frais_agence*12/100;
				
				//Fin calcul
				
				$date_enreg = date('Y-m-d H:i:s');
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
					
					
					//INSERTION DU PROPRIETAIRE
				$insquery = "INSERT INTO locataire(nom_locataire,
													prenoms_locataire,
													date_nais_locataire,
													lieu_nais_locataire,
													telephone_locataire,
													num_cni_sejour,
													fonction_locataire,
													e_maill_locataire,
													date_sortie,
													caution,
													nature_carte,
													delivre_le,
													expire_le,
													frais_de_gestion,
													date_entree_locataire,
													id_user
													
												)							
										VALUES(:nom_locataire,
												:prenoms_locataire,
												:date_nais_locataire,
												:lieu_nais_locataire,
												:telephone_locataire,
												:num_cni_sejour,
												:fonction_locataire,
												:e_maill_locataire,
												:date_sortie,
												:caution,
												:nature_carte,
												:delivre_le,
												:expire_le,
												:frais_de_gestion,
												:date_entree_locataire,
												:id_user
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":nom_locataire" => $nom,
											":prenoms_locataire" => $prenom,
											":date_nais_locataire" => $datenaissance,
											":lieu_nais_locataire" => $lieunaissance,
											":telephone_locataire" => $telephone,
											":num_cni_sejour" => $cnisejour,
											":fonction_locataire" => $profession,
											":e_maill_locataire" => $e_mail,
											":date_sortie" => $date_sortie,
											":caution" => $caution,
											":nature_carte" => $nature_carte,
											":delivre_le" => $delivre_carte,
											":expire_le" => $expire_carte,
											":frais_de_gestion" => $frais_de_gestion,
											":date_entree_locataire" => $date_entree_locataire,
											":id_user" => $id_user
											
										));
										$id_locataire = $DBcon->lastInsertId();
										
				$disponibilite=1;
				
				$insquery = "UPDATE  bien   SET disponiblite =:disponiblite,
												id_locataire =:id_locataire,
												montant_impot =:montant_impot,
												description =:description
												WHERE id_bien =:id_bien";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":disponiblite" => $disponibilite,
										  ":id_locataire" => $id_locataire,
										   ":montant_impot" => $somme_impot,
										    ":description" => $description,
											":id_bien" => $V_id_bien
											));
											
											
				
											
					// echo"     je suis  UPDATE matricule_collecteur ".$matricule_collecteur ;
					$stmt->closeCursor();
									//$msgexecute	= " .$Id_user.";			
					$msgexecute	= "LOCATAIRE AJOUTE AVEC SUCCES !";
			$DBcon->commit();
			$DBcon = null;
				
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
			
			if(($_POST['action'])== "MISE_A_JOUR") {
						// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
					//matricule_collecteur = :matricule_collecteur,
					$v_id_locataire = htmlspecialchars($_POST['v_id_locataire']);
					//$date_sortie = htmlspecialchars($_POST['date_sortie']);
					
					
					//INSERTION DU PROPRIETAIRE
					
					$insquery = "UPDATE  locataire   SET nom_locataire =:nom_locataire,
												prenoms_locataire =:prenoms_locataire,
												date_nais_locataire =:date_nais_locataire,
												lieu_nais_locataire =:lieu_nais_locataire,
												telephone_locataire =:telephone_locataire,
												num_cni_sejour =:num_cni_sejour,
												fonction_locataire =:fonction_locataire,
												e_maill_locataire =:e_maill_locataire,
												caution =:caution,
												Id_user =:Id_user,
												frais_de_gestion =:frais_de_gestion,
												date_entree_locataire =:date_entree_locataire
												WHERE id_locataire =:id_locataire";
												
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":nom_locataire" => $nom,
										  ":prenoms_locataire" => $prenom,
										  ":date_nais_locataire" => $datenaissance,
										  ":lieu_nais_locataire" => $lieunaissance,
										  ":telephone_locataire" => $telephone,
										  ":num_cni_sejour" => $cnisejour,
										  ":fonction_locataire" => $profession,
										  ":e_maill_locataire" => $e_mail,
										  ":caution" => $caution,
										   ":Id_user" => $id_user,
										    ":frais_de_gestion" => $frais_de_gestion,
										  ":date_entree_locataire" => $date_entree_locataire,
											":id_locataire" => $v_id_locataire
											));
											
											
				
					
				
											
					// echo"     je suis  UPDATE matricule_collecteur ".$matricule_collecteur ;
					$stmt->closeCursor();
									//$msgexecute	= " .$Id_user.";			
					$msgexecute	= "LOCATAIRE MODIFIÉ AVEC SUCCES !";
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