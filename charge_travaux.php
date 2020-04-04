<head>
<link rel="stylesheet" href="css/popupform.css"/>

</head>
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header " style="margin-top:10px;" align="center">ENREGISTREMENT DES TRAVAUX</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form" >
      <!--  <div class="col-lg-6">
            <div class="panel panel-default  panel-green">
                <div class="panel-heading">
                    Infos Locataire
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                            <div class="" id="nom1div">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="nom" id="nom" value="" readonly>
                            </div>
                            <div class="" id="prenomdiv">
                                <label class="label_form">Prénoms</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="prenom" id="prenom" value="" readonly >
                            </div>
                            <div class="" id="datenaissancediv">
                                <label class="label_form">Date naissance</label>
                                <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="datenaissance" id="datenaissance" value="" readonly>
                            </div>
                            <div class="" id="lieunaissancediv">
                                <label class="label_form">Lieu naissance</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="lieunaissance" id="lieunaissance" value="" readonly>
                            </div>
                            <div class="" id="cnisejourdiv">
                                <label class="label_form">CNI/Sejour</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="cnisejour" id="cnisejour" value="" readonly >
                            </div>
                            <div class="" id="telephonediv">
                                <label class="label_form">Téléphone</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="telephone" id="telephone" value=""  readonly>
                            </div>
                            <div class="" id="emaildiv">
                                <label class="label_form">E-mail</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="e_mail" id="e_mail" value=""readonly >
                            </div>

                           <!-- <div class="" id="quartierdiv">
                                <label class="label_form">Quartier</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="">
                            </div>-->
                           <!-- <div class="" id="fonctiondiv">
                                <label class="label_form">Profession</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:400px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="profession" id="profession" value=""  readonly>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    <!--</div>
                    <!-- /.row (nested) -->
                <!--</div>-->
                <!-- /.panel-body -->
            <!--</div>-->

            <!-- /.panel -->
      <!--  </div>-->

        <div class="col-lg-6" style="margin-left:280px;">
            <div class="panel panel-default  panel-green">

                <div class="panel-heading">
                    Informations requises
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                         <div class="" id="nom1div">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="nom" id="nom" value="" readonly>
                            </div>
                            
                            <div class="" id="prenomdiv">
                                <label class="label_form">Prénoms</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="prenom" id="prenom" value="" readonly >
                            </div>
                            <div class="">
                                <label class="label_form">Type Bien</label>
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='type_bien'name='type_bien'  class='form-control'  style='margin-bottom:5px;' required readonly>
					<option value='' selected></option>\n";
					
						/*
						$query1 ="SELECT
										type_bien.id_type_bien,
										type_bien.libelle_type_bien
										FROM
										type_bien";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_type_bien = $row['id_type_bien'];
							$libelle_type_bien = $row['libelle_type_bien'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_type_bien'>$libelle_type_bien</option>\n";
							
						}*/

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                            <div class="">
                                <label class="label_form">Categ. Bien</label>
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='categorie_bien'name='categorie_bien'   class='form-control'  style='margin-bottom:5px;' required readonly>
					<option value='' selected></option>\n";
					
						

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                           
                            
                             <div class="">
                                <label class="label_form">Nbre de pièces</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='nbre_piece'name='nbre_piece'   class='form-control'  style='margin-bottom:5px;' required readonly>
					<option value='' selected></option>\n";
					/*

						$query1 ="SELECT
										nbre_piece.id_nbre_piece,
										nbre_piece.libelle_piece
										FROM
										nbre_piece";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_nbre_piece = $row['id_nbre_piece'];
							$libelle_piece = $row['libelle_piece'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_nbre_piece'>$libelle_piece</option>\n";
							
						}*/

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                             <div class="">
                                <label class="label_form">Commune</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='commune'name='commune'   class='form-control'  style='margin-bottom:5px;' required readonly>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					
