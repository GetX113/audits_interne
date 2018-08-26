<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Audits internes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo URL; ?>img/Logo.png">
    <!-- JS -->

    <!-- CSS -->
    <!-- <link href="<?php echo URL; ?>css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?php echo URL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>css/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstraps.min.css"> -->
    <style type="text/css">
      .tooltip.top .tooltip-arrow {
  border-top-color: #00acd6;
}
  #ex1Slider .slider-selection {
  background: #BABABA;
}
  .right {
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
}

  .left {
    transform: rotate(135deg);
    -webkit-transform: rotate(135deg);
}
  th, td {
    border: 1px solid black;
    overflow: hidden;
    width: 100px !important;
}
   .block {
    text-align: center;
    vertical-align: middle;
    margin-left: -6%;
}
.circle {
    border-radius: 200px;
    height: 40px;
    font-weight: bold;
    width: 40px;
    display: table;
    margin: 2px auto;
}
.circle p {
    vertical-align: middle;
    display: table-cell;
}
    </style>
</head>
<body>

  <!-- navigation -->
  <div id="navbar-example2">
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-primary" style="border-bottom-style: inset;border-bottom-width: thin;">
      <a href="<?php echo URL; ?>home/index"><img src="<?php echo URL; ?>img/Logo.png" width="25%"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo $home; ?>">
              <a class="nav-link" href="<?php echo URL; ?>home/index" style="color: <?php echo $clrAccueil; ?>;">Accueil</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: <?php echo $clrPoste; ?>;">
                Audit de poste
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Ajouter_action">Ajouter une action</a> -->
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Plan_action/1">Plan d'action</a>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Statistique">Statistique</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Planning_poste">Planning</a>
              </div>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#"></a>
          </li>
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: <?php echo $clrProduit; ?>;">
                Audit de produit
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Ajouter_action">Ajouter une action</a> -->
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_produit/Plan_action/1">Plan d'action</a>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_produit/Statistique">Statistique</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_produit/Planning_produit">Planning</a>
              </div>
           </li>
           <li class="nav-item">
              <a class="nav-link" href="#"></a>
          </li>
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: <?php echo $clrProcessus; ?>;">
                Audit de processus
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="<?php echo URL; ?>audit_de_poste/Ajouter_action">Ajouter une action</a> -->
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_processus/Plan_action/1">Plan d'action</a>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_processus/Statistique">Statistique</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URL; ?>audit_de_processus/Planning_processus">Planning</a>
              </div>
           </li>
          <li class="nav-item">
              <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#"></a>
          </li>
          <?php
          if ($_SESSION["fonction"] == "responsable") { ?>
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: <?php echo $clrAdmin; ?>;">
                Espace administrateur
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_secteur/1">Gestion des secteurs</a>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_poste/1">Gestion des postes</a>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_references/1">Gestion des r<?php if (isset($utf)) { echo '&eacute'; }else echo "é"; ?>f<?php if (isset($utf)) { echo '&eacute'; }else echo "é"; ?>rences</a>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_processus">Gestion des processus</a>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_affiche/1">Gestion des affiches</a>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_ecart">Gestion des types d'<?php if (isset($utf)) { echo '&eacute'; }else echo "é"; ?>cart</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo URL; ?>administration/gestion_compte/1">Gestion des comptes</a>
              </div>
           </li>
         <?php }else echo '<li></li>'; ?>
        </ul>
        <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
          <li class="dropdown" >
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #f3f5f7 !important;">
                <i class="fa fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-user" style="margin-left: -300%;">
              Bonjour,<br>
                <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo strtoupper($_SESSION["nom"])." ".$_SESSION["prenom"]; ?></a>
                </li>
                <li><a href="<?php echo URL; ?>administration/modifier_password"><i class="fa fa-gear fa-fw"></i> Change password</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo URL; ?>home/logOut"><i class="fa fa-sign-out fa-fw"></i> D<?php if (isset($utf)) { echo '&eacute'; }else echo "é"; ?>connecter</a>
                </li>
           </li>
         </ul>
      </div>

    </nav>
  </div>
  