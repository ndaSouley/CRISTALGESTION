    
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
							Count(bien.id_bien) as nbre_bien,
							bien.disponiblite
							FROM
							bien
							WHERE bien.disponiblite=1 and bien.id_charge=1";
			
										
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
			
			$nbre_bien = utf8_decode($row['nbre_bien']);
			
		}
	}
 
 ?>
   <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header" align="center">NOMBRE TOTAL DE BIEN OCCUPE<?php echo(' ' . $nbre_bien);?></h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES LOCATAIRES </h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date Créa</th>
                              <th>Code Proprietaire</th>
                              <th>Nom complet</th>
                                <th>Téléphone</th>
                              <th>Type Bien </th>
                              <th>Categ. Bien </th>
                              <th>Nbre de pièces </th>
                              <th>Localité</th>
                              <th>Loyer</th>
                               <th>Action</th>
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
							categorie_bien.id_type_bien,
							proprietaire.id_proprietaire,
							proprietaire.initial_proprietaire
							FROM
							bien
							INNER JOIN commission ON bien.id_commission = commission.id_commission
							INNER JOIN commune ON bien.id_commune = commune.id_commune
							INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
							INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
							INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
							INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
							INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien
							INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
							WHERE
							 bien.id_charge=1


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
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$id_type_bien = utf8_encode($row['id_type_bien']);
			$id_nbre_piece = utf8_encode($row['id_nbre_piece']);
			$libelle_type_bien = utf8_encode($row['libelle_type_bien']);
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$libelle_categorie_commune = utf8_encode($row['libelle_categorie_commune']);
			$disponiblite = utf8_encode($row['disponiblite']);
			$loyer_agence = utf8_encode($row['loyer_agence']);
			$libelle_categorie_bien = utf8_encode($row['libelle_categorie_bien']);
			$initial_proprietaire = utf8_encode($row['initial_proprietaire']);
			$loyer_proprietaire_ok = utf8_encode($row['loyer_proprietaire']);
			
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
				 //$dispoinibilite='Disponible';
				 //$V_localite=$libelle_categorie_commune .' ' .$localite;
?>
			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                  <td><?php echo $initial_proprietaire; ?></td>
                   <td><?php echo $nom_complet; ?></td>
                    <td><?php echo $telephone_locataire; ?></td>
                    <td><?php echo $libelle_type_bien; ?></td>
                  <td><?php echo $libelle_categorie_bien; ?></td>
                  <td><?php echo $Nbre_pieces; ?></td>
                    <td><?php echo $quartier_bien; ?></td>
                    <td><?php echo number_format($prix_bien); ?></td>
                <!--<td><button name="BoutonDetail" type="button" onclick="('<?php echo $V_id_bien; ?>')" class="btn btn-success" id="myBtn">Détail</button></td>-->
                <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $V_id_bien; ?>')" class="btn btn-success" id="sortir">Travaux</button></td>
              
                  
                  
				  
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