/*
						$query1 ="SELECT
										commune.id_commune,
										commune.libelle_categorie_commune
										FROM
										commune";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_commune = $row['id_commune'];
							$libelle_categorie_commune = $row['libelle_categorie_commune'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_commune'>$libelle_categorie_commune</option>\n";
							
						}*/

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                           
                            <div class="" id="localitediv">
                                <label class="label_form">Quartier</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:200px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="localite" id="localite" value="" required readonly>
                            </div>
                            <div class="" id="loyerdiv">
                                <label class="label_form">Loyer </label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="loyer_agence" id="loyer_agence" value="" required readonly>
                            </div>
                            <div class="" id="nomdiv">
                                <label class="label_form">Code du proprietaire</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="num_impot" id="num_impot" value="" required readonly>
                            </div>
                            
                           <div class="" id="date_travauxdiv">
                                <label class="label_form">Date Travaux</label>
                                <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="date_travaux" id="date_travaux" value="" >
                            </div>
                            
                            <div class="" id="mt_travauxdiv">
                                <label class="label_form">Mt Travaux</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="Mt_travaux" id="Mt_travaux" value="" required >
                            </div>

                            <div class="">
                                <label class="label_form">Commission</label>
                                 <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='V_commission'name='V_commission'   class='form-control'  style='text-transform: capitalize;width:150px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
										commission.id_commission,
										commission.libelle_commission
										FROM
										commission";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_commission = $row['id_commission'];
							$libelle_commission = $row['libelle_commission'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_commission'>$libelle_commission</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                             <div class="">
                                <label class="label_form">Prise en  Charge</label>
                                 <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='prise_en_charge'name='prise_en_charge'   class='form-control'  style='text-transform: capitalize;width:150px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
										responssabilite.id_responssabilite,
										responssabilite.libelle_responssabilite
										FROM
										responssabilite";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_responssabilite = $row['id_responssabilite'];
							$libelle_responssabilite = $row['libelle_responssabilite'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_responssabilite'>$libelle_responssabilite</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                             
                            
                            <div class="" id="mt_total_travauxdiv">
                                <label class="label_form">Mt Total</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onKeyDown="upperCaseF(this)" name="num_impot" id="mt_total_travaux" value="" required readonly>
                            </div>

                            <div class="" id="descriptiondiv">
                                <label class="label_form"></label>
                                <textarea name="description_travaux" id="description_travaux" onkeydown="upperCaseF(this)" placeholder="DESCRIPTION DES TRAVAUX"  style="text-transform: capitalize;width:400px;margin-bottom:5px;"></textarea>
                            </div>
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="TFDPPCA">

                        </div>
                        <!-- /.col-lg-6 (nested) -->
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
        $("#page-wrapper").load("liste_charge.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_charge.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#nom').val('');
        $('#prenom').val('');
        $('#datenaissance').val('');
        $('#lieunaissance').val('');
		$('#prise_en_charge').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		$('#quartier').val('');
		$('#nbre_piece').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#localite').val('');
		$('#loyer_agence').val('');
		$('#Mt_travaux').val('');
		$('#num_ncc').val('');
		$('#mt_total_travaux').val('');
		$('#V_commission').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#num_impot').val('');
		$('#description_travaux').val('');
		$('#loyer_final').val('');
		$('#date_travaux').val('');
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
		$('#prise_en_charge').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		$('#mt_total_travaux').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#nbre_piece').val('');
		$('#localite').val('');
		$('#loyer_agence').val('');
		$('#num_ncc').val('');
		$('#Mt_travaux').val('');
		$('#V_commission').val('');
		//$('#montant').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#commune').val('');
		$('#num_impot').val('');
		$('#loyer_final').val('');
		$('#date_travaux').val('');
		$('#frais_agence').val('');
		$('#description_travaux').val('');
        $('#message').remove();
		
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_locataire.php");
    });
	
	$('#mt_total_travaux').empty();
	
	 $("#V_commission").change(function(){

            if ( Mt_travaux!==null) {
                choisirmontant();
            }
        });

        function choisirmontant() {
            var Mt_travaux = $('#Mt_travaux').val();
            var V_commission = $('#V_commission').val();
   // alert(activite);
 // alert(categorie);
 

var donnees = {action:"SELECTAJAX",
Mt_travaux:Mt_travaux,
V_commission:V_commission};
console.log('{"acte":"Loyer","action":"select","V_commission":'+V_commission+',"montant":'+Mt_travaux+'}');     

$.ajax({
    type: "POST",
    url: "traitement_charge.php" ,
    data: donnees,
    success : function(data) {      
        //console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');


    $('#mt_total_travauxdiv').find('input').val(data.Mt_total_travaux);
	$('#frais_agencediv').find('input').val(data.frais_agence);
	
    
   }                       
	
	});
		
	}
	
	

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
	var prise_en_charge = $('#prise_en_charge').val();
	var num_ncc = $('#num_ncc').val();
	var Mt_travaux = $('#Mt_travaux').val();
	var mt_total_travaux = $('#mt_total_travaux').val();
	var loyer_agence = $('#loyer_agence').val();
	var V_commission = $('#V_commission').val();
	var commune = $('#commune').val();
	var prise_en_charge = $('#prise_en_charge').val();
	var nom_proprio = $('#nom_proprio').val();
	var num_impot = $('#num_impot').val();
	var loyer_final = $('#loyer_final').val();
	var frais_agence = $('#frais_agence').val();
	var date_travaux = $('#date_travaux').val();
	var description_travaux = $('#description_travaux').val();
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
					mt_total_travaux:mt_total_travaux,
					profession:profession,
					type_bien:type_bien,
					prise_en_charge:prise_en_charge,
					localite:localite,
					num_ncc:num_ncc,
					nbre_piece:nbre_piece,
					Mt_travaux:Mt_travaux,
					num_impot:num_impot,
					nom_proprio:nom_proprio,
					description_travaux:description_travaux,
					e_mail:e_mail,
					loyer_agence:loyer_agence,
					Vid_bien:Vid_bien,
					date_travaux:date_travaux,
					commune:commune,
					V_commission:V_commission,
					prise_en_charge:prise_en_charge,
					frais_agence:frais_agence,
					//loyer_final:loyer_final,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+'/,"profession":'+profession+',"type_bien":'+type_bien+',"localite":'+localite+',"num_impot":'+num_impot+',"id du bien":'+Vid_bien+',"commune":'+commune+',"Commission":'+V_commission+',"frais_agence":'+frais_agence+',"loyer_final":'+loyer_final+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_charge.php" ,
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
   // $('#datenaissancediv').find('input').val(sessionStorage.date_nais_proprietaire);
	// $('#lieunaissancediv').find('input').val(sessionStorage.lieu_nais_proprietaire);
   /// $('#cnisejourdiv').find('input').val(sessionStorage.cni_proprietaire);
   // $('#telephonediv').find('input').val(sessionStorage.contact);
	//$('#emaildiv').find('input').val(sessionStorage.e_mail);
	//$('#quartierdiv').find('input').val(sessionStorage.localite);
	//$('#fonctiondiv').find('input').val(sessionStorage.fonction);
	$('#loyerdiv').find('input').val(sessionStorage.prix_bien);
	$('#localitediv').find('input').val(sessionStorage.quartier_bien);
	//$('#descriptiondiv').find('textarea').val(sessionStorage.description);
	$('#impotdiv').find('input').val(sessionStorage.impot_foncier);
	$('#num_ncc_div').find('input').val(sessionStorage.num_ncc);
	$('#frais_agencediv').find('input').val(sessionStorage.frais_agence);
	$('#loyer_finaldiv').find('input').val(sessionStorage.loyer_proprietaire);
	
	//INFORMATIONS DU LOCATAIRE
	
	$('#nom1div').find('input').val(sessionStorage.nom_locataire);
	$('#prenomdiv').find('input').val(sessionStorage.prenoms_locataire);
	$('#datenaissancediv').find('input').val(sessionStorage.date_nais_locataire);
	$('#lieunaissancediv').find('input').val(sessionStorage.lieu_nais_locataire);
	$('#telephonediv').find('input').val(sessionStorage.telephone_locataire);
	$('#cnisejourdiv').find('input').val(sessionStorage.num_cni_sejour);
	$('#fonctiondiv').find('input').val(sessionStorage.fonction_locataire);
	$('#emaildiv').find('input').val(sessionStorage.e_maill_locataire);
	//$('#loyer_finaldiv').find('input').val(sessionStorage.loyer_proprietaire);
	//$('#loyer_finaldiv').find('input').val(sessionStorage.loyer_proprietaire);
	
	
	
	/* sessionStorage.id_locataire = data.id_locataire;
							  sessionStorage.nom_locataire = data.nom_locataire;
							   sessionStorage.prenoms_locataire = data.prenoms_locataire;
							    sessionStorage.date_nais_locataire = data.date_nais_locataire;
								 sessionStorage.lieu_nais_locataire = data.lieu_nais_locataire;
								 sessionStorage.telephone_locataire = data.telephone_locataire;
								 sessionStorage.num_cni_sejour = data.num_cni_sejour;
								 sessionStorage.fonction_locataire = data.fonction_locataire;
								 sessionStorage.e_maill_locataire = data.e_maill_locataire;*/
						
																																						$('#categorie_bien').append('<option value='+ sessionStorage.id_categorie_bien +' selected>'+ sessionStorage.libelle_categorie_bien +'</option>');	
	
	//$('#V_commission').append('<option value='+ sessionStorage.id_commission +' selected>'+ sessionStorage.libelle_commission +'</option>');					
    $('#commune').append('<option value='+ sessionStorage.id_commune +' selected>'+ sessionStorage.libelle_categorie_commune +'</option>');
   $('#nbre_piece').append('<option value='+ sessionStorage.id_nbre_piece +' selected>'+ sessionStorage.libelle_piece +'</option>');
	$('#type_bien').append('<option value='+ sessionStorage.id_type_bien +' selected>'+ sessionStorage.libelle_type_bien +'</option>');
	//$('#prise_en_charge').append('<option value='+ sessionStorage.id_charge +' selected>'+ sessionStorage.libelle_charge +'</option>');
	}
});

</script>     
 