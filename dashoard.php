
  
                            <?php

include('dbconnexion.php');

		
			$mois_en_cours = date('m');
			//$mois_en_cours =01;
			$anne_en_cours = date('y');
			if($anne_en_cours==20){
				
				$anne_en_cours_1=3;
				
				}
			
			$query7 = "SELECT
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
								Sum(reglement_locataire.Loyer_locataire)as loyer_mois,
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

		$result = $mysqli->query($query7);
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			
			$V_loyer_mois = utf8_decode($row['loyer_mois']);
			$V_MT_frais_agence = utf8_decode($row['MT_frais_agence']);
			
			
			
		}
		 }
		 
		//echo'Année en cours' .$anne_en_cours;
  
			$query = "SELECT
							Count(proprietaire.id_proprietaire) as nbre_proprietaire
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
		
		// TRAITEMENT DES LOCATAIRES IMPAYER 2019//
		
		$query = "SELECT
							Sum(bien.prix_bien) as montant_impayer
							FROM bien
							WHERE
							id_locataire in (
							SELECT id_locataire from locataire where id_locataire not in (
							SELECT
							id_locataire
							FROM
							calendrier_paie
							WHERE id_annee  = 2)
							and id_locataire in (
							SELECT id_locataire from bien)
							)
							
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
			
			$V_montant_impayer = utf8_decode($row['montant_impayer']);
			
			
		}
	}
		
		//**********************FIN**************************//
		
		
		
		 }
		 
		 
		 $query = "SELECT
						Count(locataire.id_locataire) as nbre_locataire
						FROM
						locataire
							
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
			
			$nbre_locataire = utf8_decode($row['nbre_locataire']);
			
			
		}
		 }
		 
		  $query = "SELECT
							Count(bien.id_bien) as nbre_bien_occupe,
							bien.disponiblite,
							bien.id_locataire
							FROM
							bien
							WHERE
							bien.disponiblite = 1 and bien.id_locataire!=''
							GROUP BY
							bien.disponiblite
																				
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
			
			$nbre_bien_occupe = utf8_decode($row['nbre_bien_occupe']);
			
			
			
		}
		 }
		   $query = "SELECT
						Count(bien.id_bien) as nbre_bien_dispo,
						bien.disponiblite
						FROM
						bien
						WHERE
						bien.disponiblite = 0
						GROUP BY
						bien.disponiblite
													
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
			
			$nbre_bien_dispo = utf8_decode($row['nbre_bien_dispo']);
			
			
			
		}
		 }
		 
		 $query = "SELECT
						Sum(bien.prix_bien) AS total_loyer,
						bien.disponiblite
						FROM
						bien
						WHERE 
						bien.disponiblite = 1

													
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
			
			
			$total_loyer = utf8_decode($row['total_loyer']);
			
			
		}
		 }
		 
		 $query = "SELECT
						charge.id_charge,
						charge.id_bien,
						charge.id_proprietaire,
						charge.id_locataire,
						charge.prix_reparation,
						charge.id_commission,
						Sum(charge.mt_total_travaux) as montant_charge,
						charge.id_responssabilite
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
			
			
			$montant_charge = utf8_decode($row['montant_charge']);
			
			
		}
		 }
		 
		 $date_jour = date('Y-m-d');
		 
		//$date_jour= date('d');
	
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
					reglement_locataire.date_dernier_versement ,
					reglement_locataire.id_mois,
					Sum(reglement_locataire.Mt_restant_loyer)as loyer_regle,
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
												AND reglement_locataire.date_dernier_versement='".$date_jour."'
													
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

<?php

