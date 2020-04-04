<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"  style="margin-top:5px;"></h3>
  </div>
  <!-- /.col-lg-12 --> 
</div>
<!-- /.row -->
<div class="row">
  <form role="form" method="post" class="form-inline" id="form" action="">
    <div class="col-lg-12">
      <div class="panel panel-default  panel-green">
        <div class="panel-heading"> SAISI GACHE</div>
        <div class="panel-body">
          <div class="row">
            <p>
            <div class="col-lg-12">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr rolspan=""3>
                    <td rowspan="4"><div class="form-group">
                        <label class="control-label"> Exercice:</label>
                          <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:35px;padding:20px" onkeydown="upperCaseF(this)" name="execercie" id="execercie" value="" required>

                      </div>
                      <div class="form-group">
                        <label class="control-label"> Niveau:</label>
                        <select name="select" id="select">
                        </select>
                      </div>

                           <div class="form-group" style="margin-left:30px">
                        <label class="control-label"> N° Sticker:</label>
                        <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:30px;padding:20px" onkeydown="upperCaseF(this)" name="numsticker" id="numsticker" value="" required>
                      </div>
                          <div class="form-group" style="margin-left:50px">
                        <label class="control-label"> Valeur Sticker:</label>
                            <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:30px;padding:20px" onkeydown="upperCaseF(this)" name="numsticker" id="numsticker" value="" required>
                      </div>
                      <div class="form-group" style="margin-left:50px">
                        <label class="control-label"> Date:</label>
                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-left:30px;padding:20px" onkeydown="upperCaseF(this)" name="numsticker" id="numsticker" value="" required>
                      </div>
                      <div class="form-group" style="margin-left:15px;">
                <button type="submit" class="btn btn-success">Ajouter</button>
                 </div>
       
                      </td>
                  <tr> </tr>
                </thead>
              </table>
              
             <div class="panel-body">
                
                <div id="page-bon">
              <!-- <table width="100%" class="table " id="dataTables-example">
                  <thead>
                    <tr>
                      <th>N° Quittance</th>
                      <th>Date paiement</th>
                      <th>N° Sticker</th>
                      <th>Montant Sticker</th>
                    </tr>
                  </thead>
                  <tbody>
                  <p>
                  
                  <tr height="40">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr height="40">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr height="40">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  <tr height="40">
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                                     
                    </tbody>
                  
                </table>
                </div>
                
                
              </div>-->-->
              <p>
              <table width="100%" class="table " id="dataTables-example">
                <tr>
                  <div class="text-right " >
                    <button type="submit" class="btn btn-success">Valider</button>
                  </div>
                  <br />
				  <div class="text-right " >
                    <button type="submit" class="btn btn-success">Valider</button>
                  </div>
                </tr>
              </table>              
            </div>
            <!-- /.col-lg-6 (nested) --> 
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

<!--<div id="message" class="modalDialog">	
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
 </div> --> 

