<?PHP
session_start();
  $id_user=$_SESSION['TaxeUserData'][0]['id_user'];
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
//$InputJsonString = file_get_contents('php://input');
//$data = json_decode($InputJsonString, true);
try
{
    require_once 'dbconfig.php';
    $stmt = null;
   
    $execercie = htmlspecialchars($_POST['execercie']);
    $V_num_collecte = htmlspecialchars($_POST['V_num_collecte']);
    $collecteur = htmlspecialchars($_POST['collecteur']);
    $matricule_col = htmlspecialchars($_POST['matricule_col']);
    $numquittance = htmlspecialchars($_POST['numquittance']);
    $datepaiement = htmlspecialchars($_POST['datepaiement']);
    $numsticker = htmlspecialchars($_POST['numsticker']);
    $montantsticker = htmlspecialchars($_POST['montantsticker']);
    $date_enreg = date('Y-m-d H:i:s');
    $annee = date('Y');
    //echo"je suis au dessus de cree ligne";
    if(($_POST['action'])== "CREELIGNE") {
        // echo"je suis dans cree ligne";
        /////
        $select = "SELECT id_quittance, code_quittance FROM quittance WHERE quittance.code_quittance='".$numquittance."'";
        $resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $id_quittance = utf8_decode($donnees['id_quittance']);
            $code_quittance = utf8_decode($donnees['code_quittance']);

        }
        //echo"   N° Quittance".$id_quittance;
       
        $select = "SELECT
								service.id_service,
								service.id_abonn_serv,
								service.id_contribuable,
								service.id_quittance,
								contribuable.matricule_collecteur
								FROM
								service
								INNER JOIN contribuable ON service.id_contribuable = contribuable.id_contribuable
								WHERE service.id_quittance='".$id_quittance."'";
        $resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $id_service = utf8_decode($donnees['id_service']);
            $id_abonn_serv = utf8_decode($donnees['id_abonn_serv']);
            $id_contribuable = utf8_decode($donnees['id_contribuable']);
            $id_quittance = utf8_decode($donnees['id_quittance']);
            $matricule_collecteur = utf8_decode($donnees['matricule_collecteur']);

        }
        //Insertion des données dans la TABLE regie temporaire
        //echo"   Je suis user=".$id_contribuable;
        $insquery = "INSERT INTO temp_paiement(id_user,
														code_contribuable,
														matricule_collecteur,
														montant_paye,
														date_paye,
														annee_paye,
														date_enregistrement,
														num_sticker,
														id_service
														)							
											  VALUES(:id_user,
														:code_contribuable,
														:matricule_collecteur,
														:montant_paye,
														:date_paye,
														:annee_paye,
														:date_enregistrement,
														:num_sticker,
														:id_service
													)";
        $stmt = $DBcon->prepare($insquery);
        $stmt->execute(array(":id_user" => $id_user,
            ":code_contribuable" => $id_contribuable,
            ":matricule_collecteur" => $matricule_col,
            ":montant_paye" => $montantsticker,
            ":date_paye" => $datepaiement,
            ":annee_paye" => $annee,
            ":date_enregistrement" => $date_enreg,
            ":num_sticker" => $numsticker,
            ":id_service" => $id_service

        ));

        $stmt->closeCursor();
        $msgexecute	= "LIGNE CREEE AVEC SUCCES !";
        $DBcon->commit();
        echo "{
				\"id_contribuable\":\"$id_contribuable\",
						\"montantsticker\":\"$montantsticker\",
						\"user\":\"$id_user\"}";
        exit();
    }
    if(($_POST['action'])== "INSERT") {
        // echo"je suis dans insert";
        $requete = "SELECT
									temp_paiement.num_sticker,
									temp_paiement.date_enregistrement,
									temp_paiement.id_service,
									temp_paiement.annee_paye,
									temp_paiement.date_paye,
									temp_paiement.montant_paye,
									temp_paiement.matricule_collecteur,
									temp_paiement.code_contribuable,
									temp_paiement.id_user,
									temp_paiement.num_collecte
									FROM
									temp_paiement
									WHERE
									temp_paiement.id_user='".$id_user."'";
        //echo"je suis user".$id_user;
        // exécution de la requête
        $resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $num_collecte = utf8_decode($donnees['num_collecte']);
            $id_user = utf8_decode($donnees['id_user']);
            $code_contribuable = utf8_decode($donnees['code_contribuable']);
            $matricule_collecteur = utf8_decode($donnees['matricule_collecteur']);
            $montant_paye = utf8_decode($donnees['montant_paye']);
            $date_paye = utf8_decode($donnees['date_paye']);
            $annee_paye = utf8_decode($donnees['annee_paye']);
            $date_enregistrement = utf8_decode($donnees['date_enregistrement']);
            $num_sticker = utf8_decode($donnees['num_sticker']);
            $id_service = utf8_decode($donnees['id_service']);
            // Insertion des données dans la TABLE regie
            $insquery = "INSERT INTO paiement(id_user,
													code_contribuable,
													matricule_collecteur,
													montant_paye,
													date_paye,
													annee_paye,
													date_enregistrement,
													num_sticker,
													id_service
													)
											VALUES(:id_user,
														:code_contribuable,
														:matricule_collecteur,
														:montant_paye,
														:date_paye,
														:annee_paye,
														:date_enregistrement,
														:num_sticker,
														:id_service
														)";
            $stmt = $DBcon->prepare($insquery);
            $stmt->execute(array( ":id_user" => $id_user,
                ":code_contribuable" => $code_contribuable,
                ":matricule_collecteur" => $matricule_collecteur,
                ":montant_paye" => $montant_paye,
                ":date_paye" => $date_paye,
                ":annee_paye" => $annee_paye,
                ":date_enregistrement" => $date_enregistrement,
                ":num_sticker" => $num_sticker,
                ":id_service" => $id_service
            ));
            $V_num_collecte = $DBcon->lastInsertId();

			//Selection du code contribuable dans la table paiment
			 $requete = "SELECT
							paiement.num_collecte,
							paiement.id_user,
							paiement.code_contribuable,
							paiement.montant_paye
							FROM
							paiement
							WHERE
							paiement.num_collecte='".$V_num_collecte."'";

            // exécution de la requête
            $resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));
            // résultats
            $donnees = array();
            while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
                //$rows[] = utf8_encode($donnees);
                $num_collecte = utf8_decode($donnees['num_collecte']);
                $id_user = utf8_decode($donnees['id_user']);
                $Vcode_contribuable = utf8_decode($donnees['code_contribuable']);
				$montant_paye = utf8_decode($donnees['montant_paye']);
				
			//------------------------------------------------------------------------------
            //REQUETE POUR SELECTION STICKEER

            $requete = "SELECT
												sticker.id_sticker,
												sticker.code_type_sticker,
												sticker.num_collecte,
												sticker.num_sticker,
												sticker.annee,
												sticker.date_creation,
												sticker.isused,
												sticker.montant_sticker
												FROM
												sticker
												WHERE
												sticker.num_sticker='".$num_sticker."'";

            // exécution de la requête
            $resultat = $DBcon->query($requete) or die(print_r($DBcon->errorInfo()));
            // résultats
            $donnees = array();
            while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
                // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
                //$rows[] = utf8_encode($donnees);
                $Vid_sticker = utf8_decode($donnees['id_sticker']);
                $code_type_sticker = utf8_decode($donnees['code_type_sticker']);
                $num_collecte = utf8_decode($donnees['num_collecte']);
                $num_sticker = utf8_decode($donnees['num_sticker']);
                $annee = utf8_decode($donnees['annee']);
                $date_creation = utf8_decode($donnees['date_creation']);
                $isused = utf8_decode($donnees['isused']);
                $montant_sticker = utf8_decode($donnees['montant_sticker']);
                //FIN REQUETE DE SELECTION
                //echo"  numero collecte".$num_collecte;
                $insquery = "UPDATE sticker SET num_collecte=:num_collecte,
																isused=:isused
												WHERE id_sticker = :id_sticker";
                $stmt = $DBcon->prepare($insquery);

                $stmt->execute(array(
                    ":num_collecte" => $V_num_collecte,
                    ":isused" => 1, 
                    ":id_sticker" => $Vid_sticker
                ));
            }
			
		}
            //FIN INSERTION
            $insquery = "DELETE FROM temp_paiement 
											WHERE temp_paiement.id_user='".$id_user."'";
            $stmt = $DBcon->prepare($insquery);
            $stmt->execute(array(":code_contribuable" => $id_contribuable,
                ":matricule_collecteur" => $matricule_col,
                ":montant_paye" => $montantsticker,
                ":date_paye" => $datepaiement,
                ":annee_paye" => $annee,
                ":date_enregistrement" => $date_enreg,
                ":num_sticker" => $numsticker,
                ":id_service" => $id_service,
                ":id_user" => $v_id_user
            ));
        }
        $stmt->closeCursor();
        $msgexecute	= "BON LIVRAISON TRESOR AJOUTER AVEC SUCCES !";

        $DBcon->commit();
        $DBcon = null;
        //echo "[{\"Etat\":\"SUCCES\",\"Motif\":\"OPERATION EFFECTUEE AVEC SUCCES !\"}]";
        //echo "{\"Etat\":\"SUCCES\",\"Motif\":\"$msgexecute\"}";
        echo "{
				\"regie\":\"$regie\",
						\"numbc\":\"$numbc\",
						\"user\":\"$iduser\"}";
        exit();

    }
    //DEBUT  TRAITEMENT DE SELECTION

    //Seppression d'une ligne de la table temporaire
    //echo"matricule".$id_tempo2 ;
    if(($_POST['action'])== "SELECT") {
        $id_tempo2 = htmlspecialchars($_POST['id_tempo2']);
        //echo"matricule".$id_tempo2 ;
        $select = "SELECT
						temp_paiement.num_collecte,
						temp_paiement.id_user,
						temp_paiement.code_contribuable,
						temp_paiement.matricule_collecteur,
						temp_paiement.montant_paye,
						temp_paiement.date_paye,
						temp_paiement.annee_paye,
						temp_paiement.date_enregistrement,
						temp_paiement.id_service
						FROM
						temp_paiement
						WHERE
						temp_paiement.num_collecte=".$id_tempo2."";
        $resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $num_collecte = utf8_decode($donnees['num_collecte']);
            $id_user = utf8_decode($donnees['id_user']);
            $code_contribuable = utf8_decode($donnees['code_contribuable']);
            $matricule_collecteur = utf8_decode($donnees['matricule_collecteur']);
            $montant_paye = utf8_decode($donnees['montant_paye']);
            $date_paye = utf8_decode($donnees['date_paye']);
            $annee_paye = utf8_decode($donnees['annee_paye']);
            $date_enregistrement = utf8_decode($donnees['date_enregistrement']);
            $id_service = utf8_decode($donnees['id_service']);
        }
        echo "{
					\"num_collecte\":\"$num_collecte\",
							\"id_user\":\"$id_user\",
							\"code_contribuable\":\"$code_contribuable\",
							\"matricule_collecteur\":\"$matricule_collecteur\",
							\"montant_paye\":\"$montant_paye\",
							\"date_paye\":\"$date_paye\",
							\"annee_paye\":\"$annee_paye\",
							\"date_enregistrement\":\"$date_enregistrement\",
							\"id_service\":\"$id_service\"}";

        $stmt->closeCursor();
    }

    //FIN TRAITEMENT DE SELECTION

    if(($_POST['action'])== "SELECTCOL") {

        $select = "SELECT
								collecteur.matricule_collecteur,
								collecteur.nom,
								collecteur.prenom
								FROM
								collecteur
								WHERE
								collecteur.matricule_collecteur='".$matricule_col."'";
        $resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $matricule_collecteur = utf8_decode($donnees['matricule_collecteur']);
            $nom = utf8_decode($donnees['nom']);
            $prenom = utf8_decode($donnees['prenom']);
            $collecteur =$nom.'   '.$prenom;

        }
        echo "{
			                \"collecteur\":\"$collecteur\",
							\"matricule_collecteur\":\"$matricule_collecteur\",
							\"num_bon_commande\":\"$num_bon_commande\"
							}";

        $stmt->closeCursor();
    }
    //FIN REQUETE SELECT COLLECTEUR

    //Seppression d'une ligne de la table temporaire
    if(($_POST['action'])== "SELECTALL") {
        $numsticker = htmlspecialchars($_POST['numsticker']);
        //echo"je suis le numero".$numsticker;
        $select = "SELECT
									sticker.id_sticker,
									sticker.code_type_sticker,
									sticker.num_collecte,
									sticker.isused,
									sticker.num_sticker,
									sticker.montant_sticker
									FROM
									sticker
									WHERE sticker.num_sticker='".$numsticker."'";
        $resultat = $DBcon->query($select) or die(print_r($DBcon->errorInfo()));
        // résultats
        $donnees = array();
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // je remplis un tableau et mettant l'id en index (que ce soit pour les classe ou les types)
            //$rows[] = utf8_encode($donnees);
            $V_id_sticker = utf8_decode($donnees['id_sticker']);
            $V_num_collecte= utf8_decode($donnees['num_collecte']);
            $V_code_type_sticker = utf8_decode($donnees['code_type_sticker']);
            $V_isused = utf8_decode($donnees['isused']);
            $V_num_sticker = utf8_decode($donnees['num_sticker']);
            $V_montant_sticker = utf8_decode($donnees['montant_sticker']);
        }
        echo "{
						\"id_sticker\":\"$V_id_sticker\",
							\"num_collecte\":\"$V_num_collecte\",
							\"code_type_sticker\":\"$V_code_type_sticker\",
							\"isused\":\"$V_isused\",
							\"montant_sticker\":\"$V_montant_sticker\"}";
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
        echo "{
			        \"regie\":\"$regie\",
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