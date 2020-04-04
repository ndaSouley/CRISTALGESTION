    
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
							WHERE bien.disponiblite=1";
			
										
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES LOCATAIRES</h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date Créa</th>
                              <th>Code Proprietaire</th>
                              <th>Nom locataire</th>
                              <th>Type Bien</th>
                               <th>Residence</th>
                               <th>N° Appartement</th>
                              <th>Categ Bien</th>
                                <th>Nbre de Pièces</th>
                              <th>Localité </th>
                              <th>Loyer </th>
                              <th>Action 1</th>
                              <th>Action 2</th>
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
							bien.num_appartement,
							bien.parcelle,
							bien.date_enregistrement,
							bien.num_ncc,
							bien.id_charge,
							bien.id_commission,
							bien.num_appartement,
							commission.id_commission,
							commission.libelle_commission,
							commune.id_commune,
							commune.libelle_categorie_commune,
							nbre_piece.id_nbre_piece,
							nbre_piece.libelle_piece,
							proprietaire.id_proprietaire,
							proprietaire.nom_proprietaire,
							proprietaire.prenoms,
							proprietaire.contact,
							proprietaire.e_mail,
							proprietaire.fonction,
							proprietaire.localite,
							proprietaire.montant_impot,
							proprietaire.date_nais_proprietaire,
							proprietaire.lieu_nais_proprietaire,
							proprietaire.initial_proprietaire,
							proprietaire.cni_proprietaire,
							type_bien.id_type_bien,
							type_bien.libelle_type_bien,
							charge_bien.id_charge,
							charge_bien.libelle_charge,
							bien.loyer_proprietaire,
							bien.id_categorie_bien,
							bien.nom_immeuble,
							bien.id_charge_impot,
							bien.lot,
							bien.disponiblite,
							bien.ilot,
							bien.frais_agence,
							charge_impot.id_charge_impot,
							charge_impot.libelle_charge_impot,
							categorie_bien.id_categorie_bien,
							categorie_bien.libelle_categorie_bien,
							categorie_bien.id_type_bien,
							locataire.id_locataire,
							locataire.nom_locataire,
							locataire.prenoms_locataire,
							bien.id_locataire
							FROM
							bien
							INNER JOIN commission ON bien.id_commission = commission.id_commission
							INNER JOIN commune ON bien.id_commune = commune.id_commune
							INNER JOIN nbre_piece ON bien.id_nbre_piece = nbre_piece.id_nbre_piece
							INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
							INNER JOIN type_bien ON bien.id_type_bien = type_bien.id_type_bien
							INNER JOIN charge_bien ON bien.id_charge = charge_bien.id_charge
							INNER JOIN charge_impot ON bien.id_charge_impot = charge_impot.id_charge_impot
							INNER JOIN categorie_bien ON categorie_bien.id_type_bien = type_bien.id_type_bien AND bien.id_categorie_bien = categorie_bien.id_categorie_bien ,
							locataire
							where disponiblite='1' and locataire.id_locataire=bien.id_locataire
							ORDER BY bien.quartier_bien ASC";
						
			
										
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
			$nom_proprietaire = utf8_encode($row['nom_proprietaire']);
			$initial_proprietaire = utf8_encode($row['initial_proprietaire']);
			$prenoms = utf8_encode($row['prenoms']);
			$nom_complet=$nom_proprietaire . ' ' .$prenoms;
			$contact = utf8_encode($row['contact']);
			$e_mail = utf8_encode($row['e_mail']);
			$fonction = utf8_encode($row['fonction']);
			$localite = utf8_encode($row['localite']);
			$cni_proprietaire = utf8_encode($row['cni_proprietaire']);
			$libelle_charge = utf8_encode($row['libelle_charge']);
			$id_type_bien = utf8_encode($row['id_type_bien']);
			$id_nbre_piece = utf8_encode($row['id_nbre_piece']);
			$libelle_type_bien = utf8_encode($row['libelle_type_bien']);
			$libelle_categorie_bien = utf8_encode($row['libelle_categorie_bien']);
			$loyer_proprietaire = utf8_encode($row['loyer_proprietaire']);
			$libelle_categorie_commune = utf8_encode($row['libelle_categorie_commune']);
			$disponiblite = utf8_encode($row['disponiblite']);
			$nom_locataire = utf8_encode($row['nom_locataire']);
			$prenoms_locataire = utf8_encode($row['prenoms_locataire']);
			$nom_complet_locataire=$nom_locataire . ' ' .$prenoms_locataire;
			$nom_immeuble = utf8_encode($row['nom_immeuble']);
			$num_appartement = utf8_encode($row['num_appartement']);
			
			$date_enregistrement = utf8_encode($row['date_enregistrement']);
			
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
				 //$dispoinibilite='Disponible';
				 $V_localite=$libelle_categorie_commune .' ' .$localite;
