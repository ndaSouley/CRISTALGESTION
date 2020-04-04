<?php
session_start();
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-header panel-green" style="margin-top:5px;">BON DE LIVRAISON REGIE</h4>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form" action="bon_livraison_regie.php">
        <div class="col-lg-12">
            <div class="panel panel-default   panel-green">
                <div class="panel-heading"> LIVRAISON STIKER </div>
                <div class="panel-body">
                    <div class="row">
                        <p>
                        <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <td><div class="form-group" id="regiediv">
                                            <label class="control-label" > Regie:</label>
                                            <?php
                                            error_reporting(0);
                                            @ini_set('display_errors',0);
                                            header("Content-type: application/json");
                                            include('dbconnexion.php');

                                            echo "<select id='regie' name='regie'  class='form-control' style='width:130px;margin-bottom:5px;' required>
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
                                        <div class="form-group" id="numbcdiv">
                                            <label class="control-label"> N° BC:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px;" onkeydown="upperCaseF(this)" name="numbc" id="numbc" value="" required>
                                        </div>
                                        <div class="form-group" id="datecdediv">
                                            <label class="control-label"> Date Cde:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="" required>
                                        </div>
                                        <div class="form-group" id="numbldiv">
                                            <label class="control-label"> N° BL:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:130px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="numbl" id="numbl" value="" required>
                                        </div>
                                        <div class="form-group" id="datebldiv">
                                            <label class="control-label"> Date BL:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="datebl" id="datebl" value="" required>
                                        </div></td>
                                <tr> </tr>
                                </thead>
                            </table>
                        </p>
                        <p>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <td colspan="7"><div class="form-group row col-lg-2">
                                        <div class="col-lg-5" >
                                            <label class="control-label"> Valeur Unitaire Cde</label>
                                        </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;" id="valeurunitairecdediv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:70px;margin-top:10px;" onkeydown="upperCaseF(this)" name="valeurunitairecde" id="valeurunitairecde" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-4 pull-3">
                                            <label class="control-label"> Qté Cde</label>
                                        </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;" id="qtecdediv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:50px;margin-top:10px;" onkeydown="upperCaseF(this)" name="qtecde" id="qtecde" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-5">
                                            <label class="control-label"> Valeur Unitaire Livrée</label>
                                        </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;" id="valeurunitairelivrediv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:70px;margin-top:10px;" onkeydown="upperCaseF(this)" name="valeurunitairelivre" id="valeurunitairelivre" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-4 pull-3">
                                            <label class="control-label"> Plage Debut</label>
                                        </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;" id="plagedebutdiv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:70px;margin-top:10px;" onkeydown="upperCaseF(this)" name="plagedebut" id="plagedebut" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-4">
                                            <label class="control-label"> Plage Fin</label>
                                        </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;" id="plagefindiv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:70px;margin-top:10px;" onkeydown="upperCaseF(this)" name="plagefin" id="plagefin" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-4 pull-3">
                                            <label class="control-label"> Qté Livrée</label>
                                        </div>
                                        <div class="col-lg-2 " style="margin-bottom:auto;" id="qtelivreediv">
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:50px;margin-bottom:5px;" onkeydown="upperCaseF(this)" name="qtelivree" id="qtelivree" value="0" required readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row col-lg-2">
                                        <div class="col-lg-0"> </div>
                                        <div class="col-lg-2" style="margin-bottom:auto;">
                                            <button type="button"  name="btn_creeligne" id="btn_creeligne" class="btn btn-success">Crée Ligne</button>
                                        </div>
                                    </div></td>
                            </tr>
                            </thead>
                        </table>
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
        var regie = $('#regie').val();
        var numbc = $('#numbc').val();
        var datecd = $('#datecde').val();
        var datebl = $('#datebl').val();
        var numbl = $('#numbl').val();
        var valeurunitairecde = $('#valeurunitairecde').val();
        var plagedebut = $('#plagedebut').val();
        var plagefin =$('#plagefin').val();
        var qtecde =$('#qtecde').val();
        var valeurunitairelivre =$('#valeurunitairelivre').val();
        var qtelivree =$('#qtelivree').val();

        var num_tempo = sessionStorage.id_tempo2;
        var donnees = {action:sessionStorage.even,
            num_tempo:num_tempo,
            regie:regie,
            numbc:numbc,
            datebc:datecd,
            numbl:numbl,
            datebl:datebl,
            valunitcde:valeurunitairecde,
            qtecde:qtecde,
            valunitliv:valeurunitairelivre,
            plagedebut:plagedebut,
            plagefin:plagefin,
            qtelivre:qtelivree};
        console.log('{"action":'+sessionStorage.even+',"regie":'+regie+',"numbc":'+numbc+',"datebc":'+datecd+',"datebl":'+datebl+',"valunitcde":'+valeurunitairecde+',"qtecde":'+qtecde+',"valunitliv":'+valeurunitairelivre+',"plagedebut":'+plagedebut+',"plagefin":'+plagefin+',"qtelivre":'+qtelivree+'}');

        $.ajax({
            type: "POST",
            url: "traitement_bon_regie.php",
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
                $("#page-bon").load("liste_temporaire_bon2.php");

            },
            error: function(){
            }
        });

        $("#page-bon").load("liste_temporaire_bon2.php");
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
                $("#page-bon").load("liste_temporaire_bon2.php");

            },
            error: function(){
            }
        });

        $("#page-bon").load("liste_temporaire_bon2.php");

    });



    $(document).ready(function() {

        $("#page-bon").load("liste_temporaire_bon2.php");

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

        $('#regie').val('');
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
            $('#regiediv').find('input').val(sessionStorage.regie);
            $('#datecdediv').find('input').val(sessionStorage.date_cde);
            $('#numbcdiv').find('input').val(sessionStorage.num_bc);
            $('#numbldiv').find('input').val(sessionStorage.num_bl);
            $('#datebldiv').find('input').val(sessionStorage.date_bl);
            $('#valeurunitairecdediv').find('input').val(sessionStorage.valeur_unitaire_cde);
            $('#qtecdediv').find('input').val(sessionStorage.qte_cde);
            $('#valeurunitairelivrediv').find('input').val(sessionStorage.valeur_unitaire_livree);
            $('#plagedebutdiv').find('input').val(sessionStorage.plage_debut);
            $('#plagefindiv').find('input').val(sessionStorage.plage_fin);
            $('#qtelivreediv').find('input').val(sessionStorage.qte_livree);
            $('#regie').append('<option value='+ sessionStorage.regie +' selected>'+ sessionStorage.libelle +'</option>');

        }
    });



</script> 
