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
                              <th width="33%">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
				<tr>
                  <td id="dateFin"></td>
                  <td id="valeursticker"></td>
                  <td id="qte"></td>
                  <td id="montant"></td>
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
    
    <script>    

   
if(sessionStorage.even == "RESULTAT"){
		$(document).ready(function() {

    document.getElementById('qte').innerHTML = sessionStorage.valeur_unitaire_livraison;
	 document.getElementById('dateFin').innerHTML = sessionStorage.date_bon_livraison;
    document.getElementById('valeursticker').innerHTML = sessionStorage.valeur_unitaire_livraison;
	document.getElementById('montant').innerHTML = sessionStorage.date_bon_livraison;
	});
}


</script>