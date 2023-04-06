<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- sidebar -->
			<div class="sidebar">
				<a href="<?php echo URL_SITE . '?page=vote'; ?>" class="btn btn-warning btn-block btn-md btn-bold margin-bottom-15">Vote&nbsp; <i class="fa fa-sign-in"></i> &nbsp;RPG-Paradize</a>
				
				<!-- section -->
				<div class="section section-default">
					<div class="title dark-grey no-margin padding-10-15">
						<i class="ion-game-controller-a"></i> Etat des serveurs
					</div>
									
					<div class="tab-content padding-15">
						<ul id="Connexion" class="tab-pane active clearfix box">
							<!-- row -->
							<li class="row"> 
								<div class="col-md-2 no-padding"><img src="./img/servers/login.jpg"/></div>
								<div class="details col-md-10 no-padding-right">
									<div class="pull-left">
										<h5><a href="#">Serveur de connexion</a></h5>
										Connecté(s) : <?php 
										$query = $login -> prepare('SELECT COUNT(*) FROM world_players WHERE logged = 1;');
										$query -> execute();
										$row = $query -> fetch();
										$query -> closeCursor();
										echo $row['COUNT(*)']; 
										?>
									</div>
									
									<?php if(checkState(LOGIN_IP, LOGIN_PORT)) $state = "success"; else $state = "danger"; ?>
									
									<span class="label label-<?php echo $state ?> pull-right">
										<?php 
										if($state == "success") 
											echo '<i class="glyphicon glyphicon-ok"></i>'; 
										else 
											echo '<i class="glyphicon glyphicon-remove"></i>'; ?>
									</span>
								</div>
							</li>
						</ul>
						
						<ul id="Jiva" class="tab-pane active clearfix box">
							<!-- row -->
							<li class="row"> 
								<div class="col-md-2 no-padding"><img src="./img/servers/jiva.jpg"/></div>
								<div class="details col-md-10 no-padding-right">
									<div class="pull-left">
										<h5><a href="#" style="color: #2a5d9f">Jiva - Ankalike</a></h5>
										Connecté(s) : <?php 
										$query = $login -> prepare('SELECT COUNT(*) FROM world_players WHERE logged = 1 AND server = 601;');
										$query -> execute();
										$row = $query -> fetch();
										$query -> closeCursor();
										echo $row['COUNT(*)']; 
										?>
										<div class="info">
											<?php
											$query = $login -> prepare('SELECT * FROM world_servers WHERE `id` = 601;');
				                            $query -> execute();
											$query -> setFetchMode(PDO:: FETCH_OBJ);
											$server = $query -> fetch();
											$uptime = convertTimestampToUptime($server -> uptime);
											$query -> closeCursor();
											echo "Uptime : " . $uptime;
											?>
										</div>
									</div>
									
									<?php if(checkState(JIVA_IP, JIVA_PORT)) $state = "success"; else $state = "danger"; ?>
									
									<span class="label label-<?php echo $state; ?> pull-right">
										<?php 
										if($state == "success") 
											echo '<i class="glyphicon glyphicon-ok"></i>'; 
										else 
											echo '<i class="glyphicon glyphicon-remove"></i>'; ?>
									</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- ./section -->
								
				<!-- section -->
				<div class="section section-default">
					<div class="title dark-grey no-margin padding-10-15">
						<i class="ion-podium"></i> Statistique
					</div>
					<div class="padding-15">
						<ul class="box no-padding">
							<li class="no-padding-top no-padding-bottom"><br />
								<div class="facebook-like-box">
									<?php
									$query = $login -> prepare('SELECT COUNT(*) FROM world_accounts;');
									$query -> execute();
									$row = $query -> fetch();
									$query -> closeCursor();
									$inscris = $row['COUNT(*)'];
				
									$query = $login -> prepare('SELECT COUNT(*) FROM `world_guilds`;');
									$query -> execute();
									$row = $query -> fetch();
									$query -> closeCursor();
									$guildes = $row['COUNT(*)'];
									
									$query = $login -> prepare('SELECT COUNT(*) FROM `world_objects`;');
									$query -> execute();
									$row = $query -> fetch();
									$query -> closeCursor();
									$objets = $row['COUNT(*)'];
									
									$query = $login -> prepare('SELECT COUNT(*) FROM world_players;');
									$query -> execute();
									$row = $query -> fetch();
									$query -> closeCursor();
									$personnages = $row['COUNT(*)']; ?>
									
									<h4>Inscris&nbsp; : <?php echo $inscris; ?></h4>
									<br/><h4>Guildes&nbsp; : <?php echo $guildes; ?></h4>
									<br/><h4>Objets&nbsp; : <?php echo $objets; ?></h4>
									<br/><h4>Personnages&nbsp; : <?php echo $personnages; ?></h4>
								</div>
							<br /></li>
						</ul>
					</div>
				</div>
				<!-- ./section -->	
				
				<div class="section carousel-tab section-info">
					<div class="title no-margin">
						<i class="ion-ribbon-a" ></i> TOP 3 JOUEURS
					</div>
					<div class="jcarousel" data-jcarousel="true" data-jcarouselautoscroll="true">
						<ul class="box" style="left: 0px; top: 0px;">	
							<?php 

							$query = $login -> prepare('SELECT * FROM world_players WHERE groupe = -1 ORDER BY xp DESC LIMIT 0, 3;');
                  					$query -> execute();
         						$query -> setFetchMode(PDO:: FETCH_OBJ);
							
	           					$i = 1;
		
							while($row = $query -> fetch()) {
								$name = $row -> name;
								$class = $row -> class;
								$level = $row -> level;
								$sexe = $row -> sexe;
								
								$map = $jiva -> prepare('SELECT id, mappos FROM maps WHERE id = ' . $row -> map . ';');
								$map -> execute();
								$map -> setFetchMode(PDO:: FETCH_OBJ);
								$map_row = $map -> fetch();	
								$map -> closeCursor();
								
								$mappos = explode(",", $map_row -> mappos)[2];
								
								$sub = $login -> prepare('SELECT id, name FROM subarea_data WHERE id = ' . $mappos . ';');
								$sub -> execute();
								$sub -> setFetchMode(PDO:: FETCH_OBJ);
								$sub_row = $sub -> fetch();	
								$sub -> closeCursor();
								
								$color = "";
								switch($i) {
								case 1: $color = "F5C553"; 
									echo '<li class="no-padding"><h4 class="padding-15"><a href="#"><i class="ion-trophy" style="color: #' . $color . ';"></i>
									' . $i . '<sup>er</sup> Joueur : ' . $name . '</a></h4><div class="padding-15"><p>
									Un jeune ' . convertClassIdToString($class, $sexe) . ', de niveau ' . $level . ' est le seul à être performant sur son expérience' . ($row -> showOrHidePos ? '.' : '
									et traverse en se moment même ' . $sub_row -> name . '.</p></div></li>');
									break;
								case 2: $color = "D1D1E3"; 
									echo '<li class="no-padding"><h4 class="padding-15"><a href="#"><i class="ion-trophy" style="color: #' . $color . ';"></i>
									' . $i . '<sup>er</sup> Joueur : ' . $name . '</a></h4><div class="padding-15"><p>
									Un jeune ' . convertClassIdToString($class, $sexe) . ', de niveau ' . $level . ' essaye de prendre possésion de la première place malgrè ça légére infériorité.' . ($row -> showOrHidePos ? '' : 
									' Il traverse en se moment même ' . $sub_row -> name . '.</p></div></li>');
									break;
								case 3: $color = "E48644"; 
									echo '<li class="no-padding"><h4 class="padding-15"><a href="#"><i class="ion-trophy" style="color: #' . $color . ';"></i>
									' . $i . '<sup>er</sup> Joueur : ' . $name . '</a></h4><div class="padding-15"><p>
									Un jeune ' . convertClassIdToString($class, $sexe) . ', de niveau ' . $level . ' à l\'amibition d\'être à la première place, même s\'il lui reste pas mal de travail !' . ($row -> showOrHidePos ? '' : 
									' Il traverse en se moment même ' . $sub_row -> name . '.</p></div></li>');
									break;
								}

								$i++;
							}
							$query -> closeCursor();
							?>
						</ul>
					</div>
					<div class="jcarousel-pagination" data-jcarouselpagination="true"><a href="#1" class="active">1</a><a href="#2" class="">2</a></div>
				</div>
				
				<?php 
				$query = $login -> prepare('SELECT COUNT(*) FROM world_players WHERE groupe = -1 AND deshonor > 0;');
				$query -> execute();
				$row = $query -> fetch();
				$query -> closeCursor();
				$i = $row['COUNT(*)'];
				if($i > 0) {
					?>
					<div class="section carousel-tab section-warning">
						<div class="title text-dark no-margin">
							<i class="ion-nuclear"></i><?php echo '<span style="color: red">' . $i . '</span>'; ?> Recherché(s) ! 
						</div>
						<div class="jcarousel" data-jcarousel="true" data-jcarouselautoscroll="true">
							<ul class="box" style="left: 0px; top: 0px;">	
								<?php
								$query = $login -> prepare('SELECT * FROM world_players WHERE groupe = -1 AND deshonor > 0 ORDER BY deshonor DESC LIMIT 0, 5;');
								$query -> execute();
								$query -> setFetchMode(PDO:: FETCH_OBJ);
								
								$i = 1;							
								while($row = $query -> fetch()) {
									if($i > 5) break;
					
									$name = $row -> name;
									$class = $row -> class;
									$sexe = $row -> sexe;
									$level = $row -> level;
									$logged = $row -> logged;
									
					
									$map = $jiva -> prepare('SELECT id, mappos FROM maps WHERE id = ' . $row -> map . ';');
									$map -> execute();
									$map -> setFetchMode(PDO:: FETCH_OBJ);
									$map_row = $map -> fetch();	
									$map -> closeCursor();
									
									$mappos = explode(",", $map_row -> mappos);
									
									$sub = $login -> prepare('SELECT id, name FROM subarea_data WHERE id = ' . $mappos[2] . ';');
									$sub -> execute();
									$sub -> setFetchMode(PDO:: FETCH_OBJ);
									$sub_row = $sub -> fetch();	
									$sub -> closeCursor();
									
									$subName = $sub_row -> name;
									
									?><li class="no-padding clearfix">
										<h4 class="padding-15"><a href="#"><?php echo $name . ' - Niveau ' . $level; ?> </a></h4>
					
										<div class="padding-15">
											<p>Un satané <b><?php echo convertClassIdToString($class, $sexe); ?></b> c'est attaqué à un jeune aventurier sans défense, ni compagnie.
											Cet <?php if($sexe == 0) echo 'homme'; else echo 'femme'; ?> mérite une correction ! </p>
											<p>
											<?php 
											switch($logged) {
											case 0:
												echo "Nous ne possédons pour l'instant aucune information concernant sa position..";
												break;
											case 1:
												echo "Cet personne a été récement vue à travers " . $subName . " ( <b>" . $mappos[0] ." ; " . $mappos[1] . "</b>) !";
												break;
											} ?>
											</p>
										</div>
									</li><?php
									
									$i++;
								}
								$query -> closeCursor();	
								?>
							</ul>
						</div>
						<div class="jcarousel-pagination" data-jcarouselpagination="true"><a href="#1" class="active">1</a><a href="#2" class="">2</a></div>
					</div>
				<?php
				} ?>
				<!-- section -->
				<div class="section section-default">
					<div class="title dark-grey no-margin padding-10-15">
						<i class="ion-thumbsup"></i> Facebook
					</div>
					<div class="padding-15">
						<ul class="box no-padding">
							<li class="no-padding-top no-padding-bottom">
								<div class="fb-page" data-href="https://www.facebook.com/Aestia-447842705416732" data-width="300" data-height="281" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"></div>						
							</li>
						</ul>
					</div>
				</div>
				<!-- ./section -->
			</div><!-- ./sidebar -->
