
<?PHP
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
	try
	{
	require_once 'dbconfig.php';
	session_start();
  $id_user=$_SESSION['TaxeUserData'][0]['id_user'];
	$stmt = null;
	
	   //$id_user=$data['id_user'] ;

		$regie = htmlspecialchars($_POST['regie']);
		$numbc = htmlspecialchars($_POST['numbc']);
		$datebc = htmlspecialchars($_POST['datebc']);
		$numbl = htmlspecialchars($_POST['numbl']);
		$datebl = htmlspecialchars($_POST['datebl']);
		$qtecde = htmlspecialchars($_POST['qtecde']);
		$valunitliv = htmlspecialchars($_POST['valunitliv']);
		$valunitcde = htmlspecialchars($_POST['valunitcde']);
		$plagedebut = htmlspecialchars($_POST['plagedebut']);
		$plagefin = htmlspecialchars($_POST['plagefin']);
		$num_tempo = htmlspecialchars($_POST['num_tempo']);
		$qtelivre = htmlspecialchars($_POST['qtelivre']);
		$date_enreg = date('Y-m-d H:i:s');
		$annee = date('Y');
				
			 if(($_POST['action'])== "CREELIGNE") {
				// Insertion des données dans la TABLE regie temporaire
				$insquery = "INSERT INTO temp_bon_livre(regie,
													date_cde,
													num_bc,
													num_bl,
													date_bl,
													valeur_unitaire_cde,
													qte_cde,
													valeur_unitaire_livree,
													plage_debut,
													plage_fin,
													qte_livree,
													id_user)							
											VALUES(:regie,
													:date_cde,
													:num_bc,
													:num_bl,
													:date_bl,
													:valeur_unitaire_cde,
													:qte_cde,
													:valeur_unitaire_livree,
													:plage_debut,
													:plage_fin,
													:qte_livree,
													:id_user)";
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
											":id_user" => $id_user
										));
										
									
				$stmt->closeCursor();				
				$msgexecute	= "LIGNE CREEE AVEC SUCCES !";
				
			$DBcon->commit();
			
			echo "
			{\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$id_user\"}";
			exit();
			
			}	
			   
			   //Insertion dans la table bon_livraison
			   	 if(($_POST['action'])== "INSERT") {
					 //echo"je suis dans le insert";
					 // session_start();
	                 // $id_user=$_SESSION['id_user'] ;
			//Selection des données de la table temporaire pour insertion dans la table bon_livraison 
			
			
			
				  $requete = "SELECT
									temp_bon_livre.id_temp_bon_livre,
									temp_bon_livre.regie,
									temp_bon_livre.date_cde,
									temp_bon_livre.num_bc,
									temp_bon_livre.num_bl,
									temp_bon_livre.date_bl,
									temp_bon_livre.valeur_unitaire_cde,
									temp_bon_livre.qte_cde,
									temp_bon_livre.valeur_unitaire_livree,
									temp_bon_livre.plage_debut,
									temp_bon_livre.plage_fin,
									temp_bon_livre.qte_livree,
									temp_bon_livre.id_user
									FROM
									temp_bon_livre
									WHERE temp_bon_livre.id_user='".$id_user."'";
									
									//echo"   je suis dans la select";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$v_id_temp_bon_livre = utf8_decode($donnees['id_temp_bon_livre']);
					$v_regie = utf8_encode($donnees['regie']);
					$v_date_cde = utf8_encode($donnees['date_cde']);
					$v_num_bc = utf8_encode($donnees['num_bc']);
					$v_num_bl = utf8_encode($donnees['num_bl']);
					$v_date_bl = utf8_encode($donnees['date_bl']);
					$v_valeur_unitaire_cde = utf8_encode($donnees['valeur_unitaire_cde']);
					$v_qte_cde = utf8_encode($donnees['qte_cde']);
					$v_valeur_unitaire_livree = utf8_encode($donnees['valeur_unitaire_livree']);
					$v_plage_debut = utf8_encode($donnees['plage_debut']);
					$v_plage_fin = utf8_encode($donnees['plage_fin']);
					$v_qte_livree = utf8_encode($donnees['qte_livree']);	
					$v_id_user = utf8_encode($donnees['id_user']);									
				//echo"   je suis dans le bon livraison = ".$v_id_temp_bon_livre." ".$v_num_bc;
				
				 $requete = "SELECT count(*) as nbre FROM bon_livraison where id_bon =".$v_id_temp_bon_livre;
																		
									//echo"   je suis dans la select";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$nbre = utf8_decode($donnees['nbre']);
				}
				
				//echo"   apres select";
				
				if($nbre == 0){
					
				// Insertion des données dans la TABLE regie
				$insquery = "INSERT INTO bon_livraison(id_bon,
				                                    mle_regisseur,
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
													date_operation,
													id_user)
											VALUES(:id_bon,
											        :mle_regisseur,
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
													:date_operation,
													:id_user)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array( ":id_bon" => $v_id_temp_bon_livre,
					                        ":mle_regisseur" => $v_regie,
											":num_bon_commande" => $v_num_bc,
											":num_bon_livraison" => $v_num_bl,
											":valeur_unitaire_commande" => $v_valeur_unitaire_cde,
											":plage_debut_sticker" => $v_plage_debut,
											":plage_fin_sticker" => $v_plage_debut,
											":total_qte_commande" => $v_qte_cde,
											":valeur_unitaire_livraison" => $v_valeur_unitaire_livree,
											":total_qte_livraison" => $v_qte_livree,
											":date_bon_commande" => $v_date_cde,
											":date_bon_livraison" => $v_date_bl,
											":date_operation" => $date_enreg,
											":id_user" => $v_id_user
										));
									
							$stmt->closeCursor();
				}
							//Insertion dans la table sticker
							 ////echo"je suis dans au debut du for VU = ".$v_valeur_unitaire_livree;
							 
							//Debut select	 
	$requete = "SELECT code_type_sticker FROM type_sticker where type_sticker.valeur_faciale =".$v_valeur_unitaire_livree;
																		
									///echo"   je suis dans la select";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$code_type_sticker = utf8_decode($donnees['code_type_sticker']);
				}
								//Fin select
							 $i =$v_plage_debut;
							 
							// echo" i = ".$i." ".$code_type_sticker." ".$v_plage_fin;
							 
							//for ($i =$v_plage_debut; $i <= $v_qte_livree; $i++) {
							while($i <= $v_plage_fin)
						{
							//echo" i1 = ".$i;
								// Insertion des données dans la TABLE regie
								
				$insquery = "INSERT INTO sticker(code_type_sticker,
				                                     num_sticker,
													 annee,
													 date_creation,
													montant_sticker
													)
											VALUES(:code_type_sticker,
				                                     :num_sticker,
													 :annee,
													 :date_creation,
													:montant_sticker
													)";
											 //echo"je suis dans au milieu du for";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array( ":code_type_sticker" => $code_type_sticker,
											":num_sticker" => $i,
											":annee" => $annee,
											":date_creation" => $date_enreg,
											":montant_sticker" => $v_valeur_unitaire_livree
										));
							
							$i++;
							
						}//Fin de la boucle
						
						$stmt->closeCursor();	
							//$DBcon->commit();
			                //$DBcon = null;
						
							//Fin d'insertion dans la table sticker
								//echo"je suis dans a la fin du for";	
				$insquery = "DELETE FROM temp_bon_livre 
							WHERE temp_bon_livre.id_user='".$id_user."' AND temp_bon_livre.id_temp_bon_livre='".$v_id_temp_bon_livre."'";
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
							}				
				$msgexecute	= "BON LIVRAISON AJOUTER AVEC SUCCES !";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			//echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			echo "{\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$iduser\"}";
			exit();
			
			}
			
			//Seppression d'une ligne de la table temporaire
			if(($_POST['action'])== "SUPPRESSION") {
			$V_id_tempo = htmlspecialchars($_POST['id_tempo']);
			  	//echo"matricule".$V_id_tempo ;
				$insquery = "DELETE FROM temp_bon_livre 
							WHERE temp_bon_livre.id_temp_bon_livre='".$V_id_tempo."'";
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
	
			//Seppression d'une ligne de la table temporaire
			if(($_POST['action'])== "SELECT") {
			$id_tempo2 = htmlspecialchars($_POST['id_tempo2']);
			  	//echo"matricule".$V_id_tempo1 ;
				$select = "SELECT
								temp_bon_livre.id_temp_bon_livre,
								temp_bon_livre.regie,
								temp_bon_livre.date_cde,
								temp_bon_livre.num_bc,
								temp_bon_livre.num_bl,
								temp_bon_livre.date_bl,
								temp_bon_livre.valeur_unitaire_cde,
								temp_bon_livre.qte_cde,
								temp_bon_livre.valeur_unitaire_livree,
								temp_bon_livre.plage_debut,
								temp_bon_livre.plage_fin,
								temp_bon_livre.qte_livree,
								temp_bon_livre.id_user,
								regie.libelle,
								regie.id_regie
								FROM
								temp_bon_livre ,
								regie
								WHERE
										temp_bon_livre.id_temp_bon_livre='".$id_tempo2."' AND temp_bon_livre.regie=regie.id_regie";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_temp_bon_livre = utf8_decode($donnees['id_temp_bon_livre']);
					$regie = utf8_decode($donnees['regie']);
					$date_cde = utf8_decode($donnees['date_cde']);
					$num_bc = utf8_decode($donnees['num_bc']);
					$num_bl = utf8_decode($donnees['num_bl']);
					$date_bl = utf8_decode($donnees['date_bl']);
					$valeur_unitaire_cde = utf8_decode($donnees['valeur_unitaire_cde']);
					$qte_cde = utf8_decode($donnees['qte_cde']);
					$valeur_unitaire_livree = utf8_decode($donnees['valeur_unitaire_livree']);
					$plage_debut = utf8_decode($donnees['plage_debut']);
					$plage_fin = utf8_decode($donnees['plage_fin']);
					$qte_livree = utf8_decode($donnees['qte_livree']);
					$id_user = utf8_decode($donnees['id_user']);
					$libelle = utf8_decode($donnees['libelle']);
				}	
					echo "{\"id_temp_bon_livre\":\"$id_temp_bon_livre\",
							\"regie\":\"$regie\",
							\"date_cde\":\"$date_cde\",
							\"num_bc\":\"$num_bc\",
							\"num_bl\":\"$num_bl\",
							\"date_bl\":\"$date_bl\",
							\"valeur_unitaire_cde\":\"$valeur_unitaire_cde\",
							\"qte_cde\":\"$qte_cde\",
							\"valeur_unitaire_livree\":\"$valeur_unitaire_livree\",
							\"plage_debut\":\"$plage_debut\",
							\"plage_fin\":\"$plage_fin\",
							\"libelle\":\"$libelle\",
							\"qte_livree\":\"$qte_livree\",
							\"id_tempo2\":\"$id_tempo2\",
                            \"id_user\":\"$id_user\"}";
									
					
					$stmt->closeCursor();				
			}
			// SCRIPT DE MISE A JOUR
		
			 if(($_POST['action'])== "UPDATE") {
			 $num_tempo = htmlspecialchars($_POST['num_tempo']);
				$insquery = "UPDATE temp_bon_livre SET regie=:regie,
													date_cde=:date_cde,
													num_bc=:num_bc,
													num_bl=:num_bl,
													date_bl=:date_bl,
													valeur_unitaire_cde=:valeur_unitaire_cde,
													qte_cde=:qte_cde,
													valeur_unitaire_livree=:valeur_unitaire_livree,
													plage_debut=:plage_debut,
													plage_fin=:plage_fin,
													qte_livree=:qte_livree,
													id_user=:id_user
												WHERE id_temp_bon_livre = :id_tempo2";
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
											":id_user" => $id_user,
											":id_tempo2" => $num_tempo
											
											)); 
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "BON DE LIVRAISON MODIFIEE AVEC SUCCES!";
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