//include('dbconnexion.php');
//$mois_en_cours_3='05';
$anne_en_cours_2='3';
			  $date_expire = '2019/01/01 00:00:00';    
			$date_debut = new DateTime($date_expire);
			$date_fin = new DateTime();
			$interval_mois = $date_debut->diff($date_fin)->format("%m");
			$interval_annee = $date_debut->diff($date_fin)->format("%y");
			$diff_total = $interval_annee*12 + $interval_mois;
			$donnees = array();
				
				class Locataire{
					public $id_locataire;
					public $nom_locataire;
					public $prenoms_locataire;
					public $date_nais_locataire;
					public $lieu_nais_locataire;	
					public $telephone_locataire;
					public $num_cni_sejour;
					public $fonction_locataire;
					public $e_maill_locataire;
					public $date_sortie;
					public $date_entree_locataire;
					public $prix_bien;
					public $Montant_total_impaye;
				}
				
				$liste_locataires = array();
			    $id_annee = 2;
				$id_mois = 0;
				$str_mois = "";
			
			
			
			for ($i =0; $i <= $diff_total; $i++) {
				/*$date = $date_debut;
				$date->$date_debut.('+'.$i.' months'); // or you can use '-90 day' for deduct
				$date = $date->format('Y-m-d h:i:s');
                echo $date. "<br>";*/
				$id_mois = $id_mois + 1;
				if($id_mois<10)
				{
					$str_mois = '0'.$id_mois;
				}
				else
				{
					$str_mois =$id_mois;
				}
				if($id_mois>12) {
					$id_mois = 1;
					$str_mois = "01";
					$id_annee = $id_annee +1;
				}
				
				$effectiveDate = date('Y-m-d', strtotime($i." months",  strtotime('2019/01/01'))) . "<br>";
  		      //echo $effectiveDate;
			  
			 /* $query = "SELECT * from locataire where date_entree_locataire<='".$effectiveDate."'";*/
			    $query = "SELECT
								locataire.id_locataire,
								locataire.nom_locataire,
								locataire.prenoms_locataire,
								bien.id_locataire AS identifiant_locataire,
								Sum(bien.prix_bien) As Montant_total_impaye
								from
								locataire 
								inner join bien on bien.id_locataire = locataire.id_locataire where locataire.date_entree_locataire<='".$effectiveDate."'";
			  
			
										
				if (mysqli_connect_errno())
					{
						echo "[{\"ConnectError\":\"yes\"}]";
						//exit();
					}
	else
	{
		
		$mysqli->set_charset('utf8');

		$result = $mysqli->query($query);
		   $liste_id = array();			
		while($donnees = $result->fetch_array(MYSQLI_ASSOC))
		{
			//$rows[] = utf8_encode($donnees);
						
					/*$loc = new Locataire();
					$loc->id_locataire = utf8_decode($donnees['id_locataire']);
					$loc->nom_locataire = utf8_decode($donnees['nom_locataire']);
					$loc->prenoms_locataire = utf8_decode($donnees['prenoms_locataire']);*/
					$Montant_total_impaye= utf8_decode($donnees['Montant_total_impaye']);
					
					
					//array_push($liste_id, $loc);
				
				
		}
			/*echo json_encode($liste_id);*/
			
			/*foreach($liste_id as $valeur)
			{                
				
						  $req = "SELECT * from reglement_locataire where id_locataire='".$valeur->id_locataire."'
											AND id_annee ='".$id_annee."' and id_mois = '".$str_mois."'";
									
									
									$result_ok = $mysqli->query($req);
									if (mysqli_num_rows($result_ok)==0) {
										
										 
							}
									
								
							
						
	
			}
				*/
				
		
		}
		

	
	}

	 
?><head>
<link rel="stylesheet" href="css/popupform.css"/>
 <link rel="stylesheet" type="text/css" id="theme" href="css2/theme-default.css"/>
</head>



             





<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header " style="margin-top:10px;">TABLEAU DE BORD</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
         



               <div class="col-md-3">
                <a href="#" onClick="affiche('liste_proprietaire.php');">
    
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget bg-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-users"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?Php echo($nbre_proprietaire);?> </div>
                                    <div class="widget-title">TOTAL PROPRIETAIRE</div>
                                    
                                   
                                    <div class="widget-subtitle"></div>
                                </div>
                                <div class="widget-controls">                                
                                </div>                            
                            </div>       
                            </a>                     
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                       
                         <div class="col-md-3">
    						 <a href="#" onClick="affiche('liste_locataire1.php');">
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget alert-warning widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-users"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <?php echo($nbre_bien_occupe);?> </div>
                                    <div class="widget-title">TOTAL LOCATAIRE</div>
                                    <div class="widget-subtitle"> </div>
                                </div>
                                <div class="widget-controls">                                
                                </div>                            
                            </div>    
                            </a>                        
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
               <a href="#" onClick="affiche('liste_biens_occupe.php');">
                <div class="col-md-3">
			            <!-- START WIDGET MESSAGES -->
                            <div class="widget badge-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-home"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <?php echo($nbre_bien_occupe);?></div>
                                    <div class="widget-title">TOTAL BIENS OCCUPES</div>
                                    <div class="widget-subtitle"> </div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        </a>
               
               			<a href="#" onClick="affiche('liste_locataire.php');">
                       <div class="col-md-3">
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-primary widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-home"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count">  <?php
									echo($nbre_bien_dispo);
									/*if($nbre_bien_dispo==0){
										echo'0';
										
										}else{echo($nbre_bien_dispo);}*/
									?> </div>
                                    <div class="widget-title">TOTAL BIENS DISPONIBLES</div>
                                    <div class="widget-subtitle"> </div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>        
						</a>

