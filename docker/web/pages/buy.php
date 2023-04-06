			<?php if(!isset($_SESSION['user']) || !isset($_GET['template']) || !isset($_GET['server'])) {
				echo "<script>window.location.replace(\"?page=signin\")</script>";
				return;	
			}?>
			<div class="leftside">
				<ol class="breadcrumb">
					<li><a href="?page=index">Accueil</a></li>
					<li class="active">Achat</li>
				</ol>	
				<?php 
				if(isset($_POST['ok1']) && isset($_GET['template']) && isset($_GET['server'])) {
					$template = $_GET['template'];
					$server = $_GET['server'];
					if(!empty($template) && is_numeric($template) && !empty($server) && is_numeric($server)) {
						$template = $_GET['template'];
						$server = $_GET['server'];
						
						$query1 = $connection -> prepare("SELECT * FROM `website_shop_objects` WHERE `template` = " . $template . ";");
						$query1 -> execute();
						$count1 = $query1 -> rowCount();
						$query1 -> setFetchMode(PDO:: FETCH_OBJ);
						
						$pdo = null;
						switch($server) {
							case 1:
								$pdo = $jiva;
						}
					
						if($count1 && $pdo != null) {
						
							$query2 = $login -> prepare("SELECT guid, points FROM world_accounts WHERE `guid` = " . $_SESSION['id'] . ";");
							$query2 -> execute();
							$query2 -> setFetchMode(PDO:: FETCH_OBJ);
							
							$row1 = $query1 -> fetch();
							$query1 -> closeCursor();
							$row2 = $query2 -> fetch();
							$query2 -> closeCursor();
							
							$price = $row1 -> price;
							$curPoints = $row2 -> points;
							
							if($price > $curPoints) {
								echo '<div class="alert alert-danger no-border-radius" role="alert">
									<strong>Oh shit!</strong> Tu n\'as pas assez de points pour acheter cet objet. Il te manque ' . ($price - $curPoints) . ' point(s) boutique !
									</div>';
							} else {
								$newPoints = $curPoints - $price;
								if($newPoints < 0) $newPoints = 0;

								$query = $pdo -> prepare("SELECT * FROM gifts WHERE `id` = " . $_SESSION['id'] . ";");			
								$query -> execute();
								$query -> setFetchMode(PDO:: FETCH_OBJ);
								$row = $query -> fetch();
								$query -> closeCursor();
							
								$gifts = $row -> objects;
								
								if(empty($gifts)) {
									$gifts = $template . ',1,' . ($row1 -> jp);
								} else {
									if(strstr($gifts, $template)) {
										$split = explode(';', $gifts); $line = "";
										
										foreach($split as $element) {
											if(strstr($element, $template)) {
												$line = $element;
												break;
											}
										}
										
										$split = explode(',', $line);
										$quantity = $split[1];
										
										if(strstr($gifts, $template . ',' . $quantity . ',' . ($row1 -> jp))) {
											$gifts = str_replace($line, ($template . "," . ($quantity + 1) . "," . ($row1 -> jp)), $gifts);
										} else {
											$gifts .= ';' . $template . ',1,' . ($row1 -> jp);
										}										
									} else {
										$gifts .= ';' . $template . ',1,' . ($row1 -> jp);
									}	
								}
								
								$query = $pdo -> prepare("UPDATE gifts SET `objects` = '" . $gifts . "' WHERE `id` = " . $_SESSION['id'] . ";");			
								$query -> execute();
								$query -> closeCursor();
								
								$query = $login -> prepare("UPDATE world_accounts SET `points` = " . $newPoints . " WHERE `guid` = " . $_SESSION['id'] . ";");
								$query -> execute();
								$query -> closeCursor();
								
								$query = $connection -> prepare("INSERT INTO `website_shop_purchase` (account, template, server, date) VALUES ('".$_SESSION['id']."', '".$template."','".$server."', '" . date('d/m/y H:i') . "~');");
								$query -> execute();
								$query -> closeCursor();
								
								echo '<div class="alert alert-info no-border-radius" role="alert">
								<strong>Oh good!</strong> L\'achat c\'est effectué avec succès, il te reste ' . $newPoints . ' point(s) boutique !
								</div>';
							}						
						} else {
							echo '<div class="alert alert-danger no-border-radius" role="alert">
								<strong>Oh shit!</strong> Une erreur c\'est produite veuillez réessayer.
								</div>';
						}
					}					
				} else if(isset($_GET['template']) && isset($_GET['server'])) {
					$template = $_GET['template'];
					$server = $_GET['server'];
					if(!empty($template) && is_numeric($template) && !empty($server) && is_numeric($server)) {
						$query1 = $connection -> prepare("SELECT * FROM `website_shop_objects` WHERE `template` = " . $template . ";");
						$query1 -> execute();
						$count1 = $query1 -> rowCount();
						$query1 -> setFetchMode(PDO:: FETCH_OBJ);
						
						$query2 = $login -> prepare('SELECT id, name FROM world_servers WHERE id = ' . $server . ';');
						$query2 -> execute();
						$count2 = $query2 -> rowCount();
						
						if($count1 && $count2) {
							$object = $query1 ->fetch();
							$query1 -> closeCursor(); 
							
							$row = $query2 -> fetch();
							$query2 -> closeCursor();							
							$server = $row['name'];
							
							$category = $object -> category;
							
							$query1 = $connection -> prepare('SELECT id, name FROM `website_shop_categories` WHERE id = ' . $category . ';');
							$query1 -> execute();
							$row = $query1 -> fetch();
							$query1 -> closeCursor();							
							$category = $row['name'];
							
							$query1 = $connection -> prepare('SELECT id, name, skin, level, effects FROM `website_shop_objects_templates` WHERE id = ' . $template . ';');
							$query1 -> execute();
							$row = $query1 -> fetch();
							$query1 -> closeCursor();	
							$name = $row['name'];
							$skin = $row['skin'];
							$level = $row['level'];
							$effects = $row['effects'];
						
							?>
							<div class="alert alert-info no-border-radius" role="alert">
								Vous êtes sur le point d'acheter un(e) <?php echo $category; ?> sur le serveur <strong><?php echo $server; ?></strong> !
							</div>
								
							<div class="section section-default padding-25" data-toggle="tooltip" title="" data-original-title="<?php if($effects == "") echo "Aucun"; else  echo convertStatsToString($effects);?>" data-html="true">			
								<div style="display:inline-flex;">
									<object class="thumbnail" style="height: 140px;width: 140px;" type="application/x-shockwave-flash" data="<?php echo URL_SITE; ?>img/dofus/swf/items/item.swf">
										<param name="allowscriptaccess" value="always">
										<param name="flashvars" value="item=<?php echo URL_SITE; ?>img/dofus/swf/items/<?php echo $object -> category; ?>/<?php echo $skin; ?>.swf"/>
										<param name="wmode" value="transparent"/>
									</object>
									<div style="margin-left: 25px;">
										<strong>Informations :</strong><br>
										Nom : <?php echo $name; ?><br>
										Level : <?php echo $level; ?><br>
										Prix : <?php echo $object -> price; ?><br>
										Jet maximum : <?php echo ($object -> jp ? "Oui." : "Non."); ?><br>		
									</div>						
								</div>
							</div>
							<form method="post" action="">
								<button type="submit" name="ok1" class="btn btn-lg btn-block btn-info btn-outline">Êtes-vous sûr de vouloir acheter cet objet ?</button>
							</form>
							<?php							
						} else {
							echo "<script>window.location.replace(\"?page=signin\")</script>";
							return;
						}
					}
				} ?>
			</div>
			<!-- ./leftside -->			