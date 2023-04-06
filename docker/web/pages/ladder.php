<?php require_once('./class/PlayerJobs.class.php'); ?>
			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Classement</li>
				</ol>	
					
				<section class="section section-default padding-20">
					<div class="default-tab box">
						<ul id="myTab4" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="<?php if(!isset($_POST['ok'])) echo 'active'; ?>"><a href="#pvm" id="pvm-tab" role="tab" data-toggle="tab" aria-controls="pvm" aria-expanded="<?php if(!isset($_POST['ok'])) echo 'true'; else echo 'false'; ?>">PvM</a></li>
								<li role="presentation" class=""><a href="#pvp" role="tab" id="pvp-tab" data-toggle="tab" aria-controls="pvp" aria-expanded="false">PvP</a></li>
								<li role="presentation" class=""><a href="#guilds" role="tab" id="guilds-tab" data-toggle="tab" aria-controls="guilds" aria-expanded="false">Guildes</a></li>
								<li role="presentation" class="<?php if(isset($_POST['ok'])) echo 'active'; ?>"><a href="#jobs" role="tab" id="links-tab3" data-toggle="tab" aria-controls="jobs" aria-expanded="<?php if(isset($_POST['ok'])) echo 'true'; else echo 'false'; ?>">Métiers</a></li>
								<li role="presentation" class=""><a href="#votes" role="tab" id="links-tab5" data-toggle="tab" aria-controls="votes" aria-expanded="false">Votes</a></li>
						</ul>
			
						<div id="myTabContent4" class="tab-content padding-20">
							<div role="tabpanel" class="tab-pane fade <?php if(!isset($_POST['ok'])) echo 'active in'; else echo ''; ?>" id="pvm" aria-labelledby="pvm-tab">
								<div class="row">
									<div class="col-md-12">
										<?php				
										$query = $login -> prepare("SELECT * FROM world_players WHERE groupe = -1 ORDER BY xp DESC LIMIT 0, 50");
										
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
											while($row = $query -> fetch()) { ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row -> name; ?></td>
													<td class="hidden-sm"><img src ="<?php echo URL_SITE . 'img/dofus/img/class/' . ($row -> class * 10 + $row -> sexe) . '.png'; ?>" /></td>
													<td><?php echo $row -> level; ?></td>
													<td> 
														<?php 
														if($row -> level != 200) {
															$query2 = $jiva -> prepare('SELECT lvl, perso FROM experience WHERE lvl = ' . $row -> level . ';');
															$query2 -> execute();
															$query2 -> setFetchMode(PDO:: FETCH_OBJ);
															$row2 = $query2 -> fetch();
															$query2 -> closeCursor();
															
															$query3 = $jiva -> prepare('SELECT lvl, perso FROM experience WHERE lvl = ' . ($row -> level + 1) . ';');
															$query3 -> execute();
															$query3 -> setFetchMode(PDO:: FETCH_OBJ);
															$row3 = $query3 -> fetch();
															$query3 -> closeCursor();
															
															$xpActuel = $row -> xp;
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
													<td class="hidden-sm"><img style="border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px;" src="<?php echo URL_SITE . 'img/dofus/img/align/' . $row -> alignement . '.jpg'; ?>" /></td>
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
											<div class="alert alert-info no-border-radius" role="alert">
												<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage.
											</div>
										<?php
										} ?>	
									</div>
								</div>
							</div>

							<div role="tabpanel" class="tab-pane fade" id="pvp" aria-labelledby="pvp-tab">
								<div class="row">
									<div class="col-md-12">
										<?php				
										$query = $login -> prepare("SELECT * FROM world_players WHERE groupe = -1 ORDER BY honor DESC LIMIT 0, 50");
										
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
													<th>Alignement</th>
													<th>Honneur</th>
												</tr>
											</thead>
											
											<tbody>
											<?php
											while($row = $query -> fetch()) { ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row -> name; ?></td>
													<td class="hidden-sm"><img src ="<?php echo URL_SITE . 'img/dofus/img/class/' . ($row -> class * 10 + $row -> sexe) . '.png'; ?>" /></td>
													<td><?php echo $row -> level; ?></td>
													<td class="hidden-sm"><img style="border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px;" src="<?php echo URL_SITE . 'img/dofus/img/align/' . $row -> alignement . '.jpg'; ?>" /></td>
													<td><?php echo $row -> honor; ?></td>
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
											<div class="alert alert-info no-border-radius" role="alert">
												<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage.
											</div>
										<?php
										} ?>
									</div>
								</div>
							</div>
									
							<div role="tabpanel" class="tab-pane fade" id="guilds" aria-labelledby="guilds">
								<div class="row">
									<div class="col-md-12">
										<?php				
										$query = $login -> prepare("SELECT name, emblem, lvl, xp  FROM `world.entity.guilds` ORDER BY xp DESC LIMIT 0, 50;");
												
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
													<th>Niveau</th>
													<th>Expérience</th>
													<th>Emblème</th>
												</tr>
											</thead>
												
											<tbody>
											<?php
											while($row = $query -> fetch()) { 
												$embleme = explode(',', $row->emblem);
												$embleme['bgSrc'] = base_convert($embleme['0'], 36, 10);
												$embleme['bgColor'] = base_convert($embleme['1'], 36, 10);
												$embleme['logoSrc'] = base_convert($embleme['2'], 36, 10);
												$embleme['logoColor'] = base_convert($embleme['3'], 36, 10);

											?>	<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row -> name; ?></td>
													<td><?php echo $row -> lvl; ?></td>
													<td><?php echo $row -> xp; ?></td>
													<td>
														<object width="30" height="30" >
															<param name="movie" value="<?php echo URL_SITE . 'img/dofus/swf/guilds/DofusGuildes.swf'; ?>" />														<param name="play" value="true" />
															<param name="flashvars" value="bcgSrc=<?php echo $embleme['bgSrc']; ?>&bcgColor=<?php echo $embleme['bgColor']; ?>&frtSrc=<?php echo $embleme['logoSrc']; ?>&frtColor=<?php echo $embleme['logoColor']; ?>" />
															<param name="loop" value="true" />
															<param name="quality" value="high" />
															<param name="wmode" value="transparent" />
															<!--[if !IE]>-->
															<object id="logo_guilde_container" type="application/x-shockwave-flash" data="<?php echo URL_SITE . 'img/dofus/swf/guilds/DofusGuildes.swf'; ?>" width="50" height="50">
																<param name="play" value="true" />
																<param name="flashvars" value="bcgSrc=<?php echo $embleme['bgSrc']; ?>&bcgColor=<?php echo $embleme['bgColor']; ?>&frtSrc=<?php echo $embleme['logoSrc']; ?>&frtColor=<?php echo $embleme['logoColor']; ?>" />
																<param name="loop" value="true" />
																<param name="quality" value="high" />
																<param name="wmode" value="transparent" />
																<!--<![endif]-->
																<a href="http://www.adobe.com/go/getflashplayer">
																	<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
																</a>
																<!--[if !IE]>-->
															</object>
															<!--<![endif]-->
														</object>
													</td>
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
											<div class="alert alert-info no-border-radius" role="alert">
												<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage.
											</div>
										<?php
										} ?>
									</div>
								</div>
							</div>
						
							<div role="tabpanel" class="tab-pane fade <?php if(isset($_POST['ok'])) echo 'active in'; else echo ''; ?>" id="jobs" aria-labelledby="jobs">
								<div class="row">
									<div class="col-md-12">
										<form class="form-inline" role="form" method="post" action="#" style="margin-bottom: 10px;">
											<select class="form-control" style="width: 90%!important; height: 35px; padding: 6px 12px!important;" name="job">
												<?php 
												$query = $jiva -> prepare("SELECT id, name, skills FROM jobs_data WHERE  tools != '';");			
												$query -> execute();
												$count = $query -> rowCount();
												$query -> setFetchMode(PDO:: FETCH_OBJ);
												$jobsName = array();
												while($row = $query -> fetch()) {
													$jobsName[$row -> id] = $row -> name;
													echo '<option value="' . $row -> id . '" ' . (isset($_POST['job']) && $row -> id == $_POST['job']  ? 'selected' : '') . '>' . $row -> name . '</option>';
												}
												?>
											</select>
											<button type="submit" name="ok" class="btn btn-info">Ok</button>
										</form>
										
										<div class="panel panel-primary">
											<div class="panel-heading">Légende <small>( nom du métier au survolle )</small></div>
											<div class="panel-body">
												<?php 
												$query = $jiva -> prepare("SELECT id, name, skills FROM jobs_data WHERE  tools != '';");			
												$query -> execute();
												$count = $query -> rowCount();
												$query -> setFetchMode(PDO:: FETCH_OBJ);
												
												while($row = $query -> fetch()) {
													echo '<img style="margin:1px;" src="' . URL_SITE . 'img/dofus/img/job/' . $row -> id . '.png" data-toggle="tooltip" title="" data-original-title="' . $row -> name . '"/>';
												}
												?>
											</div>
										</div>
										
										<?php 
										
										if(isset($_POST['ok']) && isset($_POST['job'])) {
											$query = $login -> prepare("SELECT *  FROM world_players WHERE jobs LIKE '%" . $_POST['job'] . "%' LIMIT 0, 50;");
											$query -> execute();
											$count = $query -> rowCount();
											$query -> setFetchMode(PDO:: FETCH_OBJ);
										
											if($count) { ?>
												<section class="section section-white no-border no-padding-top">	
												<div class="box no-border-radius padding-20">
												<table class="table table-striped no-margin">
												<thead>
													<tr>
														<th>#</th>
														<th>Nom</th>
														<th>Métier</th>
														<th>Niveau</th>
														<th>Expérience</th>
														<th>Autre(s)</th>
													</tr>
												</thead>
													
												<tbody>
												<?php
												$players = array();
												$i = 0;
												while($row = $query -> fetch()) { 
													$split1 = explode(';', $row -> jobs);
													$currentJob = $_POST['job'];
													$currentJobXp = 0;
												        $otherJobs = array();
												        $nbr = 0;
													foreach($split1 as $element) {
														$split2 = explode(',', $element);
														
														if($split2[0] == $_POST['job']) {
															$currentJobXp = $split2[1];
															continue;
														}

														$otherJobs[$nbr] = $split2[0];
														$nbr++;
													} 
																									
													$query1 = $jiva -> prepare('SELECT lvl, metier FROM experience WHERE metier > ' . $currentJobXp . ';');
													$query1 -> execute();
													$row1 = $query1 -> fetch();
													$query1 -> closeCursor();
													$currentJobLvl = $row1['lvl'] - 1;
													
													if($currentJobLvl != 100) {
														$query2 = $jiva -> prepare('SELECT lvl, metier FROM experience WHERE lvl = ' . $currentJobLvl . ';');
														$query2 -> execute();
														$row2 = $query2 -> fetch();
														
														$query3 = $jiva -> prepare('SELECT lvl, metier FROM experience WHERE lvl = ' . ($currentJobLvl + 1) . ';');
														$query3 -> execute();
														$row3 = $query3 -> fetch();
													
														
														$xpActuel = $currentJobXp;
														$xpMax1 = $row2['metier'];
														$xpMax2 = $row3['metier'];
														
														if($xpMax2 - $xpMax1 != 0) {
															$pourcent = ($xpActuel - $xpMax1) / ($xpMax2 - $xpMax1) * 100;
															if($pourcent < 10)
																$pourcent = '0' . substr($pourcent * 100, 0, 1) . '%';
															else
																$pourcent = substr($pourcent * 100, 0, 2) . '%';
														} else {
															$pourcent = '00';
														}
                                                                                                                $query2 -> closeCursor();
                                                                                                                $query3 -> closeCursor();
													} else {
														$pourcent = '100';
													}												
													
													$players[$i]['lvl'] = $currentJobLvl;
													$players[$i]['xp'] = 1;
													$players[$i]['player'] = new PlayerJobs($row -> name, $currentJob, $currentJobLvl, $pourcent, $otherJobs);	
													$i++;
												}
												$query -> closeCursor(); 
												echo '2';
                                                                                                $players = array_sort($players, 'xp', SORT_DESC);
												$players = array_sort($players, 'lvl', SORT_DESC);
												
												//array_multisort($players, 'lvl', SORT_DESC, 'xp', SORT_DESC); 
												
												$i = 1;
												
												foreach($players as $player) { 
													$player = $player['player']; 
													if($player -> currentJobLvl == -1)
														continue; ?>	
													
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $player -> name; ?></td>
														<td><img src="<?php echo URL_SITE . 'img/dofus/img/job/' . $player -> currentJob . '.png'; ?>"/></td>
														<td><?php echo $player -> currentJobLvl; ?></td>
														<td><?php echo $player -> currentJobXp; ?></td>
														<td>
														<?php
														foreach($player -> otherJobs as $id) {
															echo '<img style="margin-right: 5px;" src="' . URL_SITE . 'img/dofus/img/job/' . $id . '.png" data-toggle="tooltip" title="" data-original-title="'. utf8_encode($jobsName[$id]) .'"/>';
														}
														?>
														</td>
													</tr>
												<?php $i++;													
												} 
												 ?>
												</tbody>
												</table>	
												</div>
												</section>
												<?php
											} else { ?>
												<div class="alert alert-info no-border-radius" role="alert">
													<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage possédant ce métier.
												</div>
											<?php
											}
										} ?>
									</div>
								</div>
							</div>
							
							<div role="tabpanel" class="tab-pane fade" id="votes" aria-labelledby="votes-tab">
								<div class="row">
									<div class="col-md-12">
										<?php				
										$query = $login -> prepare("SELECT pseudo, votes FROM world_accounts ORDER BY votes DESC LIMIT 0, 50;");
												
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
													<th>Pseudo</th>
													<th>Nombre de vote</th>
												</tr>
											</thead>
												
											<tbody>
											<?php
											while($row = $query -> fetch()) { ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $row -> pseudo; ?></td>
													<td><?php echo $row -> votes; ?></td>
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
											<div class="alert alert-info no-border-radius" role="alert">
												<strong>Oh shit!</strong> Désolé, il n'y a encore aucun personnage.
											</div>
										<?php
										} ?>
									</div>
								</div>
							</div>

							
						</div>
					</div>
				</section>	
			</div>
			<!-- ./leftside -->				
