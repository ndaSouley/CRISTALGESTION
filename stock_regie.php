<!-- /.row -->
<div class="row" style="margin-top:15px;">
    <form role="form" method="post" class="form-inline" id="form" action="bon_livraison_regie.php">
        <div class="col-lg-12">
            <div class="panel panel-default   panel-green">
                <div class="panel-heading"> STOCK REGIE</div>
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
                                        <div class="form-group" style="margin-left:15px">

                      <label class="control-label" >Regie:</label>
                      <?php
error_reporting(0);
@ini_set('display_errors', 0);
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
                         <div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label"> Date Debut:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="datedebut" id="datedebut" value="" required>
                                        </div>
                                       <div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label"> Date Fin:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:150px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="datedefin" id="datedefin" value="" required>
                                        </div>

                                       <div class="form-group" id="datebldiv"  style="margin-left:25px">
            <button type="button"  name="btn_rechercher" id="btn_rechercher" class="btn btn-success">Rechercher</button>
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
                 <h4 class="panel-title pull-left" style="padding-top: 7.5px;">INFORMATIONS REGIE</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th width="13%">Date</th>
                               <th width="34%">Regie</th>
                              <th width="34%">Valeur Stcker</th>
                                 <th width="34%" >Qté Livrée</th>
                              <th width="100%">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
				<tr>
                  <td><input type="text" value="" id="dateFin" disabled="disabled"></td>
                  <td ><input type="text" value="" id="Vregie" disabled="disabled"></td>
                  <td ><input type="text" value="" id="valeursticker" disabled="disabled"></td>
                  <td ><input type="text" value="" id="qtelivree" disabled="disabled"></td>
                  <td ><input type="text" value="" id="montant" disabled="disabled"></td>
                   	  <td></td>	
                </tr>
                <tr><td colspan="3">Total</td>
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
    $("#btn_rechercher").on('click', function()
    {
		
		var regie = $('#regie').val();
		var datedefin = $('#datedefin').val();
		var datedebut = $('#datedebut').val();
		var exercice = $('#exercice').val();
		var donnees = {action:"SELECT",
		datedefin:datedefin,
		exercice:exercice,
		datedebut:datedebut,
		regie:regie,
		
		};
console.log('{"action":'+"SELECT"+',"exercice":'+exercice+',"datedebut":'+datedebut+',"datedefin":'+datedefin+'}');     
	
	$.ajax({
		type: "POST",
		url: "traitement_stocke_regie.php" ,
		data: donnees,
		success : function(data) {
			console.log('valeur_unitaire_commande = '+data.valeur_unitaire_commande);
			console.log('mle_regisseur= '+data.libelle);
			var mle_regisseur = data.mle_regisseur;
			var valeur_unitaire_commande = data.valeur_unitaire_commande;
			var montant = data.montant;
			var date_bon_livraison = data.date_bon_livraison;
			var V_total_qte_livraison = data.total_qte_livraison;
			var V_libelle = data.libelle;
			var valeur_unitaire_livraison = data.valeur_unitaire_livraison;
			var total_qte_livraison = data.total_qte_livraison;
			$('#dateFin').val(date_bon_livraison);
			$('#Vregie').val(V_libelle);
			//$('#Vregie').find('input').val(V_libelle);
			$('#montant').val(montant);
			$('#qtelivree').val(V_total_qte_livraison);
			$('#valeursticker').val(valeur_unitaire_livraison);
			$('#tqte').val(V_total_qte_livraison);
			$('#tmontant').val(montant);
		//	-------------------------------------------------------------------------
			// var i = 0;
			//while (i<montant)
                      // {
                        // document.getElementById("td_peer_addr" ).html(infos.peer_addr);
                         //  document.getElementById("td_peer_aas" ).html(infos.peer_as);
                           
                      // }
					 //  I++.
		//	-------------------------------------------------------------------------
		},
		error: function(){
		}
		});
		
       // $("#page-bon").load("tableau_regie.php");
    });

		
</script> 
