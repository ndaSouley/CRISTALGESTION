<?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
//$profil=$_SESSION['TaxeUserData'][0]['id_profil'];
$id_user=$_SESSION['TaxeUserData'][0]['id_user'];

?><head>
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">CALENDRIER DE PAIE DU LOCATAIRE ANNEE: 2020</h4>
                  
                </div> 
              </div>
                <!-- /.panel-heading -->
               <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                            <tr>
								<th>Janvier</th>
								<th>Fevrier</th>
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
                        
			
						<tr>    
							<td><div id="janvier"></td>
							<td><div id="Fevrier"></td>
							<td><div id="Mars"></td>
							<td><div id="Avril"></td>
							<td><div id="Mai"></td>
							<td><div id="Juin"></td>
							<td><div id="Juillet"></td>
							<td><div id="Aout"></td>
							<td><div id="Septembre"></td>
							<td><div id="Octobre"></td>
							<td><div id="Novembre"></td>
							<td><div id="Decembre"></td>
							
					
						</tr>

                            
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
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="nom_locataire" id="nom_locataire" value="" readonly>
                            </div>
                            
                            <div class="col-lg-3" id="loyer_locatairediv">
                                <label class="label_form">Loyer</label>
                               
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="Loyer_locataire" id="Loyer_locataire" value="" readonly>
                            </div>
                            
                            
                            <div class="col-lg-3" id="penalitediv">
                                <label class="label_form">Pénalité</label>
                                 <input class="form-control" type="text"   name="penalite" id="penalite" value="">
                            </div>
                            
                            
                            
                            <?php

include('dbconnexion.php');

  
			$query = "SELECT
							bien.id_bien,
							bien.loyer_proprietaire
							FROM
							bien
							WHERE
							bien.id_bien=2

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
			
			$loyer_proprietaire = utf8_decode($row['loyer_proprietaire']);
			
			$mt_penalite=$loyer_proprietaire*10/100;
			
			$mt_total_payer=$mt_penalite+$loyer_proprietaire;
			
		}
		 }
