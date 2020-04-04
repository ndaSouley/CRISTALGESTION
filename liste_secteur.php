    <?php
session_start(); 
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
    <center>
    
    <div class="row">
        <div class="col-lg-8 ">
            <h1 class="page-header "></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8 col-md-offset-2">
            <div class="panel panel-default panel-green" >
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES SECTEURS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body ">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>date Crea</th>
                              <th>Secteur</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');

	
			$query = "SELECT
						secteur.id_secteur,
						secteur.libelle,
						secteur.date_creation
						FROM
						secteur";
										
				if (mysqli_connect_errno())
	{
		echo "[{\"ConnectError\":\"yes\"}]";
		//exit();
	}
	else
	{
		$mysqli->set_charset('utf8');

		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$id_secteur = utf8_decode($row['id_secteur']);
			$libelle = utf8_decode($row['libelle']);
					$date_creation = utf8_encode($row['date_creation']);
					
					
?>
			
		<tr>       
                  <td><?php echo $date_creation; ?></td>
                   <td><?php echo $libelle; ?></td>
                  <td align="center"><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $id_secteur; ?>')" class="btn btn-success" id="BoutonDetail">Modifier</button></td>
				  
                </tr>
<?php				
		}
	}	
$mysqli->close();
	  
?>
                            
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
     </center>
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
    
        var donnees = {action:"SELECT",id_secteur:mat}; 
        console.log('{"action":"SELECT","id_secteur":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_secteur.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour id_secteur=  '+ sessionStorage.id_secteur);
			//console.log('retour date creation =  '+sessionStorage.date_creation);
			//console.log('retour  libelle=  '+	sessionStorage.libelle);
			    sessionStorage.id_secteur ="mat";
                sessionStorage.even = "UPDATE";
				 sessionStorage.id_secteur =data.id_secteur;
				sessionStorage.date_creation = data.date_creation;
				sessionStorage.libelle = data.libelle;
				
                }                       
                
            });
            
        $("#page-wrapper").load("secteur.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("secteur.php");
    });
	
    
    
</script>