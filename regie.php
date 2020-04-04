<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">REGIE</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row" align="center">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-5">
            <div class="panel panel-default">

                <div class="panel-heading text-align-center">
                    Infos Regie
                </div>                                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="" id="prenomdiv">
                                <label class="label_form">Regie</label>
                                <input class="form-control" type="text" style="text-transform: capitalize;width:250px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="prenom" id="prenom" value="" required >
                            
            <div class="text-right col-lg-12">
                <button type="submit" class="btn btn-success ">Valider</button>
                </div>
            </div>
                            <input type="hidden" name="action" id="action" value="">
                            <input type="hidden" name="acte" id="acte" value="quittance">
                            <input type="hidden" name="typequittance" id="typequittance" value="">
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
        $("#includedContent").load("collecteur.php");
    });
    
    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#includedContent").load("collecteur.php");
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
    //alert(activite);
  //alert(categorie);

var donnees = {action:"SELECTAJAX",
activite:activite,
categorie:categorie};
console.log('{"acte":"quittance","action":"select","activite":'+activite+',"categorie":'+categorie+'}');     

$.ajax({
    type: "POST",
    url: "traitement_taxe_forfaitaire.php" ,
    data: donnees,
    success : function(data) {      
        console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');

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

    var montant = $('#montant').val();

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
    var numquittance = $('#numquittance').val();
    var exercice = $('#exercice').val();
	var numserie = $('#numserie').val();
    var activite = $('#activite').val();
    var categorie = $('#categorie').val();
	 var cbdaf = $('#cbdaf').val();
	
  	var TAXE_FORFAITAIRE  = "TFDPPCA";
	var TAXE_OCCUPATION   = "T-ODP";
	var DEMANDE_AUTORISATION  = "DATC";
    var AUTORISATION_TRANSPORT_PUBLIC  = "ATPuV";
	var AUTORISATION_TRANSPORT_PRIVE = "ATPrV";
    var AUTORISATION_STATIONNEMENT = "AS";
    var AUTORISATION_STATIONNEMENT = "AC";
	 var id_user = "1";
	
  
    var datequittance = $('#datequittance').val();
    var montant = $('#montant').val();
	var droitplace = $('#droitplace').val();
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
     console.log('donnees = '+data);
	 
	 var donnees = {action:sessionStorage.even,
	 				collecteur:collecteur,
					nom:nom,
					prenom:prenom,
					TAXE_FORFAITAIRE:TAXE_FORFAITAIRE,
					datenaissance:datenaissance,
					lieunaissance:lieunaissance,
					cnisejour:cnisejour,
					cbdaf:cbdaf,
					telephone:telephone,
					quartier:quartier,
					profession:profession,
					numquittance:numquittance,
					exercice:exercice,
					activite:activite,
					categorie:categorie,
					id_user:id_user,
					datequittance:datequittance,
					montant:montant,
					droitplace:droitplace
					};
					
	               console.log('{"action":'+sessionStorage.even+',"collecteur":'+collecteur+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+',"lieunaissance":'+lieunaissance+',"cnisejour":'+cnisejour+',"telephone":'+telephone+',"quartier":'+quartier+',"profession":'+profession+',"numquittance":'+numquittance+',"exercice":'+exercice+',"activite":'+activite+',"categorie":'+categorie+',"datequittance":'+datequittance+',"montant":'+montant+'}');
					
//					console.log('{"id_abonn_serv":'+data.id_abonn_serv+',"montant_mensuel":'+ data.montant_mensuel+',"droit_de_place":'+ data.droit_de_place+'}');
					
    $.ajax({
        type: "POST",
        url: "traitement_taxe_forfaitaire.php" ,
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
            $("#page-wrapper").load("regie.php");

            }
            else
            {
            document.getElementById('mess2').innerHTML = data.Motif;
            $(location).attr('href','#message2');
            }
				
            },
            error: function (errorThrown) {
            //callbackfn("Error msg = "+errorThrown.Motif);
            $("#includedContent").load("regie.php");
            }

            });

});
});

</script>     