?>
                            
               
               <!--<div class="col-lg-3" id="mt_total_payerdiv">-->
                              <div class="col-lg-3"  id="chargediv">
                              
                                <label class="label_form">Charge</label>
                                 <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="charge" id="charge" value="" readonly >
                            </div>             
                            
                            
                              
                            
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="TFDPPCA">

                        
                    </div>
                    <!-- /.row (nested) -->
                    
                    
                     <div class="row">
                     
                     <!--<div class="col-lg-3" id="mt_total_payerdiv">-->
                              <div class="col-lg-3" id="mt_total_div" >
                              
                                <label class="label_form">Mt Total à Payer</label>
                                 <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="mt_total_payer" id="mt_total_payer" value="" readonly >
                            </div>
                        
                        <div class="col-lg-3" style="margin-top:5px;">
                         
                                <label class="label_form">Mt Réglé</label>
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="mt_verse" id="mt_verse" value="" width="" required="required">
                            </div>
                            
                            <div class="col-lg-3" id="Mt_restantdiv">
                                <label class="label_form">Reste à Payer</label>
                               
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="Mt_restant" id="Mt_restant" value="" readonly="readonly">
                            </div>
                            
                            <div class="col-lg-3" style="margin-top:15px;">
                                <label class="label_form">Mois de reglé</label>
                                  <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='mois_reglement'name='mois_reglement'   class='form-control'   required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
											mois_paiement.id_mois,
											mois_paiement.libelle_mois
											FROM
											mois_paiement";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_mois = $row['id_mois'];
							$libelle_mois = $row['libelle_mois'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_mois'>$libelle_mois</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                             <div class="col-lg-3" style="margin-top:15px;">
                                <label class="label_form">Année</label>
                                  <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='anne_regelement'name='anne_regelement'   class='form-control'   required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
										annee.id_annee,
										annee.annee
										FROM
										annee
										";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_annee = $row['id_annee'];
							$annee = $row['annee'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_annee'>$annee</option>\n";
							
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
                            
                            
                            <div class="col-lg-3">
                               <label class="label_form">N° Chèque</label>
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="num_cheque" id="num_cheque" value="" width="">
                           </div> 
                             <div class="col-lg-3">
                               <label class="label_form">Banque</label>
                               
                             <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="nom_banque" id="nom_banque" value="" width="">
                           </div> 
                     
                   <div class="col-lg-3">
                                <label class="label_form">Date de versement</label>
                                 <input class="form-control" type="date"  onkeydown="upperCaseF(this)" name="date_loyer" id="date_loyer" value="" required="required">
                           </div> 
                           
                           
                     
                           
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
                        <input type="hidden" name="id_user" id="id_user" value="<?php echo( $id_user);?>">
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
        $("#page-wrapper").load("liste_locataire_reglement.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_locataire_reglement.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#num_cheque').val('');
		$('#nom_banque').val('');
		$('#nom_locataire').val('');
        $('#Loyer_locataire').val('');
        $('#mt_verse').val('');
		$('#penalite').val('');
		$('#charge').val('');
		$('#id_user').val('');
		$('#mt_total_payer').val('');
		$('#Mt_restant').val('');
		$('#mode_reglement').val('');
		$('#date_loyer').val('');
		$('#mois_reglement').val('');
		$('#anne_regelement').val('');
		
		
        $('#message').remove();
    }); 
	
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("liste_locataire_reglement.php");
    });
    $(document).ready(function() {
		
		//$('#message').hide();
		//$('#message2').hide();
		
        $('#form')[0].reset();
        $('#action').val(sessionStorage.even);
        


$("#BoutonOUI").on('click', function()
	{
		
		$('#num_cheque').val('');
		$('#nom_banque').val('');
		$('#nom_locataire').val('');
        $('#Loyer_locataire').val('');
        $('#mt_verse').val('');
		$('#penalite').val('');
		$('#charge').val('');
		$('#mt_total_payer').val('');
		$('#Mt_restant').val('');
		$('#date_loyer').val('');
		$('#id_user').val('');
		$('#mois_reglement').val('');
		$('#mode_reglement').val('');
		$('#anne_regelement').val('');
        $('#message').remove();
		
		
    });	
	
	
	
	
	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_locataire_reglement.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	
	var num_cheque = $('#num_cheque').val();
	var nom_banque = $('#nom_banque').val();
	
	var nom_locataire = $('#nom_locataire').val();
	var Loyer_locataire = $('#Loyer_locataire').val();
	var penalite = $('#penalite').val();
	var mt_verse = $('#mt_verse').val();
	var charge = $('#charge').val();
	var id_user = $('#id_user').val();
	var mt_total_payer = $('#mt_total_payer').val();
	var Mt_restant = $('#Mt_restant').val();
    var mode_reglement = $('#mode_reglement').val();
	var date_loyer = $('#date_loyer').val();
	var mois_reglement = $('#mois_reglement').val();
	var anne_regelement = $('#anne_regelement').val();
	
	
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    //var data = $('form').serialize(); 
    // console.log('donnees = '+data);
	 
	 var Vid_bien =   sessionStorage.id_bien;
	 
 var donnees = {action:sessionStorage.even,
 
	
					num_cheque:num_cheque,
					nom_banque:nom_banque,
					nom_locataire:nom_locataire,
					Loyer_locataire:Loyer_locataire,
					penalite:penalite,
					mt_verse:mt_verse,
					charge:charge,
					mt_total_payer:mt_total_payer,
					Mt_restant:Mt_restant,
					mode_reglement:mode_reglement,
					Vid_bien:Vid_bien,
					date_loyer:date_loyer,
					id_user:id_user,
					mois_reglement:mois_reglement,
					anne_regelement:anne_regelement,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom_locataire":'+nom_locataire+',"Loyer_locataire":'+Loyer_locataire+',"penalite":'+penalite+',"mt_verse":'+mt_verse+',"charge":'+charge+',"mt_total_payer":'+mt_total_payer+',"Mt_restant":'+Mt_restant+',"mode_reglement":'+mode_reglement+',"Vid_bien":'+Vid_bien+',"date_loyer":'+date_loyer+',"Num_cheque":'+num_cheque+',"Nom de la Banque":'+nom_banque+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_reglement_locataire.php" ,
        data: donnees,
        success : function(data) {
			console.log("Retour="+data.Motif);
			//alert("Retour="+data.Motif);
			
			if(data.Motif==data.Motif_1){
				location.href="quittance_de_loyer.php?Id_bien_envoye="+sessionStorage.id_bien;
				
				
				
				}else if(data.Motif!=data.Motif_1){
					
					location.href="avance_quittance_loyer.php?Id_bien_envoye="+sessionStorage.id_bien;
					}
			
					
          /* if(sessionStorage.even == "INSERT")
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
			//$("#page-wrapper").load("liste_locataire_reglement.php");
			//location.href="quittance_de_loyer.php?Id_bien_envoye="+sessionStorage.id_bien;
			//location.href="avance_quittance_loyer.php?Id_bien_envoye="+sessionStorage.id_bien;
            }*/
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            $("#page-wrapper").load("liste_locataire_reglement.php");
			
            }

            });

		});
});

