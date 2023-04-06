 			<?php if(!isset($_SESSION['user']) || ($_SESSION['data'] -> account != "locos975" && $_SESSION['data'] -> account != "mimikg29pvphl")) exit; ?>
			<div class="leftside">
					<ol class="breadcrumb">
						<li><a href="?page=index">Accueil</a></li>
						<li class="active">Panel d'administration</li>
					</ol>	
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<section class="no-border no-padding-top">
							<div class="page-header margin-top-10"><h4>Gestions des web news</h4></div>
							<div class="section section-default padding-25">
								<?php if(isset($_POST["webNews"]) && isset($_POST["title"]) && isset($_POST["content"])) {
									if(!empty($_POST["title"]) && !empty($_POST["content"])) {
										$query = $login -> prepare("INSERT INTO `website_timeline_news`(title, content, date) VALUES (?, ?, ?);");
										$query -> bindParam(1, $_POST["title"]);
										$query -> bindParam(2, $_POST["content"]);
										$date = date('d-m-Y');
										$query -> bindParam(3, $date);
										$query -> execute();
										$query -> closeCursor();
										echo '<div class="alert alert-success no-border-radius no-margin" role="alert"><strong>Oh good!</strong> La nouvelle a été ajouter avec succès !</div><br>';
									}
								} ?>
								<form method="post" action="#addWN">
									<div class="col-md-12 col-xs-12 no-padding">
										<div class="control-group col-md-12 no-padding">
											<div class="controls">
												<input type="text" class="form-control" name="title" placeholder="Titre" required>
											</div>
										</div>
									</div>
									<div class="control-group col-md-12 no-padding col-xs-12 margin-top-15">
										<div class="controls">
											<textarea class="form-control" name="content" rows="3" style="max-width: 100%;" placeholder="Votre contenu.."></textarea>
										</div>
									</div>
									<button type="submit" class="btn btn-success btn-outline pull-left margin-top-15" name="webNews" style="width:100%;">Envoyer</button>
								</form>	
							</div>
						</section>
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<section class="section section-white no-border no-padding-top">	
						<div class="section section-default padding-25">
							<?php 
							if(isset($_GET['wNews']) && is_numeric($_GET['wNews']) && isset($_GET['remove'])) {
								$query = $login -> prepare("DELETE FROM `website_timeline_news` WHERE `id` = ?;");
								$query -> bindParam(1, $_GET['wNews']);
								$query -> execute();
								$query -> closeCursor();
								echo '<div class="alert alert-success no-border-radius no-margin" role="alert"><strong>Oh good!</strong> La nouvelle a été supprimer avec succès !</div><br>';
							} ?>
							<div class="box no-border-radius">
								<table class="table table-striped no-margin">
									<thead>
										<tr>
											<th class="padding-left-15">#</th>
											<th>Titre</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = $login -> prepare("SELECT * FROM `website_timeline_news` ORDER BY `id` DESC;");
										$query -> execute();
										
										while($row = $query -> fetch()) { ?>
										<tr>
											<td class="padding-left-15"><?php echo $row['id']; ?></td>
											<td><?php echo $row['title']; ?></td>
											<td>
												<span class="btn btn-info btn-outline btn-sm" data-toggle="tooltip" title="" data-original-title="Modifier"><i class="ion-edit"></i></span>
												<a href="?page=administration&wNews=<?php echo $row['id']; ?>&remove"<span class="btn btn-danger btn-outline btn-sm" data-toggle="tooltip" title="" data-original-title="Supprimer"><i class="ion-trash-b"></i></span>
											</td>                          
										</tr><?php
										}
										$query -> closeCursor(); ?>
									</tbody>
								</table>	
							</div>
							</div>
						</section>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<section class="no-border no-padding-top">
							<div class="page-header margin-top-10"><h4>Gestions des game news</h4></div>
							<div class="section section-default padding-25">
								<?php if(isset($_POST["gameNews"]) && isset($_POST["title"]) && isset($_POST["type"])) {
									if(!empty($_POST["title"]) && !empty($_POST["type"])) {
										$query = $login -> prepare("INSERT INTO `client_rss_news`(title, date, icon) VALUES (?, ?, ?);");	
										$query -> bindParam(1, $_POST["title"]);
										$date = date('Ymd');
										$query -> bindParam(2, $date);
										$query -> bindParam(3, $_POST["type"]);
										$query -> execute();
										$query -> closeCursor();
										echo '<div class="alert alert-success no-border-radius no-margin" role="alert"><strong>Oh good!</strong> La nouvelle a été ajouter avec succès !</div><br>';
									}
								} ?>
								<form method="post" action="#addWN">
									<div class="col-md-12 col-xs-12 no-padding">
										<div class="control-group col-md-12 no-padding">
											<div class="controls">
												<input type="text" class="form-control" name="title" placeholder="Titre" required>
											</div>
										</div>
									</div>
									<div class="control-group col-md-12 no-padding col-xs-12 margin-top-15">
										<div class="controls">
											<select name="type" class="form-control">
												<option disabled selected>Intitulé</option>
												<option value="News">Nouvelle</option>
												<option value="Event">Evénement</option>
												<option value="Update_fr">Mise à jour</option>
												<option value="Maintenance">Maintenance</option>	
											</select>
										</div>
									</div>
									<button type="submit" class="btn btn-success btn-outline pull-left margin-top-15" name="gameNews" style="width:100%;">Envoyer</button>
								</form>	
							</div>
						</section>
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-12 col-xs-12">
						<section class="section section-white no-border no-padding-top">	
						<div class="section section-default padding-25">
							<?php 
							if(isset($_GET['gNews']) && is_numeric($_GET['gNews']) && isset($_GET['remove'])) {
								$query = $login -> prepare("DELETE FROM `client_rss_news` WHERE `id` = ?;");	
								$query -> bindParam(1, $_GET['gNews']);
								$query -> execute();
								$query -> closeCursor();
								echo '<div class="alert alert-success no-border-radius no-margin" role="alert"><strong>Oh good!</strong> La nouvelle a été supprimer avec succès !</div><br>';
							} ?>
							<div class="box no-border-radius">
								<table class="table table-striped no-margin">
									<thead>
										<tr>
											<th class="padding-left-15">#</th>
											<th>Titre</th>
											<th>Icone</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = $login -> prepare("SELECT * FROM `client_rss_news` ORDER BY `id` DESC;");	
										$query -> execute();
										
										while($row = $query -> fetch()) { ?>
										<tr>
											<td class="padding-left-15"><?php echo $row['id']; ?></td>
											<td><?php echo $row['title']; ?></td>
											<td>
												<?php 
												switch($row['icon']) {
													case "News": echo "Nouvelle"; break;
													case "Event": echo "Evénement"; break;
													case "Update_fr": echo "Mise à jour"; break;
													case "Maintenance": echo "Maintenance"; break;
												} ?>
											</td>
											
											<td>
												<a href="?page=administration&gNews=<?php echo $row['id']; ?>&remove"<span class="btn btn-danger btn-outline btn-sm" data-toggle="tooltip" title="" data-original-title="Supprimer"><i class="ion-trash-b"></i></span>
											</td>                          
										</tr><?php
										}
										$query -> closeCursor(); ?>
									</tbody>
								</table>	
							</div>
							</div>
						</section>
					</div>
				</div>			
			</div>
			<!-- ./leftside -->			