    
   <?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];
?>

    <?php
 
 include('dbconnexion.php');


			$query = "SELECT DISTINCT
									Count(charge.id_charge) as nbre_charge
									FROM
									charge";
							
										
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
			
			$nbre_charge = utf8_decode($row['nbre_charge']);
			
		}
	}
 
 ?>
   
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header" align="center">NOMBRE TOTAL DE TRAVAUX<?php echo(' ' . $nbre_charge);?></h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES CHARGES </h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date démarrage</th>
                               <th>Code Proprietaire</th>
                              <th>Locataire</th>
                                <th>Téléphone</th>
                              <!--<th>Type Bien </th>-->
                              <th> Bien </th>
                              <th>Nbre de pièces </th>
                              <th>Localité</th>
                               <th>Prise en Charge</th>
                              <th>Mt Travaux</th>
                              <!--<th>Commission Cristal</th>-->
                              <th>Description</th>
                               
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');


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
							commune.id_commune,
							commune.libelle_categorie_commune,
							nbre_piece.id_nbre_piece,
							nbre_piece.libelle_piece,
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
							categorie_bien.id_type_bien,
							charge.id_charge,
							charge.id_bien,
							charge.id_proprietaire,
							charge.id_locataire,
							charge.prix_reparation,
							charge.id_commission,
							charge.description_charge,
							charge.date_enregistrement,
							charge.date_travaux,
							charge.mt_total_travaux,
							charge.id_responssabilite,
							responssabilite.id_responssabilite,
							responssabilite.libelle_responssabilite,
							proprietaire.id_proprietaire,
							proprietaire.initial_proprietaire,
							proprietaire.nom_proprietaire,
							proprietaire.prenoms
							FROM
							bien
							INNER JOIN commune ON bien.id_commune = commune.id_commune
							INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
							INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
							INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
							INNER JOIN categorie_bien ON bien.id_categorie_bien = categorie_bien.id_categorie_bien
							INNER JOIN charge ON charge.id_bien = bien.id_bien AND charge.id_locataire = locataire.id_locataire
							INNER JOIN responssabilite ON charge.id_responssabilite = responssabilite.id_responssabilite
							INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire AND charge.id_proprietaire = proprietaire.id_proprietaire
							
															
							
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
			//$id_type_bien = utf8_decode($row['id_type_bien']);
			$id_commune = utf8_decode($row['id_commune']);
			$prix_bien = utf8_decode($row['prix_bien']);
			$quartier_bien = utf8_decode($row['quartier_bien']);
			$id_proprietaire = utf8_encode($row['id_proprietaire']);
			$impot_foncier = utf8_encode($row['impot_foncier']);
			$Nbre_pieces = utf8_encode($row['libelle_piece']);
			$prix_reparation = utf8_encode($row['prix_reparation']);
			$nom_locataire = utf8_encode($row['nom_locataire']);
			$prenoms = utf8_encode($row['prenoms_locataire']);
			
			$nom_complet=$nom_locataire . ' ' .$prenoms;
			$telephone_locataire = utf8_encode($row['telephone_locataire']);
			//$e_mail = utf8_encode($row['e_mail']);
			//$fonction = utf8_encode($row['fonction']);
			//$localite = utf8_encode($row['localite']);
			//$cni_proprietaire = utf8_encode($row['cni_proprietaire']);
			$id_type_bien = utf8_encode($row['id_type_bien']);
			$libelle_responssabilite = utf8_encode($row['libelle_responssabilite']);
			
			$nom_proprietaire = utf8_encode($row['nom_proprietaire']);
			$prenoms = utf8_encode($row['prenoms']);
			$initial_proprietaire = utf8_encode($row['initial_proprietaire']);
			
			$proprietaire=$nom_proprietaire . ' ' . $prenoms;
			
			$id_nbre_piece = utf8_encode($row['id_nbre_piece']);
			//$libelle_type_bien = utf8_encode($row['libelle_type_bien']);
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$libelle_categorie_commune = utf8_encode($row['libelle_categorie_commune']);
			$disponiblite = utf8_encode($row['disponiblite']);
			$loyer_agence = utf8_encode($row['loyer_agence']);
			$libelle_categorie_bien = utf8_encode($row['libelle_categorie_bien']);
			$mt_total_travaux = utf8_encode($row['mt_total_travaux']);
			$V_commission=$prix_reparation-$mt_total_travaux;
			$description_charge = utf8_encode($row['description_charge']);
			$date_travaux = utf8_encode($row['date_travaux']);
			 $date_travaux_ok = date("d-m-Y", strtotime($date_travaux));
			
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
				 //$dispoinibilite='Disponible';
				 //$V_localite=$libelle_categorie_commune .' ' .$localite;
