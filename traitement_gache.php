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
	
	//echo" A = ".$data['usrLogin'];
	
		$exercice = htmlspecialchars($_POST['exercice']);
		$niveau = htmlspecialchars($_POST['niveau']);
		$valeur = htmlspecialchars($_POST['valeur']);
		$numsticker = htmlspecialchars($_POST['numsticker']);
		$dategache = htmlspecialchars($_POST['dategache']);
		
			// if(($_POST['action'])== "CONNEXION") {
				 
				  if(($_POST['action'])== "AJOUTER") {
					   //echo"je suis dans l ajout";
				// Insertion des données dans la TABLE regie temporaire
				$insquery = "INSERT INTO tempo_gache(exercice,
														niveau,
														Numsticker,
														valeur,
														date
														)							
											VALUES(:exercice,
														:niveau,
														:Numsticker,
														:valeur,
														:date)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":exercice" => $exercice,
											":niveau" => $niveau,
											":Numsticker" => $numsticker,
											":valeur" => $valeur,
											":date" => $dategache
										));
										
				$stmt->closeCursor();				
				$msgexecute	= "LIGNE CREEE AVEC SUCCES !";
				
			$DBcon->commit();
			
			echo "{
				\"exercice\":\"$exercice\",
						\"numbc\":\"$numbc\",
						\"user\":\"$id_user\"}";
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
			$id_gache = htmlspecialchars($_POST['id_gache']);
			  	//echo"matricule".$id_gache ;
				$select = "SELECT          tempo_gache.id_gache,
											tempo_gache.exercice,
											tempo_gache.niveau,
											tempo_gache.Numsticker,
											tempo_gache.valeur,
											tempo_gache.date,
											regie.libelle,
											exercice.periode,
											regie.id_regie
											FROM
											tempo_gache,
											regie,
											exercice
											WHERE
											tempo_gache.niveau=regie.id_regie AND tempo_gache.id_gache='".$id_gache."'";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_gache = utf8_decode($donnees['id_gache']);
					$exercice = utf8_decode($donnees['exercice']);
					$niveau = utf8_decode($donnees['niveau']);
					$Numsticker = utf8_decode($donnees['Numsticker']);
					$valeur = utf8_decode($donnees['valeur']);
					$libelle = utf8_decode($donnees['libelle']);
					$periode = utf8_decode($donnees['periode']);
					$id_regie = utf8_decode($donnees['id_regie']);
					$date = utf8_decode($donnees['date']);
					
				}	
					echo "{
						\"id_gache\":\"$id_gache\",
							\"exercice\":\"$exercice\",
							\"niveau\":\"$niveau\",
							\"Numsticker\":\"$Numsticker\",
							\"valeur\":\"$valeur\",
							\"libelle\":\"$libelle\",
							\"periode\":\"$periode\",
							\"date\":\"$date\"}";
					$stmt->closeCursor();				
			}
			// SCRIPT DE MISE A JOUR
		
			 if(($_POST['action'])== "UPDATE") {
			 $V_id_gache = htmlspecialchars($_POST['V_id_gache']);
				$insquery = "UPDATE temp_bon_livre SET exercice=:exercice,
														niveau=:niveau,
														Numsticker=:,
														valeur=:valeur,
														date=:date
												WHERE   id_gache = :V_id_gache";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":exercice" => $exercice,
											":niveau" => $niveau,
											":Numsticker" => $Numsticker,
											":valeur" => $valeur,
											":date" => $date,
											":id_gache" => $V_id_gache
											)); 
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "BON DE LIVRAISON MODIFIEE AVEC SUCCES!";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"exercice\":\"$exercice\",
						\"niveau\":\"$niveau\",
						\"Numsticker\":\"$Numsticker\"}";
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