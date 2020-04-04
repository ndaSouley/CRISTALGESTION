
<?php
require_once 'dbconfig.php';
    session_start();
	 $_SESSION['nom'];
//    if(!(isset($_SESSION['IdProfil'])))
//    {
//      header("location:Accueil.php");
//    }
//    
    ?>

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
				$valeur_faciale = htmlspecialchars($_POST['valeur_faciale']);
				$code_type_sticker = htmlspecialchars($_POST['code_type_sticker']);
				
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				$insquery = "INSERT INTO type_sticker(code_type_sticker,
												valeur_faciale)							
										VALUES(:code_type_sticker,
												:valeur_faciale)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":code_type_sticker" =>$code_type_sticker.$valeur_faciale,
											":valeur_faciale" => $valeur_faciale));
									//$id_contri = mysql_insert_id($DBcon);
									//$id_contri = $DBcon->lastInsertId();
									
				
						$stmt->closeCursor();				
				$msgexecute	= "TYPE STICKER AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER LA SAISIE?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			   
			    	if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$V_code_type_sticker = htmlspecialchars($_POST['num']);
				
			$insquery = "UPDATE  type_sticker SET
												valeur_faciale = :valeur_faciale
												WHERE code_type_sticker = :code_type_sticker";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":valeur_faciale" => $valeur_faciale,
											":code_type_sticker" =>$code_type_sticker.$valeur_faciale
											));
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "TYPE STICKER MODIFIEE AVEC SUCCES!";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			
			echo "{
						\"code_type_sticker\":\"$code_type_sticker\"}";
				
					
			exit();
			
			}	
			//FIN Requete de modification
			
				/////////////////////////////////////////////////////////////////////
		   //echo"11111111";
			if(($_POST['action'])== "SELECT") {
				$code_type_sticker = $_POST['code_type_sticker'];
				 // echo"     2222222".$code_type_sticker;
	
	
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
					$requete = "SELECT
									type_sticker.code_type_sticker,
									type_sticker.valeur_faciale
									FROM
									type_sticker
									WHERE code_type_sticker='".$code_type_sticker."'";
                            // echo"     3333333".$id_quit;

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$code_type_sticker = utf8_decode($donnees['code_type_sticker']);
					$valeur_faciale = utf8_decode($donnees['valeur_faciale']);}
				//echo "Affichage ";
				 //echo"     4444".$valeur_faciale ;
					echo "{
						\"code_type_sticker\":\"$code_type_sticker\",
						\"valeur_faciale\":\"$valeur_faciale\"}";
					
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