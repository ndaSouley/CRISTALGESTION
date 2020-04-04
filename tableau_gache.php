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
                              <th width="33%" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
require('dbconnexion.php');
		
		$query = "SELECT
					tempo_gache.id_gache,
					tempo_gache.exercice,
					tempo_gache.niveau,
					tempo_gache.Numsticker,
					tempo_gache.valeur,
					tempo_gache.date
					FROM
					tempo_gache";
				 
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
			        $id_gache = utf8_decode($row['id_gache']);
			        $exercice = utf8_decode($row['exercice']);
					$Numsticker = utf8_encode($row['Numsticker']);
					$valeur = utf8_encode($row['valeur']);
					$niveau = utf8_encode($row['niveau']);
					$date = utf8_encode($row['date']);
					
			?>
			
				<tr>
                  <td><?php echo $date; ?></td>
                  <td><?php echo $niveau; ?></td>
                  <td><?php echo $Numsticker; ?></td>
                  <td><?php echo $valeur; ?></td>
                  <td><button name="BoutonSupprime" type="button" onclick="delligne('<?php echo $id_gache; ?>')" class="btn btn-danger" id="BoutonSupprime">Supprimer</button></td>	
                   	  <td><button name="BoutonSupprime" type="button" onclick="selligne('<?php echo $id_gache; ?>')" class="btn btn-success" id="BoutonSupprime">Modifier</button></td>	
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
    <!-- /.row -->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
    <script>    
    /*$(document).ready(function() {
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

		
    });*/
        
    $('#tbl1 button').click(function () {
        alert($(this).closest('table').attr('id'));
    });

    function getMethod(idget) {
        parentTable = element.parentNode;
        alert(parentTable.id);
        //alert($(idget).closest('td').attr('id'));
    }
    
    function decodeHTML(str){
    return str.replace(/&#([0-9]{1,3});/gi, function(match, num) {
        return String.fromCharCode(parseInt(num));
        });
    }   

//CODE DE SUPPRESSION DU TABLEAU tempo_regie_bon
	   function delligne(mat)
    {
        var donnees = {action:"SUPPRESSION",id_tempo:mat};
         console.log('je suis dans la suppression');
		 console.log('{"action":"SUPPRESSION","id_tempo_bon_livre":'+mat+'}');    
		
        $.ajax({
                type: "POST",
                url: "traitement_bon_regie.php",
                data: donnees,
                success : function(data) {      
                 console.log("Retour "+data.Id_temp);   
                }                       
                
            });
            
        $("#page-bon").load("liste_temporaire_bon2.php");
        }
	

	
//Code de rappel des  données du tableau tempo_regie_bon
	   function selligne(mat)
    {
	   
        var donnees = {action:"SELECT",id_gache:mat}; 
        console.log('{"action":"SELECT","id_gache":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_gache.php" ,
                data: donnees,
                success : function(data) {      
                
             
			    sessionStorage.id_gache = mat;
                sessionStorage.even = "UPDATE";
				sessionStorage.id_gache = data.id_gache;
				sessionStorage.exercice = data.exercice;
				sessionStorage.niveau = data.niveau;
				sessionStorage.Numsticker = data.Numsticker;
				sessionStorage.libelle = data.libelle;
				sessionStorage.periode = data.periode;
				sessionStorage.valeur = data.valeur;
				sessionStorage.date = data.date;
              }                       
                
            });
            
        $("#page-bon").load("situation_gache.php");
    }
	
	

</script>