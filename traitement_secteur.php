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
				$libelle = htmlspecialchars($_POST['libelle']);
				$action = htmlspecialchars($_POST['action']);
				$date_enreg = date('Y-m-d H:i:s');
				$annee = date('Y');
			 if(($_POST['action'])== "INSERT") {
				 
				// Insertion des données dans la TABLE quittance
				$insquery = "INSERT INTO secteur(libelle,
												date_creation)							
										VALUES(:libelle,
												:date_creation)";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":libelle" =>	$libelle,
											":date_creation" => $date_enreg));
									//$id_contri = mysql_insert_id($DBcon);
									$id_contri = $DBcon->lastInsertId();
						$stmt->closeCursor();				
				$msgexecute	= "TYPE ACIVITE AJOUTE AVEC SUCCES! VOULEZ-VOUS CONTINUER?";
				
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			     // echo"je suis au debut de UPDATE";
			    	if(($_POST['action'])== "UPDATE") {
					//matricule_collecteur = :matricule_collecteur,
					$id_secteur = htmlspecialchars($_POST['numquit']);
					//echo"     je suis dans la variable de UPDATE".$id_secteur;
				 
				 // Requête pur selectionner l'identifant du contribuable
				$select = "SELECT id_secteur from secteur WHERE id_secteur = '".$id_secteur."'";
				$resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$id_secteur = utf8_decode($donnees['id_secteur']);
				}
			$insquery = "UPDATE  secteur SET   libelle = :libelle,
												date_creation = :date_creation
												WHERE id_secteur = :id_secteur";
					$stmt = $DBcon->prepare($insquery);
					$stmt->execute(array(":libelle" =>$libelle,
											":date_creation" =>$date_enreg,
											":id_secteur" =>$id_secteur));
											$stmt->closeCursor();
	
						$stmt->closeCursor();				
				//echo "Fin traitement";
					$msgexecute	= "SECTEUR MODIFIEE AVEC SUCCES !";
			$DBcon->commit();
			$DBcon = null;
			//echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
			echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
			exit();
			
			}	
			//FIN Requete de modification
			
				/////////////////////////////////////////////////////////////////////
		  // echo"   je suis au debut de la select";
			if(($_POST['action'])== "SELECT") {
				$id_secteur = $_POST['id_secteur'];
				 //echo"je suis la variable".$id_secteur;
				//echo "id_quit = ".$id_quit;
						$json = array();
				// requête qui récupère les informations de la facture
				 //echo"  je suis au dessus de la requete".$id_secteur;
					$requete = "SELECT
									secteur.id_secteur,
									secteur.libelle,
									secteur.date_creation
									FROM
									secteur
								WHERE
								secteur.id_secteur='".$id_secteur."'";
								  //echo"   je suis au milieu de la select ";


				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					
					$id_secteur = utf8_encode($donnees['id_secteur']);
					$libelle = utf8_encode($donnees['libelle']);
					$date_creation = utf8_encode($donnees['date_creation']);
					
					
				}
				// echo"   je suis le libelle ".$libelle ;
				//echo "Affichage ";
					echo "{
						
							\"id_secteur\":\"$id_secteur\",
							\"libelle\":\"$libelle\",
							\"date_creation\":\"$date_creation\"}";
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