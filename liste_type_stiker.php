 <?php
session_start(); 
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?> 
   <div class="row">
        <div class="col-lg-8">
            <h1 class="page-header"></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row col-md-offset-2">
        <div class="col-lg-10">
            <div class="panel panel-default panel-green" >
              <div class="panel-heading">
                <div class="clearfix">
                  <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES TYPES STICKERS</h4>
                  <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div> 
              </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                              <th>Code Type Sticker</th>
                              <th>Type Sticker</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
<?php

include('dbconnexion.php');
	$quittance = "<script>document.write(sessionStorage.type_quittance); </script>";
	
					$query = "SELECT
									type_sticker.code_type_sticker,
									type_sticker.valeur_faciale
									FROM
									type_sticker";
			
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
			$code_type_sticker = utf8_decode($row['code_type_sticker']);
			$valeur_faciale = utf8_decode($row['valeur_faciale']);
					
?>
		<tr>       
                  <td><?php echo $code_type_sticker; ?></td>
                   <td><?php echo $valeur_faciale; ?></td>
                  <td><button name="BoutonDetail" type="button" onclick="ouvrefen('<?php echo $code_type_sticker; ?>')" class="btn btn-success" id="BoutonDetail" style="margin-left:30px;">Modifier</button></td>
				  
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
    
    
    function ouvrefen(mat)
    {
    
    //var mat = mle;
    
        var donnees = {action:"SELECT",code_type_sticker:mat}; 
        console.log('{"action":"SELECT","code_type_sticker":'+mat+'}');     
        
        $.ajax({
                type: "POST",
                url: "traitement_type_styker.php" ,
                data: donnees,
                success : function(data) {      
                
                //console.log('retour');
			console.log('retour =  '+mat);
				sessionStorage.code_type_sticker = mat;
			   // sessionStorage.mat_quittance = mat;
                sessionStorage.even = "UPDATE";
				sessionStorage.code_type_sticker = data.code_type_sticker;
				sessionStorage.valeur_faciale = data.valeur_faciale;}                       
                
            });
            
        $("#page-wrapper").load("type_stiker.php");
    }
    
    $("#BoutonAjout").on('click', function(){
        sessionStorage.even = "INSERT";
		sessionStorage.mess = "1";
        $("#page-wrapper").load("type_stiker.php");
    });
	    
</script>
