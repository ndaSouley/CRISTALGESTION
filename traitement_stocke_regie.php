
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
	
		$exercice = htmlspecialchars($_POST['exercice']);
		$date_fin = htmlspecialchars($_POST['datedefin']);
		$date_debut = htmlspecialchars($_POST['datedebut']);
		$regie = htmlspecialchars($_POST['regie']);
		$date_enreg = date('Y-m-d H:i:s');
		$annee = date('Y');
				
	  
			   //Insertion dans la table bon_livraison
			   	 if(($_POST['action'])== "SELECT") {
					//echo"date_fin".$date_fin;
				  $requete = "SELECT
								bon_livraison.mle_regisseur,
								bon_livraison.num_bon_livraison,
								bon_livraison.valeur_unitaire_commande,
								bon_livraison.plage_debut_sticker,
								bon_livraison.plage_fin_sticker,
								bon_livraison.total_qte_commande,
								bon_livraison.valeur_unitaire_livraison,
								bon_livraison.total_qte_livraison,
								bon_livraison.date_bon_commande,
								bon_livraison.date_bon_livraison,
								regie.id_regie,
								regie.libelle,
								bon_livraison.num_bon_commande
								FROM
								bon_livraison ,
								regie
								WHERE
								bon_livraison.mle_regisseur=regie.id_regie AND bon_livraison.date_bon_livraison='".$date_fin."'AND bon_livraison.date_bon_commande='".$date_debut."'";
									
									//echo"   je suis dans la select";

				// exécution de la requête
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					// je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
					//$rows[] = utf8_encode($donnees);
					$mle_regisseur = utf8_decode($donnees['mle_regisseur']);
					$valeur_unitaire_commande = utf8_encode($donnees['valeur_unitaire_commande']);
					$total_qte_commande = utf8_encode($donnees['total_qte_commande']);
					$valeur_unitaire_livraison = utf8_encode($donnees['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_encode($donnees['total_qte_livraison']);
					$date_bon_commande = utf8_encode($donnees['date_bon_commande']);
					$libelle = utf8_encode($donnees['libelle']);
					$date_bon_livraison = utf8_encode($donnees['date_bon_livraison']);
					$montant=$total_qte_livraison*$valeur_unitaire_livraison;
					//$montant= $total_qte_livraison * $valeur_unitaire_livraison;
				
				}	
				//echo"je suis valeur_unitaire_livraison".$valeur_unitaire_livraison;
										
				
			echo "{
				    \"mle_regisseur\":\"$mle_regisseur\",
						\"valeur_unitaire_commande\":\"$valeur_unitaire_commande\",
							\"total_qte_commande\":\"$total_qte_commande\",
							\"valeur_unitaire_livraison\":\"$valeur_unitaire_livraison\",
							\"date_bon_livraison\":\"$date_bon_livraison\",
							\"libelle\":\"$libelle\",
							\"montant\":\"$montant\",
						\"total_qte_livraison\":\"$total_qte_livraison\"}";
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