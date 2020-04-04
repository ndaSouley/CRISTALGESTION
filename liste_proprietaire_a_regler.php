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


			$query = "SELECT
							Count(proprietaire.id_proprietaire) AS nbre_proprietaire
							FROM
							proprietaire
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
			
			$nbre_proprietaire = utf8_decode($row['nbre_proprietaire']);
			
		}
	}
	//$date_jour_1 = date('m')-1;
	$date_jour_1 = '11';
	
	$query = "SELECT
					bien.id_bien,
					bien.id_proprietaire,
					bien.quartier_bien,
					bien.id_locataire,
					bien.num_appartement,
					locataire.id_locataire,
					locataire.nom_locataire,
					locataire.prenoms_locataire,
					locataire.telephone_locataire,
					proprietaire.id_proprietaire,
					proprietaire.initial_proprietaire,
					reglement_locataire.id_reglement,
					reglement_locataire.id_annee,
					reglement_locataire.id_locataire,
					reglement_locataire.id_proprietaire,
					reglement_locataire.id_bien,
					reglement_locataire.date_reglement,
					reglement_locataire.Loyer_locataire,
					reglement_locataire.Id_mode_paiement,
					reglement_locataire.id_mois,
					annee.id_annee,
					annee.annee,
					mode_reglement.id_mode_reglement,
					mode_reglement.Libelle_mode_reglement,
					bien.id_categorie_bien,
					categorie_bien.id_categorie_bien,
					categorie_bien.libelle_categorie_bien,
					categorie_bien.id_type_bien,
					bien.id_type_bien,
					commune.id_commune,
					commune.libelle_categorie_commune,
					bien.id_commune,
					proprietaire.nom_proprietaire,
					proprietaire.prenoms,
					Sum(bien.loyer_proprietaire) AS loyer_regle
					FROM
										bien
										INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
										INNER JOIN categorie_bien ON bien.id_categorie_bien = categorie_bien.id_categorie_bien
										INNER JOIN commune ON bien.id_commune = commune.id_commune
										INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire ,
										reglement_locataire ,
										annee ,
										mode_reglement
					WHERE annee.id_annee=reglement_locataire.id_annee
										AND reglement_locataire.id_locataire= locataire.id_locataire
										AND reglement_locataire.Id_mode_paiement= mode_reglement.id_mode_reglement
										AND reglement_locataire.id_mois='12'

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
			
			
			$Montant_total_loyer = utf8_decode($row['loyer_regle']);
			
			
			
		}
		 }
		 
		 
		 
		
 
 ?>
   
    <div class="row">
        <div class="col-lg-12">
            <h4 class="page-header" align="center"><!--TOTAL LOCATAIRE--><?php //echo(' ' . $nbre_proprietaire);?></h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
            
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES PROPRIETAIRES A REGLER  </h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              
                              <th>Code Proprietaire</th>
                              <th>Nom Proriétaire</th>
                              <th>Télephone </th>
                              <th>Nbre de Bien réglé</th>
                              <!--<th>Charges</th>-->
                              <th>Montant total </th>
                              <th>Mois</th>
                              <th>Action</th>
                              
                               <!-- <th>Imprimer</th>
                                <th>Modifier</th>-->
                            
                            </tr>
                        </thead>
                        <tbody>
<?php

//include('dbconnexion.php');


			$query = "SELECT
							proprietaire.contact,
							bien.id_bien,
							bien.prix_bien,
							bien.id_proprietaire,
							Sum(bien.loyer_proprietaire) AS somme_loyer_proprietaire,
							bien.id_locataire,
							Count(locataire.id_locataire) AS Nbre_locataire,
							proprietaire.id_proprietaire,
							proprietaire.nom_proprietaire,
							proprietaire.prenoms,
							reglement_locataire.id_reglement,
							reglement_locataire.id_locataire,
							reglement_locataire.id_proprietaire,
							Count(reglement_locataire.id_bien) nbre_bien_regle,
							reglement_locataire.id_mois,
							proprietaire.initial_proprietaire
							FROM
																					bien
																					INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
																					INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire ,
																					reglement_locataire
							WHERE reglement_locataire.id_proprietaire=proprietaire.id_proprietaire 
																					and  reglement_locataire.id_bien=bien.id_bien 
																					AND locataire.id_locataire=reglement_locataire.id_locataire 
																					AND reglement_locataire.id_mois='12'
							GROUP BY
							proprietaire.id_proprietaire
							
							
														 
							
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
			
			$id_proprietaire = utf8_decode($row['id_proprietaire']);
			$contact = utf8_decode($row['contact']);
			$initial_proprietaire = utf8_decode($row['initial_proprietaire']);
			$nom_proprietaire = utf8_decode($row['nom_proprietaire']);
			$nbre_bien_regle = utf8_decode($row['nbre_bien_regle']);
			$prenoms = utf8_decode($row['prenoms']);
			$nom_compte_proprietaire=$nom_proprietaire . ' ' .$prenoms;
			$Nbre_locataire_regle = utf8_decode($row['Nbre_locataire']);
			$somme_loyer_proprietaire = utf8_decode($row['somme_loyer_proprietaire']);
			$id_mois = utf8_decode($row['id_mois']);
			
			
			
?>
			
		<tr>       
                  <td><?php echo $initial_proprietaire; ?></td>
                  <td><?php echo $nom_compte_proprietaire; ?></td>
                   <td><?php echo $contact; ?></td>
                  <td><?php echo $nbre_bien_regle; ?></td>
                  <td><?php echo number_format($somme_loyer_proprietaire); ?></td>
                 
                   <td><?php if($id_mois=='01'){
					   echo ('Janvier');
					   
					   }elseif($id_mois=='02'){
						   
						   echo ('Février');
						  
						   }elseif($id_mois=='03'){
						   
						   echo ('Mars');
						   }elseif($id_mois=='04'){
						   
						   echo ('Avril');
						   }elseif($id_mois=='05'){
						   
						   echo ('Mai');
						   }elseif($id_mois=='06'){
						   
						   echo ('Juin');
						   }elseif($id_mois=='07'){
						   
						   echo ('Juillet');
						   }elseif($id_mois=='08'){
						   echo ('Août');
						   
						   }elseif($id_mois=='09'){
						   
						   echo ('Septembre');
						   }elseif($id_mois==10){
						   
						   echo ('Octobre');
						   }elseif($id_mois=='11'){
						   
						   echo ('Novembre');
						   }elseif($id_mois=='12'){
						   
						   echo ('Décembre');
						   } ?></td>
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen_OK_1('<?php echo $id_proprietaire; ?>')" class="btn btn-success" id="BoutonDetail">Détail</button></td>
                <a href="lien.html" target="_blank"></a>  
                
                </tr>
<?php								
	}
	 
	}
		
$mysqli->close();
	 
?>

	
                            
                      </tbody>
                       
                    </table>
                    <!-- /.table-responsive -->
                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th height="51" colspan="15"><strong><font size="5">Montant Total</font></strong></th>
                              
                               <th width="19%"><font size="5"><?php if($Montant_total_loyer==''){
								   
								   echo'0';
								   
								   }elseif($Montant_total_loyer!=''){
									   echo number_format($Montant_total_loyer);
									   
									   }?></font></th>
                               <!-- <th>Imprimer</th>
                                <th>Modifier</th>-->
                            
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
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
     function ouvrefen_OK(mat)
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
			
        $("#page-wrapper").load("detail_paiement.php");
		
    }
	
	 
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("locataire.php");
    });
	
    
    
</script>
    
>