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
        <h4 class="page-header " style="margin-top:10px;">ENREGISTREMENT DU PROPRIETAIRE</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="panel panel-default  panel-green">
                <div class="panel-heading">
                    Infos Propriétaire
                </div>                                
                <div class="panel-body">
                    <div class="row">
                       <!-- <div class="col-12 col-sm-6 col-lg-4">-->
                        
                           <div class="col-lg-12" >
                                <label class="label_form">Proprietaire</label>
                                
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='nom_proprio'name='nom_proprio'   class='form-control'  style='margin-bottom:5px;'>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

						$query1 ="SELECT
										proprietaire.id_proprietaire,
										proprietaire.nom_proprietaire,
										proprietaire.prenoms
										FROM
										proprietaire";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_proprietaire = $row['id_proprietaire'];
							$nom_proprietaire = $row['nom_proprietaire'];
							$prenoms = $row['prenoms'];
							
							$nom_complet=$nom_proprietaire . ' ' .$prenoms;
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_proprietaire'>$nom_complet</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                        <!------------------------------------------------------------------>
                        
                      
                      <div class="col-lg-12" id="nomdiv">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="nom" id="nom" value="" style="margin-bottom:5px;" >
                      </div>
                       
                       <div class="col-lg-12" id="prenomdiv">
                                <label class="label_form">Prenoms</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="prenom" id="prenom" value="" style="margin-bottom:5px;" >
                      </div>
                       <div class="col-lg-12" id="initialdiv">
                                <label class="label_form">Initial </label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="initial" id="initial" value="" style="margin-bottom:5px;" >
                      </div>
                 
                       <div class="col-lg-12" id="datenaissancediv">
                                <label class="label_form">Date naissance</label>
                      <input class="form-control" type="date"  onkeydown="upperCaseF(this)" name="datenaissance" id="datenaissance" value="" style="margin-bottom:5px;" >
                      </div> 
                                           
                   <div class="col-lg-12" id="lieunaissancediv">
                                <label class="label_form">Lieu naissance</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="lieunaissance" id="lieunaissance" value="" style="margin-bottom:5px;" >
                      </div>  
                      <div class="col-lg-12" id="cnisejourdiv">
                                <label class="label_form">CNI/Sejour</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="cnisejour" id="cnisejour" value="" style="margin-bottom:5px;" >
                      </div>  
                       <div class="col-lg-12" id="telephonediv">
                                <label class="label_form">Téléphone</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="telephone" id="telephone" value="" style="margin-bottom:5px;" >
                      </div>  
                       <div class="col-lg-12" id="emaildiv">
                                <label class="label_form">E-mail</label>
                      <input class="form-control" type="email"  onkeydown="upperCaseF(this)" name="e_mail" id="e_mail" value=""style="margin-bottom:5px;" >
                      </div>
                       <div class="col-lg-12" id="quartierdiv">
                                <label class="label_form">Quartier</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="" style="margin-bottom:5px;" >
                      </div>
                      <div class="col-lg-12" id="fonctiondiv">
                                <label class="label_form">Profession</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="profession" id="profession" value="" style="margin-bottom:5px;" >
                      
                      </div>
                      <div class="col-lg-12" id="societediv">
                                <label class="label_form">Société</label>
                      <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="societe" id="societe" value="" style="margin-bottom:5px;" >
                      </div>
                      <div class="col-lg-12" id="num_ncc_div">
                                <label class="label_form">N°CC</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="num_ncc" id="num_ncc" value="" >
                            </div>
                                            
                          
                        <!------------------------------------------------------------------->
                         
                        <!--</div>-->
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
                    Infos Du Bien en Vente
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                     
                            <div class="col-lg-12">
                                <label class="label_form">Type de Bien</label>
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='type_bien' name='type_bien'   class='form-control' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

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
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                             <div id="lbl_nom_immeublediv" style="display: none">
                            <!-- <div class="col-lg-12" id="lbl_mt_impotdiv">-->
                                <label class="label_form">Nom Immeuble</label>
                               <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="nom_immeuble" id="nom_immeuble" value=""  >
                           
                            </div>
                            
                            
                           <div class="col-lg-12">
                                <label class="label_form"> Categ. Bien</label>
                               
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='categorie_bien' name='categorie_bien'   class='form-control'  required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                             <div id="nbre_place_garagediv" style="display: none">
                            <!-- <div class="col-lg-12" id="lbl_mt_impotdiv">-->
                                <label class="label_form">Paking</label>
                               <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="nbre_place_garage" id="nbre_place_garage" value=""  >
                               
                           
                           
                           
                            </div>
                            
                            <div class="col-lg-12" id="nbre_pi_div">
                                <label class="label_form">Nbre de pièces</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='nbre_piece'name='nbre_piece'   class='form-control'  ' >
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

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
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            <div class="col-lg-12" id="appartementdiv">
                                <label class="label_form">N° Appartement</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="num_appartement" id="num_appartement" value="" >
                            </div>
                            
                            <div class="col-lg-12" id="lotdiv">
                                <label class="label_form">Lot</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="lot" id="lot" value="" >
                            </div>
                            <div class="col-lg-12" id="ilotdiv">
                                <label class="label_form">Ilot</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="ilot" id="ilot" value="" >
                            </div>
                             <div class="col-lg-12" id="impotdiv">
                                <label class="label_form">N°Titre Foncier</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="num_impot" id="num_impot" value=""  >
                            </div>
                             <div class="col-lg-12" id="parcellediv">
                                <label class="label_form">Parcelle</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="parcelle" id="parcelle" value=""  >
                            </div>
                            
                            
                             <div class="col-lg-12">
                                <label class="label_form">Commune</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='commune'name='commune'   class='form-control'   >
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";
					

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
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                            </div>
                            
                           
                            <div class="col-lg-12" id="localitediv">
                                <label class="label_form">Quartier</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="localite" id="localite" value="" >
                            </div>
                             <div class="col-lg-12" id="loyerdiv">
                             
                             
                             <div class="col-lg-8" id="loyerdiv">
                                <label class="label_form">Prix de Vente </label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="montant" id="montant" value=""placeholder="Mini" >
                            </div>
                            <div class="col-lg-4" id="loyerdiv">
                                <label class="label_form" style="margin-left:200;"></label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="montant" id="montant" value="" style="margin-left:60px;margin-top:7px;" placeholder="Maxi">
                            </div>
                            
                             </div>
                            
                            
                             <div class="col-lg-12">
                                <label class="label_form">Commission</label>
                                <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='V_commission'name='V_commission'   class='form-control'  >
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
                            
                            <div class="col-lg-12" id="loyer_finaldiv">
                                <label class="label_form">Loyer Proprietaire</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="loyer_final" id="loyer_final" value="" required readonly><!--<label class="label_form" style="margin-left:10px">FCFA</label>-->
                            </div>
                            <div class="col-lg-12" id="frais_agencediv">
                                <label class="label_form">Frais d'agence</label>
                                <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="frais_agence" id="frais_agence" value="" required readonly><!--<label class="label_form" style="margin-left:-5px">FCFA</label>-->
                            </div>
                            
                            
                             <div class="col-lg-12" id="lbl_rehabilitation">
                                <label class="label_form">Réhabilitation</label>

                                <select id='rehabilitation' name='rehabilitation' class='form-control' >
                               <option value='2'>Non</option>
                                </option><option value='1'>Oui</option>
                               
							</select>
                            </div>
                            <div class="col-lg-12" id="lbl_apport_proprietaire_div">
                                <label class="label_form">Apport Propriétaire</label>

                                <input type="text"  class="form-control" name="apport_proprietaire" id="apport_proprietaire" value="">
                               
							
                            </div>
                            <div class="col-lg-12" id="lbl_apport_cristal_div">
                                <label class="label_form">Apport Cristal</label>

                                <input type="text"  class="form-control" name="apport_cristal" id="apport_cristal" value="">
                            </div>

                            
                            <div class="col-lg-12" id="exercicediv">
                                <label class="label_form">Travaux</label>

                                <select id='prise_en_charge' name='prise_en_charge' class='form-control' required>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>Oui</option>
                                </option><option value='2'>Non</option>
                               
							</select>
                            </div>
                            
                            
                            
                            <div class="col-lg-12">
                                <label class="label_form">Charge Impôt</label>

                                <select id='charge_impot' name='charge_impot' class='form-control'>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>Oui</option>
                                </option><option value='2'>Non</option>
                               
							</select>
                            
                           
                            </div>
                            <!--<div id="lbl_mt_impotdiv" style="display: none">-->
                             <div class="col-lg-12" id="lbl_mt_impotdiv">
                                <label class="label_form">Mt Impôt</label>
                               <input class="form-control" type="text"  onkeydown="upperCaseF(this)" name="mt_impot" id="mt_impot" value=""  >
                           
                            </div>

                             <div class="col-lg-12" id="descriptiondiv">
                                <label class="label_form"></label>
                                <textarea name="description" id="description" onkeydown="upperCaseF(this)" placeholder="OBSERVATIONS" style="width:350px;"></textarea>
                            </div>
                            
                             <!--<div class="col-lg-12" id="impotdiv">
                                <label class="label_form">Photo</label>
                                <input class="form-control" type="file"  onkeydown="upperCaseF(this)" name="Photo1" id="Photo1" value="" required >
                            </div>-->
                            
                            
                            <input type="hidden" name="action" id="action" value="">
                             <input type="hidden" name="id_user" id="id_user" value="<?php echo( $id_user);?>">
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
        $("#page-wrapper").load("liste_proprietaire.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_proprietaire.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#societe').val('');
		$('#apport_proprietaire').val('');
		$('#apport_cristal').val('');
		//$('#rehabilitation').val('');
		$('#nom').val('');
        $('#prenom').val('');
		$('#initial').val('');
        $('#datenaissance').val('');
        $('#lieunaissance').val('');
		$('#num_appartement').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#e_mail').val('');
		$('#charge_impot').val('');
		$('#quartier').val('');
		$('#parcelle').val('');
		$('#ilot').val('');
		$('#lot').val('');
		$('#nbre_piece').val('');
		$('#profession').val('');
		$('#type_bien').val('');
		$('#categorie_bien').val('');
		$('#localite').val('');
		$('#num_ncc').val('');
		$('#montant').val('');
		///$('#Photo1').val('');
		$('#V_commission').val('');
		$('#prise_en_charge').val('');
		$('#nom_proprio').val('');
		$('#mt_impot').val('');
		$('#num_impot').val('');
		$('#description').val('');
		$('#loyer_final').val('');
		$('#frais_agence').val('');
		$('#nbre_place_garage').val('');
		$('#id_user').val('');
		$('#nom_immeuble').val('');
		$('#commune').val('');
        $('#message').remove();
    }); 
	
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("proprietaire.php");
    });
    $(document).ready(function() {
		
		//$('#message').hide();
		//$('#message2').hide();
		
	//AU CHARGEMENT DE LA PAGE LE CHAMP MONT IMPOT EST DESACTIVE
//mt_impot.style.display ="none"
//lbl_mt_impotdiv.style.display = "none"
		
        $('#form')[0].reset();
        $('#action').val(sessionStorage.even);
        $("#montant").change(function(){
            var montant = $('#montant').val();
            var V_commission = $('#V_commission').val();
            if ( V_commission!==null) {
                choisirmontant();
            }
        });
		
		
		
		//MASQUER LE CHAMP MONT IMPÔT 
    $("#rehabilitation").change(function()
    {
		
        var rehabilitation = $('#rehabilitation').val();
        var donnees = {action:"Req_rehabilitation",
            rehabilitation:rehabilitation,
			
			
			
        }
		console.log('action:Req_rehabilitation','rehabilitation:'+rehabilitation);
        $.ajax({
            type: "POST",
            url: "traitement_proprietaire.php",
            data: donnees,
            success : function(data) {
                console.log('retour = '+data.rehabilitation);
				
				
			
			//boton_position.style.display = "bl
			
         if (data.rehabilitation==1){
			 
			  // console.log('retour je suis dans prise en charge impot');
			 
			  apport_proprietaire.style.display ="block"
			   lbl_apport_proprietaire_div.style.display ="block"
			apport_cristal.style.display = "block"
			lbl_apport_cristal.style.display = "block"
			
		 }else if (data.rehabilitation==2){
			// MASQUER LES CHAMPS 
			 
			  lbl_apport_proprietaire_div.style.display ="none"
			apport_proprietaire.style.display = "none"
			apport_cristal.style.display = "none"
			lbl_apport_cristal_div.style.display = "none"
			
			 }
			
            }
        })
        
    });
		
		
		//MASQUER LE CHAMP Nombre de place pour le garage 
		
		
		
		//MASQUER LE CHAMP MONT IMPÔT 
		
	
    $("#charge_impot").change(function()
    {
		
        var charge_impot = $('#charge_impot').val();
        var donnees = {action:"Req_charge_impot",
            charge_impot:charge_impot,
        }
		console.log('action:Req_charge_impot','charge impot:'+charge_impot);
        $.ajax({
            type: "POST",
            url: "traitement_proprietaire.php",
            data: donnees,
            success : function(data) {
                console.log('retour = '+data.id_charge_impot);
				
				
			
			//boton_position.style.display = "bl
				
         if (data.id_charge_impot==1){
			 
			  // console.log('retour je suis dans prise en charge impot');
			 
			  mt_impot.style.display ="block"
			lbl_mt_impotdiv.style.display = "block"
			//boton_position.style.display = "block"
			 //latitude.style.display ="block"
			  //longitude.style.display ="block";
			  
		 }else if (data.id_charge_impot==2){
			// MASQUER LES CHAMPS 
			 
			  mt_impot.style.display ="none"
			lbl_mt_impotdiv.style.display = "none"
			
			 }
			
            }
        })
        
    });
		
		
		//MASQUER LE CHAMP Nombre de place pour le garage 
		
	
    $("#categorie_bien").change(function()
    {
		
        var categorie_bien = $('#categorie_bien').val();
        var donnees = {action:"Req_categorie_bien",
            categorie_bien:categorie_bien,
        }
		console.log('action:Req_categorie_bien','categorie bien:'+categorie_bien);
        $.ajax({
            type: "POST",
            url: "traitement_proprietaire.php",
            data: donnees,
            success : function(data) {
                console.log('retour de la categorie de bien= '+data.id_categorie_bien);
			
				
         if (data.id_categorie_bien==10){
			 
			  // console.log('retour je suis dans prise en charge impot');
			 
			  nbre_place_garage.style.display ="block"    
			nbre_place_garagediv.style.display = "block"
			
			 nbre_pi_div.style.display ="none"
			  nbre_piece.style.display ="none"
			  
			  appartementdiv.style.display ="none"
			  num_appartement.style.display ="none"
			
			  
		 }else {
			// MASQUER LES CHAMPS 
			 
			  nbre_place_garage.style.display ="none"
			nbre_place_garagediv.style.display = "none"
			
			 }
			
            }
        })
        
    });
	
		//DEBUT DU CODE POUR LE CHARGEMENT DE LA DEUXIEME LISTE DEROULANTE
    $("#type_bien").change(function()
	
    {
		 var type_bien = $('#type_bien').val();
		
		if(type_bien==2){
			
			
			 nom_immeuble.style.display ="block"    
			lbl_nom_immeublediv.style.display = "block"
			
			
			}else{
				
				nom_immeuble.style.display ="none"
			lbl_nom_immeublediv.style.display = "none"
				
				
				}
		
       
        var donnees = {action:"Requete_type",
            V_type_bien:type_bien,
        }
		//console.log('action:QUITTANCE','profession:'+profession);
        $.ajax({
            type: "POST",
            url: "traitement_proprietaire.php",
            data: donnees,
            success : function(ka) {
                console.log(ka);
				
				
				$('#categorie_bien').empty();
				$('#categorie_bien').append('<option value=0 selected>--Choisir--</option>');
				$.each(ka, function(index, categorie){
					$('#categorie_bien').append('<option value='+ categorie.Id +'>'+ categorie.Libelle +'</option>');
				});
				
            }
        })
        
    });
		//FIN DU CODE POUR LE CHARGEMENT DE LA DEUXIEME LISTE DEROULANTE

        $("#V_commission").change(function(){

            if ( montant!==null) {
                choisirmontant();
            }
        });

        function choisirmontant() {
            var montant = $('#montant').val();
            var V_commission = $('#V_commission').val();
   // alert(activite);
 // alert(categorie);
 
 

 

var donnees = {action:"SELECTAJAX",
montant:montant,
V_commission:V_commission};
console.log('{"acte":"Loyer","action":"select","V_commission":'+V_commission+',"montant":'+montant+'}');     

$.ajax({
    type: "POST",
    url: "traitement_proprietaire.php" ,
    data: donnees,
    success : function(data) {      
        //console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');


    $('#loyer_finaldiv').find('input').val(data.loyer_final);
	$('#frais_agencediv').find('input').val(data.frais_agence);
	
    
   }                       
	
	});
		
	}
	
$("input").focusout(function(){
    $(this).val($.trim($(this).val()));
});


$("#BoutonOUI").on('click', function()

	{
		$('#apport_proprietaire').val('');
		$('#apport_cristal').val('');
		$('#rehabilitation').val('');
		 $('#nom').val('');
		 $('#societe').val('');
        $('#prenom').val('');
		$('#datenaissance').val('');
        $('#initial').val('');
        $('#lieunaissance').val('');
		$('#cnisejour').val('');
		$('#telephone').val('');
		$('#charge_impot').val('');
		$('#e_mail').val('');
		$('#quartier').val('');
		$('#profession').val('');
		$('#ilot').val('');
		$('#lot').val('');
		$('#parcelle').val('');
		$('#type_bien').val('');
		$('#categorie_bien').val('');
		$('#nbre_piece').val('');
		$('#mt_impot').val('');
		//$('#Photo1').val('');
		$('#localite').val('');
		$('#num_ncc').val('');
		$('#V_commission').val('');
		$('#montant').val('');
		$('#prise_en_charge').val('');
		$('#mt_impot').val('');
		$('#nom_proprio').val('');
		$('#commune').val('');
		$('#num_impot').val('');
		$('#loyer_final').val('');
		$('#nbre_place_garage').val('');
		$('#frais_agence').val('');
		$('#num_appartement').val('');
		$('#nom_immeuble').val('');
		$('#description').val('');
		$('#id_user').val('');
        $('#message').remove();
		
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_proprietaire.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	

	var apport_proprietaire = $('#apport_proprietaire').val();
	var apport_cristal = $('#apport_cristal').val();	
	var rehabilitation = $('#rehabilitation').val();
	var nom = $('#nom').val();
	var societe = $('#societe').val();
	var prenom = $('#prenom').val();
	var initial = $('#initial').val();
	var datenaissance = $('#datenaissance').val();
	var lieunaissance = $('#lieunaissance').val();
	var cnisejour = $('#cnisejour').val();
	var telephone = $('#telephone').val();
	var nbre_piece = $('#nbre_piece').val();
	var mt_impot = $('#mt_impot').val();
	var quartier = $('#quartier').val();
    var profession = $('#profession').val();
	var categorie_bien = $('#categorie_bien').val();
	var type_bien = $('#type_bien').val();
	var localite = $('#localite').val();
	var charge_impot = $('#charge_impot').val();
	var e_mail = $('#e_mail').val();
	var parcelle = $('#parcelle').val();
	var num_ncc = $('#num_ncc').val();
	var ilot = $('#ilot').val();
	//var Photo1 = $('#Photo1').val();
	var num_appartement = $('#num_appartement').val();
	var lot = $('#lot').val();
	var montant = $('#montant').val();
	var V_commission = $('#V_commission').val();
	var commune = $('#commune').val();
	var prise_en_charge = $('#prise_en_charge').val();
	var nom_proprio = $('#nom_proprio').val();
	var num_impot = $('#num_impot').val();
	var loyer_final = $('#loyer_final').val();
	var frais_agence = $('#frais_agence').val();
	var description = $('#description').val();
	var nom_immeuble = $('#nom_immeuble').val();
	var id_user = $('#id_user').val();
	var nbre_place_garage = $('#nbre_place_garage').val();
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    //var data = $('form').serialize(); 
    // console.log('donnees = '+data);
	 
	 var Vid_bien =   sessionStorage.id_bien;
	 
 var donnees = {action:sessionStorage.even,
 
					nom:nom,
					apport_proprietaire:apport_proprietaire,
					apport_cristal:apport_cristal,
					rehabilitation:rehabilitation,
					prenom:prenom,
					datenaissance:datenaissance,
					lieunaissance:lieunaissance,
					cnisejour:cnisejour,
					telephone:telephone,
					quartier:quartier,
					profession:profession,
					type_bien:type_bien,
					prise_en_charge:prise_en_charge,
					localite:localite,
					num_ncc:num_ncc,
					nbre_piece:nbre_piece,
					montant:montant,
					num_impot:num_impot,
					nom_proprio:nom_proprio,
					description:description,
					e_mail:e_mail,
					Vid_bien:Vid_bien,
					commune:commune,
					initial:initial,
					V_commission:V_commission,
					frais_agence:frais_agence,
					loyer_final:loyer_final,
					categorie_bien:categorie_bien,
					charge_impot:charge_impot,
					ilot:ilot,
					nom_immeuble:nom_immeuble,
					parcelle:parcelle,
					nbre_place_garage:nbre_place_garage,
					lot:lot,
					mt_impot:mt_impot,
					num_appartement:num_appartement,
					id_user:id_user,
					societe:societe,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+',"quartier":'+quartier+',"profession":'+profession+',"type_bien":'+type_bien+',"localite":'+localite+',"montant":'+montant+',"num_impot":'+num_impot+',"id du bien":'+Vid_bien+',"commune":'+commune+',"Commission":'+V_commission+',"frais_agence":'+frais_agence+',"loyer_final":'+loyer_final+',"initial":'+initial+',"categorie_bien":'+categorie_bien+',"charge_impot":'+charge_impot+',"ilot":'+ilot+',"lot":'+lot+',"mt_impot":'+mt_impot+',"Id_user":'+id_user+',"societe":'+societe+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_proprietaire.php" ,
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
	
	
	//AU CHARGEMENT DE LA PAGE LE CHAMP MONT IMPOT EST DESACTIVE
//mt_impot.style.display ="none"
//lbl_mt_impotdiv.style.display = "none"
	
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

	//console.log('je suis le libelle de la catégorie bien  '+sessionStorage.libelle_categorie_bien);
	
	
		// Afectation des données dans chaque champs
	//$('#nomdiv').find('input').val(sessionStorage.nom_proprietaire);
	$('#lbl_apport_proprietaire_div').find('input').val(sessionStorage.apport_proprietaire);
	$('#lbl_apport_cristal_div').find('input').val(sessionStorage.apport_cristal);
	$('#nomdiv').find('input').val(sessionStorage.nom_proprietaire);
    $('#prenomdiv').find('input').val(sessionStorage.prenoms);
    $('#datenaissancediv').find('input').val(sessionStorage.date_nais_proprietaire);
	 $('#lieunaissancediv').find('input').val(sessionStorage.lieu_nais_proprietaire);
    $('#cnisejourdiv').find('input').val(sessionStorage.cni_proprietaire);
    $('#telephonediv').find('input').val(sessionStorage.contact);
	$('#emaildiv').find('input').val(sessionStorage.e_mail);
	$('#quartierdiv').find('input').val(sessionStorage.localite);
	$('#fonctiondiv').find('input').val(sessionStorage.fonction);
	$('#loyerdiv').find('input').val(sessionStorage.prix_bien);
	$('#localitediv').find('input').val(sessionStorage.quartier_bien);
	$('#descriptiondiv').find('textarea').val(sessionStorage.description);
	$('#impotdiv').find('input').val(sessionStorage.impot_foncier);
	$('#num_ncc_div').find('input').val(sessionStorage.num_ncc);
	$('#initialdiv').find('input').val(sessionStorage.initial_proprietaire);
	$('#ilotdiv').find('input').val(sessionStorage.ilot);
	$('#lotdiv').find('input').val(sessionStorage.lot);
	$('#lbl_mt_impotdiv').find('input').val(sessionStorage.montant_impot);
	$('#appartementdiv').find('input').val(sessionStorage.num_appartement);
	$('#societediv').find('input').val(sessionStorage.societe);
	$('#parcellediv').find('input').val(sessionStorage.parcelle);
	
	$('#frais_agencediv').find('input').val(sessionStorage.frais_agence);
	
	$('#loyer_finaldiv').find('input').val(sessionStorage.loyer_proprietaire);
	
	$('#categorie_bien').append('<option value='+ sessionStorage.id_categorie_bien +' selected>'+ sessionStorage.libelle_categorie_bien +'</option>');
	
	$('#charge_impot').append('<option value='+ sessionStorage.id_charge_impot +' selected>'+ sessionStorage.libelle_charge_impot +'</option>');
	
	$('#rehabilitation').append('<option value='+ sessionStorage.Id_rehabilitation +' selected>'+ sessionStorage.Libele_rehabilitation +'</option>');
	$('#V_commission').append('<option value='+ sessionStorage.id_commission +' selected>'+ sessionStorage.libelle_commission +'</option>');					
    $('#commune').append('<option value='+ sessionStorage.id_commune +' selected>'+ sessionStorage.libelle_categorie_commune +'</option>');
   $('#nbre_piece').append('<option value='+ sessionStorage.id_nbre_piece +' selected>'+ sessionStorage.libelle_piece +'</option>');
	$('#type_bien').append('<option value='+ sessionStorage.id_type_bien +' selected>'+ sessionStorage.libelle_type_bien +'</option>');
	$('#prise_en_charge').append('<option value='+ sessionStorage.id_charge +' selected>'+ sessionStorage.libelle_charge +'</option>');
	}
});

</script>     
 