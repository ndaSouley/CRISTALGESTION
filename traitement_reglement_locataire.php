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
				$num_cheque = htmlspecialchars($_POST['num_cheque']);
				$nom_banque = htmlspecialchars($_POST['nom_banque']);
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
				$V_id_user = htmlspecialchars($_POST['id_user']);
				
				$Mois_loyer = htmlspecialchars($_POST['mois_reglement']);
				
				$anne_regelement = htmlspecialchars($_POST['anne_regelement']);
				
				$payer='1';
			
				// QUELQUES CALCUL MATHEMETIQUES
				
				$MT_penalite_req=$Loyer_locataire*10/100;
				
				$Restant_Mt_penalite = $mt_total_payer - $Loyer_locataire;
				
				$Restant_Mt_Travaux = $Restant_Mt_penalite - $MT_penalite_req;
				
				
				//FIN DE CULCUL 
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
				$null = 0;
				//echo"11111";
				
				
				$requete = "SELECT
										bien.id_bien AS REQ_ID_BIEN,
										locataire.id_locataire AS REQ_id_locataire,
										proprietaire.id_proprietaire AS REQ_ID_PROPRIETAIRE,
										bien.prix_bien AS REQ_LOYER_PROPRIETAIRE
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
									reglement_locataire.id_mois,
									reglement_locataire.Mt_restant,
									reglement_locataire.id_annee
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
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$id_proprietaire_resultat = utf8_decode($donnees['id_proprietaire']);
					$id_locataire_ok = utf8_decode($donnees['REGLEMEN_ID_LOCATAIRE']);
					$Loyer_locataire_BD = utf8_decode($donnees['Loyer_locataire']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$V_id_annee = utf8_decode($donnees['id_annee']);
					$Mt_penalite = utf8_decode($donnees['Mt_penalite']);
					$Mt_travaux_req_Bon_ok = utf8_decode($donnees['Mt_travaux']);
					$mt_charge_ok = utf8_decode($donnees['Mt_charge']);
					$V_id_mois = utf8_decode($donnees['id_mois']);
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
													calendrier_paie.id_annee,
													calendrier_paie.Decembre
													FROM
													calendrier_paie
													WHERE
													calendrier_paie.id_bien_locataire_calendrier=?
													AND calendrier_paie.id_annee=?

													");
													$parametre=array($Vid_bien,$V_id_annee);
													$ps->execute($parametre);
													$Calendrier_paie=$ps->fetch();
			

			     //echo"je suis au dessus de l'UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
						// Insertion des données dans la TABLE quittance
				//echo"1111";
				$msg = "Erreur Insert user";
				
					if($Calendrier_paie['id_calendrier_paie']==''){
						
						$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													date_dernier_versement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge,
													id_mois,
													id_annee,
													Mt_restant_loyer,
													Id_user,
													num_cheque,
													nom_banque
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:date_dernier_versement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge,
												:id_mois,
												:id_annee,
												:Mt_restant_loyer,
												:Id_user,
												:num_cheque,
												:nom_banque
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":date_dernier_versement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant,
											":Mt_penalite" => 0,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => 0,
											":id_mois" =>$Mois_loyer,
											":id_annee" =>$anne_regelement,
											":Mt_restant_loyer" =>$Loyer_locataire,
											":Id_user" =>$V_id_user,
											":num_cheque" =>$num_cheque,
											":nom_banque" =>$nom_banque
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
						
						if($anne_regelement==1){
							
							
							 if($Mois_loyer=="01"){// calandrier paie si calendrier id locatair =null
												
								///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $payer,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								}elseif($Mois_loyer=="02"){
									
									///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $payer,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									
									}elseif($Mois_loyer=="03"){
										
										///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $payer,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="04"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $payer,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
											
											}elseif($Mois_loyer=="05"){
												///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $payer,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								
									}elseif($Mois_loyer=="06"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $payer,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="07"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $payer,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="08"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $payer,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="09"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $payer,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="10"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $payer,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="11"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $payer,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="12"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $payer
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}
							
								//$message ='je n\'esxiste pas dans la table paie';
							
							
							}elseif($anne_regelement==2){
								
								 if($Mois_loyer=="01"){// calandrier paie si calendrier id locatair =null
												
								///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $payer,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								}elseif($Mois_loyer=="02"){
									
									///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $payer,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									
									}elseif($Mois_loyer=="03"){
										
										///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $payer,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="04"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $payer,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
											
											}elseif($Mois_loyer=="05"){
												///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $payer,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								
									}elseif($Mois_loyer=="06"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $payer,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="07"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $payer,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="08"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $payer,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="09"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $payer,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="10"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $payer,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="11"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,


											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $payer,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="12"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $payer
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}
								
								//$message ='je n\'esxiste pas dans la table paie';
								
								}elseif($anne_regelement==3){
								
								 if($Mois_loyer=="01"){// calandrier paie si calendrier id locatair =null
												
								///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $payer,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								}elseif($Mois_loyer=="02"){
									
									///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $payer,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									
									}elseif($Mois_loyer=="03"){
										
										///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $payer,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="04"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $payer,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
											
											}elseif($Mois_loyer=="05"){
												///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $payer,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								
									}elseif($Mois_loyer=="06"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $payer,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="07"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $payer,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="08"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $payer,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="09"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";

					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $payer,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="10"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $payer,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="11"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $payer,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="12"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $payer
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}
								
								//$message ='je n\'esxiste pas dans la table paie';
								
								}//$Calendrier_paie['id_annee']==1
								
						
					
						
						}elseif($Calendrier_paie['id_calendrier_paie']!=''){
							
					$requete4 = "SELECT
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
									reglement_locataire.id_mois,
									reglement_locataire.Mt_restant
									FROM
										reglement_locataire
									WHERE
										reglement_locataire.id_bien='".$Vid_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete4) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_bien_resultat = utf8_decode($donnees['id_bien']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$id_proprietaire_resultat = utf8_decode($donnees['id_proprietaire']);
					$id_locataire_ok = utf8_decode($donnees['REGLEMEN_ID_LOCATAIRE']);
					$Loyer_locataire_BD = utf8_decode($donnees['Loyer_locataire']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$Mt_penalite = utf8_decode($donnees['Mt_penalite']);
					$Mt_travaux_req_Bon_ok = utf8_decode($donnees['Mt_travaux']);
					$mt_charge_ok = utf8_decode($donnees['Mt_charge']);
					$V_id_mois = utf8_decode($donnees['id_mois']);
					$frais_penalite_agence = utf8_decode($donnees['frais_penalite_agence']);
					$Mt_restant = utf8_decode($donnees['Mt_restant']);
				}
							
							
							if($mt_verse==$mt_total_payer){
								
									if($Loyer_locataire_BD==$REQ_LOYER_PROPRIETAIRE){
										
				$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													date_dernier_versement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge,
													id_mois,
													id_annee,
													Mt_restant_loyer,
													Id_user,
													Num_cheque,
													nom_banque
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:date_dernier_versement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge,
												:id_mois,
												:id_annee,
												:Mt_restant_loyer,
												:Id_user,
												:Num_cheque,
												:nom_banque
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":date_dernier_versement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $penalite,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $charge,
											":Mt_charge" => $charge,
											":id_mois" =>$Mois_loyer,
											":id_annee" =>$anne_regelement,
											":Mt_restant_loyer" =>$Loyer_locataire,
											":Id_user" =>$V_id_user,
											":Num_cheque" =>$num_cheque,
											":nom_banque" =>$nom_banque
											
										));
										
										if($Calendrier_paie['id_annee']==$anne_regelement){
											
											
											if($Mois_loyer=="01"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier,
										  											 id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="02"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="03"){
										  
										  
												
												 $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="04"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												 $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  
										  }elseif($Mois_loyer=="05"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="06"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												
												$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  }elseif($Mois_loyer=="07"){
										  
										   ///$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="08"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="09"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="10"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="11"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  }elseif($Mois_loyer=="12"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie['id_calendrier_paie']
											));
										  
										  
										  }// calandrier paie si calendrier id locatair =null
											
											}elseif($Calendrier_paie['id_annee']!=$anne_regelement){
												
												
												if($Mois_loyer=="01"){// calandrier paie si calendrier id locatair =null
												
								///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $payer,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								}elseif($Mois_loyer=="02"){
									
									///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $payer,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
									
									
									}elseif($Mois_loyer=="03"){
										
										///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $payer,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="04"){
											
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $payer,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
											
											}elseif($Mois_loyer=="05"){
												///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $payer,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
								
									}elseif($Mois_loyer=="06"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $payer,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="07"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $payer,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="08"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $payer,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								
								
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="09"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $payer,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="10"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $payer,
											":Novembre" => $null,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="11"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $payer,
											":Decembre" => $null
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}elseif($Mois_loyer=="12"){
											///INSERTION DU PROPRIETAIRE
		$insquery = "INSERT INTO calendrier_paie(id_locataire,
													id_bien_locataire_calendrier,
													id_annee,
													Janvier,
													Fevrier,
													Mars,
													Avril,
													Mai,
													Juin,
													Juillet,
													Aout,
													Septembre,
													Octobre,
													Novembre,
													Decembre
												)							
										VALUES(:id_locataire,
												:id_bien_locataire_calendrier,
												:id_annee,
													:Janvier,
													:Fevrier,
													:Mars,
													:Avril,
													:Mai,
													:Juin,
													:Juillet,
													:Aout,
													:Septembre,
													:Octobre,
													:Novembre,
													:Decembre
												
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_bien_locataire_calendrier" => $REQ_ID_BIEN,
											":id_annee" => $anne_regelement,
											":Janvier" => $null,
											":Fevrier" => $null,
											":Mars" => $null,
											":Avril" => $null,
											":Mai" => $null,
											":Juin" => $null,
											":Juillet" => $null,
											":Aout" => $null,
											":Septembre" => $null,
											":Octobre" => $null,
											":Novembre" => $null,
											":Decembre" => $payer
											
										));
								$id_calendrier_reglement_locataire = $DBcon->lastInsertId();
										
										
										}
												
												
												
												}// $Calendrier_paie['id_annee']==$anne_regelement
								
								$id_reglement_locataire = $DBcon->lastInsertId();

										
										$message ='Nouvelle insertion';
										
										
											
											}// $Loyer_locataire_BD==$REQ_LOYER_PROPRIETAIRE
								
								$message ='vous avez soldé';
								
								}elseif($mt_verse<$mt_total_payer){
									// CALCUL COMPTABLE 
									
									
									//$message=$Loyer_locataire_BD;
																	
									if($Loyer_locataire_BD!=$REQ_LOYER_PROPRIETAIRE ){
										
										$rest= $Mt_penalite- $frais_penalite_agence;
										
										// CALCUL 1
										
										if($mt_verse<=$rest){
											
												
									$insquery = "UPDATE  reglement_locataire  SET frais_penalite_agence =:frais_penalite_agence
												
												WHERE id_reglement =:id_reglement";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":frais_penalite_agence" => $mt_verse+$frais_penalite_agence,


											
											":id_reglement" => $id_reglement
											));
											
											
										  
											//$message="Votre pénalité a été réglé avec succès";
											
											}elseif($mt_verse>$rest){
												
												$rest1= $Mt_penalite- $frais_penalite_agence;
												$rest_penealite=$mt_verse-$rest1;
												
												$dif_charge=$mt_charge_ok-$Mt_travaux_req_Bon_ok;
												$rest_verse=$rest_penealite-$dif_charge;
												if($rest_verse<=0){
													
													
												$insquery = "UPDATE  reglement_locataire  SET frais_penalite_agence =:frais_penalite_agence,
																								Mt_travaux =:Mt_travaux
												
																			WHERE id_reglement =:id_reglement";
												
												$stmt = $DBcon->prepare($insquery);
												$stmt->execute(array(":frais_penalite_agence" => $rest+$frais_penalite_agence,
																		":Mt_travaux" => $dif_charge+$Mt_travaux_req_Bon_ok,
																		
																		":id_reglement" => $id_reglement
																		));
											
											
										  
													}elseif($rest_verse>0){
														
												$rest2= $Mt_penalite- $frais_penalite_agence;
												$rest_penealite1=$mt_verse-$rest2;
												
												$dif_charge=$mt_charge_ok-$Mt_travaux_req_Bon_ok;
												$rest_verse2=$rest_penealite1-$dif_charge;
												$rest_loyer=$REQ_LOYER_PROPRIETAIRE-$Loyer_locataire_BD;
												$rest_cal=$rest_verse2-$rest_loyer;
													
													$message=$rest_cal;
												
												if($rest_cal==0){
													
												
													
													$insquery = "UPDATE  reglement_locataire  SET frais_penalite_agence =:frais_penalite_agence,
																								Mt_travaux =:Mt_travaux,
																								date_dernier_versement=:date_dernier_versement,
																								mt_verse_2=:mt_verse_2,
																								Mt_restant_loyer=:Mt_restant_loyer,
																								Loyer_locataire=:Loyer_locataire
												
																			WHERE id_reglement =:id_reglement";
												
												$stmt = $DBcon->prepare($insquery);
												$stmt->execute(array(":frais_penalite_agence" => $rest2+$frais_penalite_agence,
																		":Mt_travaux" => $dif_charge+$Mt_travaux_req_Bon_ok,
																		":date_dernier_versement" => $date_loyer,
																		":Loyer_locataire" => $rest_loyer+$Loyer_locataire_BD,
																		":mt_verse_2" => $mt_verse,
																		":Mt_restant_loyer" => $rest_loyer,
																		":id_reglement" => $id_reglement
																		));
																		
																		
							if($Calendrier_paie['id_annee']==$anne_regelement){
															
									$ps_4=$DBcon->prepare("SELECT
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
													AND calendrier_paie.id_annee=?

													");
													$parametre=array($Vid_bien,$V_id_annee);
													$ps_4->execute($parametre);
													$Calendrier_paie5=$ps_4->fetch();
											
											
											if($V_id_mois=="01"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier,
										  											 id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="02"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="03"){
										  
										  
												
												 $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="04"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												 $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  
										  }elseif($V_id_mois=="05"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												$insquery = "UPDATE  calendrier_paie  SET Mai =:Mai,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="06"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												
												$insquery = "UPDATE  calendrier_paie  SET Juin =:Juin,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  }elseif($V_id_mois=="07"){
										  
										   ///$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												$insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="08"){
										  
										   //$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												$insquery = "UPDATE  calendrier_paie  SET Aout =:Aout,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="09"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												$insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="10"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												$insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }elseif($V_id_mois=="11"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												$insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  }elseif($V_id_mois=="12"){
										  
										  // $insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												$insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre,
										   												id_annee =:id_annee
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_annee" => $anne_regelement,
											":id_calendrier_paie" => $Calendrier_paie5['id_calendrier_paie']
											));
										  
										  
										  }// calandrier paie si calendrier id locatair =null
											
											}// $Calendrier_paie['id_annee']==$anne_regelement
											
																		
												$message="Votre pénalité a été réglé avec succès";
													
													
													}// $rest_cal==0
														
														
														}//$rest_penealite<=$Mt_travaux_req_Bon_ok
												}// $mt_verse<=$rest
									
											
											
											//$message ='Locataire loyer, pénalité et charge pas à jour';
											
											}elseif($Loyer_locataire_BD == $REQ_LOYER_PROPRIETAIRE ){
												
												
					$requete1 = "SELECT
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
									reglement_locataire.id_mois,
									reglement_locataire.Mt_restant,
									reglement_locataire.id_annee
									FROM
										reglement_locataire
									WHERE
										reglement_locataire.id_bien='".$Vid_bien."'";
						

				// exécution de la requête
				$resultat = $DBcon->query($requete1) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_bien_resultat = utf8_decode($donnees['id_bien']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$id_proprietaire_resultat = utf8_decode($donnees['id_proprietaire']);
					$id_locataire_ok = utf8_decode($donnees['REGLEMEN_ID_LOCATAIRE']);
					$Loyer_locataire_BD = utf8_decode($donnees['Loyer_locataire']);
					$id_reglement = utf8_decode($donnees['id_reglement']);
					$Var_id_annee = utf8_decode($donnees['id_annee']);
					$Mt_penalite = utf8_decode($donnees['Mt_penalite']);
					$Mt_travaux_req_Bon_ok = utf8_decode($donnees['Mt_travaux']);
					$mt_charge_ok = utf8_decode($donnees['Mt_charge']);
					$V_id_mois = utf8_decode($donnees['id_mois']);
					$frais_penalite_agence = utf8_decode($donnees['frais_penalite_agence']);
					$Mt_restant = utf8_decode($donnees['Mt_restant']);
					
					
				}
												
												
												$ps4=$DBcon->prepare("SELECT
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
													AND calendrier_paie.id_annee=?

													");
													$parametre=array($Vid_bien,$Var_id_annee);
													$ps4->execute($parametre);
													$Calendrier_paie_02=$ps4->fetch();
													
													$cal=$mt_verse-$Loyer_locataire;
												if($cal<=0){
													
													if($charge==''){
														$charge_1=0;
														
														}elseif($charge!=''){
															$charge_1=$charge;
															
															}
													
				$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													date_dernier_versement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge,
													id_mois,
													id_annee,
													Mt_restant_loyer,
													Id_user,
													num_cheque,
													nom_banque
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:date_dernier_versement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge,
												:id_mois,
												:id_annee,
												:Mt_restant_loyer,
												:Id_user,
												:num_cheque,
												:nom_banque
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":date_dernier_versement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $mt_verse,
											":frais_penalite_agence" => 0,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge_1,
											":id_mois" =>$Mois_loyer,
											":id_annee" =>$anne_regelement,
											":Mt_restant_loyer" =>$mt_verse,
											":Id_user" =>$V_id_user,
											":num_cheque" =>$num_cheque,
											":nom_banque" =>$nom_banque
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie_02['CALENDRIER_ID_LOCATAIRE']!=''){
									
									if($Calendrier_paie_02['id_annee']==$anne_regelement)
									
									{
										
										if($Mois_loyer=="01"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="02"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="03"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="04"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="05"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="06"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="07"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="08"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="09"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="10"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="11"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="12"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $mt_verse,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }// calandrier paie si calendrier id locatair =null
										
										}//$Calendrier_paie_02['id_annee']==$anne_regelement
									 
									
									  
										  
								}// $Calendrier_paie['CALENDRIER_ID_LOCATAIRE']!=''
													
													}elseif($cal<0){
														
														$cal_1=$cal-$penalite;
														
														if($cal_1<=0){
															
															
																if($charge==''){
																	
														$charge_1=0;
														
														}elseif($charge!=''){
															
															$charge_1=$charge;
															
															}
													
				$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													date_dernier_versement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge,
													id_mois,
													id_annee,
													Mt_restant_loyer,
													Id_user,
													num_cheque,
													nom_banque
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:date_dernier_versement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge,
												:id_mois,
												:id_annee,
												:Mt_restant_loyer,
												:Id_user,
												:Num_cheque,
												:nom_banque
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":date_dernier_versement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $cal_1,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => 0,
											":Mt_charge" => $charge_1,
											":id_mois" =>$Mois_loyer,
											":id_annee" =>$anne_regelement,
											":Mt_restant_loyer" =>$Loyer_locataire,
											":Id_user" =>$V_id_user,
											":Num_cheque" =>$num_cheque,
											":nom_banque" =>$nom_banque
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie_02['CALENDRIER_ID_LOCATAIRE']!=''){
									 
									
									  if($Mois_loyer=="01"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="02"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="03"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="04"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="05"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="06"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="07"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="08"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="09"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="10"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="11"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="12"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }// calandrier paie si calendrier id locatair =null
										  
								}// $Calendrier_paie['CALENDRIER_ID_LOCATAIRE']!=''
															}elseif($cal_1>0){
																
																$cal_2=$cal_1-$charge;
																
																if($cal_2<=0){
																	
																	if($charge==''){
																	
														$charge_1=0;
														
														}elseif($charge!=''){
															
															$charge_1=$charge;
															
															}
													
				$insquery = "INSERT INTO reglement_locataire(id_locataire,
													id_proprietaire,
													id_bien,
													date_reglement,
													date_dernier_versement,
													Mt_verse,
													Mt_restant,
													Mt_penalite,
													Loyer_locataire,
													frais_penalite_agence,
													Id_mode_paiement,
													Mt_travaux,
													Mt_charge,
													id_mois,
													id_annee,
													Mt_restant_loyer,
													Id_user,
													num_cheque,
													nom_banque
													
												)							
										VALUES(:id_locataire,
												:id_proprietaire,
												:id_bien,
												:date_reglement,
												:date_dernier_versement,
												:Mt_verse,
												:Mt_restant,
												:Mt_penalite,
												:Loyer_locataire,
												:frais_penalite_agence,
												:Id_mode_paiement,
												:Mt_travaux,
												:Mt_charge,
												:id_mois,
												:id_annee,
												:Mt_restant_loyer,
												:Id_user,
												:num_cheque,
												:nom_banque
												)";
					$stmt = $DBcon->prepare($insquery);
				
					$stmt->execute(array(":id_locataire" => $REQ_id_locataire,
											":id_proprietaire" => $REQ_ID_PROPRIETAIRE,
											":id_bien" => $REQ_ID_BIEN,
											":date_reglement" => $date_loyer,
											":date_dernier_versement" => $date_loyer,
											":Mt_verse" => $mt_verse,
											":Mt_restant" => $Mt_restant,
											":Mt_penalite" => $penalite,
											":Loyer_locataire" => $Loyer_locataire,
											":frais_penalite_agence" => $cal_1,
											":Id_mode_paiement" => $mode_reglement,
											":Mt_travaux" => $cal_2,
											":Mt_charge" => $charge_1,
											":id_mois" =>$Mois_loyer,
											":id_annee" =>$anne_regelement,
											":Mt_restant_loyer" =>$Loyer_locataire,
											":Id_user" =>$V_id_user,
											":num_cheque" =>$num_cheque,
											":nom_banque" =>$nom_banque
											
										));
								
								$id_reglement_locataire = $DBcon->lastInsertId();
								
								
								if($Calendrier_paie_02['CALENDRIER_ID_LOCATAIRE']!=''){
									 
									
									  if($Mois_loyer=="01"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Janvier =:Janvier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Janvier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="02"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Fevrier =:Fevrier
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Fevrier" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="03"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mars =:Mars
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mars" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="04"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Avril =:Avril
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Avril" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="05"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Mai =:Mai
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Mai" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="06"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juin =:Juin
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juin" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="07"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Juillet =:Juillet
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Juillet" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="08"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Aout =:Aout
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Aout" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="09"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Septembre =:Septembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Septembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="10"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Octobre =:Octobre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Octobre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="11"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Novembre =:Novembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Novembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }elseif($Mois_loyer=="12"){
										  
										   $insquery = "UPDATE  calendrier_paie  SET Decembre =:Decembre
												
												WHERE id_calendrier_paie =:id_calendrier_paie";
												
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":Decembre" => $payer,
											":id_calendrier_paie" => $Calendrier_paie_02['id_calendrier_paie']
											));
										  
										  
										  }// calandrier paie si calendrier id locatair =null
										  
								}// $Calendrier_paie['CALENDRIER_ID_LOCATAIRE']!=''
																	}
																
																}// $cal_1<=0
														
														
														}//$cal<=0
							
								
												
											}// $Loyer_locataire_BD==$REQ_LOYER_PROPRIETAIRE && $Mt_penalite==$frais_penalite_agence && $mt_charge_ok==$Mt_travaux_req_Bon_ok
									
									
									
									}// $mt_verse==$mt_total_payer
							
							//$message =$REQ_LOYER_PROPRIETAIRE;
							
							
							//$message ='j\'esxiste pas dans la table paie';
							
							}//$Calendrier_paie['id_calendrier_paie']==""
					
					
							
						$msgexecute1=$mt_verse;		
				
					$ble=$mt_total_payer ;
					
			$DBcon->commit();
			$DBcon = null;
				
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",
					\"Motif\":\"$ble\",
						\"Motif_1\":\"$msgexecute1\"}";
						/*echo "{\"Etat\":\"SUCCES\",
					\"Motif\":\"$msgexecute1\",
						}";*/
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
				
				$annee =3;
				//if($annee==20){
					
					//$annee_1=3;
					
					//}
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
											calendrier_paie.Decembre,
											calendrier_paie.id_annee
											FROM
											calendrier_paie
										WHERE
											calendrier_paie.id_bien_locataire_calendrier=? AND calendrier_paie.id_annee=?
											
													");
													$parametre=array($V_id_bien,$annee);
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
													$id_annee=$DATA_Calendrier_paie['id_annee'];
													
				
				
				
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
							\"id_annee\":\"$id_annee\",
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