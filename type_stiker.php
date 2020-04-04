<?php
session_start(); 
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
<head>
<link rel="stylesheet" href="css/popupform.css"/>
</head>

<div class="row">
    
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row col-md-offset-2" style="margin-top:15px;">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-8">
            <div class="panel panel-default  panel-green">

                <div class="panel-heading">
                    Infos Type Sticker
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="" id="valeur_facialediv">
                                <label class="label_form">Type Sticker:</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:300px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="valeur_faciale" id="valeur_faciale" value="" required>
                            </div>
                      <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="">
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                            <div class="col-lg-12">
            <div class=" text-right">
              <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
                <button type="submit" class="btn btn-success">Valider</button>
            </div>
        </div>

                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>

            <!-- /.panel -->
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
 
 
<script>
    
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
        $("#page-wrapper").load("liste_type_stiker.php");
    });
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-wrapper").load("liste_type_stiker.php");
    });
    
    $("#BoutonOUI").on('click', function()
    {
        $('#valeur_faciale').val('');
        
        $('#message').remove();
    }); 
    
    $("#BoutonNON").on('click', function()
    {
       $("#page-wrapper").load("type_stiker.php");
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

      
$("input").focusout(function(){
    $(this).val($.trim($(this).val()));
});


$("#BoutonOUI").on('click', function()
	{
	$('#valeur_faciale').val('');
	
	
	 // Variables service 
    $('#valeur_faciale').val('');
    $('#action').val('');
	$('#message').remove();
	
    });	
	
	$("#BoutonNON").on('click', function()
	{
		$("#page-wrapper").load("liste_type_stiker.php");
    });

$('form').submit(function(e) {
//    alert("submit form");
    e.preventDefault(e);

 
   // variables contribuable
    var valeur_faciale  = $('#valeur_faciale').val();
	 var code_type_sticker  = 'STK';
    var action = $('#action').val();

    var data = $('form').serialize(); 
     console.log('donnees = '+data);
	 
	// var numquit = sessionStorage.mat_quittance;
	 var num =sessionStorage.code_type_sticker;
	 var donnees = {action:sessionStorage.even,
	                
					//Données contribuable
	 				valeur_faciale:valeur_faciale,
					num:num,
					};
					
	           console.log('{"action":'+sessionStorage.even+',"valeur_faciale":'+valeur_faciale+',"code_type_sticker":'+num+'}');                 
					
//					console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_type_styker.php" ,
        data: donnees,
        success : function(data) {
			console.log("id_abonn_serv="+data.Motif);
			console.log('code type sticker'+data.code_type_sticker);
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
            $("#page-wrapper").load("liste_type_stiker.php");
			
            }

            });

});
});

$(document).ready(function() {
	
    $('#valeur_faciale').val('');
	
	//sessionStorage.code_type_sticker=code_type_sticker;
	if(sessionStorage.even == "UPDATE"){
		//console.log('je suis dans le update '+sessionStorage.valeur_faciale);
	$('#valeur_facialediv').find('input').val(sessionStorage.valeur_faciale);
	//sessionStorage.valeur_faciale = sessionStorage.code_type_sticker;
	//$('#valeur_faciale').val(sessionStorage.valeur_faciale);
	
	}
});


</script>  
