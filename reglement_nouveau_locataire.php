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
        <h4 class="page-header " style="margin-top:10px;">REGLEMENT CAUTION</h4>
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
                            
                            
                            <div class="col-lg-3" id="1er_moisdiv">
                                <label class="label_form"> Mois</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
					
						echo "<select id='_1er_mois_regele'name='_1er_mois_regele'   class='form-control'   required>
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
							$_1er_mois = $row['libelle_mois'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_mois'>$_1er_mois</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
            
                            </div>
                            
               
               <!--<div class="col-lg-3" id="mt_total_payerdiv">-->
                               <!--<div class="col-lg-3" id="2er_moisdiv">
                                <label class="label_form">2 ER Mois</label>-->
                                <?php
								/*
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
					echo "<select id='__2er_mois_regle'name='__2er_mois_regle'   class='form-control'   required>
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
							$_2er_mois = $row['libelle_mois'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_mois'>$_2er_mois</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();*/
	  
?>
</select>
            
                            <!--</div>-->
                            
                              
                            
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="TFDPPCA">

                        
                    </div>
                    <!-- /.row (nested) -->
                    
                    
                     <div class="row">
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
                     <!--<div class="col-lg-3" id="mt_total_payerdiv">-->
                              <div class="col-lg-3" id="frais_agence_div" >
                              
                                <label class="label_form">Frais d'agence</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="frais_agence" id="frais_agence" value="" >
                            </div>
                       
                            <div class="col-lg-3" id="montant_tva_div">
                                <label class="label_form">Montant TVA</label>
                               
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="montant_tva" id="montant_tva" value="" >
                            </div>
                            
                            <div class="col-lg-3"  id="cautiondiv">
                                <label class="label_form">Caution</label>
                                  <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="caution" id="caution" value="" >
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
        $("#page-wrapper").load("liste_locataire.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_locataire.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#nom_locataire').val('');
        $('#Loyer_locataire').val('');
        $('#_1er_mois_regele').val('');
        $('#__2er_mois_regle').val('');
		$('#frais_agence').val('');
		$('#montant_tva').val('');
		$('#caution').val('');
		$('#mode_reglement').val('');
		$('#id_user').val('');
		$('#date_loyer').val('');
		;
		$('#anne_regelement').val('');
		
		
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
		$('#nom_locataire').val('');
        $('#Loyer_locataire').val('');
        $('#_1er_mois_regele').val('');
        $('#__2er_mois_regle').val('');
		$('#frais_agence').val('');
		$('#montant_tva').val('');
		$('#caution').val('');
		$('#mode_reglement').val('');
		$('#date_loyer').val('');
		$('#id_user').val('');
		$('#anne_regelement').val('');
        $('#message').remove();
		
		
    });	
	
	
	
	
	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_locataire.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	
	var nom_locataire = $('#nom_locataire').val();
	var Loyer_locataire = $('#Loyer_locataire').val();
	var _1er_mois_regele = $('#_1er_mois_regele').val();
	var __2er_mois_regle = $('#__2er_mois_regle').val();
	var frais_agence = $('#frais_agence').val();
	var montant_tva = $('#montant_tva').val();
	var caution = $('#caution').val();
    var mode_reglement = $('#mode_reglement').val();
	var date_loyer = $('#date_loyer').val();
	var id_user = $('#id_user').val();
	var anne_regelement = $('#anne_regelement').val();
	
	
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    
	 
	 var Vid_bien =   sessionStorage.id_bien;
	 
 var donnees = {action:sessionStorage.even,
 
					nom_locataire:nom_locataire,
					Loyer_locataire:Loyer_locataire,
					_1er_mois_regele:_1er_mois_regele,
					__2er_mois_regle:__2er_mois_regle,
					frais_agence:frais_agence,
					montant_tva:montant_tva,
					caution:caution,
					mode_reglement:mode_reglement,
					Vid_bien:Vid_bien,
					date_loyer:date_loyer,
					anne_regelement:anne_regelement,
					id_user:id_user,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom_locataire":'+nom_locataire+',"Loyer_locataire":'+Loyer_locataire+',"_1er_mois_regele":'+_1er_mois_regele+',"__2er_mois_regle":'+__2er_mois_regle+',"frais_agence":'+frais_agence+',"montant_tva":'+montant_tva+',"caution":'+caution+',"mode_reglement":'+mode_reglement+',"Vid_bien":'+Vid_bien+',"date_loyer":'+date_loyer+',"anne_regelement":'+anne_regelement+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_nouveau_locataire.php" ,
        data: donnees,
        success : function(data) {
			console.log("Retour="+data.Motif);
			
					
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
			//$("#page-wrapper").load("liste_locataire_reglement.php");
			location.href="quittance_caution.php?Id_bien_envoye="+sessionStorage.id_bien;
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            $("#page-wrapper").load("liste_locataire_reglement.php");
			
            }

            });

		});
});

//VERIFICATION DU N°STICKER SAISIE


$(document).ready(function() {
	
	//$('#penalite').val('10%');

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
   
	
						
	//INFORMATIONS DU LOCATAIRE
	
	
	$('#locatairediv').find('input').val(sessionStorage.nom_locataire + ' ' +sessionStorage.prenoms_locataire );
	console.log(sessionStorage.prenoms_locataire);
	
	
	$('#loyer_locatairediv').find('input').val(sessionStorage.prix_bien);
	//$('#test').find('input').val(sessionStorage.prix_bien);
	$('#id_bien_okdiv').find('input').val(sessionStorage.id_bien);
	
	
	
	
	//TRAITEMENT DES CONDITIONS DE PENALITES 
	
	
	
	}
});


</script>     
 