?>
			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                  <td><?php echo $initial_proprietaire; ?></td>
                   <td><?php echo $nom_complet_locataire; ?></td>
                   <td><?php echo $libelle_type_bien; ?></td>
                   <td><?php echo $nom_immeuble; ?></td>
                   <td><?php echo $num_appartement; ?></td>
                    <td><?php echo $libelle_categorie_bien; ?></td>
                    <td><?php echo $Nbre_pieces; ?></td>
                  <td><?php echo $quartier_bien; ?></td>
                  <td><?php echo number_format($prix_bien) . ' FCFA ' ; ?></td>
                 
                <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $V_id_bien; ?>')" class="btn btn-success" >Régler</button></td>
                 <td><button name="BoutonDetail" type="button" onclick="ouvrefen1('<?php echo $V_id_bien; ?>')" class="btn btn-success" >Caution</button></td>
                  
				  
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
    
   // var Vid_bien = 'je suis la';
    
        var donnees = {action:"REQUET_selecte_locataire",V_id_bien:mat}; 
        console.log('{"action":"REQUET_selecte_locataire","V_id_bien":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_reglement_locataire.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+data.Vid_bien);
			    sessionStorage.id_bien = mat;
                sessionStorage.even = "UPDATE";
						
					// CALENDRIER DE PAIE
					
						sessionStorage.Janvier = data.Janvier;
						sessionStorage.Fevrier = data.Fevrier;
						sessionStorage.Mars = data.Mars;
						sessionStorage.Avril = data.Avril;
						sessionStorage.Mai = data.Mai;
						sessionStorage.Juin = data.Juin;
						sessionStorage.Juillet = data.Juillet;
						sessionStorage.Aout = data.Aout;
						sessionStorage.Septembre = data.Septembre;
						sessionStorage.Octobre = data.Octobre;
						sessionStorage.Novembre = data.Novembre;
						sessionStorage.Decembre = data.Decembre;
						sessionStorage.id_annee = data.id_annee;
						
						// CALENDRIER DE PAIE
						
						sessionStorage.loyer_proprietaire = data.loyer_proprietaire;
						
						console.log('retour bon =  '+data.nom_locataire);
						
						sessionStorage.id_bien = data.id_bien;
						sessionStorage.Var_mt_total_travaux = data.Var_mt_total_travaux;
						sessionStorage.mois_travaux = data.mois_travaux;
						sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
						sessionStorage.charge_regle = data.charge_regle;
						sessionStorage.prix_bien = data.prix_bien;
						sessionStorage.nom_locataire = data.nom_locataire;
						sessionStorage.prenoms_locataire = data.prenoms_locataire;
						sessionStorage.id_charge = data.id_charge;
						sessionStorage.mt_total_travaux = data.Var_mt_total_travaux;
						sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
						sessionStorage.mois_travaux = data.mois_travaux;
						sessionStorage.charge_regle = data.charge_regle;
						
          			
                }                       
                
            });
			
			 

            
        $("#page-wrapper").load("reglement_locataire.php");
		
		//top.document.location = "calendrier_locataire.php?w="+reglement;
    }
	
	 function ouvrefen1(mat)
    {
    
   // var Vid_bien = 'je suis la';
    
        var donnees = {action:"REQUET_selecte_locataire",V_id_bien:mat}; 
        console.log('{"action":"REQUET_selecte_locataire","V_id_bien":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_reglement_locataire.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+data.Vid_bien);
			    sessionStorage.id_bien = mat;
                sessionStorage.even = "UPDATE";
						
					// CALENDRIER DE PAIE
					
						sessionStorage.Janvier = data.Janvier;
						sessionStorage.Fevrier = data.Fevrier;
						sessionStorage.Mars = data.Mars;
						sessionStorage.Avril = data.Avril;
						sessionStorage.Mai = data.Mai;
						sessionStorage.Juin = data.Juin;
						sessionStorage.Juillet = data.Juillet;
						sessionStorage.Aout = data.Aout;
						sessionStorage.Septembre = data.Septembre;
						sessionStorage.Octobre = data.Octobre;
						sessionStorage.Novembre = data.Novembre;
						sessionStorage.Decembre = data.Decembre;
						
						// CALENDRIER DE PAIE
						
						sessionStorage.loyer_proprietaire = data.loyer_proprietaire;
						
						console.log('retour bon =  '+data.nom_locataire);
						
						sessionStorage.id_bien = data.id_bien;
						sessionStorage.Var_mt_total_travaux = data.Var_mt_total_travaux;
						sessionStorage.mois_travaux = data.mois_travaux;
						sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
						sessionStorage.charge_regle = data.charge_regle;
						sessionStorage.prix_bien = data.prix_bien;
						sessionStorage.nom_locataire = data.nom_locataire;
						sessionStorage.prenoms_locataire = data.prenoms_locataire;
						sessionStorage.id_charge = data.id_charge;
						sessionStorage.mt_total_travaux = data.Var_mt_total_travaux;
						sessionStorage.ID_LOCATAIRE_Charge = data.ID_LOCATAIRE_Charge;
						sessionStorage.mois_travaux = data.mois_travaux;
						sessionStorage.charge_regle = data.charge_regle;
						
          			
                }                       
                
            });
			
			 

            
        $("#page-wrapper").load("reglement_nouveau_locataire.php");
		
		//var reglement=1;
		//var h = screen.height;
		
		//top.document.location = "calendrier_locataire.php?w="+reglement;
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("locataire.php");
    });
	
 </script>