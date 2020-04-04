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
	//$date_jour_1 = '11';
	$mois_en_cours = date('m');
			$anne_en_cours = date('y');
			if($anne_en_cours==20){
				
				$anne_en_cours_1=3;
				
				}
	
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
					Sum(reglement_locataire.Loyer_locataire)as loyer_regle,
					reglement_locataire.Id_mode_paiement,
					reglement_locataire.id_mois,
					annee.id_annee,
					annee.annee,
					mode_reglement.id_mode_reglement,
					mode_reglement.Libelle_mode_reglement,
					bien.id_categorie_bien,
					Sum(bien.frais_agence) AS MT_frais_agence,
					categorie_bien.id_categorie_bien,
					categorie_bien.libelle_categorie_bien,
					categorie_bien.id_type_bien,
					bien.id_type_bien,
					commune.id_commune,
					commune.libelle_categorie_commune,
					bien.id_commune
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
												AND reglement_locataire.id_mois='".$mois_en_cours."' 
												AND reglement_locataire.id_annee='".$anne_en_cours_1."'";
			
										
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">ETAT DES PAIEMENTS DU MOIS  </h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Date Enrg</th>
                              <th>Code Proprietaire</th>
                              <th>Nom Locataire</th>
                              <th>Télephone </th>
                              <th>Bien</th>
                              <th>N°Appart</th>
                              <th>Localite </th>
                              <th>Résidence</th>
                              <th>Mois</th>
                              <th>Moyen de paiement</th>
                              <th>Loyer</th>
                               <th>Action </th>
                               <th>Imprimer</th>
                                <!-- <th>Modifier</th>-->
                            
                            </tr>
                        </thead>
                        <tbody>
<?php

//include('dbconnexion.php');
$mois_en_cours_3='01';
$anne_en_cours_2='3';
			$query = "SELECT
							bien.id_bien,
							bien.id_type_bien,
							bien.id_commune,
							bien.quartier_bien,
							bien.id_proprietaire,
							bien.id_locataire,
							bien.id_categorie_bien,
							bien.num_appartement,
							categorie_bien.id_categorie_bien,
							categorie_bien.libelle_categorie_bien,
							categorie_bien.id_type_bien,
							locataire.id_locataire,
							locataire.nom_locataire,
							locataire.prenoms_locataire,
							locataire.telephone_locataire,
							proprietaire.id_proprietaire,
							proprietaire.initial_proprietaire,
							commune.id_commune,
							commune.libelle_categorie_commune,
							reglement_locataire.id_reglement,
							reglement_locataire.id_annee,
							reglement_locataire.id_locataire,
							reglement_locataire.id_proprietaire,
							reglement_locataire.id_bien,
							reglement_locataire.date_reglement,
							reglement_locataire.Loyer_locataire,
							reglement_locataire.Id_mode_paiement,
							reglement_locataire.id_mois,
							mode_reglement.id_mode_reglement,
							mode_reglement.Libelle_mode_reglement,
							annee.id_annee,
							annee.annee
							FROM
							bien
							INNER JOIN categorie_bien ON bien.id_categorie_bien = categorie_bien.id_categorie_bien
							INNER JOIN locataire ON bien.id_locataire = locataire.id_locataire
							INNER JOIN proprietaire ON bien.id_proprietaire = proprietaire.id_proprietaire
							INNER JOIN commune ON bien.id_commune = commune.id_commune ,
							reglement_locataire ,
							mode_reglement ,
							annee
							WHERE annee.id_annee=reglement_locataire.id_annee
												AND reglement_locataire.id_locataire= locataire.id_locataire
												AND reglement_locataire.Id_mode_paiement= mode_reglement.id_mode_reglement
												AND reglement_locataire.id_mois='".$mois_en_cours_3."' 
												AND reglement_locataire.id_annee='".$anne_en_cours_2."'"; 
							
						
			
										
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
			$quartier_bien = utf8_decode($row['quartier_bien']);
			$num_appartement = utf8_decode($row['num_appartement']);
			$libelle_categorie_bien = utf8_decode($row['libelle_categorie_bien']);
			$nom_locataire = utf8_decode($row['nom_locataire']);
			$prenoms_locataire = utf8_decode($row['prenoms_locataire']);
			$nom_compte_locataire=$nom_locataire . ' ' .$prenoms_locataire;
			$telephone_locataire = utf8_decode($row['telephone_locataire']);
			$initial_proprietaire = utf8_decode($row['initial_proprietaire']);
			$Loyer_locataire = utf8_decode($row['Loyer_locataire']);
			$libelle_categorie_commune = utf8_decode($row['libelle_categorie_commune']);
			$id_mois = utf8_decode($row['id_mois']);
			$Libelle_mode_reglement = utf8_decode($row['Libelle_mode_reglement']);
			$annee = utf8_decode($row['annee']);
			
			$date_enregistrement = utf8_encode($row['date_reglement']);
			// Code pour formater une dans y-m-d en -d-m-y
                  $newDate = date("d-m-Y H:i:s", strtotime($date_enregistrement));
				 //$date_doc = date("d-m-Y H:i:s", strtotime($date_doc));
?>
			
		<tr>       
                  <td><?php echo $newDate; ?></td>
                  <td><?php echo $initial_proprietaire; ?></td>
                   <td><?php echo $nom_compte_locataire; ?></td>
                  <td><?php echo $telephone_locataire; ?></td>
                  <td><?php echo $libelle_categorie_bien; ?></td>
                  <td><?php echo $num_appartement; ?></td>
                  <td><?php echo $libelle_categorie_commune; ?></td>
                  <td><?php echo $quartier_bien; ?></td>
                  <td><?php 
				   
				   		if($id_mois=='01'){
					   			echo 'Janvier'. ' ' . $annee;
					   
					   	}elseif($id_mois=='02'){
							echo 'Fevrier' . ' ' . $annee;
							
							}elseif($id_mois=='03'){
							echo 'Mars'. ' ' . $annee;
							
							}elseif($id_mois=='04'){
							echo 'Avril'. ' ' . $annee;
							
							}elseif($id_mois=='05'){
							echo 'Mai'. ' ' . $annee;
							
							}elseif($id_mois=='06'){
							echo 'Juin'. ' ' . $annee;
							
							}elseif($id_mois=='07'){
							echo 'Juillet'. ' ' . $annee;
							
							}elseif($id_mois=='08'){
							echo 'Août'. ' ' . $annee;
							
							} elseif($id_mois=='09'){
							echo 'Septembre'. ' ' . $annee;
							
							}elseif($id_mois=='10'){
							echo 'Octobre'. ' ' . $annee;
							
							}elseif($id_mois=='11'){
							echo 'Novrembre'. ' ' . $annee;
							
							}elseif($id_mois=='12'){
							echo 'Decembre'. ' ' . $annee;
							
							}?></td>
                            
                   <td><?php echo $Libelle_mode_reglement; ?></td>
                   <td><?php echo number_format($Loyer_locataire) . ' FCFA  '; ?></td>
                   
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen_OK('<?php echo $V_id_bien; ?>')" class="btn btn-success" id="BoutonDetail">Détail</button></td>
                  <td> <a href="quitance_mois.php?Id_bien_envoye=<?php echo($V_id_bien);?>" target="_bloank"><button name="BoutonDetail" type="button"  class="btn btn-success" id="BoutonDetail" ><img src="css/images/imprimante.png" alt="Image de modification" width="35" height="35"></button></a></td>
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
    