<script>
    function collecteur_insert() {

    }
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
    //console.log("je suis dans le declencheur");
        $("#page-bon").load("liste_bon_tresor.php");
    });
    
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
       $("#page-bon").load("liste_temporaire_bon2.php");
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
	//PERD LE FOCUS
	 $("#plagefin").on('blur', function()
    {
		var plagedebut = $('#plagedebut').val();
		var plagefin =$('#plagefin').val();
		
        $("#qtelivree").val(plagefin-plagedebut+1);
    });
	// Creation d'une ligne
    $("#btn_creeligne").on('click', function()
    {
		console.log('sessionStoragebon '+sessionStorage.V_gest_bon);
		if(sessionStorage.V_gest_bon=="1"){
			sessionStorage.even = "CREELIGNE";
			console.log('Je suis dans la session créeligne');
			
			//Reinitialisation des champs	
			}
			else
			{
			sessionStorage.even = "UPDATE";	
			
			//sessionStorage.V_gest_bon="1";
			console.log('Je suis dans la session UPDATE');
			//Reinitialisation des champs		
			}
		var execercie = $('#execercie').val();
		var collecteur = $('#collecteur').val();
		var matricule_col = $('#matricule_col').val();
		var numquittance = $('#numquittance').val();
		var datepaiement = $('#datepaiement').val();
		var numsticker = $('#numsticker').val();
		var montantsticker = $('#montantsticker').val();
		µ
		var num_tempo = sessionStorage.id_tempo2;
		var donnees = {action:sessionStorage.even,
		num_tempo:num_tempo,
		execercie:execercie,
		collecteur:collecteur,
		matricule_col:matricule_col,
		numquittance:numquittance,
		datepaiement:datepaiement,
		numsticker:numsticker,
		montantsticker:montantsticker
		};
console.log('{"action":'+sessionStorage.even+',"execercie":'+execercie+',"collecteur":'+collecteur+',"matricule_col":'+matricule_col+',"numquittance":'+numquittance+',"datepaiement":'+datepaiement+',"numsticker":'+numsticker+',"montantsticker":'+montantsticker+'}');     
	
	$.ajax({
		type: "POST",
		url: "traitement_paiement.php" ,
		data: donnees,
		success : function(data) {
			console.log('okregie = '+data.regie);
			console.log('okbon = '+data.numbc);
			console.log('okuser = '+data.user);
			var v_regie = data.regie;
			var v_numbc = data.numbc;
			var v_user = data.user;
		
			sessionStorage.v_regie = data.regie;
			sessionStorage.v_numbc = data.numbc;
			sessionStorage.v_user = data.user;
			
		if(sessionStorage.V_gest_bon=="1"){
			sessionStorage.even = "CREELIGNE";
			console.log('Je suis dans la session créeligne');
			
			//Reinitialisation des champs	
			 
		     $('#plagedebut').val('');
	         $('#plagefin').val('');
		     $('#qtecde').val('');
		     $('#valeurunitairelivre').val('');
		     $('#qtelivree').val('');
			 $('#valeurunitairecde').val('');
		
			}
			else
			{
			sessionStorage.even = "UPDATE";	
			
			//sessionStorage.V_gest_bon="1";
			console.log('Je suis dans la session UPDATE');
			//Reinitialisation des champs		
			$('#agent_receptionnaire').val('');
			$('#numbc').val('');
			$('#datecde').val('');
			$('#datebl').val('');
			$('#numbl').val('');
			$('#valeurunitairecde').val('');
			$('#plagedebut').val('');
			$('#plagefin').val('');
			$('#qtecde').val('');
			$('#valeurunitairelivre').val('');
			$('#qtelivree').val('');
			}
			sessionStorage.V_gest_bon="1";
			$("#page-bon").load("liste_temporaire_bon_tresor.php");
	
		},
		error: function(){
		}
		});
		
        $("#page-bon").load("liste_temporaire_bon_tresor.php");
    });

		//CODE D'AJOUT DANS LA TABLE bon_livraison
		 $("#btn_valider").on('click', function()
      {
		//Reinitialiser tous les champs
		$('#agent_receptionnaire').val('');
		$('#numbc').val('');
		$('#datecde').val('');
		$('#datebl').val('');
		$('#numbl').val('');
		$('#valeurunitairecde').val('');
		$('#plagedebut').val('');
		$('#plagefin').val('');
	    $('#qtecde').val('');
		$('#valeurunitairelivre').val('');
		$('#qtelivree').val('');
	
		var donnees = {action:"INSERT",
		};
 
	console.log('Je suis dans insertion');
	
	$.ajax({
		type: "POST",
		url: "traitement_paiement.php" ,
		data: donnees,
		success : function(data) {
			
			
		$("#page-bon").load("liste_temporaire_paiement.php");
	
		},
		error: function(){
		}
		});
		
        $("#page-bon").load("liste_temporaire_paiement.php");
		
    });
	
    $(document).ready(function() {
		
		$("#page-bon").load("liste_temporaire_paiement.php");
		
        //$('#form')[0].reset();
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
    //alert(activite);
  //alert(categorie);

var donnees = {action:"SELECTAJAX",
numsticker:numsticker};
console.log('{"acte":"quittance","action":"select","activite":'+activite+',"categorie":'+categorie+'}');     

$.ajax({
    type: "POST",
    url: "traitement_paiement.php" ,
    data: donnees,
    success : function(data) {      
        console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');

        $('#montant').val(data.montant_sticker);
		
        //PERD LE FOCUS
	 $("#numsticker").on('blur', function()
    {
	var numsticker = $('#numsticker').val();
		var montantsticker = $('#montantsticker').val();
		var numsticker = $('#numsticker').val();
        $("#montantsticker").val(7);
    });

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
// Variables regie
    

    var action = $('#action').val();

    
    var data = $('form').serialize(); 
     console.log('donnees = '+data);
	 var donnees = {action:sessionStorage.even,
	 				};
					
					
//	               console.log('{"action":'+sessionStorage.even+',"collecteur":'+collecteur+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+',"quartier":'+quartier+',"profession":'+profession+',"numquittance":'+numquittance+',"exercice":'+exercice+',"activite":'+activite+',"categorie":'+categorie+',"datequittance":'+datequittance+',"montant":'+montant+'}');
					
//					console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_bon_tresor.php" ,
        data: donnees,
        success : function(data) {
			if(sessionStorage.even == "INSERT")
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
            alert(data.Motif);
            $("#page-wrapper").load("bon_livraison_regie.php");

            }
            else
            {
            document.getElementById('mess2').innerHTML = data.Motif;
            $(location).attr('href','#message2');
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            //$("#includedContent").load("collecteur.php");
            }

            });

});
});

// CODE DE POUR RAPPELER LES DONNEES DANS LES DIFFERENTS CHAMPS

$(document).ready(function() {

	$('#agent_receptionnaire').val('');
	$('#datecde').val('');
	$('#numbc').val('');
	$('#numbl').val('');
	$('#datebl').val('');
	$('#valeurunitairecde').val('');
	$('#qtecde').val('');
	$('#plagedebut').val('');
	$('#valeurunitairelivre').val('');
     $('#plagefin').val('');
	$('#qtelivree').val('');
   $('#acte').val('');
    $('#action').val('');
	
	if(sessionStorage.even == "UPDATE"){
	console.log('je suis dans le update '+sessionStorage.regie);
	$('#agent_receptionnairediv').find('input').val(sessionStorage.agent_receptionnaire);
	$('#datecdediv').find('input').val(sessionStorage.date_bon_commande);
	$('#numbcdiv').find('input').val(sessionStorage.num_bon_commande);
	$('#numbldiv').find('input').val(sessionStorage.num_bon_livraison);
	$('#datebldiv').find('input').val(sessionStorage.date_bon_livraison);
	$('#valeurunitairecdediv').find('input').val(sessionStorage.valeur_unitaire_commande);
	$('#qtecdediv').find('input').val(sessionStorage.total_qte_commande);
	$('#valeurunitairelivrediv').find('input').val(sessionStorage.valeur_unitaire_livraison);
	$('#plagedebutdiv').find('input').val(sessionStorage.plage_debut_sticker);
	$('#plagefindiv').find('input').val(sessionStorage.plage_fin_sticker);
	$('#qtelivreediv').find('input').val(sessionStorage.total_qte_livraison);
	//$('#regie').append('<option value='+ sessionStorage.regie +' selected>'+ sessionStorage.libelle +'</option>');
	
	}
});



</script> 