<!-- FIN TABLEAU DE BORD -->

                        
                        <div style="margin-top:50px;">
 <table width="100%" border="0" background="img/arrplan.png">
  <tr>
    <td height="42" align="center"><h3>ETAT DES RECOUVREMENTS</h3></td>
  </tr>
</table>

                        </div > 
                        
                  <div class="col-md-3" style="margin-top:20px;">
    
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-primary widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <?php echo number_format($total_loyer);?> </div>
                                    <div class="widget-title">MONTANT ATTENDU</div>
                                    <div class="widget-subtitle"><!--<a href="customer_taxes_forfaitaires.php">--><!--Voir la liste</a>--></div>
                                </div>
                                <div class="widget-controls">                                
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <a href="#" onClick="affiche('liste_paiement_locataire.php');">
                         <div class="col-md-3" style="margin-top:20px;">
    
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget bg-info widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php if($Montant_total_loyer==''){
										echo ('0');
										
										}elseif($Montant_total_loyer!=''){
											
											echo number_format($Montant_total_loyer);
											
											}?></div>
                                    <div class="widget-title">RECETTE DU JOUR</div>
                                    
                                    <div class="widget-subtitle"></div>
                                </div>
                                <div class="widget-controls">                                
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div></a>
               
               
               
               <a href="#" onClick="affiche('liste_paiement__mois.php');">
                       <div class="col-md-3" style="margin-top:20px;">
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget  widget-item-icon" style="background-color:#0CF">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <?php if($V_loyer_mois==''){
										echo ('0');
										
										}elseif($V_loyer_mois!=''){
											
											echo number_format($V_loyer_mois);
											
											}?></div>
                                    <div class="widget-title">RECETTE DU MOIS </div>
                                    <div class="widget-subtitle"></div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div> </a>
                        <!--<a href="#" onClick="#">-->
                         <div class="col-md-3" style="margin-top:20px;">
			            <!-- START WIDGET MESSAGES -->
                           <div class="widget alert-warning widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php if($V_MT_frais_agence==''){
										echo ('0');
										
										}elseif($V_MT_frais_agence!=''){
											
											echo number_format($V_MT_frais_agence);
											
											}?>  </div>
                                    <div class="widget-title">COMISSION DU MOIS</div>
                                    <div class="widget-subtitle"></div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div><!--</a>-->
                        
                        <div style="margin-top:50px;">
 <table width="100%" border="0" background="img/arrplan.png">
  <tr>
    <td height="42" align="center"><h3>AUTRES</h3></td>
  </tr>
</table>

                    </div > 
                      <a href="#" onClick="affiche('liste_charge_ok.php');">  
                   <div class="col-md-3" style="margin-top:20px;">
			            <!-- START WIDGET MESSAGES -->
                            <div class="widget alert-danger widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php if($montant_charge==''){
										echo ('0');
										
										}elseif($montant_charge!=''){
											
											echo number_format($montant_charge);
											
											}?>  </div>
                                    <div class="widget-title">MONTANT TOTAL TRAVAUX</div>
                                    <div class="widget-subtitle"></div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>  
                                                     
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        
                        
                        
                        <a href="#" onClick="affiche('liste_locataire_impayer_2019.php');">  
                   <div class="col-md-3" style="margin-top:20px;">
			            <!-- START WIDGET MESSAGES -->
                            <div class="widget alert-danger widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-money"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count"> <?php echo number_format($Montant_total_impaye);?></div>
                                    <div class="widget-title">IMPAYER</div>
                                    <div class="widget-subtitle"></div>
                                </div>      
                                <div class="widget-controls">                                
                                </div>
                            </div>  
                                                     
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                       
                         
<!-- /.row -->
    <!-- /.col-lg-12 -->
</div>
   <script>  
   
   function affiche(fen) {
        //sessionStorage.even = "insert";
        $("#page-wrapper").empty();
        if (fen!=='non') {
            <!-- $("#page-wrapper").load(fen+".html"); -->
            $("#page-wrapper").load(fen);

        }
    }  
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
    
     function ouvrefen_pro(pro)
    {
    
            
        $("#page-wrapper").load("liste_proprietaire.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("locataire.php");
    });
	
    
    
</script>
  
 
 
