<?php
session_start();
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header panel-green" style="margin-top:5px;">AUTORISATION DE TRANSPORT</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-6">
            <div class="panel panel-default  panel-green">
                <div class="panel-heading">
                    Infos Contribuable
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="" id="collecteurdiv">
                                <label class="label_form">Collecteur</label>                     
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='collecteur' name='collecteur'  class='form-control' style='width:300px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT a.matricule_collecteur,
				a.id_secteur,
				a.date_affectation,
				a.code_periode,
				CONCAT(collecteur.nom,' ',collecteur.prenom) AS nomcollectteur ,
				collecteur.date_enreg,
				secteur.libelle
				FROM
				affectation AS a
				INNER JOIN collecteur ON a.matricule_collecteur = collecteur.matricule_collecteur
				INNER JOIN secteur ON a.id_secteur = secteur.id_secteur
				WHERE date_affectation = (SELECT MAX(date_affectation) FROM affectation b WHERE b.matricule_collecteur = a.matricule_collecteur) order by collecteur.date_enreg desc";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$nom = $row['nomcollectteur'];
							$matricule_collecteur = $row['matricule_collecteur'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$matricule_collecteur'>$nom</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
	
                            </div>
                            <div class="" id="nomdiv">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="nom" id="nom" value="" required>
                            </div>
                            <div class="" id="prenomdiv">
                                <label class="label_form">Prénoms</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="prenom" id="prenom" value="" required >
                            </div>
                            <div class="" id="datenaissancediv">
                                <label class="label_form">Date naissance</label>
                                <input class="form-control" type="date" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="datenaissance" id="datenaissance" value="" required>
                            </div>
                            <div class="" id="lieunaissancediv">
                                <label class="label_form">Lieu naissance</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="lieunaissance" id="lieunaissance" value="" required>
                            </div>
                            <div class="" id="cnisejourdiv">
                                <label class="label_form">CNI/Sejour</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="cnisejour" id="cnisejour" value="" required >
                            </div>
                            <div class="" id="telephonediv">
                                <label class="label_form">Téléphone</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="telephone" id="telephone" value="" required >
                            </div>
                            <div class="" id="adressediv">
                                <label class="label_form">Adresse</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="adresse" id="adresse" value="" >
                            </div>

                            <div class="" id="quartierdiv">
                                <label class="label_form">Quartier</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="quartier" id="quartier" value="">
                            </div>
                            <div class="" id="professiondiv">
                                <label class="label_form">Profession</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="profession" id="profession" value="" required >
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
                    Infos Quittance
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="" id="numquittancediv">
                                <label class="label_form">N° Quittance</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="numquittance" id="numquittance" value="" required />
                            </div>
                            <div class="" id="exercicediv">
                                <label class="label_form">Exercice</label>

                                <select id='exercice' name='exercice' class='form-control' style='width:150px;margin-bottom:5px;' required>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>2018</option>
</select>
                            </div>
                            
                              
                            <div class="" id="activitediv">
                                <label class="label_form">Type Transport</label>                     
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='typetransport' name='typetransport'  class='form-control' style='width:300px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT
								type_quittance.Id_Type_quit,
								type_quittance.Lib_Type_quit
								FROM
								type_quittance
								WHERE
								type_quittance.Id_Type_quit ='ATPrV' OR type_quittance.Id_Type_quit='ATPuV'";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$Lib_Type_quit = $row['Lib_Type_quit'];
							$Id_Type_quit = $row['Id_Type_quit'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$Id_Type_quit'>$Lib_Type_quit</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
                                 </div> 

  
                            <div class="" id="activitediv">
                                <label class="label_form">Activité</label>
                                 <select id='activite' name='activite'  class='form-control' style='width:300px;margin-bottom:5px;' required>                    			  <option value='' selected>&ndash; Choisir &ndash;</option>
                                 
                               <?php /*?><?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
						
						echo "<select id='activite' name='activite'  class='form-control' style='width:300px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT lib_type_service,code_type_service FROM type_service  WHERE IdType_quit='ATPrV' order by lib_type_service";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$lib_type_service = $row['lib_type_service'];
							$code_type_service = $row['code_type_service'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$code_type_service'>$lib_type_service</option>\n";
							
						}

						echo "</select>\n";
$mysqli->close();
	  
?><?php */?>
</select>
                                 </div> 
                                 <div class="" id="immatriculationdiv">
                                 <label class="label_form">Immatriculation</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="immatriculation" id="immatriculation" value="" required />
                            </div>
                                 <div class="" id="genre_vehiculediv">
                                 <label class="label_form">Genre</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="genre_vehicule" id="genre_vehicule" value="" required />
                            </div>
                                <div class="" id="type_vehiculediv">
                                 <label class="label_form">Type</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="type_vehicule" id="type_vehicule" value="" required />
                            </div>
                                 <div class="" id="marque_vehiculediv">
                                 <label class="label_form">Marque</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="marque_vehicule" id="marque_vehicule" value="" required />
                            </div>
                                  <div class="" id="numseriediv">
                                 <label class="label_form">N° Serie</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="numserie" id="numserie" value="" required />
                            </div>
                                     <div class="" id="regiondiv">
                                 <label class="label_form">Region</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name=" region" id="region" value="" required />
                            </div>
                                  <div class="" id="departementdiv">
                                 <label class="label_form">Departement</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name=" departement" id="departement" value="" required />
                            </div>


                               <div class="" id="place_assisediv">
                                 <label class="label_form">Place Assise</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="place_assise" id="place_assise" value="" required />
                            </div>
                                                           <div class="" id="placedeboutdiv">
                                 <label class="label_form">Place Debout</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="place_debout" id="place_debout" value="" required />
                            </div>

                            
                            <div class="" id="date_validitediv">
                                <label class="label_form">Date Validité</label>
                                <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="date_validite" id="date_validite" value="" required>
                            </div>
                                 <div class="" id="itinerairediv">
                                 <label class="label_form">Itineraire</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="itineraire" id="itineraire" value="" required />
                            </div>

                               <div class="" id="date_docdiv">
                                <label class="label_form">Date Quittance</label>
                                <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="date_doc" id="date_doc" value="" required>
                            </div>

                            <div class="" id="montantdiv">
                                <label class="label_form">Montant</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="montantreel" id="montantreel" value="0" required readonly>
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
		<table border="0" width="100%" >
			<tr>
                <td>
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">INFORMATION</h3></div>
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
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">INFORMATION</h3></div>
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
 
 
<div id="message2" class="modalDialog">	
    <div>        
		<table border="0" width="100%" >
			<tr>
                <td>
					<div border="1" style="align-content: center; margin-top: 10px;"><h3 style="text-align: center; font-weight: Bold" class="shiny-white">INFORMATION</h3></div>
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
<script>
	$("#typetransport").on('change', function(){
        console.log('je suis dans change function 22');
        var val = $(this).val(); // on récupère la valeur de la classe de navire
        console.log('valeur = '+val);
		var donnees = {type_quit:val};
        if(val != '') {
            //$type.empty(); // on vide la liste des types de navire
            $('#activite').empty();
            $.ajax({
				type: "POST",
                url: 'activite_trp.php',
                data: donnees, // on envoie $_GET['clnav_code']
                //dataType: 'json',
                success: function(json) {
                   // $.each(json, function(index, value) {
						console.log('valeur2 = '+json.code_type_service);
//                        $('#classe').append('<option value="'+ index +'">'+ value +'</option>');
                        $('#activite').append('<option value="'+ json.code_type_service +'">'+ json.lib_type_service +'</option>');
//                        document.getElementById('clnav').value=value.CLNAV_LIBELLE;
//                        document.getElementById('tynav').value=value.TNAV_LIBELLE;
                   // });
                }
            });
        }
    });
	
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
       $("#page-wrapper").load("liste_autorisation_transport_commerce.php");
    });
    
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_autorisation_transport_commerce.php");
    });
    
   $("#BoutonOUI").on('click', function()
    {
   $('#matricule').val('');
   $('#collecteur').val('');
   $('#nom').val('');;
   $('#prenom').val('');
   $('#datenaissance').val('');
   $('#lieunaissance').val('');
   $('#cnisejour').val('');
   $('#telephone').val('');
   $('#adresse').val('');
   $('#quartier').val('');
   $('#profession').val('');
	 $('#itineraire').val('');
	
	//variable quittance
    $('#numquittance').val('');
	$('#date_habilitation').val('');
	$('#departement').val('');
	$('#date_visite').val('');
	$('#numero_patente').val('');
    $('#place_assise').val('');
	$('#place_debout').val('');
	$('#datevisiste').val('');
    $('#exercice').val('');
    $('#numserie').val('');
    $('#activite').val('');
    $('#categorie').val('');
	$('#cbdaf').val('');
    $('#numplaque').val('');
  
	$('#numpatente').val('');
	$('#date_doc').val('');
	$('#date_validite').val('');
	$('#droitplace').val('');
	$('#immatriculation').val('');
	$('#numero_macaron').val('');
	$('#numquittance').val('');
	$('#region').val('');
	$('#couleur').val('');
	$('#numantenne').val('');
	$('#marque_vehicule').val('');
	$('#genre_vehicule').val('');
	$('#numserie').val('');
	$('#nbrplace').val('');
	 // Variables service 
    $('#montant').val('');
	
   $('#patc').val('');
   $('#type_vehicule').val('');
   $('#message').remove();
    }); 
    
    $("#BoutonNON").on('click', function()
    {
       $("#page-wrapper").load("liste_autorisation_transport_commerce.php");
    });
    


    $(document).ready(function() {
        $('#form')[0].reset();
        $('#action').val(sessionStorage.even);
        $("#activite").change(function(){
            var activite = $('#activite').val();
            var categorie = $('#categorie').val();

            if ( categorie!==null) {
                choisirmontant();
            }
        });

        $("#categorie").change(function(){

            if ( activite!==null) {
                choisirmontant();
            }
        });

        function choisirmontant() {
            var activite = $('#activite').val();
            var categorie = $('#categorie').val();
   // alert(activite);
 // alert(categorie);

var donnees = {action:"SELECTAJAX",
activite:activite,
categorie:categorie};
console.log('{"acte":"quittance","action":"select","activite":'+activite+',"categorie":'+categorie+'}');     

$.ajax({
    type: "POST",
    url: "traitement_autorisation_demande_transport.php" ,
    data: donnees,
    success : function(data) {      
        //console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');

        $('#montant').val(data.montant_mensuel);
        $('#montantreel').val(data.montant_mensuel);
        $('#droitplace').val(data.droit_de_place);
        $('#droitplacereel').val(data.droit_de_place);
        
/*            sessionStorage.even = "UPDATE";
        sessionStorage.matricule = data.matricule;
        sessionStorage.nom = data.nom;
        sessionStorage.prenom = data.prenom;
        sessionStorage.contact = data.contact;
        sessionStorage.id_secteur = data.id_secteur;
        sessionStorage.libelle = data.libelle;
        sessionStorage.date_affectation = data.date_affectation;*/

   }                       

});
    //alert("Cool");

//$("#page-wrapper").load("edite_collecteur.php");

}

$("input").focusout(function(){
    $(this).val($.trim($(this).val()));
});


$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);

 
   // variables contribuable
    var collecteur  = $('#collecteur').val();
	var nom = $('#nom').val();
    var prenom = $('#prenom').val();
    var datenaissance = $('#datenaissance').val();
    var lieunaissance = $('#lieunaissance').val();
    var cnisejour = $('#cnisejour').val();
    var telephone = $('#telephone').val();
    var adresse = $('#adresse').val();
    var quartier = $('#quartier').val();
    var profession = $('#profession').val();
	 var itineraire = $('#itineraire').val();
	
	//variable quittance
    var type_quit = $('#type_quit').val();   
    var numquittance = $('#numquittance').val();
	var date_habilitation = $('#date_habilitation').val();
	 var departement = $('#departement').val();
	 var date_visite = $('#date_visite').val();
	 var numero_patente = $('#numero_patente').val();
	  var place_assise = $('#place_assise').val();
	  var place_debout = $('#place_debout').val();
	  var datevisiste = $('#datevisiste').val();
    var exercice = $('#exercice').val();
	var numserie = $('#numserie').val();
    var activite = $('#activite').val();
    var categorie = $('#categorie').val();
	var cbdaf = $('#cbdaf').val();
    var numplaque = $('#numplaque').val();
  	var TAXE_FORFAITAIRE  = "ATPrV";
	var numpatente = $('#numpatente').val();
	var date_doc = $('#date_doc').val();
	var date_validite = $('#date_validite').val();
	var droitplace = $('#droitplace').val();
	var immatriculation = $('#immatriculation').val();
	var numero_macaron = $('#numero_macaron').val();
	var numquittance = $('#numquittance').val();
		var region = $('#region').val();
	var couleur = $('#couleur').val();
	var numantenne = $('#numantenne').val();
	var marque_vehicule = $('#marque_vehicule').val();
	var genre_vehicule = $('#genre_vehicule').val();
	var numserie = $('#numserie').val();
	var nbrplace = $('#nbrplace').val();
	 // Variables service 
    var montant = $('#montant').val();
	var id_user = "1";
    var patc = $('#patc').val();
    var type_vehicule =$('#type_vehicule').val();
	var acte =$('#acte').val();
    var action = $('#action').val();
    if (collecteur===null) {
        alert('Veuillez selectionner un collecteur');
        return false;
    }
    if (activite===null) {
        alert('Veuillez selectionner une activite');
        return false;
    }
    if (categorie===null) {
        alert('Veuillez selectionner une categrie');
        return false;
    }

    var data = $('form').serialize(); 
     //console.log('donnees = '+data);
	 
	 var numquit = sessionStorage.mat_quittance;
	 
	 var donnees = {action:sessionStorage.even,
	                
					//Données contribuable
	 				collecteur:collecteur,
					nom:nom,
					prenom:prenom,
					datenaissance:datenaissance,
					lieunaissance:lieunaissance,
					cnisejour:cnisejour,
					adresse:adresse,
					telephone:telephone,
					quartier:quartier,
					profession:profession,
					
					//Données quittances
					cbdaf:cbdaf,
					TAXE_FORFAITAIRE:TAXE_FORFAITAIRE,
					marque_vehicule:marque_vehicule,
					itineraire:itineraire,
					//IdType_quit:IdType_quit,
					numserie:numserie,
					departement:departement,
					place_assise:place_assise,
					numero_patente:numero_patente,
				     numserie:numserie,
					 place_debout:place_debout,
					 region:region,
					 date_visite:date_visite,
				     type_vehicule:type_vehicule,
					 activite:activite,
				     PTAC:patc,
				    genre_vehicule:genre_vehicule,
					date_habilitation:date_habilitation,
					datevisiste:datevisiste,
					numpatente:numpatente,
					datevisiste:datevisiste,
					id_quit:numquit,
					exercice:exercice,
					activite:activite,
					numero_macaron:numero_macaron,
					couleur:couleur,
					categorie:categorie,
					numquittance:numquittance,
					date_visite:date_visite,
					date_doc:date_doc,
					numero_antenne:numantenne,
					droitplace:droitplace,
					//Données quittances
					id_user:id_user,
					montant:montant,
					immatriculation:immatriculation,
					date_validite:date_validite,
					numero_macaron:numero_macaron,
					couleur:couleur,
					droit_de_place_reel:sessionStorage.droit_de_place_reel,
				    montant_mensuel_reel:sessionStorage.montant_mensuel_reel
					};
					
	             console.log('{"action":'+sessionStorage.even+',"collecteur":'+collecteur+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+',"quartier":'+quartier+',"profession":'+profession+',"numquittance":'+numquittance+',"exercice":'+exercice+',"activite":'+activite+',"categorie":'+categorie+',"immatriculation":'+immatriculation+',"montant":'+montant+',"id_quit":'+numquit+',"TAXE_FORFAITAIRE":'+TAXE_FORFAITAIRE+',"cbdaf":'+cbdaf+',"id_user":'+id_user+',"date_validite":'+date_validite+'}');                 
					
//					console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_autorisation_demande_transport.php" ,
        data: donnees,
        success : function(data) {
			console.log("id_abonn_serv="+data.Motif);
			//if(sessionStorage.even == "INSERT")
					/*{
						document.getElementById('mess').innerHTML = data.Motif;
						$(location).attr('href','#message');
					}
					else
					{
						document.getElementById('mess2').innerHTML = data.Motif;
						$(location).attr('href','#message2');
					}*/
					
             if(sessionStorage.even == "INSERT")
            {
          //  alert('Enregistrer');
             document.getElementById('mess').innerHTML = data.Motif;
						$(location).attr('href','#message');

            }
            else
            {
            //document.getElementById('mess2').innerHTML = data.Motif;
           document.getElementById('mess2').innerHTML = data.Motif;
            $(location).attr('href','#message2');
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
             $("#page-wrapper").load("liste_autorisation_transport_commerce.php");
            }

            });

});
});

