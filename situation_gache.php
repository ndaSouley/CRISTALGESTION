

<!-- /.row -->
<div class="row" style="margin-top:15px;">
    <form role="form" method="post" class="form-inline" id="form" action="bon_livraison_regie.php">
        <div class="col-lg-12">
            <div class="panel panel-default   panel-green">
                <div class="panel-heading"> SAISIE DES GACHES</div>
                <div class="panel-body">
                    <div class="row">
                        <p>
                        <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <td><div class="form-group" id="exercicediv" style="margin-left:15px">
                                            <label class="control-label" > Exercie:</label>
                                <select id='exercice' name='exercice' class='form-control' style='width:130px;margin-bottom:5px;' required>
                                <option disabled selected value>&ndash; Choisir &ndash;</option><option value='1'>2018</option>
</select>
                                        </div>
                                        <div class="form-group" style="margin-left:15px">

                      <label class="control-label" >Niveau:</label>
                      <?php
error_reporting(0);
@ini_set('display_errors', 0);
header("Content-type: application/json");
include('dbconnexion.php');
						
						echo "<select id='niveau' name='niveau'  class='form-control' style='width:130px;margin-bottom:5px;' required>
					<option value='' selected>&ndash; Choisir &ndash;</option>\n";

						$query1 ="SELECT libelle,id_regie FROM regie";

						$result1 = $mysqli->query($query1);

						while ($row = $result1->fetch_array(MYSQLI_ASSOC))
						{
							$libelle = $row['libelle'];
							$id_regie = $row['id_regie'];
							//while ($donnees = mysql_fetch_array($result1) )
							//    {
							echo "<option value='$id_regie'>$libelle</option>\n";
						}
						echo "</select>\n";
$mysqli->close();
?>
                      </div>
                      <div class="form-group" id="Numstickerdiv"  style="margin-left:15px">
                                            <label class="control-label">N° Sticker:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="numsticker" id="numsticker" value="" required>
                                        </div>
                         <div class="form-group" id="valeurdiv"  style="margin-left:15px">
                                            <label class="control-label"> Valeur:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="valeur" id="valeur" value="" required>
                                        </div>
                                       <div class="form-group" id="datediv"  style="margin-left:15px">
                                            <label class="control-label"> Date:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="dategache" id="dategache" value="" required>
                                        </div>

                                       <div class="form-group" id="datebldiv"  style="margin-left:15px">
            <button type="button"  name="btn_ajouter" id="btn_ajouter" class="btn btn-success">Ajouter</button>
                                        </div>

                                  
                                        </td>
                                <tr> </tr>
                                </thead>
                            </table>
                        </p>

                        <div class="panel-body">
                            <div id="page-bon">

                                </tbody>

                                </table>
                            </div>

                        </div>
                        <p>
                        <table width="100%" class="table " id="dataTables-example">
                            <tr>
                                <div class="text-right " >
                                    <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Abandonner</button>
                                    <button type="button" class="btn btn-success" name="btn_valider" id="btn_valider">Valider</button>
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

    $("#plagefin").on('blur', function()
    {

        var plagedebut = $('#plagedebut').val();
        var plagefin =$('#plagefin').val();

        $("#qtelivree").val(plagefin-plagedebut+1);
    });

    $("#btn_ajouter").on('click', function()
    {
        console.log('sessionStoragebon '+sessionStorage.V_gest_bon);
        if(sessionStorage.V_gest_bon=="1"){
            sessionStorage.even = "AJOUTER";
            console.log('Je suis dans la session Ajouter');

            //Reinitialisation des champs

        }
        else
        {
            sessionStorage.even = "UPDATE";

            //sessionStorage.V_gest_bon="1";
            console.log('Je suis dans la session UPDATE');
            //Reinitialisation des champs

        }
        var exercice = $('#exercice').val();
		var niveau = $('#niveau').val();
		var valeur = $('#valeur').val();
		var numsticker = $('#numsticker').val();
		var dategache = $('#dategache').val();
		var action = $('#action').val();
		var V_id_gache = sessionStorage.id_gache;
		var donnees = {action:sessionStorage.even,
		V_id_gache:V_id_gache,
		exercice:exercice,
		niveau:niveau,
		numsticker:numsticker,
		valeur:valeur,
		dategache:dategache};
  console.log('{"action":'+"AJOUTER"+',"execercie":'+exercice+',"niveau":'+niveau+',"numsticker":'+numsticker+',"valeur":'+valeur+',"dategache":'+dategache+'}');     
	
	$.ajax({
		type: "POST",
		url: "traitement_gache.php" ,
		data: donnees,
		success : function(data) {
			console.log('je suis ok'+data.exercice);

                if(sessionStorage.V_gest_bon=="1"){
                    sessionStorage.even = "AJOUTER";
                    console.log('Je suis dans la session Ajouter');

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
                    $('#regie').val('');
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
                $("#page-bon").load("tableau_gache.php");

            },
            error: function(){
            }
        });

        $("#page-bon").load("tableau_gache.php");
    });


    //CODE D'AJOUT DANS LA TABLE bon_livraison
    $("#btn_valider").on('click', function()
    {
        //Reinitialiser tous les champs
        $('#regie').val('');
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

        console.log("Je suis dans insertion");

        $.ajax({
            type: "POST",
            url: "traitement_bon_regie.php",
            data: donnees,
            success : function(data) {


                console.log("regire="+data.regie);
                console.log("numbc="+data.numbc);
                console.log("user="+data.user);
                 $("#page-bon").load("tableau_gache.php");

            },
            error: function(){
            }
        });

        $("#page-bon").load("tableau_gache.php");

    });



    $(document).ready(function() {

         $("#page-bon").load("tableau_gache.php");

        //$('#form')[0].reset();
        $('#action').val(sessionStorage.even);

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
            url: "traitement_bon_regie.php",
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
            url: "traitement_bon_regie.php",
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

    // CODE DE POUR RAPPELER LES DONNEES DANS LES DIFFERENTS CHAMPS

   $(document).ready(function() {

	$('#exercice').val('');
	$('#niveau').val('');
	$('#datediv').val('');
	$('#valeurdiv').val('');
	$('#Numstickerdiv').val('');
	
	  if(sessionStorage.even == "UPDATE"){
	console.log('je suis dans le update '+sessionStorage.exercice);
	$('#Numstickerdiv').find('input').val(sessionStorage.Numsticker);
	$('#valeurdiv').find('input').val(sessionStorage.valeur);
	$('#datediv').find('input').val(sessionStorage.date);
	$('#exercice').append('<option value='+ sessionStorage.exercice +' selected>'+ sessionStorage.periode +'</option>'
	);
	$('#niveau').append('<option value='+ sessionStorage.niveau +' selected>'+ sessionStorage.libelle +'</option>')
	}
});

</script> 
