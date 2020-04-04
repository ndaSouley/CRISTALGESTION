<center>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MAIRIE</title>
<link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" href="css/mycss.css">
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container  col-md-3 col-xs-6 col-md-offset-4 mar" style="margin-top:100px;">
  <div class="panel panel-default ">
    <!--<div class="panel panel-heading" align="center panel-green">Authentification</div>-->
    <div class="top_b" align="center panel-green">Authentification</div>
      <div class="panel-body">
        <form method="POST" action="Authentification.php">
          <!--<div class="form-group">-->
          <div class="input-group">
            <!--<label class="control-label">Login</label>-->
            <span class="input-group-addon input-sm"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" name="user" class="form-control input-sm" style="text-transform: capitalize;width:250px;"/>
          </div>
          </br>
            <!--<div class="form-group">-->
c          </br>
           <div class="col-lg-12">
            <div class="panel-footer text-right ">
              <button class="btn btn-success" name="BoutonResetCollecteur" type="reset" id="BoutonResetCollecteur"> Annuler</button>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Valider</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

</center>