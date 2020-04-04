<?php
require_once 'dbconfig.php';
    session_start();
	 $_SESSION['nom'];
	 $_SESSION['id_user'] ;
	  $_SESSION['LibProfil'];
	  $_SESSION['prenom'];

//if(!(isset($_SESSION['IdProfil'])))
//{
//  header("location:admin.php");
// }
//    
    ?>
<!DOCTYPE html>
<html>
<style>
li a:hover{
	text-decoration: none;
   color:#F30;
}

</style>
<!-- Mirrored from polinova.ci/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 19:50:00 GMT -->
<head>

<link href="css/images/favicon2.ico" rel="shortcut icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
        <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <title>Menu Principal .:: MAIRIE BOUAKE ::.</title>
        <style type="text/css">
        .label_form {
width:120px;
}
    </style>
    <!-- Debut d'importation de style commune1 vers taxe-->
  <link rel="stylesheet" href="css/popupform.css"/>
<!-- Fin  d'importation de style commune1 vers taxe-->
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

					<?php
                      $db = new PDO('mysql:host=localhost;dbname=bdmairie; charset=utf8', 'root', '');
                      $nb = $db->query('SELECT COUNT(id_service) as countid FROM service');
                      $nb_ligne = $nb->fetch();
                          
                    ?>  
	   <div id="wrapper">
         

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0;background-color:#175f28">
            <div class="navbar-header text-center">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            
                <a class="navbar-brand text-center" href="#☺" style="margin-left:30px;"><strong><font size=5 color="#FFFFFF"> 
                 <img  style="margin-top:0px;margin-right:60px"src="css/images/bouake3.jpg">        E-COLLECTES </font></strong></a>
                 
            </div>
         
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">     
                <li class="dropdown">
               <li style="color:#FFFFFF;margin-bottom:10;px"><?php echo   $_SESSION['LibProfil'].  ' ' .$_SESSION['nom']   ;?></li>
                        
                        <li class="col"><a href="deconnexion.php" style="color:#FFFFFF"><i class="fa fa-sign-out"><strong style="color:#FFFFFF">Deconnexion</strong></i></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">
                   <ul class="nav" id="side-menu">
          <li> <a class="nav-link" href="#" onClick="affiche('tableaux.php');"><i class="fa fa-dashboard fa-fw" ></i> Tableaux</a> </li>
          <li> <a href="#"><i class="fa fa-wrench fa-fw"></i> Paramètres<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
            <li> <a href="#" onClick="affiche('liste_compte.php');">Compte Utilisateur</a> </li>
              <li> <a href="#" onClick="affiche('liste_collecteur.php');">Collecteurs</a> </li>
              <li> <a href="#" onClick="affiche('liste_secteur.php');">Type d'activité</a> </li>
              <!--<li> <a href="#" onClick="affiche('non');">Régies</a> </li>-->
              <li> <a href="#" onClick="affiche('liste_type_stiker.php');">Types stickers</a> </li>
            </ul>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Livraisons<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('liste_bon_tresor.php');">Livraison trésor</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('liste_bon_livraison_tresor.php');">Livraison régie</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('non');">Stock trésor</a>
                                </li>
                                <li>
                                    <a href="#" onClick="affiche('non');">Stock régie</a>
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
                            <a href="#"><i class="fa fa-file"></i> Gaches<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#" onClick="affiche('non');">Déclaration Gâches</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                    </ul>
                </div>
                
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

<!-- Contenu du tableau de bord -->

 <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>53</h3>
                  <p>Taxe(s) Collectée(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
						<?php echo $nb_ligne['countid']; ?>                  
                  </h3>
                  <p>paiement(s) effectué(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Meilleur Contribuable</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->





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
    
    function affiche(fen) { 
        sessionStorage.even = "insert";
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
