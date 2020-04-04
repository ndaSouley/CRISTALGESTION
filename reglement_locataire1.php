<head>
<link rel="stylesheet" href="css/popupform.css"/>

</head>
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header " style="margin-top:10px;">REGLEMENT DU LOCATAIRE</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="row">
        <div class="col-lg-12">
        
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">CALENDRIER DE PAIE DU LOCATAIRE</h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
<div class="row">
    <form role="form" method="post" class="form-inline" id="form">
        

        <div class="col-lg-12">
            <div class="panel panel-default  panel-green">

                <div class="panel-heading">
                    
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3" id="locatairediv">
                         
                                <label class="label_form">Locataire</label>
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" readonly>
                            </div>
                            
                            <div class="col-lg-3" id="loyer_locatairediv">
                                <label class="label_form">Loyer</label>
                               
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" readonly>
                            </div>
                            
                            
                            <div class="col-lg-3">
                                <label class="label_form">Pénalité</label>
                                 <input class="form-control" type="text"   name="penalite" id="penalite" value=
								 <?php
								 $date_penalite = date('d');
								if($date_penalite>=10){
									
									echo'10%';
									
									}
								 
								 ?> readonly="readonly">
                            </div>
                            
                              <div class="col-lg-3" id="mt_total_payerdiv">
                                <label class="label_form">Mt Total à Payer</label>
                                 <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="mt_total_payer" id="mt_total_payer" value="" readonly >
                            </div>
                        
                            
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="TFDPPCA">

                        
                    </div>
                    <!-- /.row (nested) -->
                    
                    
                     <div class="row">
                        <div class="col-lg-3" style="margin-top:5px;">
                         
                                <label class="label_form">Mt Réglé</label>
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" >
                            </div>
                            
                            <div class="col-lg-3">
                                <label class="label_form">Reste à Payer</label>
                               
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" >
                            </div>
                            
                            
                            <div class="col-lg-3">
                                <label class="label_form">Date de Paiement</label>
                                 <input class="form-control" type="date"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" >
                            </div>
                            
                              <div class="col-lg-3">
                                <label class="label_form">Mode de Règlement</label>
                                  <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='mode_reglement'name='mode_reglement'   class='form-control'   required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
											mode_reglement.id_mode_reglement,
											mode_reglement.Libelle_mode_reglement
											FROM
											mode_reglement";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_mode_reglement = $row['id_mode_reglement'];
							$Libelle_mode_reglement = $row['Libelle_mode_reglement'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_mode_reglement'>$Libelle_mode_reglement</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                     
                            
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="TFDPPCA">

                        
                    </div>
                    <!-- /.row (nested) -->
                    
                </div>
                <!-- /.panel-body -->
            </div>

            <!-- /.panel -->
        </div>
        <div class="col-lg-12">
            <div class="panel-footer text-right">
              <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        </div>
    </form>
    <!-- /.col-lg-12 -->
</div>
  
  <center> 
<div id="message" class="modalDialog">	
    <div>        
		<table border="0" width="100%">
			<tr>
                <td>
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">FELICITATION</h3></div>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="1" style="margin-top: 20px;margin-bottom: 20px;">
            
			<tr>
				<td>
					<p id="mess" >
						<h2 style="text-align: center" ></h2>
					</p>
				</td>
            </tr>       

        </table>
		
		<table border="0" width="100%" >
			<tr>
                <td>
					<div style="text-align: center;">
						<button class="shiny-gray" name="BoutonOUI" type="submit" id="BoutonOUI">OUI</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="shiny-gray" name="BoutonNON" type="reset" id="BoutonNON"> NON</button>
					</div>
				</td>
			</tr>
		</table>				
    </div>		
 </div>
 
 
<center>
<div id="message" class="modalDialog">	
    <div>        
		<table border="0" width="100%">
			<tr>
                <td>
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">FELICITATION</h3></div>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="1" style="margin-top: 20px;margin-bottom: 20px;">
            
			<tr>
				<td>
					<p id="mess" >
						<h2 style="text-align: center" ></h2>
					</p>
				</td>
            </tr>       

        </table>
		
		<table border="0" width="100%" >
			<tr>
                <td>
					<div style="text-align: center;">
						<button class="shiny-gray" name="BoutonOUI" type="submit" id="BoutonOUI">OUI</button>&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="shiny-gray" name="BoutonNON" type="reset" id="BoutonNON"> NON</button>
					</div>
				</td>
			</tr>
		</table>				
    </div>		
 </div>
 </center>
 
 
 <center>
<div id="message2" class="modalDialog">	
    <div>        
		<table border="0" width="100%" >
			<tr>
                <td>
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">FELICITATION</h3></div>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="1" cellpadding="1" style="margin-top: 20px;margin-bottom: 20px;">
            
			<tr>
				<td>
					<p id="mess2" >
						<h2 style="text-align: center" ></h2>
					</p>
				</td>
            </tr>       

        </table>
		
		<table border="0" width="100%" >
			<tr>
                <td>
					<div style="text-align: center;">
						<button class="shiny-gray" name="BoutonOK" type="submit" id="BoutonOK">OK</button>
					</div>
				</td>
			</tr>
		</table>				
    </div>		
 </div> 
 </center>
 
 
<script>
    
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
        $("#page-wrapper").load("liste_locataire.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_locataire.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#nom').val('');
        $('#prenom').val('');
        $('#datenaissance').val('');
        $('#lieunaissance').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		$('#quartier').val('');
		$('#nbre_piece').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#localite').val('');
		$('#loyer_agence').val('');
		$('#num_ncc').val('');
		//$('#montant').val('');
		$('#V_commission').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#num_impot').val('');
		$('#description').val('');
		$('#loyer_final').val('');
		$('#frais_agence').val('');
		$('#commune').val('');
        $('#message').remove();
    }); 
	
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("locataire.php");
    });
    $(document).ready(function() {
		
		//$('#message').hide();
		//$('#message2').hide();
		
        $('#form')[0].reset();
        $('#action').val(sessionStorage.even);
        


$("#BoutonOUI").on('click', function()
	{
		 $('#nom').val('');
        $('#prenom').val('');
        $('#datenaissance').val('');
        $('#lieunaissance').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		//$('#quartier').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#nbre_piece').val('');
		$('#localite').val('');
		$('#loyer_agence').val('');
		$('#num_ncc').val('');
		$('#V_commission').val('');
		//$('#montant').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#commune').val('');
		$('#num_impot').val('');
		$('#loyer_final').val('');
		$('#frais_agence').val('');
		$('#description').val('');
        $('#message').remove();
		
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_locataire.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	var nom = $('#nom').val();
	var prenom = $('#prenom').val();
	var datenaissance = $('#datenaissance').val();
	var lieunaissance = $('#lieunaissance').val();
	var cnisejour = $('#cnisejour').val();
	var telephone = $('#telephone').val();
	var nbre_piece = $('#nbre_piece').val();
	//var quartier = $('#quartier').val();
    var profession = $('#profession').val();
	var type_bien = $('#type_bien').val();
	var localite = $('#localite').val();
	var e_mail = $('#e_mail').val();
	var num_ncc = $('#num_ncc').val();
	//var montant = $('#montant').val();
	var loyer_agence = $('#loyer_agence').val();
	var V_commission = $('#V_commission').val();
	var commune = $('#commune').val();
	var prise_en_charge = $('#prise_en_charge').val();
	var nom_proprio = $('#nom_proprio').val();
	var num_impot = $('#num_impot').val();
	var loyer_final = $('#loyer_final').val();
	var frais_agence = $('#frais_agence').val();
	var description = $('#description').val();
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    //var data = $('form').serialize(); 
    // console.log('donnees = '+data);
	 
	 var Vid_bien =   sessionStorage.id_bien;
	 
 var donnees = {action:sessionStorage.even,
 
					nom:nom,
					prenom:prenom,
					datenaissance:datenaissance,
					lieunaissance:lieunaissance,
					cnisejour:cnisejour,
					telephone:telephone,
					//quartier:quartier,
					profession:profession,
					type_bien:type_bien,
					prise_en_charge:prise_en_charge,
					localite:localite,
					num_ncc:num_ncc,
					nbre_piece:nbre_piece,
					//montant:montant,
					num_impot:num_impot,
					nom_proprio:nom_proprio,
					description:description,
					e_mail:e_mail,
					loyer_agence:loyer_agence,
					Vid_bien:Vid_bien,
					commune:commune,
					V_commission:V_commission,
					frais_agence:frais_agence,
					loyer_final:loyer_final,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+'/,"profession":'+profession+',"type_bien":'+type_bien+',"localite":'+localite+',"num_impot":'+num_impot+',"id du bien":'+Vid_bien+',"commune":'+commune+',"Commission":'+V_commission+',"frais_agence":'+frais_agence+',"loyer_final":'+loyer_final+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_locataire.php" ,
        data: donnees,
        success : function(data) {
			console.log("Retour="+data.Motif);
			
			console.log('propriotaire'+data.V_id_proprietaire);
			
					
            if(sessionStorage.even == "INSERT")
            {
          //  alert('Enregistrer');
            document.getElementById('mess').innerHTML = data.Motif;
						$(location).attr('href','#message');
            //$("#page-wrapper").load("taxe_forfaitaire.php");

            }
            else
            {
            document.getElementById('mess2').innerHTML = data.Motif;
            $(location).attr('href','#message2');
			//$("#page-wrapper").load("liste_taxe_forfaitaire.php");
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            $("#page-wrapper").load("liste_proprietaire.php");
			
            }

            });

				});
				});


