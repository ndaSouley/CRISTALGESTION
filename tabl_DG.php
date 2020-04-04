
</head>


<section class="content">
<div class="row" style="background-color:#FFF">
    <form role="form" method="post" class="form-inline" id="form" action="traitement_autorisation_stationnement.php" enctype="multipart/form-data">
    <div align="center">
      <table width="96%" border="0" align="center" cellpadding="8" cellspacing="8">
        <tr>
          <td><h4><strong><i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i> MON TABLEAU DE BORD</strong></h4></td>
        </tr>
        <tr>
          <td><div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
              <div class="panel-body squarebox square_boxs">
                <div class="col-xs-12 pull-left nopadmar">
                  <div class="row">
                    <h4><strong><span>MON OBJECTIF 2019:</span></strong></h4>
                    <div class="col-xs-12 pull-left nopadmar">
                      <div class="row">
                        <div class="square_box col-xs-7 text-right"> <span> </span>
                          <div class="number" id="myTargetElement1"></div>
                        </div>
                        <h3>2.0000.0000.0000 </h3>
                        <hr size="1" noshade="noshade">
                        <div>Voir détails [+]</div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6"> <small class="stat-label"> </small>
                          <h4 id="myTargetElement1.1"></h4>
                        </div>
                        <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                          <h4 id="myTargetElement1.2"></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>MONTANT ACTUEL RECOUVRE:</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_montant_recouvre);?></h3>
                          <hr size="1" noshade="noshade">
                          <div><a href="liste_stckos_sticker_collecteur.php">Voir détails [+]</a></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>ETAT DU STOCK DE STICKERS:</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Nbre_sticker);?></h3>
                          <hr size="1" noshade="noshade">
                          <div>Voir détails [+]</div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>NBRE. DE CONTRIBUABLES:</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Nbre_contribuable);?></h3>
                          <hr size="1" noshade="noshade">
                          <div>Voir détails [+]</div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>NBRE. DE COLLECTEURS:</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Nbre_collecteur);?></h3>
                          <hr size="1" noshade="noshade">
                          <div>Voir détails [+]</div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
         
        <tr>
          <td background="img/bann.png"><strong>
            <h3>STATISTIQUES</h3>
          </strong></td>
        </tr>
        <tr>
          <td>
         
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>RECETTE PREVISIONNELLE ANNUELLE PAR SECTEUR</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Montant_annuel_secteur);
						  
						  ?></h3>
                          <hr size="1" noshade="noshade">
                          <div><a href="liste_odp.php">Voir détails [+]</a></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>RECETTE PREVISIONNELLE ANNUELLE PAR ACTIVITE</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Montant_annuel_activite)?></h3>
                          <hr size="1" noshade="noshade">
                          <div><a href="liste_autorisation-circuler.php">Voir détails [+]</a></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
              <!-- Trans label pie charts strats here-->
              <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                  <div class="col-xs-12 pull-left nopadmar">
                    <div class="row">
                      <h4><strong><span>RECETTE PREVISIONNELLE MENSUELLE PAR SECTEUR</span></strong></h4>
                      <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                          <div class="square_box col-xs-7 text-right"> <span> </span>
                            <div class="number" id="myTargetElement1"></div>
                          </div>
                          <h3><?php echo($V_Montant_mensuel);?></h3>
                          <hr size="1" noshade="noshade">
                          <div><a href="liste_autorisation_stationnement.php">Voir détails [+]</a></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-6"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.1"></h4>
                          </div>
                          <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                            <h4 id="myTargetElement1.2"></h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
              <div class="panel-body squarebox square_boxs">
                <div class="col-xs-12 pull-left nopadmar">

                  <div class="row">
                    <h4><strong><span>RECETTE PREVISIONNELLE MENSUELLE PAR ACTIVITE</span></strong></h4>
                    <div class="col-xs-12 pull-left nopadmar">
                      <div class="row">
                        <div class="square_box col-xs-7 text-right"> <span> </span>
                          <div class="number" id="myTargetElement1"></div>
                        </div>
                        <h3><?php echo($V_Montant_mensuel);?></h3>
                        <hr size="1" noshade="noshade">
                        <div><a href="liste_autorisation_stationnement.php">Voir détails [+]</a></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6"> <small class="stat-label"> </small>
                          <h4 id="myTargetElement1.1"></h4>
                        </div>
                        <div class="col-xs-6 text-right"> <small class="stat-label"> </small>
                          <h4 id="myTargetElement1.2"></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>  
    </form>
    <!-- /.col-lg-12 -->
</div>
</div>
                </div> 
                <!-- row-->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-->
                <!-- Third Basic Table Ends Here-->
            </section>            <!-- content --> </aside>
       