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
                    Infos Personnelle
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
                            <div class="" id="telephone1div">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Téléphone 1</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="telephone1" name="telephone1"  required style="width:100%">
                              </div>
                           </div> 
                           <div class="" id="telephone2div">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Téléphone 2</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="telephone2" name="telephone2"  required style="width:100%">
                              </div>
                           </div>  
                           
                           <div class="" id="emaildiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">E-mail</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="email" value="" id="email" name="email"  required style="width:100%">
                              </div>
                           </div> 
                           
                           <div class="" id="typediv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Type Personne</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                
                                 <?php

								include('dbconnexion.php');
											
					echo "<select id='typepersonne' name='typepersonne'  class='form-control'  required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT * FROM `type_personne` ";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$id_typepersonne = $row['id_typepersonne'];
							$libelle = $row['libelle'];
							

							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_typepersonne'>$libelle</option>\n";
							
						}

						echo "</select>\n";
							$mysqli->close();
	  
							?>
                                 
                               
                              </div>
                           </div>
                           
                              <div class="" id="typecontactdiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Type contact</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                
                                <select  name='typecontact' id="typecontact" class='form-control' required >
                                <option  selected value='1'>Public</option>
                                <option value='2'>Privé</option>
								</select>                 
                               
                              </div>
                           </div> 
                           
                           <div class="" id="societediv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Société</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="societe" name="societe"  required style="width:100%">
                              </div>
                           </div> 
                           
                           <div class="" id="fonctiondiv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Fonction</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="text" value="" id="fonction" name="fonction"  required style="width:100%">
                              </div>
                           </div> 
                            <div class="" id="datediv">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Date Saisie</label>
                                <div class="col-sm-9" style="margin-top:5px;" >
                                <input class="form-control" type="date" value="" id="date_saisie" name="date_saisie"  required >
                              </div>
                           </div> 


                             <div class="" id="quartierdiv">
                              <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-6" style="margin-top:5px;" >
                               
                              </div>
                           </div> 
                           <div class="" id="quartierdiv">
                              <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-6" style="margin-top:5px;" >
                                <input type="hidden" id="id_user" name="id_user" value="<?php echo($id_user);?>">
                               
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
        $("#page-wrapper").load("liste_contact.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_contact.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        
        $('#nom').val('');
        $('#prenom').val('');
        $('#telephone1').val('');
        $('#telephone2').val('');
		$('#email').val('');
		$('#societe').val('');
		$('#fonction').val('');
		$('#typepersonne').val('');
		$('#typecontact').val('');
		$('#date_saisie').val('');
        $('#message').remove();
    }); 
    
    $("#BoutonNON").on('click', function()
    {
        $("#includedContent").load("contact.php");
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



    $('#nomdiv').find('input').val(sessionStorage.nom);
    $('#prenomdiv').find('input').val(sessionStorage.prenom);
    $('#telephone1div').find('input').val(sessionStorage.telephone1);
    $('#telephone2div').find('input').val(sessionStorage.telephone2);
    $('#emaildiv').find('input').val(sessionStorage.email);
    $('#societediv').find('input').val(sessionStorage.societe);
    $('#fonctiondiv').find('input').val(sessionStorage.fonction);

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
        $('#telephone1').val('');
        $('#telephone2').val('');
		$('#societe').val('');
		$('#email').val('');
		$('#fonction').val('');
		$('#typepersonne').val('');
		//$('#typecontact').val('');
		$('#date_saisie').val('');
		$('#message').remove();
		
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_contact.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);
	var nom = $('#nom').val();
	var prenom = $('#prenom').val();
	var telephone1 = $('#telephone1').val();
	var telephone2 = $('#telephone2').val();
	var societe = $('#societe').val();
	var email = $('#email').val();
	var typepersonne = $('#typepersonne').val();
    var fonction = $('#fonction').val();
	var date_saisie = $('#date_saisie').val();
	var typecontact = $('#typecontact').val();
	var id_user = $('#id_user').val();
	 
	var action = $('#action').val();
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
    //var data = $('form').serialize(); 
     console.log('donnees = '+data);
	 
	// var numquit =   sessionStorage.matricule_collecteur;
	 
 var donnees = {action:sessionStorage.even,
	 				
					nom:nom,
					prenom:prenom,
					telephone1:telephone1,
					telephone2:telephone2,
					societe:societe,
					email:email,
					fonction:fonction,
					typepersonne:typepersonne,
					date_saisie:date_saisie,
					typecontact:typecontact,
                    id_user:id_user,
					};
					
	               console.log('{"action":'+sessionStorage.even+',"nom":'+nom+',"prenom":'+prenom+',"telephone1":'+telephone1+',"telephone2":'+telephone2+',"societe":'+societe+',"fonction":'+fonction+',"date_saisie":'+date_saisie+'}');
					
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
            $("#page-wrapper").load("liste_contact.php");
			
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

	console.log('je suis user '+sessionStorage.Id_user);

    console.log('je suis Téléphone 1'+sessionStorage.telephone1);
    console.log('je suis Téléphone 2 '+sessionStorage.telephone2_perso);

    console.log('je suis societe '+sessionStorage.societe);
    console.log('je suis E-mail '+sessionStorage.email);
    console.log('je suis fonction '+sessionStorage.fonction);
   

	$('#nomdiv').find('input').val(sessionStorage.nom);
	$('#prenomdiv').find('input').val(sessionStorage.prenom);
	$('#telephone1div').find('input').val(sessionStorage.telephone1_perso);
	$('#telephone2div').find('input').val(sessionStorage.telephone2_perso);
	$('#emaildiv').find('input').val(sessionStorage.email);
    $('#societediv').find('input').val(sessionStorage.societe);
    $('#fonctiondiv').find('input').val(sessionStorage.fonction);

    console.log('Je suis le '+sessionStorage.date_saisie);

   $('#datediv').find('input').val(sessionStorage.date_saisie);
	$('#typepersonne').append('<option value='+ sessionStorage.id_typepersonne +' selected>'+ sessionStorage.libelle +'</option>');
	//$('#exercice').append('<option value='+ sessionStorage.code_periode +' selected>'+ sessionStorage.periode +'</option>');
	}
});

</script>     
 