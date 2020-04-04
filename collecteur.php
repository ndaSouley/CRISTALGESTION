<?php
session_start();
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?><head>
<link rel="stylesheet" href="css/popupform.css"/>

</head>

<CENTER>

<div class="row">
</div>
<!-- /.row -->
</center>
<div class="row" style="margin-left:150px;">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-8 " style="margin-top:15px">
            <div class="panel panel-default panel-green">
               
                <div class="panel-heading text-alig-center">
                    Infos Collecteur
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                         <div class="" id="matricule_collecteurdiv">
                            <label class="label_form">Matricule</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="matricule_collecteur" id="matricule_collecteur" value="" required>
                            </div>
                            <div class="" id="nomdiv">
                                <label class="label_form">Nom</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="nom" id="nom" value="" required>
                            </div>
                            <div class="" id="prenomdiv">
                                <label class="label_form">Prénoms</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="prenom" id="prenom" value="" required >
                            </div>
                            <div class="" id="contactdiv">
                                <label class="label_form">Contact</label>
                                <input class="form-control" type="text" style="width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="contact" id="contact" value="" required>
                            </div>
                                <div class="" id="collecteurdiv">
                                <label class="label_form">Secteur</label>                     
                               <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");

include('dbconnexion.php');
	echo "<select id='secteur' style='width:250px; height:30px' name='secteur'>
					<option value='' selected>&ndash; Secteur &ndash;</option>\n";

						$query1 ="SELECT libelle,id_secteur FROM secteur order by libelle";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$libsect = $row['libelle'];
							$codesect = $row['id_secteur'];

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$codesect'>$libsect</option>\n";
						}

						echo "</select>\n";
$mysqli->close();
	  
?>
</select>
	
                            </div>
                                <div class="" id="date_affectationdiv">
                                <label class="label_form">Date Affection</label>
                                <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="date_affectation" id="date_affectation" value="" required >
                            </div>
                                         <div class="" id="exercicediv">
                                <label class="label_form">Exercice</label>

                                <select id='exercice' name='exercice' class='form-control' style='width:150px;margin-bottom:5px;' required>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>2018</option>
</select>
                            </div>


                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                    
           <div class="col-lg-12">
            <div class="panel-footer text-right" >
              <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Valider</button>
            </div>
        </div>
        </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
  </center>
  
  <center> 
<div id="message" class="modalDialog">	
    <div>        
		<table border="0" width="100%">
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
 
 
<center>
<div id="message" class="modalDialog">	
    <div>        
		<table border="0" width="100%">
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
 
 
<script>
    
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
        $("#page-wrapper").load("liste_collecteur.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_collecteur.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        $('#matricule').val('');
        $('#nom').val('');
        $('#prenom').val('');
        $('#contact').val('');
        $('#secteur').val('');
        $('#message').remove();
    }); 
    
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("collecteur.php");
    });
    $(document).ready(function() {
		
		//$('#message').hide();
		//$('#message2').hide();
		
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
    url: "traitement_collecteur.php" ,
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


$("#BoutonOUI").on('click', function()
	{
$('#nom').val('');
 $('#exercice').val('');
$('#codesect').val('');
 $('#date_affectation').val('');
 $('#contact').val('');
 $('#prenom').val('');
$('#secteur').val('');
$('#matricule_collecteur').val('');
$('#message').remove();
	
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_collecteur.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	var nom = $('#nom').val();
		var exercice = $('#exercice').val();
	var codesect = $('#codesect').val();
	var date_affectation = $('#date_affectation').val();
	var contact = $('#contact').val();
    var prenom = $('#prenom').val();
	  var secteur = $('#secteur').val();
    var matricule_collecteur = $('#matricule_collecteur').val();
	var id_user = '1';
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
	 
	 var numquit =   sessionStorage.matricule_collecteur;
	 
 var donnees = {action:sessionStorage.even,
	 				matricule_collecteur:matricule_collecteur,
					nom:nom,
					prenom:prenom,
					contact:contact,
					exercice:exercice,
					secteur:secteur,
					numquit:numquit,
					id_user:id_user,
					date_affectation:date_affectation,
					};
					
	               console.log('{"action":'+sessionStorage.even+',"matricule_collecteur":'+matricule_collecteur+',"nom":'+nom+',"prenom":'+prenom+',"contact":'+contact+',"exercice":'+exercice+',"secteur":'+secteur+',"id_user":'+id_user+',"date_affectation":'+date_affectation+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_collecteur.php" ,
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
            $("#page-wrapper").load("liste_collecteur.php");
			
            }

            });

});
});


$(document).ready(function() {
	
	$('#matricule_collecteur').val('');
     $('#nom').val('');
   $('#contact').val('');
	$('#prenom').val('');
    $('#action').val('');
	if(sessionStorage.even == "UPDATE"){
		console.log('je suis dans le update '+sessionStorage.nom);
	$('#matricule_collecteurdiv').find('input').val(sessionStorage.matricule_collecteur);
	$('#nomdiv').find('input').val(sessionStorage.nom);
	$('#contactdiv').find('input').val(sessionStorage.contact);
	$('#date_affectationdiv').find('input').val(sessionStorage.date_affectation);
	$('#prenomdiv').find('input').val(sessionStorage.prenom);date_affectation
	$('#secteur').append('<option value='+ sessionStorage.id_secteur +' selected>'+ sessionStorage.libelle +'</option>');
	$('#exercice').append('<option value='+ sessionStorage.code_periode +' selected>'+ sessionStorage.periode +'</option>');
	}
});

</script>     
 