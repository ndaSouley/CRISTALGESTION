<?php
session_start(); 
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
<div class="row">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <div class="col-lg-12">
        <h3 class="page-header"  style="margin-top:5px;"></h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <form role="form" method="post" class="form-inline" id="form">
        <div class="col-lg-12">
            <div class="panel panel-default  panel-green">
                <div class="panel-heading">
                    PAIEMENT
                </div>
                <div class="panel-body">
                    <div class="row">
                        <p>
                        <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr rolspan=""3>
                                    <td rowspan="4">
                                        <div class="form-group" ID="execiecerdiv">
                                            <label class="control-label">
                                                Exercice:
                                            </label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:35px;padding:20px" onKeyDown="upperCaseF(this)" name="execercie" id="execercie" value="" required>
                                        </div>
                                        <div class="form-group" style="margin-left:30px;" id="code_contribuablediv">
                                            <label class="control-label">
                                                Collecteur:
                                            </label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:250px;margin-left:30px;" onKeyDown="upperCaseF(this)" name="collecteur" id="collecteur" value="" required readonly>
                                        </div>
                                        </br>
                                        <div class="form-group">
                                            <label class="control-label">
                                                Matricule Col:
                                            </label>
                                            <?php
											
                                            error_reporting(0);
                                            @ini_set('display_errors', 0);
                                            header("Content-type: application/json");

                                            include('dbconnexion.php');

                                            echo "<select id='matricule_col' name='matricule_col'  form-control' style='width:150px;margin-bottom:5px;margin-left:6px;height:40px' required>
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
                                                echo "<option value='$matricule_collecteur'>$matricule_collecteur</option>\n";

                                            }

                                            echo "</select>\n";
                                            $mysqli->close();

                                            ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-left:35px">
                                            <label class="control-label" style="margin-right:10px;">
                                                N° Quittance:
                                            </label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:5px;padding:20px" onKeyDown="upperCaseF(this)" name="numquittance" id="numquittance" value="">
                                        </div>
                                        </br>
                                        <div class="form-group" id="datepaiementdiv">
                                            <label class="control-label">
                                                Date paiement:
                                            </label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;margin-right:5px;padding:10px" onKeyDown="upperCaseF(this)" name="datepaiement" id="datepaiement" value="" required>
                                        </div>
                                        <div class="form-group" style="margin-left:30px">
                                            <label class="control-label">
                                                N° Sticker:
                                            </label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-left:30px;padding:20px" onKeyDown="upperCaseF(this)" name="numsticker" id="numsticker" value="" required>
                                        </div>
                                        <div class="form-group" style="margin-left:50px" id="montantstickerdiv">
                                            <label class="control-label">
                                                Montant Sticker:
                                            </label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:150px;margin-bottom:0px;" onKeyDown="upperCaseF(this)" name="montantsticker" id="montantsticker" value="0" required readonly>
                                        </div>
                                        <div class="form-group" style="margin-left:15px;">
                                            <button type="button"  name="btn_creeligne" id="btn_creeligne" class="btn btn-success">
                                                Crée Ligne
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        </p>
                        <div class="panel-body">
                            <div id="page-bon">
                            </div>
                        </div>
                        <p>
                        <table width="100%" class="table ">
                            <tr>
                                <div class="text-right " >
                                    <button class="btn btn-danger" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur">
                                        Abandonner
                                    </button>
                                    <button type="button" class="btn btn-success" name="btn_valider" id="btn_valider" style="margin-right:15px">
                                        Valider
                                    </button>
                                </div>
                            </tr>
                        </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>


