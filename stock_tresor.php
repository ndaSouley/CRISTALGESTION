

<!-- /.row -->
<div class="row" style="margin-top:15px;">
    <form role="form" method="post" class="form-inline" id="form" action="bon_livraison_regie.php">
        <div class="col-lg-12">
            <div class="panel panel-default   panel-green">
                <div class="panel-heading"> STOCK TRESOR</div>
                <div class="panel-body">
                    <div class="row">
                        <p>
                        <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <td><div class="form-group" id="regiediv" style="margin-left:15px">
                                            <label class="control-label" > Exercie:</label>
                                <select id='exercice' name='exercice' class='form-control' style='width:130px;margin-bottom:5px;' required>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>2018</option>
</select>
                                        </div>
                                        <div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label"> Date Debut:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="date_debut" id="date_debut" value="" required>
                                        </div>
                                                <div class="form-group" id="datebldiv"  style="margin-left:25px">
                                            <label class="control-label"> Date Fin:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="date_fin" id="date_fin" value="" required>
                                        </div>
                                       <div class="form-group" id="datebldiv"  style="margin-left:25px">
            <button type="button"  name="btn_recherche" id="btn_recherche" class="btn btn-success">Rechercher</button>
                                        </div>

                                  
                                        </td>
                                <tr> </tr>
                                </thead>
                            </table>
                        </p>
                     <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">INFORMATIONS TRESOR</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th width="13%">Date</th>
                              <th width="34%">Valeur Stcker</th>
                              <th width="34%">Qté Livrée</th>
                              <th width="100%" colspan="2" align="center">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
				<tr>
                  <td><input type="text" value="" id="dateFin" disabled="disabled"></td>
                  <td ><input type="text" value="" id="valeursticker" disabled="disabled"></td>
                  <td ><input type="text" value="" id="qte" disabled="disabled"></td>
                  <td ><input type="text" value="" id="montant" disabled="disabled"></td>
                   	  <td></td>	
                </tr>
                <tr><td colspan="2">Total</td>
                  <td><input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="tqte" id="tqte" value="" disabled="disabled"></td>
                             <td><input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="tmontant" id="tmontant" value="" disabled="disabled"></td></tr>
	
                    </tbody>
          </table>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
                    </tbody>
          </table>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
           
                    </tbody>
          </table>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    

                                </tbody>

                                </table>
                            </div>

                        </div>
                        <p>
                        <table width="100%" class="table " id="dataTables-example">
                            <tr>
                                <div class="text-right " >
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
 </div>
-->

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
        $("#page-bon").load("tableau_regie.php");
    });
    
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
       $("#page-bon").load("tableau_regie.php");
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
    $("#btn_recherche").on('click', function()
    {
	
		var exercice = $('#exercice').val();
		var date_fin = $('#date_fin').val();
		var date_debut = $('#date_debut').val();
		
		var donnees = {action:"SELECT",
			exercice:exercice,
		date_fin:date_fin,
		date_debut:date_debut,
		
		};
console.log('{"action":'+"SELECT"+',"date_fin":'+date_fin+',"date_debut":'+date_debut+',"exercice":'+exercice+'}');     
	
	$.ajax({
		type: "POST",
		url: "traitement_stocke_tresor.php" ,
		data: donnees,
		success : function(data) {
			console.log('Retour valeur_unitaire_livraison:'+data.valeur_unitaire_livraison);
			console.log('Retour:'+data.total_qte_livraison);
			console.log('Retour total_qte_livraison:'+data.total_qte_livraison);
			      
			
	    var V_valeur_unitaire_livraison=data.valeur_unitaire_livraison;
		var V_total_qte_livraison=data.total_qte_livraison;
		var V_date_bon_livraison=data.date_bon_livraison;
		var V_periode=data.periode;
		var V_montant=data.montant;
	     
		 //V_total_qte_livraison.innerHTML += document.getElementById("date_fin").value;//on y met le contenu de titre
	   
		$('#dateFin').val(V_date_bon_livraison);
		$('#valeursticker').val(V_valeur_unitaire_livraison);
		$('#qte').val(V_total_qte_livraison);
		$('#montant').val(V_montant);
		$('#tqte').val(V_total_qte_livraison);
		$('#tmontant').val(V_montant);
		},
		error: function(){
		}
		});
		//document.getElementById('date_fin').innerHTML = V_date_bon_livraison;
        $("#page-bon").load("tableau_tresor.php");
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
			
			
		$("#page-bon").load("tableau_tresor.php");
	
		},
		error: function(){
		}
		});
		
        $("#page-bon").load("tableau_tresor.php");
		
    });
	
    $(document).ready(function() {
		
	$("#page-bon").load("tableau_tresor.php");
		
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
            $("#page-wrapper").load("tableau_tresor.php");

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
