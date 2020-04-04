<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
                      $nb = $db->query('SELECT COUNT(num_collecte) as countid_num_collecte FROM paiement');
                      $nb_ligne = $nb->fetch();
                          
                    ?>        

<br />
<i class="fa fa-dashboard fa-fw" ></i> Tableau de bord >> Paiement
<br />
<br />
<!-- Contenu du tableau de bord -->

 <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>
                  
                  <?php echo $nb_ligne['countid_num_collecte']; ?>
                  
                  
                  </h3>
                  <p>Taxe(s) Collectée(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onClick="affiche('tableau_taxes.php');" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
</div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              
              		<?php
                      $db = new PDO('mysql:host=localhost;dbname=bdmairie; charset=utf8', 'root', '');
                      $nb = $db->query('SELECT COUNT(id_service) as countid_id_service FROM service');
                      $nb_ligne = $nb->fetch();
                          
                    ?>
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>
						<?php echo $nb_ligne['countid_id_service']; ?>                  
                  </h3>
                  <p>paiement(s) effectué(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onClick="affiche('tableau_paiement.php');" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              
                    <?php
                      $db = new PDO('mysql:host=localhost;dbname=bdmairie; charset=utf8', 'root', '');
                      $nb = $db->query('SELECT COUNT(id_contribuable) as countid_id_contribuable FROM contribuable');
                      $nb_ligne = $nb->fetch();
                          
                    ?>
              
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>
                  
                  						<?php echo $nb_ligne['countid_id_contribuable']; ?>                  

                  
                  
                  </h3>
                  <p>Contribuables</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onClick="affiche('tableau_contribuables.php');" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
</div><!-- ./col -->
            
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
                  <?php
                      $db = new PDO('mysql:host=localhost;dbname=bdmairie; charset=utf8', 'root', '');
                      $nb = $db->query('SELECT COUNT(matricule_collecteur) as countid FROM collecteur');
                      $nb_ligne = $nb->fetch();
                          
                    ?>
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>
                  
                  <?php echo $nb_ligne['countid']; ?>
                  
                  
                  
                  </h3>
                  <p>Agent(s) collecteur(s)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" onClick="affiche('tableau_collecteurs.php');" class="small-box-footer">Voir [+] <i class="fa fa-arrow-circle-right"></i></a>
              </div>
</div><!-- ./col -->
          </div><!-- /.row -->
          
          












          

</body>
</html>
