<?php
session_start();
if(!isset($_SESSION['TaxeUserData']) || $_SESSION['IsAuthorized'] == false)
	
{
    header('Location:index.php');
}

$id_user=$_SESSION['TaxeUserData'][0]['id_user'];


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
        <div class="col-lg-7 " style="margin-top:80px">
        
        
            <div class="panel panel-default panel-green">
               
                <div class="panel-heading text-alig-center">
                    Infos Utilisateur
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        
                         
                        
                        
                          <div class="" id="nomdiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Nom</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="nom" name="nom" required style="width:100%">
                              </div>
                           </div>  
							
                             <div class="" id="prenomdiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Prénoms</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="prenom" name="prenom"  required style="width:100%">
                              </div>
                           </div>  
                            <div class="" id="telephonediv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Téléphone </label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="tel" name="tel"  required style="width:100%">
                              </div>
                           </div> 
                           <div class="" id="emaildiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="email" value="" id="email" name="email"  required style="width:100%">
                              </div>
                           </div>  
                           
                           <div class="" id="logindiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Login</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="login" name="login"  required style="width:100%">
                              </div>
                           </div> 
                           <div class="" id="motpassediv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Mot de passe</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="mot_passe" name="mot_passe"  required style="width:100%">
                              </div>
                           </div> 
                           
                           <div class="" >
                              <label for="example-text-input" class="col-sm-3 col-form-label">Profil</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                
                                 <?php

								include('dbconnexion.php');
											
					echo "<select id='profil' name='profil'  class='form-control'  required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT
										profil.id_profil,
										profil.libelle
										FROM
										profil ";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_profil = $row['id_profil'];
							$libelle = $row['libelle'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_profil'>$libelle</option>\n";
							
						}

						echo "</select>\n";
							$mysqli->close();
	  
							?>
                                 
                               
                              </div>
                           </div>
                           
                              <div class="" >
                              <label for="example-text-input" class="col-sm-3 col-form-label">Statut</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                
                                <?php

								include('dbconnexion.php');
											
					echo "<select id='statut' name='statut'  class='form-control'  required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT
										statut.Id_statut,
										statut.libelle_statut
										FROM
										statut ";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$Id_statut = $row['Id_statut'];
							$libelle_statut = $row['libelle_statut'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$Id_statut'>$libelle_statut</option>\n";
							
						}

						echo "</select>\n";
							$mysqli->close();
	  
							?>                
                               </select>
                              </div>
                           </div> 
                           

                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                    
           <div class="col-lg-12">
            <div class="panel-footer text-right" >
              <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn top_b">Valider</button>
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
        $("#page-wrapper").load("liste_utilisateur.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_utilisateur.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#nom').val('');
        $('#prenom').val('');
        $('#tel').val('');
        $('#email').val('');
		$('#login').val('');
		$('#mot_passe').val('');
		$('#profil').val('');
		$('#statut').val('');
        $('#message').remove();
    }); 
    
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("utilisateur.php");
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


		
		              


    $('#nomdiv').find('input').val(sessionStorage.Nom_user);
    $('#prenomdiv').find('input').val(sessionStorage.prenoms_user);
    $('#telephonediv').find('input').val(sessionStorage.contact);
   
    $('#emaildiv').find('input').val(sessionStorage.e_mail);
    $('#motpassediv').find('input').val(sessionStorage.mot_passe);
   // $('#profildiv').find('input').val(sessionStorage.fonction);

   }                       
	
	});
		
	}
	
$("input").focusout(function(){
    $(this).val($.trim($(this).val()));
});


$("#BoutonOUI").on('click', function()
	{
		$('#nom').val('');
        $('#prenom').val('');
        $('#tel').val('');
        $('#email').val('');
		$('#login').val('');
		$('#mot_passe').val('');
		$('#profil').val('');
		$('#statut').val('');
        $('#message').remove();
		
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_utilisateur.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	var nom = $('#nom').val();
	var prenom = $('#prenom').val();
	var tel = $('#tel').val();
	var email = $('#email').val();
	var login = $('#login').val();
	var mot_passe = $('#mot_passe').val();
	var profil = $('#profil').val();
    var statut = $('#statut').val();
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    //var data = $('form').serialize(); 
    // console.log('donnees = '+data);
	 
	 var V_id_ser =   sessionStorage.id_user;
	 
 var donnees = {action:sessionStorage.even,
 
					nom:nom,
					prenom:prenom,
					tel:tel,
					email:email,
					login:login,
					email:email,
					mot_passe:mot_passe,
					profil:profil,
					statut:statut,
					V_id_ser:V_id_ser,
					
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"telephone":'+tel+',"email":'+email+',"login":'+login+',"mot_passe":'+mot_passe+',"profil":'+profil+',"statut":'+statut+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_collecteur.php" ,
        data: donnees,
        success : function(data) {
			console.log("Retour="+data.Motif);
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
            $("#page-wrapper").load("liste_utilisateur.php");
			
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

	console.log('je suis user '+sessionStorage.Nom_user);

    
		// Afectation des données dans chaque champs
	$('#nomdiv').find('input').val(sessionStorage.Nom_user);
    $('#prenomdiv').find('input').val(sessionStorage.prenoms_user);
    $('#telephonediv').find('input').val(sessionStorage.contact);
	 $('#logindiv').find('input').val(sessionStorage.login);
    $('#emaildiv').find('input').val(sessionStorage.e_mail);
    $('#motpassediv').find('input').val(sessionStorage.mot_passe);
  //  console.log('Je suis le '+sessionStorage.date_saisie);

   $('#datediv').find('input').val(sessionStorage.date_saisie);
	$('#profil').append('<option value='+ sessionStorage.id_profil +' selected>'+ sessionStorage.libelle +'</option>');
	$('#statut').append('<option value='+ sessionStorage.Id_statut +' selected>'+ sessionStorage.libelle_statut +'</option>');
	}
});

</script>     
 