<script type="text/javascript">


    $(document).ready(function() {

        $("#page-bon").load('liste_temporaire_paiement.php');

    });
    function collecteur_insert() {

    }
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }

    $("#BoutonResetCollecteur").on('click', function(){
        //console.log("je suis dans le declencheur");
        $("#page-bon").load("liste_temporaire_paiement.php");
    });

    $("#BoutonOK").on('click', function()
    {
        $('#message').remove();
        $("#page-bon").load("liste_temporaire_paiement.php");
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
    //VERIFICATION DU N°STICKER SAISIE
    $("#numsticker").on('blur', function()
    {
        var numsticker = $('#numsticker').val();
        var donnees = {action:"SELECTALL",
            numsticker:numsticker,
        }
		console.log('action:SELECTALL','num_sticker:'+numsticker);
        $.ajax({
            type: "POST",
            url: "traitement_paiement.php",
            data: donnees,
            success : function(ka) {
                //console.log('montant sticker = '+sessionStorage.montant_sticker);
                V_id_sticker = ka.id_sticker;
                V_num_collecte = ka.num_collecte;
                V_code_type_sticker = ka.code_type_sticker;
                V_isused = ka.isused;
                V_num_sticker = ka.num_sticker;
                V_montant_sticker = ka.montant_sticker;
                console.log('montant sticker = '+ka.montant_sticker);
                if(V_num_collecte=='' && V_isused==0){
                    $('#montantsticker').val(V_montant_sticker);
                }else{
                    //alert('Ce N°sticker est déjà utilisé pour un paiement');
					//window.confirm("Ce N°sticker est déjà utilisé pour un paiement");
					$.alert({
							title: 'Erreur!',
							content: 'Ce n°sticker est déjà utilisé pour un paiement!',
						});

                }

            }
        })

        //$("#qtelivree").val(plagefin-plagedebut+1);
    });
    //DEBUT RECHERCHE DU COLLECTEUR
    $("#matricule_col").change(function()
    {
        var matricule_col = $('#matricule_col').val();
        //$('#montantsticker').val(V_montant_sticker);
        var donnees = {action:"SELECTCOL",
            matricule_col:matricule_col,
        }
        $.ajax({
            type: "POST",
            url: "traitement_paiement.php",
            data: donnees,
            success : function(ka) {
                //console.log('montant sticker = '+sessionStorage.montant_sticker);
                V_collecteur = ka.collecteur;
                console.log('montant sticker = '+ka.collecteur);
                $('#collecteur').val(V_collecteur);
            }
        })
    });
    //FIN RECHERCHE DU COLLECTEUR
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

        var num_tempo = sessionStorage.id_tempo2;
        var donnees = {action:sessionStorage.even,
            num_tempo:num_tempo,
            execercie:execercie,
            collecteur:collecteur,
            matricule_col:matricule_col,
            numquittance:numquittance,
            datepaiement:datepaiement,
            numsticker:numsticker,
            V_num_collecte:V_num_collecte,
            montantsticker:montantsticker};
        console.log('{"action":'+sessionStorage.even+',"execercie":'+execercie+',"collecteur":'+collecteur+',"matricule_col":'+matricule_col+',"numquittance":'+numquittance+',"datepaiement":'+datepaiement+',"numsticker":'+numsticker+',"montantsticker":'+montantsticker+'}');
        $.ajax({
            type: "POST",
            url: "traitement_paiement.php" ,
            data: donnees,
            success : function(data) {
                console.log('ok contribuable = '+data.id_contribuable);
                console.log('ok montant = '+data.montantsticker);
                console.log('okuser = '+data.user);

                if(sessionStorage.V_gest_bon=="1"){
                    sessionStorage.even = "CREELIGNE";
                    console.log('Je suis dans la session créeligne');

                    //Reinitialisation des champs

                    $('#execercie').val('');
                    $('#collecteur').val('');
                    $('#matricule_col').val('');
                    $('#numquittance').val('');
                    $('#datepaiement').val('');
                    $('#numsticker').val('');
                    $('#montantsticker').val('');
                }
                else
                {
                    sessionStorage.even = "UPDATE";
                    //sessionStorage.V_gest_bon="1";
                    console.log('Je suis dans la session UPDATE');
                    //Reinitialisation des champs
                    $('#execercie').val('');
                    $('#collecteur').val('');
                    $('#matricule_col').val('');
                    $('#numquittance').val('');
                    $('#datepaiement').val('');
                    $('#numsticker').val('');
                    $('#montantsticker').val('');
                }
                sessionStorage.V_gest_bon="1";
                $("#page-bon").load("liste_temporaire_paiement.php");
            },
            error: function(){
            }
        });

        $("#page-bon").load("liste_temporaire_paiement.php");
    });

    //CODE D'AJOUT DANS LA TABLE bon_livraison
    $("#btn_valider").on('click', function()
    {
        //Reinitialiser tous les champs
        $('#execercie').val('');
        $('#collecteur').val('');
        $('#matricule_col').val('');
        $('#numquittance').val('');
        $('#datepaiement').val('');
        $('#numsticker').val('');
        $('#montantsticker').val('');

        var donnees = {action:"INSERT",
        };

        console.log('Je suis dans insertion');

        $.ajax({
            type: "POST",
            url: "traitement_paiement.php" ,
            data: donnees,
            success : function(data) {

                console.log('{"action":'+sessionStorage.even+',"execercie":'+execercie+',"collecteur":'+collecteur+',"matricule_col":'+matricule_col+',"numquittance":'+numquittance+',"datepaiement":'+datepaiement+',"numsticker":'+numsticker+',"montantsticker":'+montantsticker+'}');

                $("#page-bon").load("liste_temporaire_paiement.php");

            },
            error: function(){
            }
        });

        $("#page-bon").load("liste_temporaire_paiement.php");
    });

    /* $(document).ready(function() {

        $("#page-bon").load("liste_temporaire_paiement.php");

    });*/

    // CODE DE POUR RAPPELER LES DONNEES DANS LES DIFFERENTS CHAMPS

    $(document).ready(function() {

        $('#collecteurdiv').val('');
        $('#matricule_coldiv').val('');
        $('#montantstickerdiv').val('');
        $('#datepaiementdiv').val('');
        $('#execiecerdiv').val('');
        $('#code_contribuablediv').val('');
        $('#action').val('');

        if(sessionStorage.even == "UPDATE"){
            console.log('je suis dans le update '+sessionStorage.num_collecte);
            console.log('je suis dans le update '+sessionStorage.code_contribuable);
            console.log('matricule collecteur '+sessionStorage.matricule_collecteur);
            console.log('je suis dans le update '+sessionStorage.montant_paye);
            $('#collecteurdiv').find('input').val(sessionStorage.date_paye);
            $('#code_contribuablediv').find('input').val(sessionStorage.code_contribuable);
            $('#montantstickerdiv').find('input').val(sessionStorage.montant_paye);
            $('#datepaiementdiv').find('input').val(sessionStorage.date_paye);
            $('#execiecerdiv').find('input').val(sessionStorage.annee_paye);

            //$('#id_service').find('input').val(sessionStorage.id_service);

            $('#matricule_col').append('<option value='+ sessionStorage.matricule_col +' selected>'+ sessionStorage.matricule_collecteur +'</option>');

        }
    });
</script>
