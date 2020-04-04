<?php
session_start();
if(!isset($_SESSION['IsAuthorized']) || $_SESSION['IsAuthorized'] == false)
{
    header('Location:index.php');
}
?>
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
                    <h4 class="panel-title pull-left" style="padding-top: 7.5px;">LISTE DES BON DES LIVRAISON</h4>
                    <a class="btn btn-default pull-right btn-sm" id="BoutonAjout">Ajouter</a>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr>
                        <th>Date Cde</th>
                        <th>Date Bon Liv</th>
                        <th>Regie</th>
                        <th>N° Bon Cde</th>
                        <th>N° Bon Liv</th>
                        <th>Valeur Unitaire</th>
                        <th>Qté Cde</th>
                        <th>Qté Livrée</th>
                    
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    include('dbconnexion.php');


                    $query = "SELECT
						bon_livraison.id_bon,
						bon_livraison.id_user,
						bon_livraison.mle_regisseur,
						bon_livraison.num_bon_commande,
						bon_livraison.num_bon_livraison,
						bon_livraison.valeur_unitaire_commande,
						bon_livraison.plage_debut_sticker,
						bon_livraison.plage_fin_sticker,
						bon_livraison.total_qte_commande,
						bon_livraison.valeur_unitaire_livraison,
						bon_livraison.total_qte_livraison,
						bon_livraison.date_bon_commande,
						bon_livraison.date_bon_livraison,
						bon_livraison.date_operation
						FROM
						bon_livraison";

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
                            $id_bon = utf8_decode($row['id_bon']);
                            $id_user = utf8_encode($row['id_user']);
                            $mle_regisseur = utf8_encode($row['mle_regisseur']);
                            $num_bon_commande = utf8_encode($row['num_bon_commande']);
                            $num_bon_livraison = utf8_encode($row['num_bon_livraison']);
                            $valeur_unitaire_commande = utf8_encode($row['valeur_unitaire_commande']);
                            $plage_debut_sticker = utf8_encode($row['plage_debut_sticker']);
                            $plage_fin_sticker = utf8_encode($row['plage_fin_sticker']);
                            $total_qte_commande = utf8_encode($row['total_qte_commande']);
                            $total_qte_commande = utf8_encode($row['valeur_unitaire_livraison']);
                            $total_qte_livraison = utf8_encode($row['total_qte_livraison']);
                            $date_bon_commande = utf8_encode($row['date_bon_commande']);
                            $date_bon_livraison = utf8_encode($row['date_bon_livraison']);
                            $date_operation = utf8_encode($row['date_operation']);

                            //Formatage des date en jj-mm-aaa
                            $V_date_bon_commande = date("d-m-Y ", strtotime($date_bon_commande));
                            $V_date_bon_commande = date("d-m-Y ", strtotime($date_bon_livraison));
                            ?>

                            <tr>
                                <td><?php echo $V_date_bon_commande; ?></td>
                                <td><?php echo $V_date_bon_commande; ?></td>
                                <td><?php echo $mle_regisseur; ?></td>
                                <td><?php echo $num_bon_commande; ?></td>
                                <td><?php echo $num_bon_livraison; ?></td>
                                <td><?php echo $valeur_unitaire_commande; ?></td>
                                <td><?php echo $total_qte_commande; ?></td>
                                <td><?php echo $total_qte_livraison; ?></td>

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
        $("#page-wrapper").load("bon_livraison_regie.php");
    });



</script>