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
        <h4 class="page-header " style="margin-top:10px;">ENREGISTREMENT DU LOCATAIRE</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-6">
            <div class="panel panel-default  panel-green">
                <div class="panel-heading">
                    Infos Locataire
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                            <div class="" id="nom1div">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="nom" id="nom" value="" >
                            </div>
                            <div class="" id="prenomdiv">
                                <label class="label_form">Prénoms</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="prenom" id="prenom" value=""  >
                            </div>
                            <div class="" id="datenaissancediv">
                                <label class="label_form">Date naissance</label>
                                <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="datenaissance" id="datenaissance" value="" >
                            </div>
                            <div class="" id="lieunaissancediv">
                                <label class="label_form">Lieu naissance</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="lieunaissance" id="lieunaissance" value="" >
                            </div>
                            <div class="" id="cnisejourdiv">
                                <label class="label_form">Nature. Carte</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="nature_carte" id="nature_carte" value=""  placeholder="EXEMPLE: CNI">
                                <label class="label_form">N° de la Carte</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="cnisejour" id="cnisejour" value="" placeholder="EXEMPLE: C00189">
                                
                            </div>
                             <div class="" id="cnisejourdiv">
                                <label class="label_form">Délivré le</label>
                                 <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="delivre_carte" id="delivre_carte" value="" >
                                <label class="label_form">Expire le</label>
                                 <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="expire_carte" id="expire_carte" value="" >
                                
                            </div>
                            
                            <div class="" id="telephonediv">
                                <label class="label_form">Téléphone</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="telephone" id="telephone" value=""  >
                            </div>
                            <div class="" id="emaildiv">
                                <label class="label_form">E-mail</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="e_mail" id="e_mail" value="" >
                            </div>

                            <div class="" id="fonctiondiv">
                                <label class="label_form">Profession</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="profession" id="profession" value=""  >
                            </div>
                            <div class="" id="cautiondiv">
                                <label class="label_form">Caution</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="caution" id="caution" value=""  >
                            </div>
                            <div class="" id="frais_de_gestiondiv">
                                <label class="label_form">Frais d'Agence</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="frais_de_gestion" id="frais_de_gestion" value=""  >
                            </div>
                             <div class="" id="datenaissancediv">
                                <label class="label_form">Date d'entreé du locataire</label>
                                <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="date_entree_locataire" id="date_entree_locataire" value="" >
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>

            <!-- /.panel -->
        </div>

        <div class="col-lg-6">
            <div class="panel panel-default  panel-green">

                <div class="panel-heading">
                    Infos Du Bien
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <label class="label_form">Type Bien</label>
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='type_bien'name='type_bien'   class='form-control'  style='margin-bottom:5px;' required readonly>
					<option value='' selected></option>\n";
					
					

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
					


						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                           
                            <div class="" id="localitediv">
                                <label class="label_form">Quartier</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:200px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="localite" id="localite" value="" required readonly>
                            </div>
                            <div class="" id="loyerdiv">
                                <label class="label_form">Loyer </label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="loyer_agence" id="loyer_agence" value="" required readonly>
                            </div>
                            
                             
                            <div class="" id="nomdiv">
                                <label class="label_form">Code du proprietaire</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="num_impot" id="num_impot" value="" required readonly="readonly">
                            </div>
                            
                           

                             <div class="" id="descriptiondiv">
                                <label class="label_form"></label>
                                <textarea name="description" id="description" style='width:400px;height:100px;' placeholder="DESCRIPTION" onkeydown="upperCaseF(this)"></textarea>
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
                         <input type="hidden" name="id_user" id="id_user" value="<?php echo( $id_user);?>">
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
        $('#date_entree_locataire').val('');
        $('#expire_carte').val('');
		$('#delivre_carte').val('');
		$('#nature_carte').val('');
        $('#lieunaissance').val('');
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
		$('#id_user').val('');
		$('#V_commission').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#num_impot').val('');
		$('#description').val('');
		$('#frais_de_gestion').val('');
		$('#loyer_final').val('');
		$('#caution').val('');
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
		 $('#expire_carte').val('');
		  $('#delivre_carte').val('');
        $('#nature_carte').val('');
        $('#lieunaissance').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		$('#date_entree_locataire').val('');
		//$('#quartier').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#nbre_piece').val('');
		$('#localite').val('');
		$('#loyer_agence').val('');
		$('#num_ncc').val('');
		$('#V_commission').val('');
		$('#frais_de_gestion').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#commune').val('');
		$('#num_impot').val('');
		$('#caution').val('');
		$('#loyer_final').val('');
		$('#id_user').val('');
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
	var delivre_carte = $('#delivre_carte').val();
	var expire_carte = $('#expire_carte').val();
	var nature_carte = $('#nature_carte').val();
	var datenaissance = $('#datenaissance').val();
	var lieunaissance = $('#lieunaissance').val();
	var cnisejour = $('#cnisejour').val();
	var telephone = $('#telephone').val();
	var nbre_piece = $('#nbre_piece').val();
	var date_entree_locataire = $('#date_entree_locataire').val();
	
	var id_user = $('#id_user').val();
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
	var caution = $('#caution').val();
	var frais_de_gestion = $('#frais_de_gestion').val();
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
					date_entree_locataire:date_entree_locataire,
					delivre_carte:delivre_carte,
					nature_carte:nature_carte,
					expire_carte:expire_carte,
					profession:profession,
					type_bien:type_bien,
					prise_en_charge:prise_en_charge,
					localite:localite,
					num_ncc:num_ncc,
					nbre_piece:nbre_piece,
					id_user:id_user,
					num_impot:num_impot,
					nom_proprio:nom_proprio,
					description:description,
					e_mail:e_mail,
					loyer_agence:loyer_agence,
					Vid_bien:Vid_bien,
					caution:caution,
					frais_de_gestion:frais_de_gestion,
					commune:commune,
					V_commission:V_commission,
					frais_agence:frais_agence,
					loyer_final:loyer_final,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+'/,"profession":'+profession+',"type_bien":'+type_bien+',"localite":'+localite+',"num_impot":'+num_impot+',"id du bien":'+Vid_bien+',"commune":'+commune+',"Commission":'+V_commission+',"frais_agence":'+frais_agence+',"loyer_final":'+loyer_final+',"id_user":'+id_user+'}');
					
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
			//location.href="contrat_baille_habitation.php?Id_bien_envoye="+sessionStorage.id_bien;
			
			//location.href="http://www.example.com/default.htm";
			
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            $("#page-wrapper").load("liste_locataire.php");
			
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
	
	$('#loyerdiv').find('input').val(sessionStorage.prix_bien);
	$('#localitediv').find('input').val(sessionStorage.quartier_bien);
	$('#descriptiondiv').find('textarea').val(sessionStorage.description);
	$('#impotdiv').find('input').val(sessionStorage.impot_foncier);
	$('#num_ncc_div').find('input').val(sessionStorage.num_ncc);
	$('#frais_agencediv').find('input').val(sessionStorage.frais_agence);
	$('#loyer_finaldiv').find('input').val(sessionStorage.loyer_proprietaire);
																																						$('#categorie_bien').append('<option value='+ sessionStorage.id_categorie_bien +' selected>'+ sessionStorage.libelle_categorie_bien +'</option>');	
	
	$('#V_commission').append('<option value='+ sessionStorage.id_commission +' selected>'+ sessionStorage.libelle_commission +'</option>');					
    $('#commune').append('<option value='+ sessionStorage.id_commune +' selected>'+ sessionStorage.libelle_categorie_commune +'</option>');
   $('#nbre_piece').append('<option value='+ sessionStorage.id_nbre_piece +' selected>'+ sessionStorage.libelle_piece +'</option>');
	$('#type_bien').append('<option value='+ sessionStorage.id_type_bien +' selected>'+ sessionStorage.libelle_type_bien +'</option>');
	$('#prise_en_charge').append('<option value='+ sessionStorage.id_charge +' selected>'+ sessionStorage.libelle_charge +'</option>');
	}
});

</script>     
 