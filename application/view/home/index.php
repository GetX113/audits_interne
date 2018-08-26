<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top: 6%;width: 50%;margin-left: 25%;">
  <div class="card text-center" style=" margin: 0 auto;margin-top: 8%">
  <div class="card-header <?php echo $success; ?>">
    Tableau d'affichage qualité
  </div>
  <div class="card-body" style="">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <?php for ($i=0; $i < $total-1; $i++) {  ?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>"></li>
    <?php } ?>
  </ol>
  <div class="carousel-inner">
  	<!-- <div class="carousel-item active">
      <img class="d-block w-100" src="<?php echo URL; ?>img/1.png?auto=yes&bg=666&fg=444&text=Second slide" alt="Second slide" width="500px">
      <div class="carousel-caption d-none d-md-block">
	    <h4 style="color: #306598;background-color: white;" >.okokok..</h4>
	    <p style="color: black;background-color: white;">..okokokokokokokokok.</p>
	  </div>
    </div> -->
  	  	<?php $i=1;foreach ($affiches as $affiche) {?>
    <div class="carousel-item <?php if($i==1){echo "active";$i++;} ?>">
      <a href="<?php echo URL . 'administration/view_affiche/' . htmlspecialchars($affiche->id_affiche, ENT_QUOTES, 'UTF-8');?>">
      <img class="d-block w-100" src="<?php echo URL.$affiche->target; ?>?auto=yes&bg=666&fg=444" alt="<?php echo $affiche->titre; ?>" width="500px"></a>
      <div class="carousel-caption d-none d-md-block">
	    <h3 style="color: #306598;background-color: white;" ><?php echo $affiche->titre; ?></h3>
	  </div>
    </div>
    <?php } ?>
    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
  <div class="card-footer <?php echo $success; ?>">
  </div>  
</div>
