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
		$date_fin = htmlspecialchars($_POST['date_fin']);
		$date_debut = htmlspecialchars($_POST['date_debut']);
			
		$date_enreg = date('Y-m-d H:i:s');
		$annee = date('Y');
				
	  
			   //Insertion dans la table bon_livraison
			   	 if(($_POST['action'])== "SELECT") {
				
				  $requete = "SELECT
									bon_tresor.date_bon_livraison,
									bon_tresor.date_bon_commande,
									exercice.periode,
									bon_tresor.valeur_unitaire_livraison,
									bon_tresor.total_qte_livraison
									FROM
									bon_tresor ,
									exercice
                                  WHERE bon_tresor.date_bon_livraison='".$date_fin."' AND bon_tresor.date_bon_commande='".$date_debut."'";
									
				$resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));
				
				// résultats
				$donnees = array();
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
				    
					$V_date_bon_livraison = utf8_decode($donnees['date_bon_livraison']);
					$date_bon_livraison = date("d-m-Y", strtotime($V_date_bon_livraison));
					$date_bon_commande = utf8_encode($donnees['date_bon_commande']);
					$v_date_cde = utf8_encode($donnees['date_cde']);
					$date_cde = date("d-m-Y", strtotime($v_date_cde));
					$periode = utf8_encode($donnees['periode']);
					$valeur_unitaire_livraison = utf8_encode($donnees['valeur_unitaire_livraison']);
					$total_qte_livraison = utf8_encode($donnees['total_qte_livraison']);
					$montant= $total_qte_livraison * $valeur_unitaire_livraison;
				
				}	
			//echo" select date_bon_livraison".$date_bon_livraison;
				//	echo" select valeur_unitaire_livraison".$date_fin;
			//echo" select date fin".	$date_fin;
			//echo" selectdate debut".$date_debut;
										
				
			echo "{
				    \"valeur_unitaire_livraison\":\"$valeur_unitaire_livraison\",
						\"total_qte_livraison\":\"$total_qte_livraison\",
							\"date_cde\":\"$date_cde\",
							\"montant\":\"$montant\",
							\"date_bon_livraison\":\"$date_bon_livraison\",
						\"periode\":\"$periode\"}";
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