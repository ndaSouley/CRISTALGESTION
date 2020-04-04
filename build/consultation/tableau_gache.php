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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">INFORMATIONS GACHE</h4>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th width="13%">Date</th>
                              <th width="20%">Niveau</th>
                              <th width="34%">N° Sticker</th>
                              <th width="33%">Montant Sticker</th>
                            </tr>
                        </thead>
<?php

include('dbconnexion.php');
?>
                        <tbody>

		
<tr>       
                  <td>&nbsp;</td>
                   <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
    $(document).ready(function() {
         $('#dataTables-example').DataTable({
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
        });

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
    
        var donnees = {action:"SELECT",matricule_collecteur:mat}; 
        console.log('{"action":"SELECT","matricule_collecteur":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_collecteur.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
			    sessionStorage.matricule_collecteur = mat;
                sessionStorage.even = "UPDATE";
				
				sessionStorage.matricule_collecteur = data.matricule_collecteur;
				sessionStorage.nom = data.nom;
				sessionStorage.contact = data.contact;
				sessionStorage.id_secteur = data.id_secteur;
				sessionStorage.libelle = data.libelle;
				sessionStorage.periode = data.periode;
				sessionStorage.code_periode = data.code_periode;
				sessionStorage.date_creation = data.date_creation;
				sessionStorage.date_enreg = data.date_enreg;
				sessionStorage.date_affectation = data.date_affectation;
				sessionStorage.prenom = data.prenom;
                }                       
                
            });
            
        $("#page-wrapper").load("collecteur.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("collecteur.php");
    });
	
    
    
</script>