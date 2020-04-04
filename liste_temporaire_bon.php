    
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default panel-green">
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">DETAIL DU BON DE COMMANDE</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Valeur Unitaire Cde</th>
                              <th>Qté Cde</th>
                              <th>Valeur Unitaire Livrée</th>
                              <th>Plage Debut</th>
                              <th>Plage Fin</th>
                              <th>Qté Livrée</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          
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
    $(document).ready(function() {
         /*$('#dataTables-example').DataTable({
            responsive: true,
              "language": {
                "search":       "Recherche:",
                "sZeroRecords" : "Aucun enregistrements correspondants trouvés",
                "sEmptyTable" : "Aucune donnée disponible",
                "paginate": {
                  "first":      "First",
                  "last":       "Last",
                  "next":       "Suivant",
                  "previous":   "Précédent"
    }
  }
        });*/

		
    });
        
    $("#tbl1 button").click(function () {
        alert($(this).closest("table").attr("id"));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest("td").attr("id"));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }
    
    
    function ouvrefen(mat)
    {
    
    //var mat = mle;
    
        var donnees = {action:"SELECT",id_quit:mat}; 
        console.log('{"action":"SELECT","matricule":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_autorisation_stationnement.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.mat_quittance = mat;
                sessionStorage.even = "UPDATE";
				sessionStorage.code_periode = data.code_periode;
				sessionStorage.IdType_quit = data.IdType_quit;
				sessionStorage.mat = data.mat;
				sessionStorage.code_categ = data.code_categ;
				sessionStorage.nomCollecteur = data.nomCollecteur;
				sessionStorage.nomContribuable = data.nomContribuable;
				sessionStorage.prenomContribuable = data.prenomContribuable;
				sessionStorage.datenais = data.datenais;
                sessionStorage.lieunaissance = data.lieunais;
                sessionStorage.telephone = data.telephone;
				sessionStorage.cni = data.cni;
				sessionStorage.	type_vehicule = data.type_vehicule;
				
			    sessionStorage.nombre_place = data.nombre_place;
				sessionStorage.PTAC = data.PTAC;
				sessionStorage.genre_vehicule = data.genre_vehicule;
				sessionStorage.marque_vehicule = data.marque_vehicule;
                sessionStorage.adresse = data.adresse;
                sessionStorage.quartier = data.quartier;
                sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.profession = data.profession;
			    sessionStorage.numquittance = data.numquittance;
				sessionStorage.numero_antenne = data.numero_antenne;
				sessionStorage.numero_macaron = data.numero_macaron;
				sessionStorage.immatriculation = data.immatriculation;
				sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.couleur = data.couleur;
				sessionStorage.exercice = data.periode;
				sessionStorage.numserie = data.numero_serie;
				sessionStorage.lib_categ = data.lib_categ;
				sessionStorage.lib_type_service = data.lib_type_service;
				sessionStorage.cbdaf = data.CB_DAF;
				sessionStorage.datequittance = data.date_validite;
				sessionStorage.periode = data.periode;
				sessionStorage.montant_droit_place = data.montant_droit_place;
				sessionStorage.periode = data.periode;
				sessionStorage.quotite_officiel = data.quotite_officiel;
				sessionStorage.num_plaque = data.num_plaque
                }                       
                
            });
            
        $("#page-wrapper").load("autorisation_stationnement.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("autorisation_stationnement.php");
    });
	
    
    
</script>