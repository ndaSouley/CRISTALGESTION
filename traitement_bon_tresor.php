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
	 session_start();
	  $id_user=$_SESSION['id_user'] ;
	
		$agent_receptionnaire = htmlspecialchars($_POST['agent_receptionnaire']);
		$numbc = htmlspecialchars($_POST['numbc']);
		$datebc = htmlspecialchars($_POST['datebc']);
		$numbl = htmlspecialchars($_POST['numbl']);
		$datebl = htmlspecialchars($_POST['datebl']);
		$qtecde = htmlspecialchars($_POST['qtecde']);
		$valunitliv = htmlspecialchars($_POST['valunitliv']);
		$valunitcde = htmlspecialchars($_POST['valunitcde']);
		$plagedebut = htmlspecialchars($_POST['plagedebut']);
		$plagefin = htmlspecialchars($_POST['plagefin']);
		$qtelivre = htmlspecialchars($_POST['qtelivre']);
		$date_enreg = date('Y-m-d H:i:s');
		$annee = date('Y');
				
			 if(($_POST['action'])== "CREELIGNE") {
				// Insertion des données dans la TABLE regie temporaire
				$insquery = "INSERT INTO temp_bon_tresor(agent_receptionnaire,
													id_user,
													num_bon_commande,
													num_bon_livraison,
													valeur_unitaire_commande,
													plage_debut_sticker,
													plage_fin_sticker,
													total_qte_commande,
													valeur_unitaire_livraison,
													total_qte_livraison,
													date_bon_commande,
													date_bon_livraison,
													date_operation)							
											VALUES(:agent_receptionnaire,
													:id_user,
													:num_bon_commande,
													:num_bon_livraison,
													:valeur_unitaire_commande,
													:plage_debut_sticker,
													:plage_fin_sticker,
													:total_qte_commande,
													:valeur_unitaire_livraison,
													:total_qte_livraison,
													:date_bon_commande,
													:date_bon_livraison,
													:date_operation
													)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":agent_receptionnaire" => $agent_receptionnaire,
											":id_user" => $id_user,
											":num_bon_commande" => $numbc,
											":num_bon_livraison" => $numbl,
											":valeur_unitaire_commande" => $valunitcde,
											":plage_debut_sticker" => $plagedebut,
											":plage_fin_sticker" => $plagefin,
											":total_qte_commande" => $qtecde,
											":valeur_unitaire_livraison" => $valunitliv,
											":total_qte_livraison" => $plagefin-$plagedebut+1,
											":date_bon_commande" => $datebc,
											":date_bon_livraison" => $datebl,
											":date_operation" => $date_enreg
										));
										
									
						$stmt->closeCursor();				
				$msgexecute	= "LIGNE CREEE AVEC SUCCES !";
				
			$DBcon->commit();
			
			echo "{\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$id_user\"}";
			exit();
			
			}	
			   
			   
			   	 if(($_POST['action'])== "INSERT") {
				  $requete = "SELECT
								temp_bon_tresor.id_bon_tresor,
								temp_bon_tresor.id_user,
								temp_bon_tresor.num_bon_commande,
								temp_bon_tresor.num_bon_livraison,
								temp_bon_tresor.agent_receptionnaire,
								temp_bon_tresor.valeur_unitaire_commande,
								temp_bon_tresor.plage_debut_sticker,
								temp_bon_tresor.plage_fin_sticker,
								temp_bon_tresor.total_qte_commande,
								temp_bon_tresor.valeur_unitaire_livraison,
								temp_bon_tresor.total_qte_livraison,
								temp_bon_tresor.date_bon_commande,
								temp_bon_tresor.date_bon_livraison,
								temp_bon_tresor.date_operation
								FROM
								temp_bon_tresor
								WHERE temp_bon_tresor.id_user='".$id_user."'";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_bon_tresor = utf8_decode($donnees['id_bon_tresor']);
					$id_user = utf8_decode($donnees['id_user']);
					$num_bon_commande = utf8_decode($donnees['num_bon_commande']);
					$num_bon_livraison = utf8_decode($donnees['num_bon_livraison']);
					$agent_receptionnaire = utf8_decode($donnees['agent_receptionnaire']);
					$valeur_unitaire_commande = utf8_decode($donnees['valeur_unitaire_commande']);
					$plage_debut_sticker = utf8_decode($donnees['plage_debut_sticker']);
					$plage_fin_sticker = utf8_decode($donnees['plage_fin_sticker']);
					$valeur_unitaire_livree = utf8_decode($donnees['valeur_unitaire_livree']);
					$total_qte_commande = utf8_decode($donnees['total_qte_commande']);
					$valeur_unitaire_livraison = utf8_decode($donnees['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_decode($donnees['total_qte_livraison']);
					$date_bon_commande = utf8_decode($donnees['date_bon_commande']);
					$date_bon_livraison = utf8_decode($donnees['date_bon_livraison']);
					$date_operation = utf8_decode($donnees['date_operation']);								
				
				// Insertion des données dans la TABLE regie
				$insquery = "INSERT INTO bon_tresor(id_bon_tresor,
				                                    num_bon_commande,
													num_bon_livraison,
													agent_receptionnaire,
													valeur_unitaire_commande,
													plage_debut_sticker,
													plage_fin_sticker,
													total_qte_commande,
													valeur_unitaire_livraison,
													total_qte_livraison,
													date_bon_commande,
													date_bon_livraison,
													date_operation,
													id_user)
											VALUES(:id_bon_tresor,
											        :num_bon_commande,
													:num_bon_livraison,
													:agent_receptionnaire,
													:valeur_unitaire_commande,
													:plage_debut_sticker,
													:plage_fin_sticker,
													:total_qte_commande,
													:valeur_unitaire_livraison,
													:total_qte_livraison,
													:date_bon_commande,
													:date_bon_livraison,
													:date_operation,
													:id_user)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array( ":id_bon_tresor" => $id_bon_tresor,
					                         ":num_bon_commande" => $num_bon_commande,
											":num_bon_livraison" => $num_bon_livraison,
											":agent_receptionnaire" => $agent_receptionnaire,
											":valeur_unitaire_commande" => $valeur_unitaire_commande,
											":plage_debut_sticker" => $plage_debut_sticker,
											":plage_fin_sticker" => $plage_fin_sticker,
											":total_qte_commande" => $total_qte_commande,
											":valeur_unitaire_livraison" => $valeur_unitaire_livraison,
											":total_qte_livraison" => $total_qte_livraison,
											":date_bon_commande" => $date_bon_commande,
											":date_bon_livraison" => $date_bon_livraison,
											":date_operation" => $date_enreg,
											":id_user" => $id_user
										));
										
									
					$insquery = "DELETE FROM temp_bon_tresor 
											WHERE temp_bon_tresor.id_user='".$id_user."'";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":id_bon_tresor" => $id_bon_tresor,
					                        ":num_bon_commande" => $num_bon_commande,
											":num_bon_livraison" => $num_bon_livraison,
											":agent_receptionnaire" => $agent_receptionnaire,
											":valeur_unitaire_commande" => $valeur_unitaire_commande,
											":plage_debut_sticker" => $v_plage_debut,
											":plage_fin_sticker" => $plage_fin_sticker,
											":total_qte_commande" => $total_qte_commande,
											":valeur_unitaire_livraison" => $valeur_unitaire_livraison,
											":total_qte_livraison" => $total_qte_livraison,
											":date_bon_commande" => $date_bon_commande,
											":date_bon_livraison" => $date_bon_livraison,
											":date_operation" => $date_enreg,
											":id_user" => $v_id_user
										));
								}											
						$stmt->closeCursor();				
				$msgexecute	= "BON LIVRAISON TRESOR AJOUTER AVEC SUCCES !";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			//echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			echo "{\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$iduser\"}";
			exit();
			
			}	
			
			
			//DEBUT  TRAITEMENT DE SELECTION 
			
						//Seppression d'une ligne de la table temporaire
			if(($_POST['action'])== "SELECT") {
			$id_tempo2 = htmlspecialchars($_POST['id_tempo2']);
			  	//echo"matricule".$V_id_tempo1 ;
				$select = "SELECT
								temp_bon_tresor.id_bon_tresor,
								temp_bon_tresor.id_user,
								temp_bon_tresor.num_bon_commande,
								temp_bon_tresor.num_bon_livraison,
								temp_bon_tresor.agent_receptionnaire,
								temp_bon_tresor.valeur_unitaire_commande,
								temp_bon_tresor.plage_debut_sticker,
								temp_bon_tresor.plage_fin_sticker,
								temp_bon_tresor.total_qte_commande,
								temp_bon_tresor.valeur_unitaire_livraison,
								temp_bon_tresor.total_qte_livraison,
								temp_bon_tresor.date_bon_commande,
								temp_bon_tresor.date_bon_livraison,
								temp_bon_tresor.date_operation
								FROM
								temp_bon_tresor
								WHERE
								temp_bon_tresor.id_bon_tresor='".$id_tempo2."'";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_bon_tresor = utf8_decode($donnees['id_bon_tresor']);
					$id_user = utf8_decode($donnees['id_user']);
					$num_bon_commande = utf8_decode($donnees['num_bon_commande']);
					$num_bon_livraison = utf8_decode($donnees['num_bon_livraison']);
					$agent_receptionnaire = utf8_decode($donnees['agent_receptionnaire']);
					$valeur_unitaire_commande = utf8_decode($donnees['valeur_unitaire_commande']);
					$plage_debut_sticker = utf8_decode($donnees['plage_debut_sticker']);
					$plage_fin_sticker = utf8_decode($donnees['plage_fin_sticker']);
					$valeur_unitaire_livree = utf8_decode($donnees['valeur_unitaire_livree']);
					$total_qte_commande = utf8_decode($donnees['total_qte_commande']);
					$valeur_unitaire_livraison = utf8_decode($donnees['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_decode($donnees['total_qte_livraison']);
					$date_bon_commande = utf8_decode($donnees['date_bon_commande']);
					$date_bon_livraison = utf8_decode($donnees['date_bon_livraison']);
					$date_operation = utf8_decode($donnees['date_operation']);
				}	
					echo "{\"id_bon_tresor\":\"$id_bon_tresor\",
							\"id_user\":\"$id_user\",
							\"num_bon_commande\":\"$num_bon_commande\",
							\"num_bon_livraison\":\"$num_bon_livraison\",
							\"agent_receptionnaire\":\"$agent_receptionnaire\",
							\"valeur_unitaire_commande\":\"$valeur_unitaire_commande\",
							\"plage_debut_sticker\":\"$plage_debut_sticker\",
							\"plage_fin_sticker\":\"$plage_fin_sticker\",
							\"valeur_unitaire_livree\":\"$valeur_unitaire_livree\",
							\"total_qte_commande\":\"$total_qte_commande\",
							\"valeur_unitaire_livraison\":\"$valeur_unitaire_livraison\",
							\"total_qte_livraison\":\"$total_qte_livraison\",
							\"date_bon_commande\":\"$date_bon_commande\",
							\"date_bon_livraison\":\"$date_bon_livraison\",
                            \"date_operation\":\"$date_operation\"}";
									
					
					$stmt->closeCursor();				
			}
			
			//FIN TRAITEMENT DE SELECTION
			
			
			
			
			
							//Seppression d'une ligne de la table temporaire
			if(($_POST['action'])== "SELECTALL") {
			$id_tempo2 = htmlspecialchars($_POST['id_tempo2']);
			  	//echo"matricule".$V_id_tempo1 ;
				$select = "SELECT
								bon_tresor.id_bon_tresor,
								bon_tresor.num_bon_livraison,
								bon_tresor.num_bon_commande,
								bon_tresor.agent_receptionnaire,
								bon_tresor.valeur_unitaire_commande,
								bon_tresor.plage_debut_sticker,
								bon_tresor.plage_fin_sticker,
								bon_tresor.total_qte_commande,
								bon_tresor.valeur_unitaire_livraison,
								bon_tresor.total_qte_livraison,
								bon_tresor.date_bon_commande,
								bon_tresor.date_bon_livraison,
								bon_tresor.date_operation,
								bon_tresor.id_user
								FROM
								bon_tresor
								WHERE bon_tresor.id_user='".$id_tempo2."'";
			$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_bon_tresor = utf8_decode($donnees['id_bon_tresor']);
					$id_user = utf8_decode($donnees['id_user']);
					$num_bon_livraison = utf8_decode($donnees['num_bon_livraison']);
					$num_bon_commande = utf8_decode($donnees['num_bon_commande']);
					$agent_receptionnaire = utf8_decode($donnees['agent_receptionnaire']);
					$valeur_unitaire_commande = utf8_decode($donnees['valeur_unitaire_commande']);
					$plage_debut_sticker = utf8_decode($donnees['plage_debut_sticker']);
					$plage_fin_sticker = utf8_decode($donnees['plage_fin_sticker']);
					$total_qte_commande = utf8_decode($donnees['total_qte_commande']);
					$total_qte_commande = utf8_decode($donnees['total_qte_commande']);
					$valeur_unitaire_livraison = utf8_decode($donnees['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_decode($donnees['total_qte_livraison']);
					$date_bon_commande = utf8_decode($donnees['date_bon_commande']);
					$date_bon_livraison = utf8_decode($donnees['date_bon_livraison']);
					$date_operation = utf8_decode($donnees['date_operation']);
				}	
					echo "{\"id_bon_tresor\":\"$id_bon_tresor\",
							\"id_user\":\"$id_user\",
							\"num_bon_commande\":\"$num_bon_commande\",
							\"num_bon_livraison\":\"$num_bon_livraison\",
							\"agent_receptionnaire\":\"$agent_receptionnaire\",
							\"valeur_unitaire_commande\":\"$valeur_unitaire_commande\",
							\"plage_debut_sticker\":\"$plage_debut_sticker\",
							\"plage_fin_sticker\":\"$plage_fin_sticker\",
							\"valeur_unitaire_livree\":\"$valeur_unitaire_livree\",
							\"total_qte_commande\":\"$total_qte_commande\",
							\"valeur_unitaire_livraison\":\"$valeur_unitaire_livraison\",
							\"total_qte_livraison\":\"$total_qte_livraison\",
							\"date_bon_commande\":\"$date_bon_commande\",
							\"date_bon_livraison\":\"$date_bon_livraison\",
                            \"date_operation\":\"$date_operation\"}";
					
					$stmt->closeCursor();				
			}
			
					//Seppression d'une ligne de la table temporaire
			if(($_POST['action'])== "SUPPRESSION") {
			$V_id_tempo = htmlspecialchars($_POST['id_tempo']);
			  	//echo"matricule".$V_id_tempo ;
				$insquery = "DELETE FROM temp_bon_tresor
							WHERE temp_bon_tresor.id_bon_tresor='".$V_id_tempo."'";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":regie" => $regie,
											":date_cde" => $datebc,
											":num_bc" => $numbc,
											":num_bl" => $numbl,
											":date_bl" => $datebl,
											":valeur_unitaire_cde" => $valunitcde,
											":qte_cde" => $qtecde,
											":valeur_unitaire_livree" => $valunitliv,
											":plage_debut" => $plagedebut,
											":plage_fin" => $plagefin,
											":qte_livree" => $plagefin-$plagedebut+1,
											":id_user" => $iduser
										));
						$stmt->closeCursor();	
						
						$DBcon->commit();
			            $DBcon = null;
			
						echo "{\"Id_temp\":\"$V_id_tempo\"}";		
							
			}
			
			// SCRIPT DE MISE A JOUR
		
			 if(($_POST['action'])== "UPDATE") {
			 $num_tempo = htmlspecialchars($_POST['num_tempo']);
				$insquery = "UPDATE temp_bon_tresor SET agent_receptionnaire=:agent_receptionnaire,
													id_user=:id_user,
													num_bon_commande=:num_bon_commande,
													num_bon_livraison=:num_bon_livraison,
													valeur_unitaire_commande=:valeur_unitaire_commande,
													plage_debut_sticker=:plage_debut_sticker,
													plage_fin_sticker=:plage_fin_sticker,
													total_qte_commande=:total_qte_commande,
													valeur_unitaire_livraison=:valeur_unitaire_livraison,
													total_qte_livraison=:total_qte_livraison,
													date_bon_commande=:date_bon_commande,
													date_bon_livraison=:date_bon_livraison,
													date_operation=:date_operation
												WHERE id_bon_tresor = :num_tempo";
					$stmt = $DBcon->prepare($insquery);
					
					$stmt->execute(array(":agent_receptionnaire" => $agent_receptionnaire,
											":id_user" => $id_user,
											":num_bon_commande" => $numbc,
											":num_bon_livraison" => $numbl,
											":valeur_unitaire_commande" => $valunitcde,
											":plage_debut_sticker" => $plagedebut,
											":plage_fin_sticker" => $plagefin, 
											":total_qte_commande" => $qtecde,
											":valeur_unitaire_livraison" => $valunitliv,
											":total_qte_livraison" => $plagefin-$plagedebut+1,
											":date_bon_commande" => $datebc,
											":date_bon_livraison" => $datebl,
											":date_operation" => $date_enreg,
											":num_tempo" => $num_tempo
											
											)); 
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "BON DE LIVRAISON TRESOR MODIFIEE AVEC SUCCES!";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$num_tempo\"}";
			exit();
			
			}
			
	// FIN SCRIPT MISE A JOUR
			
			
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