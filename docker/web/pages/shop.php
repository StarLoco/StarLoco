			<?php if(!isset($_SESSION['user'])) {
				echo "<script>window.location.replace(\"?page=signin\")</script>";
				return;
			} ?>
			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Boutique</li>
				</ol>
				
				<?php // var
				$server = -1; $category = -1; $name = "";
				
				if(isset($_POST['ok1'])) {
					if(isset($_POST['server'])) {
						if(!empty($_POST['server'])) {
							if(is_numeric($_POST['server'])) {
								$server = $_POST['server'];
							}
						}
					}
				} else if(isset($_GET['server'])){
					if(isset($_GET['server'])) {
						if(!empty($_GET['server'])) {
							if(is_numeric($_GET['server'])) {
								$server = $_GET['server'];
							}
						}
					}
				}
				
				if(isset($_POST['ok2'])) {
					if(isset($_POST['category'])) {
						if(!empty($_POST['category'])) {
							if(is_numeric($_POST['category'])) {
								$category = $_POST['category'];
							}
						}
					}
				} else if(isset($_GET['category'])){
					if(isset($_GET['category'])) {
						if(!empty($_GET['category'])) {
							if(is_numeric($_GET['category'])) {
								$category = $_GET['category'];
							}
						}
					}
				} ?>
				
				<!-- Selecter of server -->
				<form class="form-inline" role="form" method="post" style="margin-bottom: 10px;">
					<select class="form-control" style="width: 90%!important; height: 35px; padding: 6px 12px!important;" name="server">
						<?php 
						$query = $login -> prepare("SELECT id, name FROM world_servers;");
						$query -> execute();
						$query -> setFetchMode(PDO:: FETCH_OBJ);

						while($row = $query -> fetch()) {
							if($row -> id == $server) $name = $row -> name;
							echo '<option value="' . $row -> id . '" ' . (isset($_POST['server']) && $row -> id == $_POST['server']  ? 'selected' : '') . '>' . $row -> name . '</option>';
						}
						$query -> closeCursor();
						?>
					</select>
					<button type="submit" name="ok1" class="btn btn-info">Ok</button>
				</form>
				<!-- End selecter of server -->
				
				<!-- Selecter of category -->
				<?php 
				if($server != -1) { ?>
					<form class="form-inline" role="form" method="post" action="?page=shop&server=<?php echo $server; ?>" style="margin-bottom: 10px;">
						<select class="form-control" style="width: 90%!important; height: 35px; padding: 6px 12px!important;" name="category">
							<?php 
							$query = $connection -> prepare("SELECT id, name FROM `website_shop_categories` WHERE `active` = 1;");
							$query -> execute();
							$query -> setFetchMode(PDO:: FETCH_OBJ);

							while($row = $query -> fetch()) {
								$id = $row -> id;
								$query1 = $connection -> prepare("SELECT * FROM `website_shop_objects` WHERE `server` = ? AND `category` = ?;");
								$query1 -> bindParam(1, $server);
								$query1 -> bindParam(2, $id);
								$query1 -> execute();
							
								if($query1 -> fetch()) echo '<option value="' . $id . '" ' . (isset($_POST['category']) && $id == $_POST['category']  ? 'selected' : '') . '>' . $row -> name . '</option>';
								$query1 -> closeCursor();
							}
							$query -> closeCursor();
							?>
						</select>
						<button type="submit" name="ok2" class="btn btn-info">Ok</button>
					</form>
					
					<div class="alert alert-info no-border-radius" role="alert">
						Les achats seront effectués sur le serveur <strong><?php echo $name; ?></strong> !
					</div>
				<?php 
					if($category != -1) {
						$query = $connection -> prepare("SELECT * FROM `website_shop_objects` WHERE `category` = " . $category . " AND server LIKE '%" . $server . "%' AND `active` = 1 ORDER BY price DESC;");
						$query -> execute();
						$count = $query -> rowCount();
						$query -> setFetchMode(PDO:: FETCH_OBJ);
						
						if($count) { ?>
						<section class="section section-white no-border no-padding-top">	
							<div class="box no-border-radius padding-20">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>#</th>
										<th>Nom</th>
										<th>Level</th>
										<th>Prix</th>
										<th>Jet maximum</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody><?php
								while($row = $query -> fetch()) {
									$query1 = $connection -> prepare("SELECT * FROM `website_shop_objects_templates` WHERE `id` = " . $row -> template . ";");
									$query1 -> execute();
									$query1 -> setFetchMode(PDO:: FETCH_OBJ); 
									$object = $query1 -> fetch();
									$query1 -> closeCursor(); ?>

									<tr data-toggle="tooltip" title="" data-original-title="<?php if($object -> effects == "") echo "Aucun"; else  echo convertStatsToString($object -> effects);?>" data-html="true">
										<td>
											<object class="thumbnail" style="height: 120px;width: 120px;" type="application/x-shockwave-flash" data="<?php echo URL_SITE; ?>img/dofus/swf/items/item.swf">
												<param name="allowscriptaccess" value="always">
												<param name="flashvars" value="item=<?php echo URL_SITE; ?>img/dofus/swf/items/<?php echo $category; ?>/<?php echo $object -> skin; ?>.swf"/>
												<param name="wmode" value="transparent"/>
											</object>
										</td>
										<td><?php echo $row -> name; ?></td>
										<td><?php echo $object -> level; ?></td>
										<td><?php echo $row -> price; ?></td>
										<td>
											<span class="btn btn-<?php if($row -> jp) echo 'success'; else echo 'danger'; ?> btn-outline btn-circle btn-xs"><i class="ion-<?php if($row -> jp) echo 'checkmark'; else echo 'close'; ?>"></i></span>
										</td>
										<td>
											<a href="<?php echo URL_SITE; ?>?page=buy&template=<?php echo $object -> id; ?>&server=<?php echo $server; ?>"><span class="btn btn-info btn-outline btn-circle btn-xs" data-toggle="tooltip" title="" data-original-title="Acheter"><i class="fa fa-credit-card"></i></span></a>
										</td>                          
									</tr><?php
								} ?>
								</tbody>
							</table>	
							</div>
						</section>
						<?php
						
						} else { ?>
							<div class="alert alert-info no-border-radius" role="alert">
								<strong>Oh shit!</strong> Aucun objet est en vente pour ce serveur ainsi que cet catégorie.
							</div>
						<?php 
						}
					}
				} ?>
				<!-- End selecter of category -->
				
				
				
			</div>
			<!-- ./leftside -->			