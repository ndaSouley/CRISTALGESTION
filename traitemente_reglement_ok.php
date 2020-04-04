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
				$penalite = htmlspecialchars($_POST['penalite']);
				$mt_verse = htmlspecialchars($_POST['mt_verse']);
				$charge = htmlspecialchars($_POST['charge']);
				$mt_total_payer = htmlspecialchars($_POST['mt_total_payer']);
				//$quartier = htmlspecialchars($_POST['quartier']);
				$Mt_restant_ok = htmlspecialchars($_POST['Mt_restant']);
				$mode_reglement = htmlspecialchars($_POST['mode_reglement']);
				$Vid_bien = htmlspecialchars($_POST['Vid_bien']);
				$date_loyer = htmlspecialchars($_POST['date_loyer']);
				
				$payer='1';
			
				// QUELQUES CALCUL MATHEMETIQUES
				
				$MT_penalite_req=$Loyer_locataire*10/100;
				
				$Restant_Mt_penalite = $mt_total_payer - $Loyer_locataire;
				
				$Restant_Mt_Travaux = $Restant_Mt_penalite - $MT_penalite_req;
				
				
				
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
					
					$requete = "SELECT
									reglement_locataire.id_reglement,
									reglement_locataire.id_locataire AS REGLEMEN_ID_LOCATAIRE,
									reglement_locataire.id_bien,
									reglement_locataire.id_proprietaire,
									reglement_locataire.Loyer_locataire,
									reglement_locataire.Mt_penalite,
									reglement_locataire.frais_penalite_agence,
									reglement_locataire.Mt_travaux,
									reglement_locataire.Mt_charge,
									reglement_locataire.Mt_verse,
									reglement_locataire.Mt_restant
									FROM
										reglement_locataire
									WHERE
										reglement_locataire.id_bien='".$Vid_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_bien_resultat = utf8_decode($donnees['id_bien']);
					$id_proprietaire_resultat = utf8_decode($donnees['id_proprietaire']);
					$id_locataire_ok = utf8_decode($donnees['REGLEMEN_ID_LOCATAIRE']);
					$Loyer_locataire_BD = utf8_decode($donnees['Loyer_locataire']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$Mt_penalite = utf8_decode($donnees['Mt_penalite']);
					$Mt_travaux_req_Bon_ok = utf8_decode($donnees['Mt_travaux']);
					$mt_charge_ok = utf8_decode($donnees['Mt_charge']);
					$frais_penalite_agence = utf8_decode($donnees['frais_penalite_agence']);
					$Mt_restant = utf8_decode($donnees['Mt_restant']);
					
					
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie=$ps->fetch();
			

			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
						// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
				
					
					// DEBUT VERIFICATION DE L'EXISTANCE DU LOCATAIRE DANS LA TABLE REGLEMENT LOYER
					
					if($Loyer_locataire_BD ==''){// DEBUT LOYER LOCATAIRE BD
						
						if($mt_verse == $mt_total_payer){
							
							if($charge =='' && $penalite ==0){
								
								
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
								
								
								
								
								}elseif($charge !='' && $penalite !=0){
									
									
									//INSERTION DU PROPRIETAIRE


		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									}elseif($charge =='' && $penalite !=0){
										
										
										//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
										
										}elseif($charge !='' && $penalite ==0){
											
											
											//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
											
											
											
											
											}// FIN $charge =='' && $penalite ==0
							
							
							
							
							}elseif($mt_verse < $mt_total_payer){
								
								
								
								if($charge =='' && $penalite ==0 && $mt_verse <= $Loyer_locataire){
								
								
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
								
								
								
								
								}elseif($charge !='' && $penalite ==0 && $mt_verse <= $Loyer_locataire){
									
									
									
									
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
									}elseif($charge !='' && $penalite !=0 && $mt_verse <= $Loyer_locataire){
										
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									$message='JE SUIS BIEN LA ';
										
										
										}elseif($charge =='' && $penalite !=0 && $mt_verse <= $Loyer_locataire){
											
											
											
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);

				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
											
											
											
											}elseif($charge !='' && $penalite ==0 && $mt_verse > $Loyer_locataire){
												
												
												// CALCULE MATHEMATIQUES 
												
												$Reste = $mt_verse - $Loyer_locataire;
												
												
												
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $Reste,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
												
												}elseif($charge !='' && $penalite !=0 && $mt_verse > $Loyer_locataire){
													
													$cal_1 = $mt_verse -$Loyer_locataire;
													//$cal_2 = $cal_1
													
													
													if($cal_1<= $charge){
														
														
															//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $cal_1,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
														
														
														}elseif($cal_1>0){
															
															
															$dif = $cal_1 - $charge;
															
															
															//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $dif,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $cal_1,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
															
															
															}
													
													
													
													
													}
								
								
								
								}elseif($mt_verse > $mt_total_payer){
									
									$Resultat_cal = $mt_verse - $mt_total_payer;
									
									
									if($charge =='' && $penalite ==0){
										
										
										
										
							//INSERTION DU PROPRIETAIRE
							
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_total_payer,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_OK=$ps->fetch();
									
									
									
															//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Resultat_cal,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
								$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_OK['id_calendrier_paie']
											));
								
					
										
										
										
										
									}elseif($charge !='' && $penalite ==0){
										
										
										$Differnce_cal = $mt_verse- $mt_total_payer;
										
										
															//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
									
									
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_OK_1=$ps->fetch();
									
									
									
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Differnce_cal,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
								$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_OK_1['id_calendrier_paie']
											));
								
										
										}elseif($charge !='' && $penalite !=0){
											
											
											$resq = $mt_verse - $mt_total_payer;
											
											
											
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_OK_1=$ps->fetch();
									
									
									
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => 0,
											":Loyer_locataire" => $resq,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
								$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_OK_1['id_calendrier_paie']
											));
											
											
											}elseif($charge =='' && $penalite !=0){
												
												$somme_1 = $mt_verse - $mt_total_payer;
												
												
												
												
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => 0,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
					if($Calendrier_paie['CALENDRIER_ID_LOCATAIRE']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													Janvier
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:Janvier
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":Janvier" => $payer
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
												
									}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
									
									
									
									
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_OK_1=$ps->fetch();
									
									
									
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => 0,
											":Loyer_locataire" => $somme_1,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								
								$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_OK_1['id_calendrier_paie']
											));
											
												
												}// FIN $charge =='' && $penalite ==0
									
									}// FIN $mt_verse == $mt_total_payer
									
									
							
							}elseif($Loyer_locataire_BD !=''){
								
								if($Mt_restant == 0){
									
									if($charge==''&& $penalite==0){
										
										
										if($mt_verse <= $mt_total_payer){
											
											//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
											
											
											
											}elseif($mt_verse > $mt_total_payer){
												
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_bon_1=$ps->fetch();
										
										
										//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse - $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								if($Calendrier_paie_bon_1['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
												
												
												
												}// Fin $mt_verse == $mt_total_payer
										
										
										
										}elseif($charge!=''&& $penalite==0){
											
											if($mt_verse == $mt_total_payer){
												
												//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
												
												
												}elseif($mt_verse > $mt_total_payer){
													
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_bon_1=$ps->fetch();
										
										
										//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse - $mt_total_payer,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								if($Calendrier_paie_bon_1['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
													
													
													
													}// Fin $mt_verse <= $mt_total_payer
											
											
											
											
											}elseif($charge!=''&& $penalite!=0){
												
												if($mt_verse <= $mt_total_payer){
													
													//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => 0,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
													
													
													}elseif($mt_verse > $mt_total_payer){
														
														//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_bon_1=$ps->fetch();
										
										
										//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse - $mt_total_payer,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								if($Calendrier_paie_bon_1['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
														
														
														}// Fin $mt_verse <= $mt_total_payer
														
												
												
												
												
												}elseif($charge==''&& $penalite!=0){
													
													if($mt_verse <= $mt_total_payer){
														
														//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
														
														
														//$message= $Mt_restant;
													
														
														}elseif($mt_verse > $mt_total_payer){
															
															
															//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
										
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
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_locataire=?

													");
													$parametre=array($REQ_id_locataire);
													$ps->execute($parametre);
													$Calendrier_paie_bon_1=$ps->fetch();
										
										
										//INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant_ok,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse - $mt_total_payer,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								if($Calendrier_paie_bon_1['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie_bon_1['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie_bon_1['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie_bon_1['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_bon_1['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
															
																//$message ='JE SUIS LA 1';
															
															
															}// Fin $mt_verse <= $mt_total_payer
													
													
													}// Fin $charge==''&& $penalite==0
									}elseif($Mt_restant != 0){
										
										// Calcul pour solder le loyer 
										
										$resultat_ok_1= $mt_verse - $Mt_restant_ok;
										$result_1= $Mt_restant - $Loyer_locataire_BD;
										$rest_1 = $Loyer_locataire - $Loyer_locataire_BD;
										$result_2 = $result_1 - $frais_penalite_agence;
										$result_3 = $result_2 - $Mt_travaux_req_Bon_ok;
										
										if($resultat_ok_1==0){
											
												
												//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
											
											if($resultat_ok_1!=0){
												
												//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
												
												
												//INSERTION DU PROPRIETAIRE
												
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_penalite+$charge,
											":Mt_penalite" => $Mt_penalite,
											":Loyer_locataire" => $resultat_ok_1,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
												
												
												
												}elseif($charge!='' && $penalite==0){
													
													//$payer='1';					
									/*$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
											*/
											//$message ='JE SUIS LA 1';
											
											}elseif($resultat_ok_1>0){
												
												
												//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
												
												
												//INSERTION DU PROPRIETAIRE
												
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_penalite+$charge,
											":Mt_penalite" => $Mt_penalite,
											":Loyer_locataire" => $resultat_ok_1,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
													
													
													
													}elseif($charge!='' && $penalite!=0){
														
														//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
											
											$message ='JE SUIS LA 1';
											
											}elseif($resultat_ok_1>0){
												
												
												//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
												
												
												//INSERTION DU PROPRIETAIRE
												
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_penalite+$charge,
											":Mt_penalite" => $Mt_penalite,
											":Loyer_locataire" => $resultat_ok_1,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
														
														
														}elseif($charge=='' && $penalite!=0){
															
															
															//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
											
											$message ='JE SUIS LA 1';
											
											}elseif($resultat_ok_1>0){
												
												
												//$payer='1';					
									$insquery = "UPDATE  reglement_locataire  SET Loyer_locataire =:Loyer_locataire,
									
																				frais_penalite_agence =:frais_penalite_agence,
																				
																				Mt_restant =:Mt_restant,
																				
																				Mt_travaux =:Mt_travaux
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Mt_restant" => 0,
											":Mt_travaux" => $charge,
											":id_reglement" => $id_reglement
											));
												
												
												//INSERTION DU PROPRIETAIRE
												
		$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_penalite+$charge,
											":Mt_penalite" => $Mt_penalite,
											":Loyer_locataire" => $resultat_ok_1,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie['Fevrier']==''){// calandrier paie si calendrier id locatair =null
												
								//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
												
									}elseif($Calendrier_paie['Mars']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Avril']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Mai']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juin']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Juillet']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										}elseif($Calendrier_paie['Aout']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Septembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}elseif($Calendrier_paie['Octobre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Novembre']==''){
										
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										
										}elseif($Calendrier_paie['Decembre']==''){
										
										//$payer='1';					
									$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										
										
										
										}// fin boucle dinsertion dans la table calandrier paie si calendrier id locatair =null
															
															
															}// Fin $charge=='' && $penalite==0
											
												
												}// Fin $resultat_ok_1==0
										
										// $resultat_ok_1 =  ($Loyer_locataire - $Loyer_locataire_BD);
										
										//$message ='JE SUIS LA 2';
										} // Fin $Mt_restant == 0
								
								
								
								}// FIN $Loyer_locataire_BD ==''
						
						
						
						//$stmt->closeCursor();	message	
					//$msgexecute	= "LOYER REGLE AVEC SUCCES !";
					
					// FIN VERIFICATION DE L'EXISTANCE DU LOCATAIRE DANS LA TABLE REGLEMENT LOYER
					
				
					//$msgexecute	=$message ;
					
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