$(document).ready(function() {
	
	$('#region').val('');
	$('#IdType_quit').val('');
	$('#departement').val('');
	$('#nbrplace').val('');
	$('#date_habilitation').val('');
	$('#placedebout').val('');
	$('#genre_vehicule').val('');
	$('#type_vehicule').val('');
	$('#date_visite').val('');
	$('#numantenne').val('');
	$('#place_debout').val('');
	$('#itineraire').val('');
    $('#patc').val('');
    $('#date_doc').val('');
    $('#mat').val('');
	$('#place_assise').val('');
	$('#nom').val('');
	$('#prenom').val('');
	$('#datenaissance').val('');
	$('#lieunaissance').val('');
	$('#cnisejour').val('');
	$('#telephone').val('');
	$('#adresse').val('');
	$('#quartier').val('');
	$('#profession').val('');
	$('#numquittance').val('');
	$('#exercice').val('');
	$('#numserie').val('');
	$('#activite').val('');
	$('#typetransport').val('');
	$('#categorie').val('');
	$('#cbdaf').val('');
	$('#TAXE_FORFAITAIRE').val('');
	$('#marque_vehicule').val('');
	$('#id_user').val('');
     $('#datequittance').val('');
	  $('#numero_patente').val('');
   $('#montant').val('');
	$('#droitplace').val('');
	$('#date_validitediv').val('');
   $('#acte').val('');
    $('#action').val('');
	if(sessionStorage.even == "UPDATE"){
		//console.log('je suis dans le update '+sessionStorage.datenais);
	$('#datequittancediv').find('input').val(sessionStorage.date_validite);
	$('#place_assisediv').find('input').val(sessionStorage.place_assise);
	$('#cbdafdiv').find('input').val(sessionStorage.CB_DAF);
	$('#placedeboutdiv').find('input').val(sessionStorage.place_debout);
    $('#itinerairediv').find('input').val(sessionStorage.itineraire);
	$('#departementdiv').find('input').val(sessionStorage.departement);
	$('#numero_patentediv').find('input').val(sessionStorage.numero_patente);
	$('#numantennediv').find('input').val(sessionStorage.numero_antenne);
	$('#numantennediv').find('input').val(sessionStorage.numero_antenne);
	$('#nomdiv').find('input').val(sessionStorage.nomContribuable);
	$('#prenomdiv').find('input').val(sessionStorage.prenomContribuable);
	$('#datenaissancediv').find('input').val(sessionStorage.datenais);
	$('#datevisistediv').find('input').val(sessionStorage.date_visite);
	$('#lieunaissancediv').find('input').val(sessionStorage.lieunaissance);
	$('#cnisejourdiv').find('input').val(sessionStorage.cni);
	$('#telephonediv').find('input').val(sessionStorage.telephone);
	$('#adressediv').find('input').val(sessionStorage.adresse);
	$('#quartierdiv').find('input').val(sessionStorage.quartier);
	$('#datehabilitationdiv').find('input').val(sessionStorage.date_habilitation);
	$('#professiondiv').find('input').val(sessionStorage.profession);
    $('#numquittancediv').find('input').val(sessionStorage.numquittance);
	$('#couleurdiv').find('input').val(sessionStorage.couleur);
	$('#exercicediv').find('input').val(sessionStorage.exercice);
	$('#numseriediv').find('input').val(sessionStorage.numserie);
	//$('#numquittancediv').find('input').val(sessionStorage.mat_quittance);
	$('#numquittancediv').find('input').val(sessionStorage.code_quittance);
	$('#immatriculationdiv').find('input').val(sessionStorage.immatriculation);
		$('#cbdafdiv').find('input').val(sessionStorage.cbdaf);
		$('#regiondiv').find('input').val(sessionStorage.region);
	$('#patcdiv').find('input').val(sessionStorage.PTAC);
	$('#date_validitediv').find('input').val(sessionStorage.date_validite);
	$('#date_docdiv').find('input').val(sessionStorage.date_doc);
		
	$('#genre_vehiculediv').find('input').val(sessionStorage.genre_vehicule);
		$('#nbrplacediv').find('input').val(sessionStorage.nombre_place);
		$('#marque_vehiculediv').find('input').val(sessionStorage.marque_vehicule);
	$('#type_vehiculediv').find('input').val(sessionStorage.type_vehicule);
	$('#datequittancediv').find('input').val(sessionStorage.datequittance);
		$('#numero_macarondiv').find('input').val(sessionStorage.numero_macaron);
	$('#montantreeldiv').find('input').val(sessionStorage.montant);
	$('#categoriediv').find('input').val(sessionStorage.lib_categ);
	//$('#lib_type_servicediv').find('input').val(sessionStorage.lib_type_service);
	$('#droitplacereeldiv').find('input').val(sessionStorage.montant_droit_place);
	$('#montantdiv').find('input').val(sessionStorage.quotite_officiel);
	$('#numplaquediv').find('input').val(sessionStorage.num_plaque);
	
	$('#exercice').append('<option value='+ sessionStorage.code_periode +' selected>'+ sessionStorage.periode +'</option>');
	$('#typetransport').append('<option value='+ sessionStorage.Id_Type_quit +' selected>'+ sessionStorage.Lib_Type_quit +'</option>');
    $('#activite').append('<option value='+ sessionStorage.IdType_quit +' selected>'+ sessionStorage.lib_type_service +'</option>');
    $('#collecteur').append('<option value='+ sessionStorage.mat +' selected>'+ sessionStorage.nomCollecteur +'</option>');
	}
});

</script>     
 </h2>