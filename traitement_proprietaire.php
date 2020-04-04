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
				$societe = htmlspecialchars($_POST['societe']);
				$datenaissance = htmlspecialchars($_POST['datenaissance']);
				$lieunaissance = htmlspecialchars($_POST['lieunaissance']);
				$cnisejour = htmlspecialchars($_POST['cnisejour']);
				$telephone = htmlspecialchars($_POST['telephone']);
				$quartier = htmlspecialchars($_POST['quartier']);
				$profession = htmlspecialchars($_POST['profession']);
				$e_mail = htmlspecialchars($_POST['e_mail']);
				$initial = htmlspecialchars($_POST['initial']);
				
				// VARIABLES DE BIEN 
					
				$apport_proprietaire = htmlspecialchars($_POST['apport_proprietaire']);
				$apport_cristal = htmlspecialchars($_POST['apport_cristal']);
				$rehabilitation = htmlspecialchars($_POST['rehabilitation']);	
				$type_bien = htmlspecialchars($_POST['type_bien']);
				$prise_en_charge = htmlspecialchars($_POST['prise_en_charge']);
				$localite = htmlspecialchars($_POST['localite']);
				$categorie_bien = htmlspecialchars($_POST['categorie_bien']);
				$montant = htmlspecialchars($_POST['montant']);
				$num_appartement = htmlspecialchars($_POST['num_appartement']);
				$num_ncc = htmlspecialchars($_POST['num_ncc']);
				$nbre_piece = htmlspecialchars($_POST['nbre_piece']);
				$num_impot = htmlspecialchars($_POST['num_impot']);
				$charge_impot = htmlspecialchars($_POST['charge_impot']);
				$commune = htmlspecialchars($_POST['commune']);
				$description = htmlspecialchars($_POST['description']);
				$commission = htmlspecialchars($_POST['V_commission']);
				$id_proprietaire = htmlspecialchars($_POST['nom_proprio']);
				$frais_agence = htmlspecialchars($_POST['frais_agence']);
				$loyer_final = htmlspecialchars($_POST['loyer_final']);
				$mt_impot = htmlspecialchars($_POST['mt_impot']);
				$nom_immeuble = htmlspecialchars($_POST['nom_immeuble']);
				$ilot = htmlspecialchars($_POST['ilot']);
				$lot = htmlspecialchars($_POST['lot']);
				$V_id_user = htmlspecialchars($_POST['id_user']);
				$nbre_place_garage = htmlspecialchars($_POST['nbre_place_garage']);
				$parcelle = htmlspecialchars($_POST['parcelle']);
				
				/*$V_photo1=$_FILES['photo1']['name'];
				$fichier_tempo=$_FILES['photo1']['tmp_name'];
				move_uploaded_file($fichier_tempo,'./Images/'.$V_photo1);*/
				
				//Calcul Impote du proprietaire
				
				$somme_impot=$loyer_final*4/100;
				
				//Fin calcul
								
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
				//echo"11111";
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
				
				
				if($id_proprietaire==''){
					
					
					
					//INSERTION DU PROPRIETAIRE
				$insquery = "INSERT INTO proprietaire(nom_proprietaire,
													prenoms,
													contact,
													e_mail,
													fonction,
													localite,
													date_nais_proprietaire,
													lieu_nais_proprietaire,
													montant_impot,
													initial_proprietaire,
													societe,
													cni_proprietaire
												)							
										VALUES(:nom_proprietaire,
												:prenoms,
												:contact,
												:e_mail,
												:fonction,
												:localite,
												:date_nais_proprietaire,
												:lieu_nais_proprietaire,
												:montant_impot,
												:initial_proprietaire,
												:societe,
												:cni_proprietaire
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":nom_proprietaire" => $nom,
											":prenoms" => $prenom,
											":contact" => $telephone,
											":e_mail" => $e_mail,
											":fonction" => $profession,
											":localite" => $quartier,
											":date_nais_proprietaire" => $datenaissance,
											":lieu_nais_proprietaire" => $lieunaissance,
											":montant_impot" => $mt_impot,
											":initial_proprietaire" => $initial,
											":societe" => $societe,
											":cni_proprietaire" => $cnisejour
										));
										$id_proprietaire = $DBcon->lastInsertId();
										
										
										//INSERTION DU BIEN
										
										
					$insquery = "INSERT INTO bien(id_type_bien,
													prix_bien,
													quartier_bien,
													id_proprietaire,
													impot_foncier,
													id_nbre_piece,
													description,
													num_ncc,
													id_charge,
													id_commission,
													id_commune,
													frais_agence,
													loyer_proprietaire,
													id_categorie_bien,
													id_charge_impot,
													lot,
													Nbre_place_garage,
													nom_immeuble,
													num_appartement,
													id_user,
													parcelle,
													apport_proprietaire,
													apport_cristal,
													Id_rehabilitation,
													ilot,
													montant_impot
												)							
										VALUES(:id_type_bien,
												:prix_bien,
												:quartier_bien,
												:id_proprietaire,
												:impot_foncier,
												:id_nbre_piece,
												:description,
												:num_ncc,
												:id_charge,
												:id_commission,
												:id_commune,
												:frais_agence,
												:loyer_proprietaire, 
												:id_categorie_bien,
												:id_charge_impot,
												:lot,
												:Nbre_place_garage,
												:nom_immeuble,
												:num_appartement,
												:id_user,
												:parcelle,
												:apport_proprietaire,
												:apport_cristal,
												:Id_rehabilitation,
												:ilot,
												:montant_impot
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_type_bien" => $type_bien,
											":prix_bien" => $montant,
											":quartier_bien" => $localite,
											":id_proprietaire" => $id_proprietaire,
											":impot_foncier" => $num_impot,
											":id_nbre_piece" => $nbre_piece,
											":description" => $description,
											":num_ncc" => $num_ncc,
											":id_charge" => $prise_en_charge,
											":id_commission" => $commission,
											":id_commune" => $commune,
											":frais_agence" => $frais_agence,
											":loyer_proprietaire" => $loyer_final,
											":id_categorie_bien" => $categorie_bien,
											":id_charge_impot" => $charge_impot,
											":lot" => $lot,
											":Nbre_place_garage" => $nbre_place_garage,
											":nom_immeuble" => $nom_immeuble,
											":num_appartement" => $num_appartement,
											":id_user" => $V_id_user,
											":parcelle" => $parcelle,
											":apport_proprietaire" => $apport_proprietaire,
											":apport_cristal" => $apport_cristal,
											":Id_rehabilitation" => $rehabilitation,
											":ilot" => $ilot,
											":montant_impot" => $somme_impot
										));
										
										
					$stmt->closeCursor();
					
				$msgexecute	= "PROPRIETAIRE AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
					
			}else{
						
						// requête qui récupère les informations de la facture
					$requete = "SELECT
										proprietaire.id_proprietaire
										FROM
										proprietaire
										WHERE
										proprietaire.id_proprietaire='".$id_proprietaire."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$V_id_proprietaire = utf8_decode($donnees['id_proprietaire']);
					
				}
				
				$insquery = "INSERT INTO bien(id_type_bien,
													prix_bien,
													quartier_bien,
													id_proprietaire,
													impot_foncier,
													id_nbre_piece,
													description,
													num_ncc,
													id_charge,
													id_commission,
													id_commune,
													frais_agence,
													loyer_proprietaire,
													id_categorie_bien,
													id_charge_impot,
													lot,
													Nbre_place_garage,
													nom_immeuble,
													num_appartement,
													id_user,
													parcelle,
													apport_proprietaire,
													apport_cristal,
													Id_rehabilitation,
													ilot,
													montant_impot
												)							
										VALUES(:id_type_bien,
												:prix_bien,
												:quartier_bien,
												:id_proprietaire,
												:impot_foncier,
												:id_nbre_piece,
												:description,
												:num_ncc,
												:id_charge,
												:id_commission,
												:id_commune,
												:frais_agence,
												:loyer_proprietaire, 
												:id_categorie_bien,
												:id_charge_impot,
												:lot,
												:Nbre_place_garage,
												:nom_immeuble,
												:num_appartement,
												:id_user,
												:parcelle,
												:apport_proprietaire,
												:apport_cristal,
												:Id_rehabilitation,
												:ilot,
												:montant_impot
												)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_type_bien" => $type_bien,
											":prix_bien" => $montant,
											":quartier_bien" => $localite,
											":id_proprietaire" => $V_id_proprietaire,
											":impot_foncier" => $num_impot,
											":id_nbre_piece" => $nbre_piece,
											":description" => $description,
											":num_ncc" => $num_ncc,
											":id_charge" => $prise_en_charge,
											":id_commission" => $commission,
											":id_commune" => $commune,
											":frais_agence" => $frais_agence,
											":loyer_proprietaire" => $loyer_final,
											":id_categorie_bien" => $categorie_bien,
											":id_charge_impot" => $charge_impot,
											":lot" => $lot,
											":Nbre_place_garage" => $nbre_place_garage,
											":nom_immeuble" => $nom_immeuble,
											":num_appartement" => $num_appartement,
											":id_user" => $V_id_user,
											":parcelle" => $parcelle,
											":apport_proprietaire" => $apport_proprietaire,
											":apport_cristal" => $apport_cristal,
											":Id_rehabilitation" => $rehabilitation,
											":ilot" => $ilot,
											":montant_impot" => $somme_impot
										));
					$stmt->closeCursor();
				
				//INSERTION DU BIEN
										
				//$msgexecute	=$ilot;		
				$msgexecute	= "PROPRIETAIRE AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER?";
				
				
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
						
				}
				
				
			}	


			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$V_id_bien = htmlspecialchars($_POST['Vid_bien']);
					
						// requête qui récupère les informations de la facture
					$requete = "SELECT
										bien.id_bien,
										proprietaire.id_proprietaire,
										commission.id_commission
										FROM
										bien
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										WHERE
										bien.id_bien='".$V_id_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$V_id_proprietaire = utf8_decode($donnees['id_proprietaire']);
					
					
				}
				/*
				echo "{\"V_id_proprietaire\":\"$V_id_proprietaire\"
							
				}";*/
				
				
				if($id_proprietaire==''){
					
						$insquery = "UPDATE  proprietaire   SET nom_proprietaire =:nom_proprietaire,
												prenoms =:prenoms,
												contact =:contact,
												e_mail =:e_mail,
												societe =:societe,
												fonction =:fonction,
												localite =:localite,
												initial_proprietaire =:initial_proprietaire,
												montant_impot =:montant_impot,
												date_nais_proprietaire =:date_nais_proprietaire,
												lieu_nais_proprietaire =:lieu_nais_proprietaire,
												cni_proprietaire =:cni_proprietaire
												WHERE id_proprietaire =:id_proprietaire";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":nom_proprietaire" => $nom,
											":prenoms" => $prenom,
											":contact" => $telephone,
											":e_mail" => $e_mail,
											":societe" => $societe,
											":fonction" => $profession,
											":localite" => $quartier,
											":initial_proprietaire" => $initial,
											":montant_impot" => $mt_impot,
											":date_nais_proprietaire" => $datenaissance,
											":lieu_nais_proprietaire" => $lieunaissance,
											":cni_proprietaire" => $cnisejour,
											":id_proprietaire" => $V_id_proprietaire));
											
								//	$stmt->closeCursor();
							
								
					
			$insquery = "UPDATE  bien   SET 	id_type_bien =:id_type_bien,
												prix_bien =:prix_bien,
												quartier_bien =:quartier_bien,
												id_proprietaire =:id_proprietaire,
												impot_foncier =:impot_foncier,
												id_nbre_piece =:id_nbre_piece,
												description =:description,
												num_ncc =:num_ncc,
												id_charge =:id_charge,
												id_commission =:id_commission,
												id_commune =:id_commune,
												frais_agence =:frais_agence,
												loyer_proprietaire =:loyer_proprietaire,
												id_categorie_bien =:id_categorie_bien,
												id_charge_impot =:id_charge_impot,
												lot =:lot,
												Nbre_place_garage =:Nbre_place_garage,
												nom_immeuble =:nom_immeuble,
												num_appartement =:num_appartement,
												parcelle =:parcelle,
												apport_proprietaire =:apport_proprietaire,
												apport_cristal =:apport_cristal,
												Id_rehabilitation =:Id_rehabilitation,
												ilot =:ilot,
												montant_impot =:montant_impot
												
												WHERE id_bien =:id_bien";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_type_bien" => $type_bien,
											":prix_bien" => $montant,
											":quartier_bien" => $localite,
											":id_proprietaire" => $V_id_proprietaire,
											":impot_foncier" => $num_impot,
											":id_nbre_piece" => $nbre_piece,
											":description" => $description,
											":num_ncc" => $num_ncc,
											":id_charge" => $prise_en_charge,
											":id_commission" => $commission,
											":id_commune" => $commune,
											":frais_agence" => $frais_agence,
											":loyer_proprietaire" => $loyer_final,
											":id_categorie_bien" => $categorie_bien,
											":id_charge_impot" => $charge_impot,
											":lot" => $lot,
											":Nbre_place_garage" => $nbre_place_garage,
											":nom_immeuble" => $nom_immeuble,
											":num_appartement" => $num_appartement,
											":parcelle" => $parcelle,
											":apport_proprietaire" => $apport_proprietaire,
											":apport_cristal" => $apport_cristal,
											":Id_rehabilitation" => $rehabilitation,
											":ilot" => $ilot,
											":montant_impot" => $somme_impot,
											":id_bien" => $V_id_bien
											));
					
					
					
					}else{
						
							
								
					
			$insquery = "UPDATE  bien   SET 	id_type_bien =:id_type_bien,
												prix_bien =:prix_bien,
												quartier_bien =:quartier_bien,
												id_proprietaire =:id_proprietaire,
												impot_foncier =:impot_foncier,
												id_nbre_piece =:id_nbre_piece,
												description =:description,
												num_ncc =:num_ncc,
												id_charge =:id_charge,
												id_commission =:id_commission,
												id_commune =:id_commune,
												frais_agence =:frais_agence,
												loyer_proprietaire =:loyer_proprietaire,
												id_categorie_bien =:id_categorie_bien,
												id_charge_impot =:id_charge_impot,
												lot =:lot,
												Nbre_place_garage =:Nbre_place_garage,
												nom_immeuble =:nom_immeuble,
												num_appartement =:num_appartement,
												parcelle =:parcelle,
												apport_proprietaire =:apport_proprietaire,
												apport_cristal =:apport_cristal,
												Id_rehabilitation =:Id_rehabilitation,
												ilot =:ilot,
												montant_impot =:montant_impot
												
												WHERE id_bien =:id_bien";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_type_bien" => $type_bien,
											":prix_bien" => $montant,
											":quartier_bien" => $localite,
											":id_proprietaire" => $id_proprietaire,
											":impot_foncier" => $num_impot,
											":id_nbre_piece" => $nbre_piece,
											":description" => $description,
											":num_ncc" => $num_ncc,
											":id_charge" => $prise_en_charge,
											":id_commission" => $commission,
											":id_commune" => $commune,
											":frais_agence" => $frais_agence,
											":loyer_proprietaire" => $loyer_final,
											":id_categorie_bien" => $categorie_bien,
											":id_charge_impot" => $charge_impot,
											":lot" => $lot,
											":Nbre_place_garage" => $nbre_place_garage,
											":nom_immeuble" => $nom_immeuble,
											":num_appartement" => $num_appartement,
											":parcelle" => $parcelle,
											":apport_proprietaire" => $apport_proprietaire,
											":apport_cristal" => $apport_cristal,
											":Id_rehabilitation" => $rehabilitation,
											":ilot" => $ilot,
											":montant_impot" => $somme_impot,
											":id_bien" => $V_id_bien
											));
						
						
						
						}// $id_proprietaire==''
				
				
				
											
											
											
					// echo"     je suis  UPDATE matricule_collecteur ".$matricule_collecteur ;
					$stmt->closeCursor();
									//$msgexecute	= " .$Id_user.";			
					$msgexecute	= "PROPRIETAIRE MODIFIE AVEC SUCCES !";
					
					//$msgexecute	= "PROPRIETAIRE ID " . $id_proprietaire;
			$DBcon->commit();
			$DBcon = null;
				
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
			
			
			if(($_POST['action'])== "Requete_type") {
				$V_type_bien = $_POST['V_type_bien'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
									categorie_bien.id_categorie_bien,
									categorie_bien.libelle_categorie_bien,
									categorie_bien.id_type_bien
									FROM
									categorie_bien
									WHERE
									categorie_bien.id_type_bien='".$V_type_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				
				class Categorie{
					public $Id;
					public $Libelle;	
				}
				
				$categorieTab = array();
				
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
									
					$categorie = new Categorie();
					$categorie->Id = utf8_decode($donnees['id_categorie_bien']);
					$categorie->Libelle = utf8_decode($donnees['libelle_categorie_bien']);
					
					array_push($categorieTab, $categorie);
				}
				
				echo json_encode($categorieTab);
			}
			
			
			////////////////////////////////////////////////////////////////////////////////
			
			if(($_POST['action'])== "REQUETE_ok") {
				$Var_id_proprietaire = $_POST['id_proprietaire'];
				 //echo"     je suis dans la select avec matricule_collecteur ".$matricule_collecteur ;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
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
										bien.num_appartement,
										bien.parcelle,
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
										proprietaire.montant_impot,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.nom_immeuble,
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
										
										where bien.id_proprietaire='".$Var_id_proprietaire."'
								ORDER BY bien.date_enregistrement DESC";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				
				class bien{
					public $Id;
					public $nom;
						
				}
				
				$bienTab = array();
				
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
									
					$bien = new bien();
					$bien->Id = utf8_decode($donnees['id_bien']);
					$bien->nom = utf8_decode($donnees['nom_immeuble']);
					
					array_push($bienTab, $bien);
				}
				
				echo json_encode($bienTab);
			}
			
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
										bien.num_appartement,
										bien.parcelle,
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
										proprietaire.montant_impot,
										proprietaire.societe,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien,
										bien.photo1,
										bien.nom_immeuble,
										bien.Nbre_place_garage,
										bien.id_user
										
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
										
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
					$montant_impot = utf8_encode($donnees['montant_impot']);
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
					$societe = utf8_encode($donnees['societe']);
					$libelle_categorie_commune = utf8_encode($donnees['libelle_categorie_commune']);
					$id_commission = utf8_encode($donnees['id_commission']);
					$libelle_commission = utf8_encode($donnees['libelle_commission']);
					$loyer_proprietaire = utf8_encode($donnees['loyer_proprietaire']);
					$initial_proprietaire = utf8_encode($donnees['initial_proprietaire']);
					$id_charge_impot = utf8_encode($donnees['id_charge_impot']);
					$libelle_charge_impot = utf8_encode($donnees['libelle_charge_impot']);
					$frais_agence = utf8_encode($donnees['frais_agence']);
					$lot = utf8_encode($donnees['lot']);
					$ilot = utf8_encode($donnees['ilot']);
					$parcelle = utf8_encode($donnees['parcelle']);
					$num_appartement = utf8_encode($donnees['num_appartement']);
					$id_categorie_bien = utf8_encode($donnees['id_categorie_bien']);
					$libelle_categorie_bien = utf8_encode($donnees['libelle_categorie_bien']);
					$apport_proprietaire = utf8_encode($donnees['apport_proprietaire']);
					$apport_cristal = utf8_encode($donnees['apport_cristal']);
					$Id_rehabilitation = utf8_encode($donnees['Id_rehabilitation']);
					$Libele_rehabilitation = utf8_encode($donnees['Libele_rehabilitation']);
					
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
							   \"libelle_charge_impot\":\"$libelle_charge_impot\",
							   \"initial_proprietaire\":\"$initial_proprietaire\",
							   \"lot\":\"$lot\",
							   \"ilot\":\"$ilot\",
							   \"societe\":\"$societe\",
							   \"montant_impot\":\"$montant_impot\",
							    \"id_charge_impot\":\"$id_charge_impot\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							 \"num_appartement\":\"$num_appartement\",
							  \"parcelle\":\"$parcelle\",
							  \"id_categorie_bien\":\"$id_categorie_bien\",
							  \"libelle_categorie_bien\":\"$libelle_categorie_bien\",
							  \"apport_proprietaire\":\"$apport_proprietaire\",
							  \"apport_cristal\":\"$apport_cristal\",
							  \"Id_rehabilitation\":\"$Id_rehabilitation\",
							  \"Libele_rehabilitation\":\"$Libele_rehabilitation\",
							 \"libelle_type_bien\":\"$libelle_type_bien\"
							 
							}";
			}
			
			if(($_POST['action'])=="REQUETE_DETAIL_LOCATAIRE") {
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
										bien.num_appartement,
										bien.parcelle,
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
										proprietaire.montant_impot,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien,
										locataire.id_locataire,
										locataire.nom_locataire,
										locataire.prenoms_locataire,
										locataire.date_nais_locataire,
										locataire.lieu_nais_locataire,
										locataire.telephone_locataire,
										locataire.num_cni_sejour,
										locataire.fonction_locataire,
										locataire.e_maill_locataire,
										locataire.caution,
										locataire.frais_de_gestion,
										locataire.date_sortie,
										locataire.id_user,
										locataire.date_entree_locataire
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
										INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
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
					$nom_proprietaire = utf8_encode($donnees['nom_proprietaire']);
					$prenoms = utf8_encode($donnees['prenoms']);
					$contact = utf8_encode($donnees['contact']);
					$e_mail = utf8_encode($donnees['e_mail']);
					$fonction = utf8_encode($donnees['fonction']);
					$initial_proprietaire = utf8_encode($donnees['initial_proprietaire']);
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
					$num_appartement = utf8_encode($donnees['num_appartement']);
					
					$frais_de_gestion = utf8_encode($donnees['frais_de_gestion']);
					$caution = utf8_encode($donnees['caution']);
					
					$id_categorie_bien = utf8_encode($donnees['id_categorie_bien']);
					$libelle_categorie_bien = utf8_encode($donnees['libelle_categorie_bien']);
					
					$varid_user = utf8_encode($donnees['id_user']);
					$id_locataire = utf8_encode($donnees['id_locataire']);
					$nom_locataire = utf8_encode($donnees['nom_locataire']);
					$prenoms_locataire = utf8_encode($donnees['prenoms_locataire']);
					$date_nais_locataire = utf8_encode($donnees['date_nais_locataire']);
					$lieu_nais_locataire = utf8_encode($donnees['lieu_nais_locataire']);
					$telephone_locataire = utf8_encode($donnees['telephone_locataire']);
					$num_cni_sejour = utf8_encode($donnees['num_cni_sejour']);
					$fonction_locataire = utf8_encode($donnees['fonction_locataire']);
					$e_maill_locataire = utf8_encode($donnees['e_maill_locataire']);
					$date_entree_locataire = utf8_encode($donnees['date_entree_locataire']);
				
					
				}
				
			
													
													
													
											
				
				//echo "Affichage ";
					echo "{\"id_bien\":\"$id_bien\",
							\"prix_bien\":\"$prix_bien\",
							
							\"id_locataire\":\"$id_locataire\",
							\"nom_locataire\":\"$nom_locataire\",
							\"prenoms_locataire\":\"$prenoms_locataire\",
							\"date_nais_locataire\":\"$date_nais_locataire\",
							\"lieu_nais_locataire\":\"$lieu_nais_locataire\",
							\"telephone_locataire\":\"$telephone_locataire\",
							\"num_cni_sejour\":\"$num_cni_sejour\",
							\"fonction_locataire\":\"$fonction_locataire\",
							\"e_maill_locataire\":\"$e_maill_locataire\",
							\"date_entree_locataire\":\"$date_entree_locataire\",
							\"num_appartement\":\"$num_appartement\",
							\"frais_de_gestion\":\"$frais_de_gestion\",
							\"caution\":\"$caution\",
							
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
							 \"initial_proprietaire\":\"$initial_proprietaire\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							  \"id_categorie_bien\":\"$id_categorie_bien\",
							   \"libelle_categorie_bien\":\"$libelle_categorie_bien\",
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
										bien.num_appartement,
										bien.parcelle,
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
										proprietaire.montant_impot,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
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
					$nom_proprietaire = utf8_encode($donnees['nom_proprietaire']);
					$prenoms = utf8_encode($donnees['prenoms']);
					$contact = utf8_encode($donnees['contact']);
					$e_mail = utf8_encode($donnees['e_mail']);
					$fonction = utf8_encode($donnees['fonction']);
					$initial_proprietaire = utf8_encode($donnees['initial_proprietaire']);
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
					$frais_agence = utf8_encode($donnees['frais_agence']);
					$id_categorie_bien = utf8_encode($donnees['id_categorie_bien']);
					$libelle_categorie_bien = utf8_encode($donnees['libelle_categorie_bien']);
					
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
							 \"initial_proprietaire\":\"$initial_proprietaire\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							  \"id_categorie_bien\":\"$id_categorie_bien\",
							   \"libelle_categorie_bien\":\"$libelle_categorie_bien\",
							 \"libelle_type_bien\":\"$libelle_type_bien\"
							 
							}";
			}
			
			
			
			
			
			if(($_POST['action'])=="REQUETE_SORTIE") {
				$V_id_bien1 = $_POST['V_id_bien'];
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
										bien.num_appartement,
										bien.parcelle,
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
										proprietaire.montant_impot,
										proprietaire.date_nais_proprietaire,
										proprietaire.lieu_nais_proprietaire,
										proprietaire.initial_proprietaire,
										proprietaire.cni_proprietaire,
										type_bien.id_type_bien,
										type_bien.libelle_type_bien,
										charge_bien.id_charge,
										charge_bien.libelle_charge,
										bien.loyer_proprietaire,
										bien.id_categorie_bien,
										bien.id_charge_impot,
										bien.lot,
										bien.ilot,
										bien.frais_agence,
										charge_impot.id_charge_impot,
										charge_impot.libelle_charge_impot,
										categorie_bien.id_categorie_bien,
										categorie_bien.libelle_categorie_bien,
										categorie_bien.id_type_bien,
										locataire.id_locataire,
										locataire.nom_locataire,
										locataire.prenoms_locataire,
										locataire.date_nais_locataire,
										locataire.lieu_nais_locataire,
										locataire.telephone_locataire,
										locataire.num_cni_sejour,
										locataire.fonction_locataire,
										locataire.e_maill_locataire
										FROM
										bien
										INNER JOIN commission ON bien.id_commission = commission.id_commission
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
										INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
										INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
										INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
										INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien ,
										locataire
										WHERE bien.id_bien='".$V_id_bien1."' AND bien.id_locataire = locataire.id_locataire";

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
					$initial_proprietaire = utf8_encode($donnees['initial_proprietaire']);
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
					$frais_agence = utf8_encode($donnees['frais_agence']);
					$id_categorie_bien = utf8_encode($donnees['id_categorie_bien']);
					$libelle_categorie_bien = utf8_encode($donnees['libelle_categorie_bien']);
					$id_locataire = utf8_encode($donnees['id_locataire']);
					$nom_locataire = utf8_encode($donnees['nom_locataire']);
					$prenoms_locataire = utf8_encode($donnees['prenoms_locataire']);
					$date_nais_locataire = utf8_encode($donnees['date_nais_locataire']);
					$lieu_nais_locataire = utf8_encode($donnees['lieu_nais_locataire']);
					$telephone_locataire = utf8_encode($donnees['telephone_locataire']);
					$num_cni_sejour = utf8_encode($donnees['num_cni_sejour']);
					$fonction_locataire = utf8_encode($donnees['fonction_locataire']);
					$e_maill_locataire = utf8_encode($donnees['e_maill_locataire']);
					
					
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
							 \"initial_proprietaire\":\"$initial_proprietaire\",
							  \"id_commission\":\"$id_commission\",
							  \"frais_agence\":\"$frais_agence\",
							  \"loyer_proprietaire\":\"$loyer_proprietaire\",
							   \"libelle_commission\":\"$libelle_commission\",
							 \"libelle_categorie_commune\":\"$libelle_categorie_commune\",
							  \"id_categorie_bien\":\"$id_categorie_bien\",
							   \"libelle_categorie_bien\":\"$libelle_categorie_bien\",
							 \"libelle_type_bien\":\"$libelle_type_bien\",
							 \"id_locataire\":\"$id_locataire\",
							 \"nom_locataire\":\"$nom_locataire\",
							 \"prenoms_locataire\":\"$prenoms_locataire\",
							 \"date_nais_locataire\":\"$date_nais_locataire\",
							 \"lieu_nais_locataire\":\"$lieu_nais_locataire\",
							 \"telephone_locataire\":\"$telephone_locataire\",
							 \"num_cni_sejour\":\"$num_cni_sejour\",
							 \"fonction_locataire\":\"$fonction_locataire\",
							 \"e_maill_locataire\":\"$e_maill_locataire\"
							
							 
							}";
			}
			
			
			if(($_POST['action'])== "Req_charge_impot") {
				$charge_impot = $_POST['charge_impot'];
				
				
				$requete1 = "SELECT
									charge_impot.id_charge_impot,
									charge_impot.libelle_charge_impot
									FROM
									charge_impot
									WHERE
									charge_impot.id_charge_impot='".$charge_impot."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_charge_impot = utf8_decode($donnees['id_charge_impot']);
					$libelle_charge_impot = utf8_encode($donnees['libelle_charge_impot']);
					
					
				}
				
				echo "{\"id_charge_impot\":\"$id_charge_impot\",
				        \"libelle_charge_impot\":\"$libelle_charge_impot\"
				}";
				
			
			}
			
			
			
			if(($_POST['action'])== "Req_rehabilitation") {
				$rehabilitation = $_POST['rehabilitation'];
				
				//$test='1';
				
				echo "{\"rehabilitation\":\"$rehabilitation\"}";
				
			
			}
			
			
			if(($_POST['action'])== "Req_categorie_bien") {
				$categorie_bien = $_POST['categorie_bien'];
				
				
				$requete1 = "SELECT
									categorie_bien.id_categorie_bien,
									categorie_bien.libelle_categorie_bien,
									categorie_bien.id_type_bien
									FROM
									categorie_bien
									
									WHERE
									categorie_bien.id_categorie_bien='".$categorie_bien."'";

				// exécution de la requête
				$resultat1 = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat1->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_categorie_bien = utf8_decode($donnees['id_categorie_bien']);
					$libelle_categorie_bien = utf8_encode($donnees['libelle_categorie_bien']);
					
					
				}
				
				echo "{\"id_categorie_bien\":\"$id_categorie_bien\",
				        \"libelle_categorie_bien\":\"$libelle_categorie_bien\"
				}";
				
			
			}
			
			
			
			if(($_POST['action'])== "SELECTAJAX") {
				$montant = $_POST['montant'];
				$V_commission = $_POST['V_commission'];
				
				
				
				if($V_commission==6){
					
					
					$frais_agence=($montant*8)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==7){
					
					
					$frais_agence=($montant*8.2)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==8){
					
					
					$frais_agence=($montant*9)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==9){
					
					
					$frais_agence=($montant*10)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==10){
					
					
					$frais_agence=($montant*7.5)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==11){
					
					
					$frais_agence=($montant*8.5)/100;
					
					$loyer_final=$montant-$frais_agence;
					
					}else if($V_commission==12){
					
					
					$frais_agence=($montant*8.6)/100;
					
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