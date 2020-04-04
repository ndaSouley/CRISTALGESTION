

<!-- /.row -->
<div class="row" style="margin-top:15px;">
    <form role="form" method="post" class="form-inline" id="form" action="bon_livraison_regie.php">
        <div class="col-lg-12">
            <div class="panel panel-default   panel-green">
                <div class="panel-heading"> CONSULTATION CONTRIBUABLE</div>
                <div class="panel-body">
                    <div class="row">
                        <p>
                        <div class="col-lg-12">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <td height="20px"><div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label" style="margin-left:40px"> Nom:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="nom" id="nom" value="" required>
                                        </div>
                                        <div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label"> Prenoms:</label>
                                            <input class="form-control" type="text" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="prenom" id="prenom" value="" required>
                                        </div>
                                        <div class="form-group" id="datecdediv"  style="margin-left:25px">
                                            <label class="control-label"> Date naissance:</label>
                                            <input class="form-control" type="date" style="text-transform: capitalize;width:120px;margin-bottom:5px;padding:10px" onkeydown="upperCaseF(this)" name="datenaissance" id="datenaissance" value="" required>
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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">DETAIL CONTRIBUABLE</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th width="13%">Taxe</th>
                               <th width="34%">Montant Carnet</th>
                              <th width="34%">Quotité</th>
                                 <th width="34%">Montant Prévisonnel</th>
                              
                            </tr>
                        </thead>

                        <tbody>
           <tr>
                  <td><input type="text" value="" id="taxe" disabled="disabled"></td>
                  <td ><input type="text" value="" id="montantcarnet" disabled="disabled"></td>
                  <td ><input type="text" value="" id="quotite" disabled="disabled"></td>
                  <td ><input type="text" value="" id="montantprevisionnel" disabled="disabled"></td>
                   	  <td></td>	
                </tr>
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
                        <table>
                          <tr>
                          <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="J" required readonly><td>
                            <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="F" required readonly><td>
                              <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="M" required readonly><td>
                                <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="A" required readonly><td>
                                  <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="M" required readonly><td>
                                    <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="J" required readonly><td>
                                      <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="J" required readonly><td>
                                        <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="O" required readonly><td>
                                          <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="S" required readonly><td>
                                            <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="O" required readonly><td>
                                              <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="N" required readonly><td>
                                                <td><input class="form-control" type="text" style="text-transform: capitalize;width:40px;margin-bottom:5px;margin-left:15px" onkeydown="upperCaseF(this)" name="datecde" id="datecde" value="D" required readonly><td>
                          </tr>
                          </table>
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

<script>
    function collecteur_insert() {

    }
    function upperCaseF(a){
        setTimeout(function(){
            a.value = a.value.toUpperCase();
        }, 1);
    }
//Creation d'une ligne
    $("#btn_recherche").on('click', function()
    {
		var nom = $('#nom').val();
		var prenom = $('#prenom').val();
		var datenaissance = $('#datenaissance').val();
		var donnees = {action:"RECHERCHE",
		nom:nom,
		prenom:prenom,
		datenaissance:datenaissance
		
		};
console.log('{"action":'+"RECHERCHE"+',"nom":'+nom+',"prenom":'+prenom+',"datenaissance":'+datenaissance+'}');     
	
	$.ajax({
		type: "POST",
		url: "traitement_contribuable.php" ,
		data: donnees,
		success : function(data) {
			console.log('je suis le montant = '+ data.montant_previsionnel);
			console.log('je suis le taxe = '+data.Id_Type_quit);
			console.log('Je suis le quotité = '+data.montant_taxe );
			var V_Id_Type_quit = data.Id_Type_quit;
			var V_montant_carnet = data.montant_carnet;
			var V_montant_taxe = data.montant_taxe;
			var V_montant_previsionnel = data.montant_previsionnel;
			
			$('#taxe').val(V_Id_Type_quit);
			$('#montantcarnet').val(V_montant_carnet);
			$('#quotite').val(V_montant_taxe);
			$('#montantprevisionnel').val(V_montant_previsionnel);
		},
		error: function(){
		}
		});
		
        //$("#page-bon").load("tableau_contribuable.php");
    });

		
</script> 