?>
			
		<tr>       
                  <td><?php echo $date_travaux_ok; ?></td>
                  <td><?php echo $initial_proprietaire; ?></td>
                   <td><?php echo $nom_complet; ?></td>
                   <td><?php echo $telephone_locataire; ?></td>
                  	<td><?php echo $libelle_categorie_bien; ?></td>
                  	<td><?php echo $Nbre_pieces; ?></td>
                    <td><?php echo $quartier_bien; ?></td>
                    <td><?php echo $libelle_responssabilite; ?></td>
                    <td><?php echo $prix_reparation; ?></td>
                    <td><?php echo $description_charge; ?></td>
                
				  
                </tr>
<?php								
	}
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
    $(document).ready(function() {
         $('#dataTables-example').DataTable({
            responsive: true,
              "language": {
                "search":       "Recherche:",
                "sZeroRecords" : "Aucun enregistrements correspondants trouvés",
                "sEmptyTable" : "Aucune donnée disponible",
                "paginate": {
                  "first":      "First",
                  "last":       "Last",
                  "next":       "Suivant",
                  "previous":   "Précédent"
    }
  }
        });

    });
      
	      
    $("#tbl1 button").click(function () {
        alert($(this).closest("table").attr("id"));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest("td").attr("id"));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }
    
    
    function ouvrefen(mat)
    {
    
    //var mat = mle;
    
        var donnees = {action:"REQUETE_SORTIE",V_id_bien:mat}; 
        console.log('{"action":"REQUETE_SORTIE","V_id_bien":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_proprietaire.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.id_bien = mat;
                sessionStorage.even = "UPDATE";
						
						
		             	sessionStorage.loyer_proprietaire = data.loyer_proprietaire;
						sessionStorage.frais_agence = data.frais_agence;
						sessionStorage.id_commune = data.id_commune;
						sessionStorage.id_commission = data.id_commission;
						sessionStorage.libelle_commission = data.libelle_commission;
						sessionStorage.libelle_categorie_commune = data.libelle_categorie_commune;
						sessionStorage.id_bien = data.id_bien;
						sessionStorage.id_nbre_piece = data.id_nbre_piece;
						sessionStorage.libelle_piece = data.libelle_piece;
          				sessionStorage.prix_bien = data.prix_bien;
          				sessionStorage.quartier_bien = data.quartier_bien;
          				sessionStorage.impot_foncier = data.impot_foncier;
          				sessionStorage.loyer_percu = data.loyer_percu;
                 	    sessionStorage.Nbre_pieces = data.Nbre_pieces;
          				sessionStorage.description = data.description;
          				sessionStorage.nom_proprietaire = data.nom_proprietaire;
          				sessionStorage.prenoms = data.prenoms;
						sessionStorage.contact = data.contact;
						sessionStorage.e_mail = data.e_mail;
						sessionStorage.fonction = data.fonction;
						sessionStorage.localite = data.localite;
						sessionStorage.num_ncc = data.num_ncc;
						sessionStorage.date_nais_proprietaire = data.date_nais_proprietaire;
						sessionStorage.lieu_nais_proprietaire = data.lieu_nais_proprietaire;
						sessionStorage.cni_proprietaire = data.cni_proprietaire;
						sessionStorage.id_type_bien = data.id_type_bien;
						sessionStorage.libelle_type_bien = data.libelle_type_bien;
						sessionStorage.libelle_charge = data.libelle_charge;
						sessionStorage.id_charge = data.id_charge;
						
							 
							 sessionStorage.id_locataire = data.id_locataire;
							  sessionStorage.nom_locataire = data.nom_locataire;
							   sessionStorage.prenoms_locataire = data.prenoms_locataire;
							    sessionStorage.date_nais_locataire = data.date_nais_locataire;
								 sessionStorage.lieu_nais_locataire = data.lieu_nais_locataire;
								 sessionStorage.telephone_locataire = data.telephone_locataire;
								 sessionStorage.num_cni_sejour = data.num_cni_sejour;
								 sessionStorage.fonction_locataire = data.fonction_locataire;
								 sessionStorage.e_maill_locataire = data.e_maill_locataire;
						
						//Test d'affichage des données
                   console.log('je suis le téléphone 1 dans la liste utilisateur'+data.id_bien);
          			
                }                       
                
            });
            
        $("#page-wrapper").load("charge_travaux.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("locataire.php");
    });
	
    
    
</script>