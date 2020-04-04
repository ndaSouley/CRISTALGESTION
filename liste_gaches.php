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
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES GACHES</h4>
                    <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>Date </th>
                        <th>Niveau</th>
                        <th>N° Sticker</th>
                        <th>Montant</th>
                        
                        <th></th>
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
						tempo_gache.date,
						regie.id_regie,
						regie.libelle
						FROM
						tempo_gache ,
						regie
						WHERE
						tempo_gache.niveau = regie.id_regie";
										 
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
					$libelle = utf8_encode($row['libelle']);
					$date = utf8_encode($row['date']);
					
			?>
			
				<tr>
                  <td><?php echo $date; ?></td>
                  <td><?php echo $libelle; ?></td>
                  <td><?php echo $Numsticker; ?></td>
                  <td><?php echo $valeur; ?></td>
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


    $("#BoutonAjout").on('click', function(){
        sessionStorage.V_gest_bon="1";
        sessionStorage.even = "INSERT";
        $("#page-wrapper").load("situation_gache.php");
    });



</script>