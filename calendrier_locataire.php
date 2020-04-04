<?php
session_start();
 $V_id_user=$_SESSION['TaxeUserData'][0]['id_user'];

if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}




?>

    <div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">CALENDRIER DE PAIE DU LOCATAIRE</h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class='panel-body'>
                    <table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                        <thead>
                            <tr>
                              <th>Janvier</th>
                              <th>Fivrier</th>
                                <th>Mars</th>
                              <th>Avril </th>
                              <th>Mai</th>
                              <th>Juin</th>
                              <th>Juillet</th>
                              <th>Août</th>
                              <th>Septembre</th>
                              <th>Octobre</th>
                              <th>Novembre</th>
                              <th>Decembre</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                          <input type="hidden" id="valeur_id">
                        
<?php


include('dbconnexion.php');
$valeur=$_GET['V_id_bien'];

echo'Valeur ' . $valeur;
  
			$query = "SELECT
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

							WHERE
							bien.disponiblite= 1

							";
			
										
				if (mysqli_connect_errno())
	{
		echo "[{\"ConnectError\":\"yes\"}]";
		//exit();
	}
	else
	{
		$mysqli->set_charset('utf8');

		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			
			$V_id_bien = utf8_decode($row['id_bien']);
			$id_type_bien = utf8_decode($row['id_type_bien']);
			$id_commune = utf8_decode($row['id_commune']);
			$prix_bien = utf8_decode($row['prix_bien']);
			$quartier_bien = utf8_decode($row['quartier_bien']);
			$id_proprietaire = utf8_encode($row['id_proprietaire']);
			$impot_foncier = utf8_encode($row['impot_foncier']);
			$Nbre_pieces = utf8_encode($row['libelle_piece']);
			$nom_locataire = utf8_encode($row['nom_locataire']);
			$prenoms = utf8_encode($row['prenoms_locataire']);
			
			$nom_complet=$nom_locataire . ' ' .$prenoms;
			$telephone_locataire = utf8_encode($row['telephone_locataire']);
			//$e_mail = utf8_encode($row['e_mail']);
			//$fonction = utf8_encode($row['fonction']);
			//$localite = utf8_encode($row['localite']);
			//$cni_proprietaire = utf8_encode($row['cni_proprietaire']);
			$id_type_bien = utf8_encode($row['id_type_bien']);
			$id_nbre_piece = utf8_encode($row['id_nbre_piece']);
			$libelle_type_bien = utf8_encode($row['libelle_type_bien']);
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$libelle_categorie_commune = utf8_encode($row['libelle_categorie_commune']);
			$disponiblite = utf8_encode($row['disponiblite']);
			$loyer_agence = utf8_encode($row['loyer_agence']);
			$libelle_categorie_bien = utf8_encode($row['libelle_categorie_bien']);
			
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
				 //$dispoinibilite='Disponible';
				 //$V_localite=$libelle_categorie_commune .' ' .$localite;
		 }
?>
			
		<tr>       
                 <td style="color:#006600";>Payé</td>
                  <td style="color:#006600";>Payé</td>
                   <td style="color:#006600";>Payé</td>
                   <td style="color:#006600";>Payé</td>
                 <td style="color:#006600";>Payé</td>
                  <td style="color:#006600";>Payé</td>
                   <td style="color:#006600";>Payé</td>
                    <td style="color:#FF0000";>Impayé</td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               <!-- <td><button name="BoutonDetail" type="button" onclick="('<?php //echo $V_id_bien; ?>')" class="btn btn-success" id="myBtn">Détail</button></td>-->
               <!-- <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php //echo $V_id_bien; ?>')" class="btn btn-success" id="sortir">Régler</button></td>
              -->
                  
                  
				  
                </tr>
<?php								
	
	}	
$mysqli->close();
	 
?>




                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>    
   
        
    $('#tbl1 button').click(function () {
        alert($(this).closest('table').attr('id'));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest('td').attr('id'));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }   

//CODE DE SUPPRESSION DU TABLEAU tempo_regie_bon
	   function delligne(mat)
    {
        var donnees = {action:"SUPPRESSION",id_tempo:mat};
         console.log('je suis dans la suppression');
		 console.log('{"action":"SUPPRESSION","id_tempo_bon_livre":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_bon_tresor.php",
                data: donnees,
                success : function(data) {      
                 console.log("Retour "+data.Id_temp);   
                }                       
                
            });
            
        $("#page-bon").load("liste_temporaire_bon_tresor.php");
        }
	

	
//Code de rappel des  données du tableau tempo_regie_bon
	   function selligne(mat)
    {
	   
        var donnees = {action:"SELECT",id_tempo2:mat};
        console.log('je suis dans la selection');
		  // console.log('je suis dans la selection');
		console.log('{"action":"SELECT","Matricule tresor":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_bon_tresor.php",
                data: donnees,
                success : function(data) { 
				console.log('je suis dans le update liste temporaire2'+data.valeur_unitaire_livraison);
				sessionStorage.V_gest_bon="2";
				
				//sessionStorage.regie = data.regie;
				//sessionStorage.id_tempo2 =data.id_tempo2;
				sessionStorage.id_tempo2 =mat;
			    sessionStorage.even = "UPDATE";
                sessionStorage.id_bon_tresor = data.id_bon_tresor;
				sessionStorage.id_user = data.id_user;
				sessionStorage.num_bon_commande = data.num_bon_commande;
			    sessionStorage.num_bon_livraison = data.num_bon_livraison;
                sessionStorage.agent_receptionnaire = data.agent_receptionnaire;
                sessionStorage.valeur_unitaire_commande = data.valeur_unitaire_commande;
                sessionStorage.plage_debut_sticker = data.plage_debut_sticker;
                sessionStorage.plage_fin_sticker = data.plage_fin_sticker;
                sessionStorage.valeur_unitaire_livree = data.valeur_unitaire_livree;
                sessionStorage.total_qte_commande = data.total_qte_commande;
				sessionStorage.valeur_unitaire_livraison = data.valeur_unitaire_livraison;
				sessionStorage.total_qte_livraison = data.total_qte_livraison;
				sessionStorage.date_bon_commande = data.date_bon_commande;
				sessionStorage.date_bon_livraison = data.date_bon_livraison;
				sessionStorage.date_operation = data.date_operation;
              }                       
                
            });
            
        $("#page-bon").load("bon_livraison_tresor.php");
    }
	
	

</script>