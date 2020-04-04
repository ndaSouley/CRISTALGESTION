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
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">SITUATION CONTRIBUABLE</h4>
                  <p class="panel-title pull-left" style="padding-top: 7.5px;">&nbsp;</p>
                </div> 
                <table width="80%" align="center" cellspacing="0" bgcolor="#F7F7F7">
                <tr>
                <td height="124"><div align="center"><strong>INFORMATIONS DU CONTRIBUABLE</strong></div></td>
                </tr>
                </table>
              </div>
              <br />
              <br />

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><div align="center">Taxe</div></th>
                              <th><div align="center">Montant carnet</div></th>
                              <th><div align="center">Quotité</div></th>
                              <th><div align="center">Montant Prévisionnel</div></th>
                              <th><div align="center">Montant Régie</div></th>
                            </tr>
                        </thead>
                        <tbody>


		<tr>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
                  <td><div align="center"></div></td>
				  <td><div align="center"></div></td>				  
				  </tr>

                        </tbody>
                    </table>
                    
                    <br />
                    <table width="80%" align="center">
  <tr>
    <td>                     
     <button type="submit" >J</button>
     <button type="submit" >F</button>
     <button type="submit" >M</button>
     <button type="submit" >A</button>
     <button type="submit" >M</button>
     <button type="submit" >J</button>
     <button type="submit" >J</button>
     <button type="submit" >A</button>
     <button type="submit" >S</button>
     <button type="submit" >O</button>
     <button type="submit" >N</button>
     <button type="submit" >D</button>
                 </td>
  </tr>
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
    
        var donnees = {action:"SELECTALL"};
        //console.log('{"acte":"COLLECTEUR","action":"SELECT","matricule":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_paiment.php" ,
                data: donnees,
                success : function(data) {      
                
                console.log('retour = '+data.code_quittance+data.nom+data.prenom);
                
                sessionStorage.even = "UPDATE";
                sessionStorage.collecteur = data.collecteur;
				sessionStorage.nom = data.nom;
				sessionStorage.prenom = data.prenom;
				 sessionStorage.date_naissance = data.date_naissance;
                sessionStorage.nom = data.lieu_naissance;
                sessionStorage.cni = data.cni;
                sessionStorage.telephone = data.telephone;
                sessionStorage.adresse = data.adresse;
                sessionStorage.quartier = data.quartier;
                sessionStorage.code_quittance = data.code_quittance;
				sessionStorage.profession = data.num;
				sessionStorage.profession = data.profession;
			    sessionStorage.profession = data.profession;
				sessionStorage.profession = data.profession;
				sessionStorage.profession = data.profession;
			
                        
                }                       
                
            });
            
        $("#page-wrapper").load("paiment.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("paiment.php");
    });
	
</script>