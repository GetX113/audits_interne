<div class="row" style="margin-top: 5%;margin-left: 7%;">
	<div class="form-group col-sm-5 d-inline" style="margin-left: 33%;">
		<a href="<?php echo URL; ?>administration/ajouter_affiche" style=""><button type="button" class="btn btn-outline-secondary col-sm-4">Ajouter une affiche</button></a>
	</div>
	<div class="col-sm-3">
		<form class="d-flex" method="POST" action="<?php echo URL; ?>administration/recherche_affiche">
              <input class="form-control py-2" type="search" placeholder="Recherche ..." id="example-search-input" name="recherche">
              <span class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fa fa-search"></i>
              </button>
              </span>
        </form>
    </div>
</div>
<div class="card text-center" style="width: 60%; margin: 0 auto;">
	<div class="card-header <?php echo $success; ?>">
		La liste des affiches
	</div>
	<div class="card-body" style="width: 100%;">
		<table class="table table-hover table-bordered">
			<thead class="">
				<th>Photo</th>
				<th>Titre</th>
				<th>Text/commentaire</th>
				<th>Paramètres</th>
			</thead>
			<tbody>
				<?php foreach ($affiches as $affiche) {
				 ?>
				<tr>
					<td><img  src="<?php echo URL.$affiche->target; ?>" alt="Card image cap" width="200px"></td>
					<td><?php echo $affiche->titre; ?></td>
					<td><?php if (strlen($affiche->commentaire) >= 250){ 
								echo (substr($affiche->commentaire,0,250))." ...";
					 }else{echo $affiche->commentaire;} ?></td>
					<td><a href="<?php echo URL . 'administration/modifier_affiche/' . htmlspecialchars($affiche->id_affiche, ENT_QUOTES, 'UTF-8');?>"><img src="<?php echo URL; ?>img/2.svg" width="40%"></a><a href="<?php echo URL . 'administration/supprimer_affiche/' . htmlspecialchars($affiche->id_affiche, ENT_QUOTES, 'UTF-8');?>" onclick="return confirm('êtes-vous sûr?')"><img src="<?php echo URL; ?>img/1.svg" width="20%"></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="card-footer <?php echo $success; ?>">
		<?php if (isset($id_page)){ ?>
		<nav aria-label="...">
		  <ul class="pagination">
		  	<?php if ($page == 1) {?>
		  	<li class="page-item disabled">
		      <a class="page-link" href="#" tabindex="-1">Previous</a>
		    </li>
		  	<?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'administration/gestion_secteur/' . htmlspecialchars($page-1, ENT_QUOTES, 'UTF-8');?>" tabindex="-1">Previous</a>
		    </li>
		    <?php } ?>
		    <?php for ($i=1; $i <= $total_pages; $i++) { 
		    	if ($i == $page) { ?>
		    <li class="page-item active">
		      <a class="page-link" href="#"><?php echo $i; ?><span class="sr-only">(current)</span></a>
		    </li>
		    <?php }else{?>
		    <li class="page-item"><a class="page-link" href="<?php echo URL . 'administration/gestion_secteur/' . htmlspecialchars($i, ENT_QUOTES, 'UTF-8');?>"><?php echo $i; ?></a></li>
		    <?php }} 
		    if ($page == $total_pages) {?>
		    <li class="page-item disabled">
		      <a class="page-link" href="#">Next</a>
		    </li>
		    <?php }else{ ?>
		    <li class="page-item">
		      <a class="page-link" href="<?php echo URL . 'administration/gestion_secteur/' . htmlspecialchars($page+1, ENT_QUOTES, 'UTF-8');?>">Next</a>
		    </li>
		    <?php } ?>
		  </ul>
		</nav>

		<?php echo $commentaire; }?>
	</div>
</div>