$(document).ready(function() {
	
   $('#nom').val('');
   $('#prenom').val('');
   $('#telephone1').val('');
	$('#email').val('');
	$('#societe').val('');
	$('#fonction').val('');
	$('#typepersonne').val('');
	$('#date_saisie').val('');
	//('#typecontact').val('');
    $('#telephone2').val('');
	
	if(sessionStorage.even == "UPDATE"){

	console.log('je suis la commission  '+sessionStorage.libelle_commission);
	
	
		// Afectation des données dans chaque champs
	//$('#nomdiv').find('input').val(sessionStorage.nom_proprietaire +  " "  + sessionStorage.prenoms);
    $('#nomdiv').find('input').val(sessionStorage.initial_proprietaire);
   
	$('#loyerdiv').find('input').val(sessionStorage.prix_bien);
	$('#localitediv').find('input').val(sessionStorage.quartier_bien);
	$('#descriptiondiv').find('textarea').val(sessionStorage.description);
	$('#impotdiv').find('input').val(sessionStorage.impot_foncier);
	$('#num_ncc_div').find('input').val(sessionStorage.num_ncc);
	$('#frais_agencediv').find('input').val(sessionStorage.frais_agence);
	$('#loyer_locatairediv').find('input').val(sessionStorage.loyer_proprietaire);
	
	//INFORMATIONS DU LOCATAIRE
	
	$('#locatairediv').find('input').val(sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire );
	//$('#prenomdiv').find('input').val(sessionStorage.prenoms_locataire);
	$('#datenaissancediv').find('input').val(sessionStorage.date_nais_locataire);
	$('#lieunaissancediv').find('input').val(sessionStorage.lieu_nais_locataire);
	$('#telephonediv').find('input').val(sessionStorage.telephone_locataire);
	$('#cnisejourdiv').find('input').val(sessionStorage.num_cni_sejour);
	$('#fonctiondiv').find('input').val(sessionStorage.fonction_locataire);
	$('#emaildiv').find('input').val(sessionStorage.e_maill_locataire);
	
	
	
	$('#mt_total_payerdiv').find('input').val(sessionStorage.loyer_proprietaire);
	
	$('#categorie_bien').append('<option value='+ sessionStorage.id_categorie_bien +' selected>'+ sessionStorage.libelle_categorie_bien +'</option>');	
	
	$('#V_commission').append('<option value='+ sessionStorage.id_commission +' selected>'+ sessionStorage.libelle_commission +'</option>');					
    $('#commune').append('<option value='+ sessionStorage.id_commune +' selected>'+ sessionStorage.libelle_categorie_commune +'</option>');
   $('#nbre_piece').append('<option value='+ sessionStorage.id_nbre_piece +' selected>'+ sessionStorage.libelle_piece +'</option>');
	$('#type_bien').append('<option value='+ sessionStorage.id_type_bien +' selected>'+ sessionStorage.libelle_type_bien +'</option>');
	$('#prise_en_charge').append('<option value='+ sessionStorage.id_charge +' selected>'+ sessionStorage.libelle_charge +'</option>');
	}
});


</script>     
 