//VERIFICATION DU N°STICKER SAISIE

var elem = document.getElementById("mt_verse");

elem.onblur = function() {
	
	var mt_verse = $('#mt_verse').val();
	var mt_total_payer = $('#mt_total_payer').val(); 
	var mt_restant_locataire=mt_total_payer - mt_verse;
	//alert(mt_restant_locataire);
	$('#Mt_restantdiv').find('input').val(mt_restant_locataire);
	
	
    //alert(mt_verse);
};

$(document).ready(function() {
	
	penalite.disabled = true;
	charge.disabled = true;
	
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
		
    $('#nomdiv').find('input').val(sessionStorage.initial_proprietaire);
   
	$('#loyer_locatairediv').find('input').val(sessionStorage.loyer_proprietaire);
	
	//INFORMATIONS DU LOCATAIRE
	
	if(sessionStorage.id_annee==1){
		
		
		if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
		
		
		}else if(sessionStorage.id_annee==2){
			
			if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
			
			}else if(sessionStorage.id_annee==3){
				
				
				if(sessionStorage.Janvier==1){
		
		janvier.disabled = true;
		
		document.getElementById("janvier").innerHTML="SOLDÉ";
		document.getElementById("janvier").style.color="green";
		
		
		}else if(sessionStorage.Janvier==0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML="IMPAYÉ";
			document.getElementById("janvier").style.color="red";
			
			}
			else if(sessionStorage.Janvier!=1 && sessionStorage.Janvier!=0){
			janvier.disabled = true;
			document.getElementById("janvier").innerHTML=sessionStorage.Janvier;
			document.getElementById("janvier").style.color="red";
			
			}
			
			
			if(sessionStorage.Fevrier==1){
		
		janvier.disabled = true;
		
		document.getElementById("Fevrier").innerHTML="SOLDÉ";
		document.getElementById("Fevrier").style.color="green";
		
		
		}else if(sessionStorage.Fevrier==0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML="IMPAYÉ";
			document.getElementById("Fevrier").style.color="red";
			
			}else if(sessionStorage.Fevrier!=1 && sessionStorage.Fevrier!=0){
			janvier.disabled = true;
			document.getElementById("Fevrier").innerHTML=sessionStorage.Fevrier;
			document.getElementById("Fevrier").style.color="red";
			
			}
			if(sessionStorage.Mars==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mars").innerHTML="SOLDÉ";
		document.getElementById("Mars").style.color="green";
		
		
		}else if(sessionStorage.Mars==0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML="IMPAYÉ";
			document.getElementById("Mars").style.color="red";
			
			}else if(sessionStorage.Mars!=1 && sessionStorage.Mars!=0){
			janvier.disabled = true;
			document.getElementById("Mars").innerHTML=sessionStorage.Mars;
			document.getElementById("Mars").style.color="red";
			
			}
			
			if(sessionStorage.Avril==1){
		
		janvier.disabled = true;
		
		document.getElementById("Avril").innerHTML="SOLDÉ";
		document.getElementById("Avril").style.color="green";
		
		
		}else if(sessionStorage.Avril==0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML="IMPAYÉ";
			document.getElementById("Avril").style.color="red";
			
			}else if(sessionStorage.Avril!=1 && sessionStorage.Avril!=0){
			janvier.disabled = true;
			document.getElementById("Avril").innerHTML=sessionStorage.Avril;
			document.getElementById("Avril").style.color="red";
			
			}
			if(sessionStorage.Mai==1){
		
		janvier.disabled = true;
		
		document.getElementById("Mai").innerHTML="SOLDÉ";
		document.getElementById("Mai").style.color="green";
		
		
		
		}else if(sessionStorage.Mai==0){
			janvier.disabled = true;
			document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").style.color="red";
			
			
			}else if(sessionStorage.Mai!=1 && sessionStorage.Mai!=0){
			janvier.disabled = true;
			//document.getElementById("Mai").innerHTML="IMPAYÉ";
			document.getElementById("Mai").innerHTML=sessionStorage.Mai;
			document.getElementById("Mai").style.color="red";
			
			
			}
			if(sessionStorage.Juin==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juin").innerHTML="SOLDÉ";
		document.getElementById("Juin").style.color="green";
		
		
		}else if(sessionStorage.Juin==0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML="IMPAYÉ";
			document.getElementById("Juin").style.color="red";
			
			}else if(sessionStorage.Juin!=1 && sessionStorage.Juin!=0){
			janvier.disabled = true;
			document.getElementById("Juin").innerHTML=sessionStorage.Juin;
			document.getElementById("Juin").style.color="red";
			
			}
			if(sessionStorage.Juillet==1){
		
		janvier.disabled = true;
		
		document.getElementById("Juillet").innerHTML="SOLDÉ";
		document.getElementById("Juillet").style.color="green";
		
		
		}else if(sessionStorage.Juillet==0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML="IMPAYÉ";
			document.getElementById("Juillet").style.color="red";
			
			
			}else if(sessionStorage.Juillet!=1 && sessionStorage.Juillet!=0){
			janvier.disabled = true;
			document.getElementById("Juillet").innerHTML=sessionStorage.Juillet;
			document.getElementById("Juillet").style.color="red";
			
			
			}
			if(sessionStorage.Aout==1){
		
		janvier.disabled = true;
		
		document.getElementById("Aout").innerHTML="SOLDÉ";
		document.getElementById("Aout").style.color="green";
		
		
		}else if(sessionStorage.Aout==0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML="IMPAYÉ";
			document.getElementById("Aout").style.color="red";
			
			
			}else if(sessionStorage.Aout!=1 && sessionStorage.Aout!=0){
			janvier.disabled = true;
			document.getElementById("Aout").innerHTML=sessionStorage.Aout;
			document.getElementById("Aout").style.color="red";
			
			
			}
			if(sessionStorage.Septembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Septembre").innerHTML="SOLDÉ";
		document.getElementById("Septembre").style.color="green";
		
		
		}else if(sessionStorage.Septembre==0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML="IMPAYÉ";
			document.getElementById("Septembre").style.color="red";
			
			
			}else if(sessionStorage.Septembre!=1 && sessionStorage.Septembre!=0){
			janvier.disabled = true;
			document.getElementById("Septembre").innerHTML=sessionStorage.Septembre;
			document.getElementById("Septembre").style.color="red";
			
			
			}
			if(sessionStorage.Octobre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Octobre").innerHTML="SOLDÉ";
		document.getElementById("Octobre").style.color="green";
		
		
		}else if(sessionStorage.Octobre==0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML="IMPAYÉ";
			document.getElementById("Octobre").style.color="red";
			
			
			}else if(sessionStorage.Octobre!=1 && sessionStorage.Octobre!=0){
			janvier.disabled = true;
			document.getElementById("Octobre").innerHTML=sessionStorage.Octobre;
			document.getElementById("Octobre").style.color="red";
			
			
			}
			if(sessionStorage.Novembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Novembre").innerHTML="SOLDÉ";
		document.getElementById("Novembre").style.color="green";
		
		
		}else if(sessionStorage.Novembre==0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML="IMPAYÉ";
			document.getElementById("Novembre").style.color="red";
			
			}else if(sessionStorage.Novembre!=1 && sessionStorage.Novembre!=0){
			janvier.disabled = true;
			document.getElementById("Novembre").innerHTML=sessionStorage.Novembre;
			document.getElementById("Novembre").style.color="red";
			
			}
			if(sessionStorage.Decembre==1){
		
		janvier.disabled = true;
		
		document.getElementById("Decembre").innerHTML="SOLDÉ";
		document.getElementById("Decembre").style.color="green";
		
		
		}else if(sessionStorage.Decembre==0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML="IMPAYÉ";
			document.getElementById("Decembre").style.color="red";
			
			}else if(sessionStorage.Decembre!=1 && sessionStorage.Decembre!=0){
			janvier.disabled = true;
			document.getElementById("Decembre").innerHTML=sessionStorage.Decembre;
			document.getElementById("Decembre").style.color="red";
			
			}
			
				
				}//sessionStorage.id_annee==3
	
	
	
	
	
	$('#locatairediv').find('input').val(sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire );
	console.log(sessionStorage.prenoms_locataire);
	//$('#prenomdiv').find('input').val(sessionStorage.prenoms_locataire);
	
	$('#loyer_locatairediv').find('input').val(sessionStorage.prix_bien);
	//$('#test').find('input').val(sessionStorage.prix_bien);
	$('#id_bien_okdiv').find('input').val(sessionStorage.id_bien);
	
	$('#mt_total_payerdiv').find('input').val(sessionStorage.prix_bien);
	

	
	//VERIFICATION DES CHARGES DU LOCATAIRE
	
	var Mt_travaux= sessionStorage.mt_total_travaux;
	var ID_LOCATAIRE_Charge= sessionStorage.ID_LOCATAIRE_Charge;
	var mois_travaux= sessionStorage.mois_travaux;
	var charge_regle= sessionStorage.charge_regle;
	
	//console.log('Reglement'+sessionStorage.charge_regle);
	
	var Mois= new Date();
	
	var month = Mois.getMonth()+1;
	console.log('Le mois est'+month);
	
	if(charge_regle==0){
		
		$('#chargediv').find('input').val(Mt_travaux);
		
		}
	
	//VERIFICATION DES CHARGES DU LOCATAIRE
	
	
	
	//TRAITEMENT DES CONDITIONS DE PENALITES 
	
	
	var d= new Date();
	
	date_penalite= d.getDate();
	
	if(date_penalite>10 && charge_regle==0){
		
		var Loyer_locataire = sessionStorage.prix_bien;
		var Frais_Penalite=Loyer_locataire*10/100;
		//var Frais_Penalite=0;
		var mt_total_a_payer=Number(Loyer_locataire) + Number(Frais_Penalite)+ Number(Mt_travaux);
		//$('#mt_total_div').find('input').val(mt_total_a_payer);
		$('#mt_total_div').find('input').val(Loyer_locataire);
		//$('#penalitediv').find('input').val(Frais_Penalite);
		$('#penalitediv').find('input').val(0);
		
		
		}else if(date_penalite>10){
			
			var Loyer_locataire = sessionStorage.prix_bien;
		var Frais_Penalite=Loyer_locataire*10/100;
		//var Frais_Penalite=0;
		var mt_total_a_payer= Number(Loyer_locataire) + Number(Frais_Penalite);
		//$('#mt_total_div').find('input').val(mt_total_a_payer);
		$('#mt_total_div').find('input').val(Loyer_locataire);
		//$('#penalitediv').find('input').val(Frais_Penalite);
		$('#penalitediv').find('input').val(0);
		
			
			
			}else if(date_penalite>=10 && charge_regle==0){
				
				var Loyer_locataire = sessionStorage.prix_bien;
		var Frais_Penalite=Loyer_locataire*10/100;
				//var Frais_Penalite=0;
				//alert('je suis ici 2');
			
		var Loyer_locataire = sessionStorage.prix_bien;
		var loyer_total=Number(Loyer_locataire) + Number(Mt_travaux) + Number(Frais_Penalite);
		//var loyer_total=Number(Loyer_locataire) + Number(Mt_travaux);
		
		//$('#mt_total_div').find('input').val(loyer_total);
		$('#mt_total_div').find('input').val(Loyer_locataire);
		$('#penalitediv').find('input').val(0);
		//$('#penalitediv').find('input').val(Frais_Penalite);
		
			
			}else if(date_penalite<=10 && charge_regle==""){
				
				//alert('je suis ici 1');
				var Loyer_locataire = sessionStorage.prix_bien;
				var loyer_total=Number(Loyer_locataire) + Number(Mt_travaux);
		
		$('#mt_total_div').find('input').val(Loyer_locataire);
		$('#penalitediv').find('input').val(0);
				
				
				}
	}
});


</script>     
 