			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Profile</li>
				</ol>	
				
				<?php 
				if(!isset($_SESSION['user'])) {
					echo "<script>window.location.replace(\"?page=signin\")</script>";
					return;
				} else {
					$query = $login -> prepare("SELECT * FROM world_accounts WHERE account = '" . $_SESSION['user'] . "';");
					$query -> execute();
					$query -> setFetchMode(PDO:: FETCH_OBJ);
					$row = $query -> fetch();	
					$query -> closeCursor();
				} ?>
			
				<div class="title">
					<h2 class="headline margin-bottom-10">Bonjour, <?php echo $row -> pseudo; ?> !</h2>
					<h2 class="page-header text-center no-margin-top"></h2>
				</div>
				<div class="section section-default padding-25" >			
					<div style="display:inline-flex;">
						<img class="img-thumbnail" alt="140x140" src="<?php echo URL_SITE . 'img/avatar.jpg'; ?>" style="width: 140px; height: 140px;">
						<div style="margin-left: 25px; ">
							<strong>Informations :</strong><br><br><br>
							Pseudo : <?php echo $row -> pseudo; ?><br>
							Date d'inscription : <?php echo $row -> dateRegister; ?><br>
							Dernière connexion : <?php echo (empty($row -> lastConnectionDate) ? "aucune." : parseDate($row -> lastConnectionDate)); ?><br>
							Nombre de vote(s) : <?php echo $row -> totalVotes; ?><br>	
							Point(s) de boutique : <?php echo $row -> points; ?><br>		
						</div>						
					</div>
				</div>	
				<?php 
				$option = $row -> showOrHide;				
				if(isset($_POST['ok1'])) {
					$option = ($option ? 0 : 1);
					$query = $login -> prepare("UPDATE world_accounts SET `showOrHide` = " . $option . " WHERE account = '" . $_SESSION['user'] . "';");
					$query -> execute();
					$query -> closeCursor();
				}
				?>
				<form class="form-inline" method="post" action="#" role="form">
					<div class="alert alert-warning no-border-radius" style="width: 58%; margin-right: 5px;">
						Tu es actuellement <?php echo ($option ? "<b>visible</b>" : "<b>invisible</b>"); ?> dans l'armurerie !
					</div>
					<button type="submit" class="btn btn-info btn-icon-right" name="ok1" style="height: 46px; width: 40%; font-size: 15px;"><?php echo ($option ? "<i class='ion-eye-disabled'></i> Être invisible" : "<i class='ion-eye'></i> Être visible"); ?></button>		  
				</form>
				<?php 
				$option = $row -> showOrHidePos;				
				if(isset($_POST['ok2'])) {
					$option = ($option ? 0 : 1);
					$query = $login -> prepare("UPDATE world_accounts SET `showOrHidePos` = " . $option . " WHERE account = '" . $_SESSION['user'] . "';");
					$query -> execute();
					$query -> closeCursor();
				}
				?>
				<form class="form-inline" method="post" action="#" role="form">
					<div class="alert alert-warning no-border-radius" style="width: 58%; margin-right: 5px;">
						La position de tes joueurs est <?php echo ($option ? "<b>visible</b>" : "<b>invisible</b>"); ?> sur le site !
					</div>
					<button type="submit" class="btn btn-info btn-icon-right" name="ok2" style="height: 46px; width: 40%; font-size: 15px;"><?php echo ($option ? "<i class='ion-eye-disabled'></i> Être invisible" : "<i class='ion-eye'></i> Être visible"); ?></button>		  
				</form>
				
				<div class="default-tab">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="<?php if(!isset($_POST['change-pass'])) echo 'active'; ?>"><a href="#players" style="color: #363636;!important" id="players-tab" role="tab" data-toggle="tab" aria-controls="players" aria-expanded="<?php echo !isset($_POST['change-pass']); ?>"><i class="ion-person-stalker"></i> Personnage(s)</a></li>
						<li role="presentation" class="<?php if(isset($_POST['change-pass'])) echo 'active'; ?>"><a href="#settings" role="tab" style="color: #363636;!important" id="settings-tab" data-toggle="tab" aria-controls="settings" aria-expanded="<?php echo isset($_POST['change-pass']); ?>"><i class="ion-settings"></i> Gestion</a></li>
						<li role="presentation" class=""><a href="#reload" role="tab" style="color: #363636;!important" id="reload-tab" data-toggle="tab" aria-controls="reload" aria-expanded="false"><i class="ion-card"></i> Rechargement de points</a></li>
					</ul>
	
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade <?php if(!isset($_POST['change-pass']) && !isset($_POST['key'])) echo 'active in'; ?>" id="players" aria-labelledby="players-tab">
							<div class="row">
							<div class="col-md-12">
								<section class="section margin-top-20 margin-bottom-20 no-border">
								<?php				
								$query = $login -> prepare("SELECT name, class, xp, level, sexe, account, alignement FROM world_players WHERE account = " . $_SESSION['id'] . ";");
								$query -> execute();
								$count = $query -> rowCount();
								$query -> setFetchMode(PDO:: FETCH_OBJ);
								$i = 1;
										
								if($count) { ?>
									<section class="section section-white no-border no-padding-top">	
									<div class="box no-border-radius padding-20">
									<table class="table table-striped no-margin">
									<thead>
										<tr>
											<th>#</th>
											<th>Nom</th>
											<th class="hidden-sm">Classe</th>
											<th>Niveau</th>
											<th>Expérience</th>
											<th>Alignement</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
									while($row1 = $query -> fetch()) { ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row1 -> name; ?></td>
											<td class="hidden-sm"><img src ="<?php echo URL_SITE . 'img/dofus/img/class/' . ($row1 -> class * 10 + $row1 -> sexe) . '.png'; ?>" /></td>
											<td><?php echo $row1 -> level; ?></td>
											<td> 
												<?php 
												if($row1 -> level != 200) {
													$query2 = $jiva -> prepare('SELECT lvl, perso FROM experience WHERE lvl = ' . $row1 -> level . ';');
													$query2 -> execute();
													$query2 -> setFetchMode(PDO:: FETCH_OBJ);
													$row2 = $query2 -> fetch();
													$query2 -> closeCursor();
													
													$query3 = $jiva -> prepare('SELECT lvl, perso FROM experience WHERE lvl = ' . ($row1 -> level + 1) . ';');
													$query3 -> execute();
													$query3 -> setFetchMode(PDO:: FETCH_OBJ);
													$row3 = $query3 -> fetch();
													$query3 -> closeCursor();
													
													$xpActuel = $row1 -> xp;
													$xpMax1 = $row2 -> perso;
													$xpMax2 = $row3 -> perso;
													
													$pourcent = ($xpActuel - $xpMax1) / ($xpMax2 - $xpMax1) * 100;
													
													if($pourcent < 10)
														echo '0' . substr($pourcent * 100, 0, 1) . '%';
													else
														echo substr($pourcent * 100, 0, 2) . '%';
												} else {
													echo '100%';
												}
												?>
											</td>
											<td class="hidden-sm"><img style="border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px;" src="<?php echo URL_SITE . 'img/dofus/img/align/' . $row1 -> alignement . '.jpg'; ?>" /></td>
										</tr>
									<?php $i++;	
									} 
									$query -> closeCursor();?>
									</tbody>
									</table>	
									</div>
									</section>
									<?php
								} else { ?>
									<div class="alert alert-info no-border-radius" style="text-align: center;">
										<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage correspondant à votre compte.
									</div>
								<?php
								} ?>
								</section>								
							</div>
							</div>
						</div>
	
						<div role="tabpanel" class="tab-pane fade <?php if(isset($_POST['change-pass']) && !isset($_POST['key'])) echo 'active in'; ?>" id="settings" aria-labelledby="settings-tab">
							<div class="row">
								<div class="col-md-12">
									<section class="section margin-top-20 margin-bottom-20 no-border">
										<h4 class="page-header no-margin-top">Changement de mot de passe</h4>
										<?php
										if(isset($_POST['change-pass'])) {
											$answer = $_POST['answer'];
											$newPass = $_POST['password'];
											$newPassConf = $_POST['password-repeat'];
											
											$error = -1;
											
											if(empty($answer) || empty($newPass) || empty($newPassConf)) {
												$error = 1;
											} else {
												$count = false;
												$query = $login -> prepare("SELECT * FROM `world_accounts` WHERE `reponse` = ?;");
												$query -> bindParam(1, $answer);
												$query -> execute();
												$count = $query -> rowCount();
												$query -> closeCursor();
												
												if(!$count) {
													$error = 3;
												} else {
													if(strcmp($newPass, $newPassConf) !== 0) {
														$error = 4;
													} else {
														$newPass = hash('SHA512', md5($newPass));
														$query = $login -> prepare("UPDATE `world_accounts` SET `pass` = ? WHERE `account` = ?;");
														$query -> bindParam(1, $newPass);	
														$query -> bindParam(2, $_SESSION['user']);	
														$query -> execute();
														$query -> closeCursor();
													}
												}
											}
											
											switch($error) {
												case 1:
													echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh shit!</strong> Un des champs est invalide !
													</div><br />";
													break;
												case 2:
													echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh shit!</strong> Un des champs comporte des caractères indésirable !
													</div><br />";
													break;
												case 3:
													echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh shit!</strong> La réponse secrète est incorrecte !
													</div><br />";
													break;
													
												case 4:
													echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh shit!</strong> Les mots de passe ne sont pas identique !
													</div><br />";
													break;
												default:
													echo "<div class='alert alert-success no-border-radius no-margin' style='text-align: center!important;' role='success'>
													<strong>Oh good!</strong> Vous avez désormais changer votre mot de passe !
													</div><br />";
													break;

											}
										}
										?>									
										<form role="form" method="post" action="#">
											<div class="form-group">
												<label for="answer"><?php echo 'Question : ' . $row -> question; ?></label>
												<input type="text" class="form-control margin-top-5" id="answer" name="answer" placeholder="La réponse est..">
											</div>
											<div class="form-group">
												<label for="password">Nouveau mot de passe</label>
												<input type="password" class="form-control margin-top-5" id="password" name="password" placeholder="">
											</div>
											<div class="form-group">	
												<label for="password-repeat">Confirmation du nouveau mot de passe</label>
												<input type="password" class="form-control margin-top-5" id="password-repeat" name="password-repeat" placeholder="">	
											</div>
											<button type="submit" name="change-pass"class="btn btn-success">Confirmer</button>
										</form>
									</section>
								</div>	
							</div>
						</div>
									
						<div role="tabpanel" class="tab-pane fade <?php if(isset($_POST['key'])) echo 'active in'; ?>"" id="reload" aria-labelledby="reload-tab">
							<div class="row">
								<div class="col-md-12">
									<section class="section margin-top-10 margin-bottom-20 no-border">	
										<?php
										if(isset($_POST['key'])) {
											$public_key  = isset($_POST['key']) ? preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['key']) : '';
											$code = isset($_POST['code']) ? preg_replace('/[^a-zA-Z0-9]+/', '', $_POST['code']) : '';
											$rate = isset($_POST['rate']) ? preg_replace('/[^a-zA-Z0-9\-]+/', '', $_POST['rate']) : '';
											
											if($public_key == "39f0c66d81c066b8778f034e871fb606") {
												if(empty($code)) {
													echo 'Vous devez définir un code';
												} else if(empty($rate)) {
													echo 'Vous devez choisir un palier';
												} else {
										
													$dedipass = file_get_contents('http://api.dedipass.com/v1/pay/?key='.$public_key.'&rate='.$rate.'&code='.$code);
													$dedipass = json_decode($dedipass);
													$code = $dedipass->code; // Le code
													$rate = $dedipass->rate; // Le palier
													if($dedipass -> status == 'success') {
														$explode = explode("-", $rate);
														$points = $dedipass->virtual_currency; 
														$actualPoints = $row -> points;
														$newPoints = $actualPoints + $points;
														
														$query = $login -> prepare("UPDATE `world_accounts` SET `points` = ? WHERE `account` = ?;");
														$query -> bindParam(1, $newPoints);	
														$query -> bindParam(2, $_SESSION['user']);	
														$query -> execute();
														$query -> closeCursor();
														
														$query = $login -> prepare("INSERT INTO `website_shop_points_purchase` VALUES(?, ?, ?, ?, ?, ?);");
														$query -> bindParam(1, $row -> account);	
														$query -> bindParam(2, $points);	
														$query -> bindParam(3, $code);	
														$var1 = $explode[0] . "-" . $explode[1];
														$query -> bindParam(4, $var1);	
														$var2 = $explode[2] . "-" . $explode[3];
														$query -> bindParam(5, $var2);	
														$time = date('d/m/Y H:i');
														$query -> bindParam(6, $time);	
														
														$query -> execute();
														$query -> closeCursor();
														
														echo "<div class='alert alert-success no-border-radius no-margin' style='text-align: center!important;' role='success'><strong>Oh good !</strong> Vous avez été créditer de <b>" . $points . "</b> points soit un total de <b>" . $newPoints . "</b> points !</div><br />";
													} else {
														echo "<div class='alert alert-danger no-border-radius no-margin' style='text-align: center!important;' role='success'><strong>Oh shit !</strong> Le code <b>" . $code . "</b> est invalide ou déjà utiliser !</div><br />";
													}
												}
											}
										}
										?>
										<div class='alert alert-warning no-border-radius no-margin' style='text-align: center!important;' role='success'>
											<strong>Oh wait !</strong> Toutes les transactions sont enregistrés ainsi nous pouvons vérifier le statut d'un code, ceci dit, nous ne sommes en aucun cas responsable des problèmes de code incorrecte venant de DEDIPASS. Il est préférable que vous les contactiez en cas problème lié au système. Merci.
										</div><br />
										<div data-dedipass="39f0c66d81c066b8778f034e871fb606"></div>
									</section>
								</div>	
							</div>	
						</div>
					</div>
				</div>
			</div>
			<!-- ./leftside -->			
			<script src="//api.dedipass.com/v1/pay.js"></script>