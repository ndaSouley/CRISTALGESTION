
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
	
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$datenaissance = htmlspecialchars($_POST['datenaissance']);
		//echo"je suis le non".$nom;
		$date_enreg = date('Y-m-d H:i:s');
		$annee = date('Y');
			   //Insertion dans la table bon_livraison
			   	 if(($_POST['action'])== "RECHERCHE") {
					//echo"je suis le non";
				  $requete = "SELECT
									service.id_service,
									service.id_abonn_serv,
									service.id_user,
									service.id_contribuable,
									service.id_quittance,
									service.date_creation,
									service.date_doc,
									service.quotite_officiel,
									service.quotite_paye,
									service.montant_taxe,
									service.montant_droit_place,
									service.montant_macaron,
									service.montant_antenne,
									service.montant_carnet,
									service.code_periode,
									service.montant_previsionnel,
									service.montant_realise,
									contribuable.id_contribuable,
									contribuable.nom,
									contribuable.prenom,
									quittance.id_quittance,
									quittance.Id_Type_quit,
									contribuable.lieu_naissance
									FROM
									service
									INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
									INNER JOIN quittance ON service.id_quittance = quittance.id_quittance
									WHERE
									service.id_quittance = quittance.id_quittance AND contribuable.nom='".$nom."' AND contribuable.prenom='".$prenom."' ";
								
				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$Id_Type_quit = utf8_decode($donnees['Id_Type_quit']);
					$montant_carnet = utf8_encode($donnees['montant_carnet']);
					$montant_taxe = utf8_encode($donnees['montant_taxe']);
					$montant_previsionnel = utf8_encode($donnees['montant_previsionnel']);
					
				}	
				//echo"je suis valeur_unitaire_livraison".$valeur_unitaire_livraison;
										
				
			echo "{
				    \"Id_Type_quit\":\"$Id_Type_quit\",
						\"montant_carnet\":\"$montant_carnet\",
							\"montant_taxe\":\"$montant_taxe\",
							\"montant_previsionnel\":\"$montant_previsionnel\"}";
			$stmt->closeCursor();	
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