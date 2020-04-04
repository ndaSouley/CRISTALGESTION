<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
 <link rel="stylesheet" href="CSS/bootstrap-3.3.7-dist/css/bootstrap.css">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
  <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Tableaux</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Paramètres<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('liste_collecteur.php');">Collecteurs</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_secteur.php');">Secteurs d'activité</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_regie.php');">Régies</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_type_stiker.php');">Types stickers</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Livraisons<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('non');">Livraison trésor</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_bon_livraison_tresor.php');">Livraison régie</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('non');">Stock trésor</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('non');">Stock régier</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Quittances<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('liste_taxe_forfaitaire.php','TFDPPCA');">Taxes Forfaitaires</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_odp.php','T-ODP');">Taxes ODP</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_autorisation_circuler.php','AC');">Autorisation de circuler</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_autorisation_stationnement.php','AS');">Autorisation Stationnement</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_demande_autorisation.php','DATC');">Demande d’Autorisation</a>
                                </li>
                                 <li>
                                    <a href="#" onClick="affiche('liste_autorisation_transport_commerce.php','non');">Transport Privé / Public</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-link fa-fw"></i> Contribuables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('non');">Consultation Contribuable</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('non');">Emission Facture</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-database fa-fw"></i> Paiements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('liste_paiment.php');">Paiement taxes</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class=""></i> Graches<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('non');">Déclaration Gâches</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class=""></i>Bon de livraison</a>
                        </li>
                    </ul>
 <li>
                            <a href="#"><i class="fa fa-link fa-fw"></i> Statistiques<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                                <li>
                            <a href="#" onClick="affiche('non');">Consultation Contribuable</a>
                                </li>
                                <li>
                            <a href="#" onClick="affiche('non');">Emission Facture</a>
                                </li>
                    </ul>
</li>
                    
                    
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

        </div>
    </div>






            <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    
    function affiche(fen,type_quittance) { 
        sessionStorage.even = "insert";
		sessionStorage.type_quittance = type_quittance;
		console.log('debut='+sessionStorage.type_quittance);
        $("#page-wrapper").empty();
        if (fen!=='non') {
       <!-- $("#page-wrapper").load(fen+".html"); -->
        $("#page-wrapper").load(fen);
        } 
        }               

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
    </script> 
        
</body>

<!-- Mirrored from polinova.ci/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 19:50:10 GMT -->
</html>

</body>
</html>